<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th rowspan="2" style="padding-bottom: 32px;">Company</th>
                <th rowspan="2" style="padding-bottom: 32px;">Ticker</th>
                <th rowspan="2" style="padding-bottom: 32px;">Year</th>
                <th colspan="2">Annual</th>
            </tr>

            <tr>
                <th>Pdf</th>
                <th>Excel</th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($finance_infos as $item)
                <tr>
                    <td>{{$item->company->name}}</td>
                    <td>{{$item->company->ticker}}</td>
                    <td>{{$item->year}}</td>

                    @if(auth()->user())
                        @include('front-end.partial.annual_pdf_1_url', compact('item'))
                    @else
                        <td><a href="/login" class="btn btn-warning">Login</a></td>
                    @endif

                    @if(auth()->user())
                        @include('front-end.partial.annual_excel_url', compact('item'))
                    @else
                        <td><a href="/login" class="btn btn-warning">Login</a></td>   
                    @endif  



                    {{--@if(auth()->user())--}}
                        {{--@include('front-end.partial.annual_pdf_2_url', compact('item'))--}}
                    {{--@else--}}
                        {{--<td><a href="/login" class="btn btn-warning">Login</a></td>   --}}
                    {{--@endif --}}

                    {{--@if(auth()->user())--}}
                        {{--@include('front-end.partial.annual_pdf_3_url', compact('item'))--}}
                    {{--@else--}}
                        {{--<td><a href="/login" class="btn btn-warning">Login</a></td>   --}}
                    {{--@endif --}}

                    {{--@if(auth()->user())--}}
                         {{--@include('front-end.partial.annual_pdf_4_url', compact('item'))--}}
                    {{--@else--}}
                        {{--<td><a href="/login" class="btn btn-warning">Login</a></td>   --}}
                    {{--@endif --}}

                    {{--@if(auth()->user())--}}
                       {{--@include('front-end.partial.annual_pdf_5_url', compact('item'))     --}}
                    {{--@else--}}
                        {{--<td><a href="/login" class="btn btn-warning">Login</a></td>   --}}
                    {{--@endif           --}}
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>