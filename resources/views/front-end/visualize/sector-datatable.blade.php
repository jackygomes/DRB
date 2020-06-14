<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <div class="card-body">
            <h4>{{$sector->name}}<i class="fas fa-arrow-right float-right"></i></h4>
            <div class="table-responsive">
                <table class="table table-bordered hundred table-custom-font-size" id="myTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Company Name</th>
                        <th class="text-right">LTP (BDT)</th>
                        <th class="text-right">YCP (BDT)</th>
                        <th class="text-right">Change</th>
                        <th class="text-right">Trade</th>
                        <th class="text-right">Turnover (BDT mn)</th>
                        <th class="text-right">Volume</th>
                        <th class="text-right">Sponsor/Director</th>
                        <th class="text-right">Government</th>
                        <th class="text-right">Institute</th>
                        <th class="text-right">Foreign</th>
                        <th class="text-right">Public</th>
                        <th class="text-right">Paid Up Capital (BDT mn)</th>
                        <th class="text-right">3 Year Revenue CAGR</th>
                        <th class="text-right">3 Year NPAT CAGR</th>
                        <th class="text-right">ROA</th>
                        <th class="text-right">ROE</th>
                        <th class="text-right">Audited EPS</th>
                        <th class="text-right">Audited P/E(x)</th>
                        <th class="text-right">Forward P/E(x)</th>
                        <th class="text-right">NAVPS</th>
                        <th class="text-right">P/NAVPS(x)</th>
                        <th class="text-right">DPS</th>
                        <th class="text-right">Dividend Yield</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Sl.</th>
                        <th>Company Name</th>
                        <th class="text-right">LTP (BDT)</th>
                        <th class="text-right">YCP (BDT)</th>
                        <th class="text-right">Change</th>
                        <th class="text-right">Trade</th>
                        <th class="text-right">Turnover (BDT mn)</th>
                        <th class="text-right">Volume</th>
                        <th class="text-right">Sponsor/Director</th>
                        <th class="text-right">Government</th>
                        <th class="text-right">Institute</th>
                        <th class="text-right">Foreign</th>
                        <th class="text-right">Public</th>
                        <th class="text-right">Paid Up Capital (BDT mn)</th>
                        <th class="text-right">3 Year Revenue CAGR</th>
                        <th class="text-right">3 Year NPAT CAGR</th>
                        <th class="text-right">ROA</th>
                        <th class="text-right">ROE</th>
                        <th class="text-right">Audited EPS</th>
                        <th class="text-right">Audited P/E(x)</th>
                        <th class="text-right">Forward P/E(x)</th>
                        <th class="text-right">NAVPS</th>
                        <th class="text-right">P/NAVPS(x)</th>
                        <th class="text-right">DPS</th>
                        <th class="text-right">Dividend Yield</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @php
                        $i = 0;
                    @endphp
                    @foreach ($sector->company as $company)
                        @php
                            if($company->stockInfo != null){
                                $item = $company->stockInfo;
                            }else{
                                $item = null;
                            }
                        @endphp
                        @if($item)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$item->company->name}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->last_trading_price)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->yesterday_closing)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->price_change)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->trade)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->turnover_bdt_mn)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->volume)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->sponsor_or_director)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->government)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->institute)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->foreign)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->public)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->paid_up_capital_bdt_mn)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->three_year_revenue_cagr)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->three_year_npat_cagr)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->roa)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->roe)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->audited_eps)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->pe_1_basic)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->pe_5)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->navps)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->p_navps_x)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->dps)}}</td>
                            <td class="text-right">{{sprintf("%01.2f", $item->dividend_yield)}}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

