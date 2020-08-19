<!-- DataTables Example -->
<br><br><br><br><br><br>
<div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered hundred" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Company Name</th>
                <th>LTP (BDT)</th>
                <th>YCP (BDT)</th>
                <th>Change</th>
                <th>Trade</th>
                <th>Turnover (BDT mn)</th>
                <th>Volume</th>
                <th>Sponsor/Director</th>
                <th>Government</th>
                <th>Institute</th>
                <th>Foreign</th>
                <th>Public</th>
                <th>Paid Up Capital (BDT mn)</th>
                <th>3 Year Revenue CAGR</th>
                <th>3 Year NPAT CAGR</th>
                <th>ROA</th>
                <th>ROE</th>
                <th>Audited EPS</th>
                <th>Audited P/E(x)</th>
                <th>Forward P/E(x)</th>
                <th>NAVPS</th>
                <th>P/NAVPS(x)</th>
                <th>DPS</th>
                <th>Dividend Yield</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Company Name</th>
                <th>LTP (BDT)</th>
                <th>YCP (BDT)</th>
                <th>Change</th>
                <th>Trade</th>
                <th>Turnover (BDT mn)</th>
                <th>Volume</th>
                <th>Sponsor/Director</th>
                <th>Government</th>
                <th>Institute</th>
                <th>Foreign</th>
                <th>Public</th>
                <th>Paid Up Capital (BDT mn)</th>
                <th>3 Year Revenue CAGR</th>
                <th>3 Year NPAT CAGR</th>
                <th>ROA</th>
                <th>ROE</th>
                <th>Audited EPS</th>
                <th>Audited P/E(x)</th>
                <th>Forward P/E(x)</th>
                <th>NAVPS</th>
                <th>P/NAVPS(x)</th>
                <th>DPS</th>
                <th>Dividend Yield</th>
            </tr>
            </tfoot>
            <tbody>

            @php
                $i = 0;
            @endphp
            @foreach ($stockinfos as $item)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$item->company->name}}</td>
                    <td>{{$item->last_trading_price}}</td>
                    <td>{{$item->yesterday_closing}}</td>
                    <td>{{$item->price_change}}</td>
                    <td>{{$item->trade}}</td>
                    <td>{{$item->turnover_bdt_mn}}</td>
                    <td>{{$item->volume}}</td>
                    <td>{{$item->sponsor_or_director}}</td>
                    <td>{{$item->government}}</td>
                    <td>{{$item->institute}}</td>
                    <td>{{$item->foreign}}</td>
                    <td>{{$item->public}}</td>
                    <td>{{$item->paid_up_capital_bdt_mn}}</td>
                    <td>{{$item->three_year_revenue_cagr}}</td>
                    <td>{{$item->three_year_npat_cagr}}</td>
                    <td>{{$item->roa}}</td>
                    <td>{{$item->roe}}</td>
                    <td>{{$item->audited_eps}}</td>
                    <td>{{$item->pe_1_basic}}</td>
                    <td>{{$item->pe_5}}</td>
                    <td>{{$item->navps}}</td>
                    <td>{{$item->p_navps_x}}</td>
                    <td>{{$item->dps}}</td>
                    <td>{{$item->dividend_yield}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

