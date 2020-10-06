<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered finance-table finance-table-font-size" id="" width="100%" cellspacing="0" data-display-length='25'>
            <thead>
            <tr>
                <tr>
                    <th rowspan="2" class="th-bg-color" style="padding-bottom: 30px;">Company</th>
                    <th rowspan="2" class="th-bg-color" style="padding-bottom: 30px;">Ticker</th>
                    <th rowspan="2" class="th-bg-color" style="padding-bottom: 30px;">Year</th>

                    <th colspan="2">Q1</th>
                    <th colspan="2">Q2</th>
                    <th colspan="2">Q3</th>
                    {{--<th colspan="2">Q4</th>--}}
                    <th colspan="2">Annual</th>
                </tr>

                <tr>
                    <th>Pdf</th>
                    <th>Excel</th>
                    <th>Pdf</th>
                    <th>Excel</th>
                    <th>Pdf</th>
                    <th>Excel</th>
                    {{--<th>Pdf</th>--}}
                    {{--<th>Excel</th>--}}
                    <th>Pdf</th>
                    <th>Excel</th>
                </tr>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
            @endphp
            {{-- {{dd($user->subscriptionplans)}} --}}
            @foreach ($finance_infos as $item)
                @if($item->company!=null)
                    <tr>
                        <td>{{$item->company->name}}</td>
                        <td>{{$item->company->ticker}}</td>
                        <td>{{$item->year}}</td>
                        @if(auth()->user())
                        @include('front-end.partial.q1__pdf_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                        @include('front-end.partial.q1_excel_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                            @include('front-end.partial.q2__pdf_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                        @include('front-end.partial.q2_excel_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                            @include('front-end.partial.q3__pdf_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                        @include('front-end.partial.q3_excel_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        {{--@if(auth()->user())--}}
                        {{--@include('front-end.partial.q4__pdf_url', compact('item'))--}}
                        {{--@else--}}
                            {{--<td><a href="/login" class="btn btn-warning">Login</a></td>--}}
                        {{--@endif--}}

                        {{--@if(auth()->user())--}}
                        {{--@include('front-end.partial.q4_excel_url', compact('item'))--}}
                        {{--@else--}}
                            {{--<td><a href="/login" class="btn btn-warning">Login</a></td>--}}
                        {{--@endif--}}

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
                            {{--<td><a href="/login" class="btn btn-warning">Login</a></td>--}}
                        {{--@endif--}}

                        {{--@if(auth()->user())--}}
                            {{--@include('front-end.partial.annual_pdf_3_url', compact('item'))--}}
                        {{--@else--}}
                            {{--<td><a href="/login" class="btn btn-warning">Login</a></td>--}}
                        {{--@endif--}}

                        {{--@if(auth()->user())--}}
                            {{--@include('front-end.partial.annual_pdf_4_url', compact('item'))--}}
                        {{--@else--}}
                            {{--<td><a href="/login" class="btn btn-warning">Login</a></td>--}}
                        {{--@endif--}}

                        {{--@if(auth()->user())--}}
                        {{--@include('front-end.partial.annual_pdf_5_url', compact('item'))--}}
                        {{--@else--}}
                            {{--<td><a href="/login" class="btn btn-warning">Login</a></td>--}}
                        {{--@endif--}}
                    </tr>
                @endif    
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>