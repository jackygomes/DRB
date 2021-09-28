<?php

namespace App\Http\Controllers;

use App\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    private $visitorDownloadLimit = 2;

    public function store(Request $request)
    {
        //admin can download always
        if(auth()->user()->type == 'admin')
            return redirect()->away($request->file_path);

        $download = Download::where('user_id', '=', auth()->user()->id)->first();
        if($download != null)
        {
            if($download->how_many_left != 0)
            {
                $download = Download::find($download->id);
                $download->how_many_left =   $download->how_many_left - 1;
                $download->save();
                return redirect()->away($request->file_path);
            }else{
                return redirect()->back()->withErrors(['Download limit exceeded, please subscribe']);
            }

        } else{
            $download = new Download([
                'current_month' => date("Y-m-d"),
                'how_many_left' => $this->visitorDownloadLimit,
                'user_id' => auth()->user()->id,
            ]);
            $download->save();
            return redirect()->away($request->file_path);
        }
        return redirect()->back();
    }
}
