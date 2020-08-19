<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered finance-table finance-table-font-size" id="dataTable" width="100%" cellspacing="0" data-display-length='25'>
            <thead>
            <tr>
                <th class="th-bg-color">Company</th>
                <th>Ticker</th>
                <th>Year</th>
                <th>Q1 PDF</th>
                <th>Q1 Excel</th>
                <th>Q2 PDF</th>
                <th>Q2 Excel</th>
                <th>Q3 PDF</th>
                <th>Q3 Excel</th>
                {{-- <th>Q4 PDF</th>
                <th>Q4 Excel</th> --}}
                <th>Annual Excel</th>
                <th>Annual PDF 1</th>
                <th>Annual PDF 2</th>
                <th>Annual PDF 3</th>
                <th>Annual PDF 4</th>
                <th>Annual PDF 5</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Company</th>
                <th>Ticker</th>
                <th>Year</th>
                <th>Q1 PDF</th>
                <th>Q1 Excel</th>
                <th>Q2 PDF</th>
                <th>Q2 Excel</th>
                <th>Q3 PDF</th>
                <th>Q3 Excel</th>
                {{-- <th>Q4 PDF</th>
                <th>Q4 Excel</th> --}}
                <th>Annual Excel</th>
                <th>Annual PDF 1</th>
                <th>Annual PDF 2</th>
                <th>Annual PDF 3</th>
                <th>Annual PDF 4</th>
                <th>Annual PDF 5</th>
            </tr>
            </tfoot>
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

                        {{-- @if(auth()->user())
                        @include('front-end.partial.q4__pdf_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                        @include('front-end.partial.q4_excel_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif  --}}
                        
                    
                        @if(auth()->user())
                            @include('front-end.partial.annual_excel_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif  

                        @if(auth()->user())
                            @include('front-end.partial.annual_pdf_1_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                            @include('front-end.partial.annual_pdf_2_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                            @include('front-end.partial.annual_pdf_3_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                            @include('front-end.partial.annual_pdf_4_url', compact('item'))
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 

                        @if(auth()->user())
                        @include('front-end.partial.annual_pdf_5_url', compact('item'))     
                        @else
                            <td><a href="/login" class="btn btn-warning">Login</a></td>   
                        @endif 
                    </tr>
                @endif    
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>