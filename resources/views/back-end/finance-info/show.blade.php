@extends('back-end.admin-layout')

@section('content')

<div class="row bg-white my-4  p-3 shadow-sm">
    <div class="col-md-8">
        <div class="form-group">
        <label>Company Name: {{ $financeInfo->company->name }}</label>
    </div>

    <div class="col-md-8">
        <div class="form-group ">
            <label>Year: {{ $financeInfo->year }} </label>
        </div>
    </div>

</div>
<div class="row bg-white my-4  p-3 shadow-sm">
    <form  method="post" action="{{ route('finance-info.update', $financeInfo->id) }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
            <div class="col-md-4">
                <div class="form-group">
                <label>Annual Excel</label>
                <input class="form-control" name="annual_excel"  type="file">
                </div>
                @if($financeInfo->annual_excel_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->annual_excel_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Annual PDF 1</label>
                <input class="form-control" name="annual_pdf_1"  type="file">
                </div>
                @if($financeInfo->annual_pdf_1_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->annual_pdf_1_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Annual PDF 2</label>
                <input class="form-control" name="annual_pdf_2"  type="file">
                </div>
                @if($financeInfo->annual_pdf_2_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->annual_pdf_2_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Annual PDF 3</label>
                <input class="form-control" name="annual_pdf_3"  type="file">
                </div>
                @if($financeInfo->annual_pdf_3_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->annual_pdf_3_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Annual PDF 4</label>
                <input class="form-control" name="annual_pdf_4"  type="file">
                </div>
                @if($financeInfo->annual_pdf_4_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->annual_pdf_4_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Annual PDF 5</label>
                <input class="form-control" name="annual_pdf_5"  type="file">
                </div>
                @if($financeInfo->annual_pdf_5_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->annual_pdf_5_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 1 PDF</label>
                <input class="form-control" name="q1_pdf"  type="file">
                </div>
                @if($financeInfo->q1__pdf_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q1__pdf_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 1 Excel</label>
                <input class="form-control" name="q1_excel"  type="file">
                </div>
                @if($financeInfo->q1_excel_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q1_excel_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 2 PDF</label>
                <input class="form-control" name="q2_pdf"  type="file">
                </div>
                @if($financeInfo->q2__pdf_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q2__pdf_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 2 Excel</label>
                <input class="form-control" name="q2_excel"  type="file">
                </div>
                @if($financeInfo->q2_excel_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q2_excel_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 3 PDF</label>
                <input class="form-control" name="q3_pdf"  type="file">
                </div>
                @if($financeInfo->q3__pdf_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q3__pdf_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 3 Excel</label>
                <input class="form-control" name="q3_excel"  type="file">
                </div>
                @if($financeInfo->q3_excel_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q3_excel_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 4 PDF</label>
                <input class="form-control" name="q4_pdf"  type="file">
                </div>
                @if($financeInfo->q4__pdf_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q4__pdf_url }}">View</a>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Quarter 4 Excel</label>
                <input class="form-control" name="q4_excel"  type="file">
                </div>
                @if($financeInfo->q4_excel_url != '#')
                    <a target="_blank" href="{{ env('S3_URL') }}{{ $financeInfo->q4_excel_url }}">View</a>
                @endif
            </div>
            <div class="col-md-2">
                <label></label>
                <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Save</button>
            </div>
        </div>
    </form>
</div>

@endsection
