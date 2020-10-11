<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="financeDataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th rowspan="2" style="padding-bottom: 32px;">Company</th>
                <th rowspan="2" style="padding-bottom: 32px;">Ticker</th>
                <th rowspan="2" style="padding-bottom: 32px;">Year</th>
                @if ($frequency == 'quarterly' and $q1 == null and $q2 == null and $q3 == null and $q4 == null)
                    <th colspan="2">Q1</th>
                    <th colspan="2">Q2</th>
                    <th colspan="2">Q3</th>
                    {{-- <th>Q4 PDF</th>
                    <th>Q4 Excel</th> --}}
                @else
                    @isset($q1)
                            <th colspan="2">Q1</th>
                    @endisset
                    @isset($q2)
                            <th colspan="2">Q2</th>
                    @endisset
                    @isset($q3)
                            <th colspan="2">Q3</th>
                    @endisset
                    {{-- @isset($q4)
                        {{--<th colspan="2">Q4</th>--}}
                    {{--@endisset --}}
                @endif

            </tr>
            <tr>
                @if ($frequency == 'quarterly' and $q1 == null and $q2 == null and $q3 == null and $q4 == null)
                    <th>Pdf</th>
                    <th>Excel</th>

                    <th>Pdf</th>
                    <th>Excel</th>

                    <th>Pdf</th>
                    <th>Excel</th>
                    {{-- <th>Q4 PDF</th>
                    <th>Q4 Excel</th> --}}
                @else

                    @isset($q1)
                        <th>Pdf</th>
                        <th>Excel</th>
                    @endisset

                    @isset($q2)
                        <th>Pdf</th>
                        <th>Excel</th>
                    @endisset
                    @isset($q3)
                        <th>Pdf</th>
                        <th>Excel</th>
                    @endisset

                        @isset($q4)
                            {{--<th>Pdf</th>--}}
                            {{--<th>Excel</th>--}}
                        @endisset
                @endif


            </tr>
            </thead>

            <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($finance_infos as $item)
                <tr>
                    <td class="th-bg-color">{{$item->company->name}}</td>
                    <td class="th-bg-color">{{$item->company->ticker}}</td>
                    <td class="th-bg-color">{{$item->year}}</td>
                    @if ($frequency == 'quarterly' and $q1 == null and $q2 == null and $q3 == null and $q4 == null)
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

                        {{-- @if(auth()->user())
                            @include('front-end.partial.q4__pdf_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                            @include('front-end.partial.q4_excel_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif --}}

                    @else  
                        @isset($q1)
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
                        @endisset

                        @isset($q2)
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
                        @endisset

                        
                        @isset($q3)
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
                        @endisset


                        {{-- @isset($q4)
                            @if(auth()->user())
                                @include('front-end.partial.q4__pdf_url', compact('item'))
                            @else
                                <td><a href="/login" class="btn btn-warning">Login</a></td>   
                            @endif 

                            @if(auth()->user())
                                @include('front-end.partial.q4_excel_url', compact('item'))
                            @else
                                <td><a href="/login" class="btn btn-warning">Login</a></td>   
                            @endif
                        @endisset --}}
                    @endif        
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>