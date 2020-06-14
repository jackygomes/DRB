<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageItem;
class PageItemController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'particular' => 'required',
            'page_id' => 'required'
        ]);
        
        $pdf_path = "#";

        if($request->file('pdf')){

            $request->validate([
                'pdf' => 'mimes:pdf',
            ]);

            try{
                $path = $request->file('pdf')->store(
                    env('APP_ENV') . '/' . $request->get('page_id') . '/pdf', 's3'
                );
            }catch(\Exception $exception){
                $exception->getMessage();
                return back()->withError("There was an error with uploading your file")->withInput(); 
            }

            $pdf_path = $path;
        }

        $excel_path = "#";
        if($request->file('excel')){
            $request->validate([
                'excel' => 'mimes:xlsx,xls',
            ]);

            try{
                $epath = $request->file('excel')->store(
                    env('APP_ENV') . '/' . $request->get('page_id') . '/excel', 's3'
                );
            }catch(\Exception $exception){
                $exception->getMessage();
                return back()->withError("There was an error with uploading your file")->withInput(); 
            }

            $excel_path = $epath;
        }

        $page_item = new PageItem([
            'particular' => $request->get('particular'),
            'excel_file_url' => $excel_path,
            'pdf_file_url' => $pdf_path,
            'excel_file_url_download_count' => 0,
            'pdf_file_url_download_count' => 0,
            'page_id' => $request->get('page_id')
        ]);

        $page_item->save();
        return redirect()->back()->with('success', 'Page item has been created successfully');
    }

    public function destroy($id)
    {
        $page = PageItem::find($id);
        $page->delete();
        return redirect()->back()->with('success', 'Page has been deleted successfully');
    }
}
