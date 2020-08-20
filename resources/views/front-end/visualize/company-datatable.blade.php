<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-body">
        <i class="fas fa-arrow-right" style="float:right"></i><br>
        <table id="example" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <!-- <th rowspan="2">Sl.</th> -->
                    <th rowspan="2">Company</th>
                    <!-- <th rowspan="2">Sector</th> -->
                    <th rowspan="2">LTP<br><small>(BDT)</small></th>
                    <th rowspan="2">YCP<br><small>(BDT)</small></th>
                    <th rowspan="2">Change<br><small>(%)</small></th>
                    <th rowspan="2">Turnover<br><small>(BDT mn)</small></th>
                    <th rowspan="2">Volume</th>
                    <th rowspan="2">Audited<br>EPS<small> (BDT)</small></th>
                    <th rowspan="2">Audited<br>P/E<small> (x)</small></th>
                    <th rowspan="2">Forward<br>P/E<small> (x)</small></th>
                    <th rowspan="2">NAVPS</th>
                    <th rowspan="2">P/NAVPS<br><small>(x)</small></th>
                    <th rowspan="2">DPS<small> (BDT)</small></th>
                    <th rowspan="2">Dividend<br>Yield<small> (%)</small></th>
                    <th rowspan="2">ROAE<br><small>(%)</small></th>
                    <th rowspan="2">ROAA<br><small>(%)</small></th>
                    <th rowspan="2">3 Year NPAT<br>CAGR<small> (%)</small></th>
                    <th rowspan="2">3 Year Revenue<br>CAGR<small> (%)</small></th>
                    <th rowspan="2">Paidup Capital<br><small>(BDT mn)</small></th>
                    <th rowspan="1" colspan="4" style="text-align: center">Ownership</th>
                </tr>
                <tr>
                    <th>Sponsor/Director<small>(%)</small></th>
                    <th>Foreign<small>(%)</small></th>
                    <th>Institute<small>(%)</small></th>
                    <th>Public<small>(%)</small></th>        
                </tr>
            </thead>
            
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach($sectors as $sector)

                    @foreach ($sector->company as $company)
                        @php
                            if($company->is_visible && $company->stockInfo != null){
                                $item = $company->stockInfo;
                            }else{
                                $item = null;
                            }
                        @endphp
                        @if($item)
                            <tr>
                                <!-- <td>{{++$i}}</td> -->
                                <td>{{$item->company->ticker}}</td>
                                <!-- <td>{{$sector->name}}</td> -->
                                <td class="text-right">{{ $item->last_trading_price == 'n/a' || $item->last_trading_price == null ? 'n/a' : sprintf("%01.1f", $item->last_trading_price)}}</td>
                                <td class="text-right">{{ $item->yesterday_closing == 'n/a'  || $item->yesterday_closing == null  ? 'n/a' : sprintf("%01.1f", $item->yesterday_closing)}}</td>
                                <td class="text-right">{{ $item->price_change == 'n/a'  || $item->price_change == null  ? 'n/a' : sprintf("%01.1f", $item->price_change)}}</td>
                                <td class="text-right">{{ $item->turnover_bdt_mn == 'n/a'  || $item->turnover_bdt_mn == null  ? 'n/a' : sprintf("%01.1f", $item->turnover_bdt_mn)}}</td>
                                <td class="text-right">{{ $item->volume == 'n/a'  || $item->volume == null  ? 'n/a' : sprintf("%01.1f", $item->volume)}}</td>
                                <td class="text-right">{{ $item->audited_eps == 'n/a'  || $item->audited_eps == null  ? 'n/a' : sprintf("%01.1f", $item->audited_eps)}}</td>
                                <td class="text-right">{{ $item->pe_1_basic == 'n/a'  || $item->pe_1_basic == null  ? 'n/a' : sprintf("%01.1f", $item->pe_1_basic)}}</td>
                                <td class="text-right">{{ $item->pe_5 == 'n/a'  || $item->pe_5 == null  ? 'n/a' : sprintf("%01.1f", $item->pe_5)}}</td>
                                <td class="text-right">{{ $item->navps == 'n/a'  || $item->navps == null  ? 'n/a' : sprintf("%01.1f", $item->navps)}}</td>
                                <td class="text-right">{{ $item->p_navps_x == 'n/a'  || $item->p_navps_x == null  ? 'n/a' :  sprintf("%01.1f", $item->p_navps_x)}}</td>
                                <td class="text-right">{{ $item->dps == 'n/a'  || $item->dps == null  ? 'n/a' : sprintf("%01.1f", $item->dps)}}</td>
                                <td class="text-right">{{ $item->dividend_yield == 'n/a'  || $item->dividend_yield == null  ? 'n/a' : sprintf("%01.1f", $item->dividend_yield)}}</td>
                                <td class="text-right">{{ $item->roe == 'n/a'  || $item->roe == null  ? 'n/a' : sprintf("%01.1f", $item->roe)}}</td>
                                <td class="text-right">{{ $item->roa == 'n/a'  || $item->roa == null  ? 'n/a' : sprintf("%01.1f", $item->roa)}}</td>
                                <td class="text-right">{{ $item->three_year_npat_cagr == 'n/a'  || $item->three_year_npat_cagr == null  ? 'n/a' : sprintf("%01.1f", $item->three_year_npat_cagr)}}</td>
                                <td class="text-right">{{ $item->three_year_revenue_cagr == 'n/a'  || $item->three_year_revenue_cagr == null  ? 'n/a' : sprintf("%01.1f", $item->three_year_revenue_cagr)}}</td>
                                <td class="text-right">{{ $item->paid_up_capital_bdt_mn == 'n/a'  || $item->paid_up_capital_bdt_mn == null  ? 'n/a' : sprintf("%01.1f", $item->paid_up_capital_bdt_mn)}}</td>
                                <td class="text-right">{{ $item->sponsor_or_director == 'n/a'  || $item->sponsor_or_director == null  ? 'n/a' : sprintf("%01.1f", $item->sponsor_or_director)}}</td>
                                <td class="text-right">{{ $item->foreign == 'n/a'  || $item->foreign == null  ? 'n/a' : sprintf("%01.1f", $item->foreign)}}</td>
                                <td class="text-right">{{ $item->institute == 'n/a'  || $item->institute == null  ? 'n/a' : sprintf("%01.1f", $item->institute)}}</td>
                                <td class="text-right">{{ $item->public == 'n/a'  || $item->public == null  ? 'n/a' : sprintf("%01.1f", $item->public)}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    <br><br>
        <p class="legend"> 
            N/A= Not applicable ,
             LTP= Last Traded Price ,
             YCP= Yesterday Closing Price ,
             EPS= Earnings Per Share ,
             NAVPS= Net Asset Value Per Share ,
             DPS= Dividend Per Share ,
             ROAE= Return on Average Equity ,
             ROAA= Return on Average Asset ,
             CAGR= Compound Annual Growth Rate
        </p>
    
    
    </div>

    
</div>

@section('scripts2')
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
 <script>
     
   $(document).ready(function() {
        $("#example").dataTable().fnDestroy();
        var table = $('#example').DataTable( {
            info:           false,
            scrollY:        "50vh",
            scrollX:        "100%",
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   {
                leftColumns: 1
            }
        } );
    } );
 </script>
@endsection

@section('styles')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"  rel="stylesheet">
<link href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css"  rel="stylesheet">
 <style>
     /* Ensure that the demo table scrolls */
    th, td { white-space: nowrap;}
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
        font-size: .55em;
    }
    .DTFC_LeftBodyWrapper{
        top: -12px !important;
    }
 </style>
@endsection







