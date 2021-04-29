<?php

namespace App\Http\Controllers;

use App\Models\EmailTracker;
use App\Models\EmailTrackerAudience;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmailTrackerController extends Controller
{
    public function getChart()
    {
        $emailStat['title'] = array_fill(0, 25, 0);
        $emailStat['ratio'] = array_fill(0, 25, 0);

        $emailTrackers = EmailTracker::orderBy('id', 'DESC')->take(25)->withCount('audiences')->get()->toArray();
        $emailTrackers = array_reverse((array) $emailTrackers);

        foreach ($emailTrackers as $key => $email){
            $emailStat['title'][$key] = $email['title'];
        }

        foreach ($emailTrackers as $key => $email){
            $emailStat['ratio'][$key] = intval(($email['audiences_count'] / $email['num_of_audience']) * 100);
        }

        return view('back-end.email-tracker.chart', compact('emailStat'));
    }

    public function index()
    {
        $emailTrackers = EmailTracker::withCount('audiences')->orderBy('id', 'DESC')->paginate(25);
        return view('back-end.email-tracker.index', compact('emailTrackers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'num_of_audience' => 'required'
        ]);

        $data = $request->all();
        $data['uid'] = (string) Str::uuid();

        EmailTracker::create($data);

        return redirect()->back()->with(['success' => 'Added New Email Tracker']);
    }

    public function show($id)
    {
        $emailTracker = EmailTracker::where('id', $id)->with('audiences')->first();
        return view('back-end.email-tracker.show', compact('emailTracker'));
    }

    public function edit($id)
    {
        $emailTracker = EmailTracker::where('id', $id)->first();
        return view('back-end.email-tracker.edit', compact('emailTracker'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'num_of_audience' => 'required',
        ]);

        $emailTracker = EmailTracker::where('id', $id)->first();
        $emailTracker->update([
            'title' =>  $request->title,
            'num_of_audience' => $request->num_of_audience
        ]);

        return redirect()->back()->with(['success' => 'Updated Email Tracker']);
    }

    /**
     * @param $tracking_uid
     * @param $email
     * @param bool $name /optional
     */
    public function trackEmail($tracking_uid, $email, $name = false)
    {
        //read image
        readfile(public_path('/img/emailtracker.png'));

        $emailTrackerAudience = EmailTrackerAudience::where('email_tracker_uid', $tracking_uid)->where('email', $email)->first();

        if(!$emailTrackerAudience){
            EmailTrackerAudience::create([
                'email_tracker_uid' => $tracking_uid,
                'email' => $email,
                'name' => $name ? $name : null
            ]);
        }
    }
}
