<?php

namespace App\Http\Controllers;

use App\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function store(Request $request)
    {
        $download = Download::where('user_id', '=', auth()->user()->id)->first();
        if($download != null)
        {
            if(date("Y-m") == $download->current_month->format('Y-m')){
                if($download->how_many_left != 0)
                {
                    $download = Download::find($download->id);
                    $download->how_many_left =   $download->how_many_left - 1;
                    $download->save();
                    return redirect()->away($request->file_path);
                }else{
                    return redirect()->back()->withErrors(['Download limit exceeded, please subscribe']);
                }
            }else{
                $download = Download::find($download->id);
                $download->current_month =  date("Y-m-d");
                $download->how_many_left =  9;
                $download->save();
                return redirect()->away($request->file_path);
            }
        }else{
            $download = new Download([
                'current_month' => date("Y-m-d"),
                'how_many_left' => 9,
                'user_id' => auth()->user()->id,
            ]);
            $download->save();
            return redirect()->away($request->file_path);
        }
        return redirect()->back();
    }
}
