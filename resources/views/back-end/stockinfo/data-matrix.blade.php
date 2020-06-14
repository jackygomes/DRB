@extends('back-end.admin-layout')

@section('content')
<style>
    .fat-button{
        width: 100%;
        height: 50px;
    }
    input{
        width: 100px;
    }
    td{
        width: 100px;
    }
    th:first-child, td:first-child
    {
        position:sticky;
        left:0px;
        background-color: white;
    }
    table{
        font-size: .8em;
    }
    .table th, .table td {
        padding: .2rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
}
</style>
<div class="card-header">
    <i class="fas fa-table"></i>
    Stock Info List
    <a class="btn btn-danger" target="_blank" href="/api/fetch/dse?url=http://dsebd.org/latest_share_price_all_by_change.php" >Sync from: http://dsebd.org/latest_share_price_all_by_change.php</a>    
    <a class="btn btn-primary" href="{{ route('stockinfo.upload-bulk') }}">Bulk Upload</a>       
            
</div>
<form action="{{ route('stockinfo.process') }}" method="post">
    @csrf
    <button class="fat-button">Save</button>
    <div class="table-responsive ">
    <table class="table table-bordered" border="1">
        <tr>
            <td>Company Name</td>
            <td>LTP (BDT)</td>
            <td>YCP (BDT)</td>
            <td>Change</td>
            <td>Trade</td>
            <td>Turnover (BDT mn)</td>
            <td>Volume</td>
            <td>Sponsor/Director</td>
            <td>Government</td>
            <td>Institute</td>
            <td>Foreign</td>
            <td>Public</td>
            <td>Paid Up Capital (BDT mn)</td>
            <td>Beginning Revenue</td>
            <td>Ending Revenue</td>
            <td>3 Year Revenue CAGR</td>
            <td>Beginning NPAT</td>
            <td>Ending NPAT</td>
            <td>3 Year NPAT CAGR</td>
            <td>NPAT</td>
            <td>Beginning Asset</td>
            <td>Ending Asset</td>
            <td>ROA</td>
            <td>NPAT-non Controlling Interest</td>
            <td>Beginning Equity</td>
            <td>Ending Equity</td>
            <td>ROE</td>
            <td>Audited EPS</td>
            <td>Audited P/E(x)</td>
            <td>Forward P/E(x)</td>
            <td>NAVPS</td>
            <td>P/NAVPS(x)</td>
            <td>DPS</td>
            <td>Dividend Yield</td>
        </tr>
    @foreach($stockInfos as $company)
        <tr>
            <td>{{ $company->stockInfo->company->name}}</td>
            <td>{{ $company->stockInfo->last_trading_price}}</td>
            <td>{{ $company->stockInfo->yesterday_closing}}</td>
            <td>{{ $company->stockInfo->price_change}}</td>
            <td>{{ $company->stockInfo->trade}}</td>
            <td>{{ $company->stockInfo->turnover_bdt_mn}}</td>
            <td>{{ $company->stockInfo->volume}}</td>
            <td><input name="data[{{$company->stockInfo->id}}][sponsor_or_director]" value="{{ $company->stockInfo->sponsor_or_director}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][government]"  value="{{ $company->stockInfo->government}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][institute]"  value="{{ $company->stockInfo->institute}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][foreign]"  value="{{ $company->stockInfo->foreign}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][public]"  value="{{ $company->stockInfo->public}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][paid_up_capital_bdt_mn]"  value="{{ $company->stockInfo->paid_up_capital_bdt_mn}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][beginning_revenue]"  value="{{ $company->stockInfo->beginning_revenue}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][ending_revenue]"  value="{{ $company->stockInfo->ending_revenue}}"></td>
            <td>{{ $company->stockInfo->three_year_revenue_cagr}}</td>
            <td><input name="data[{{$company->stockInfo->id}}][beginning_npat]"  value="{{ $company->stockInfo->beginning_npat}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][ending_npat]"  value="{{ $company->stockInfo->ending_npat}}"></td>
            <td>{{ $company->stockInfo->three_year_npat_cagr}}</td>
            <td><input name="data[{{$company->stockInfo->id}}][npat]"  value="{{ $company->stockInfo->npat}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][beginning_asset]"  value="{{ $company->stockInfo->beginning_asset}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][ending_asset]"  value="{{ $company->stockInfo->ending_asset}}"></td>
            <td>{{ $company->stockInfo->roa}}</td>
            <td><input name="data[{{$company->stockInfo->id}}][npat_non_controlling_interest]"  value="{{ $company->stockInfo->npat_non_controlling_interest}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][beginning_equity]"  value="{{ $company->stockInfo->beginning_equity}}"></td>
            <td><input name="data[{{$company->stockInfo->id}}][ending_equity]"  value="{{ $company->stockInfo->ending_equity}}"></td>
            <td>{{ $company->stockInfo->roe}}</td>
            <td>{{ $company->stockInfo->audited_eps}}</td>
            <td>{{ $company->stockInfo->pe_5}}</td>
            <td>{{ $company->stockInfo->pe_1_basic}}</td>
            <td><input name="data[{{$company->stockInfo->id}}][navps]"  value="{{ $company->stockInfo->navps}}"></td>
            <td>{{ $company->stockInfo->p_navps_x}}</td>
            <td><input name="data[{{$company->stockInfo->id}}][dps]"  value="{{ $company->stockInfo->dps}}"></td>
            <td>{{ $company->stockInfo->dividend_yield}}</td>
        </tr>
    @endforeach
    </form>
</table>
</div>
{{$stockInfos->links()}}
<br><br><br><br><br><br>
@endsection
