<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Company</th>
                <th>Ticker</th>
                <th>Year</th>
                @if ($frequency == 'quarterly' and $q1 == null and $q2 == null and $q3 == null and $q4 == null)
                    <th>Q1 PDF</th>
                    <th>Q1 Excel</th>
                    <th>Q2 PDF</th>
                    <th>Q2 Excel</th>
                    <th>Q3 PDF</th>
                    <th>Q3 Excel</th>
                    {{-- <th>Q4 PDF</th>
                    <th>Q4 Excel</th> --}}
                @else    
                    @isset($q1)
                        <th>Q1 PDF</th>
                        <th>Q1 Excel</th>
                    @endisset
                    @isset($q2)
                        <th>Q2 PDF</th>
                        <th>Q2 Excel</th>
                    @endisset
                    @isset($q3)
                        <th>Q3 PDF</th>
                        <th>Q3 Excel</th>
                    @endisset
                    {{-- @isset($q4)
                        <th>Q4 PDF</th>
                        <th>Q4 Excel</th>
                    @endisset --}}
                @endif    

            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Company</th>
                <th>Ticker</th>
                <th>Year</th>
                @if ($frequency == 'quarterly' and $q1 == null and $q2 == null and $q3 == null and $q4 == null)
                    <th>Q1 PDF</th>
                    <th>Q1 Excel</th>
                    <th>Q2 PDF</th>
                    <th>Q2 Excel</th>
                    <th>Q3 PDF</th>
                    <th>Q3 Excel</th>
                    {{-- <th>Q4 PDF</th>
                    <th>Q4 Excel</th> --}}
                @else    
                    @isset($q1)
                        <th>Q1 PDF</th>
                        <th>Q1 Excel</th>
                    @endisset
                    @isset($q2)
                        <th>Q2 PDF</th>
                        <th>Q2 Excel</th>
                    @endisset
                    @isset($q3)
                        <th>Q3 PDF</th>
                        <th>Q3 Excel</th>
                    @endisset
                    {{-- @isset($q4)
                        <th>Q4 PDF</th>
                        <th>Q4 Excel</th>
                    @endisset --}}
                @endif
            </tr>
            </tfoot>
            <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($finance_infos as $item)
                <tr>
                    <td>{{$item->company->name}}</td>
                    <td>{{$item->company->ticker}}</td>
                    <td>{{$item->year}}</td>
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