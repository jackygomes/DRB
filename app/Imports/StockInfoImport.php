<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Company;
use App\StockInfo;
use Illuminate\Validation\Rule;
class StockInfoImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $company = Company::where('name', $row['company_name'])->first();

        if($company){
            $stockInfo = $company->stockInfo()->first();
        }
        if($stockInfo == null){
            return;
        }

        if($row['sponsordirector'] != null){
            $stockInfo->sponsor_or_director = floatval(preg_replace('/[^\d.]/', '', $row['sponsordirector'])) ;
        }

        if($row['government'] != null){
            $stockInfo->government = floatval(preg_replace('/[^\d.]/', '', $row['government'])) ;
        }

        if($row['institute'] != null){
            $stockInfo->institute = floatval(preg_replace('/[^\d.]/', '', $row['institute'])) ;
        }

        if($row['foreign'] != null){
            $stockInfo->foreign = floatval(preg_replace('/[^\d.]/', '', $row['foreign'])) ;
        }

        if($row['public'] != null){
            $stockInfo->public = floatval(preg_replace('/[^\d.]/', '', $row['public'])) ;
        }

        if($row['paid_up_capital_bdt_mn'] != null){
            $stockInfo->paid_up_capital_bdt_mn = floatval(preg_replace('/[^\d.]/', '', $row['paid_up_capital_bdt_mn'])) ;
        }

        if($row['beginning_revenue'] != null){
            $stockInfo->beginning_revenue = floatval(preg_replace('/[^\d.]/', '', $row['beginning_revenue'])) ;
        }

        if($row['ending_revenue'] != null){
            $stockInfo->ending_revenue = floatval(preg_replace('/[^\d.]/', '', $row['ending_revenue'])) ;
        }

        if($row['beginning_npat'] != null){
            $stockInfo->beginning_npat = floatval(preg_replace('/[^\d.]/', '', $row['beginning_npat'])) ;
        }

        if($row['ending_npat'] != null){
            $stockInfo->ending_npat = floatval(preg_replace('/[^\d.]/', '', $row['ending_npat'])) ;
        }

        if($row['npat'] != null){
            $stockInfo->npat = floatval(preg_replace('/[^\d.]/', '', $row['npat'])) ;
        }

        if($row['beginning_asset'] != null){
            $stockInfo->beginning_asset = floatval(preg_replace('/[^\d.]/', '', $row['beginning_asset'])) ;
        }

        if($row['ending_asset'] != null){
            $stockInfo->ending_asset = floatval(preg_replace('/[^\d.]/', '', $row['ending_asset'])) ;
        }

        if($row['npat_non_controlling_interest'] != null){
            $stockInfo->npat_non_controlling_interest = floatval(preg_replace('/[^\d.]/', '', $row['npat_non_controlling_interest'])) ;
        }

        if($row['beginning_equity'] != null){
            $stockInfo->beginning_equity = floatval(preg_replace('/[^\d.]/', '', $row['beginning_equity'])) ;
        }

        if($row['ending_equity'] != null){
            $stockInfo->ending_equity = floatval(preg_replace('/[^\d.]/', '', $row['ending_equity'])) ;
        }

        if($row['navps'] != null){
            $stockInfo->navps = floatval(preg_replace('/[^\d.]/', '', $row['navps'])) ;
        }

        if($row['dps'] != null){
            $stockInfo->dps = floatval(preg_replace('/[^\d.]/', '', $row['dps'])) ;
        }
        $stockInfo->save();
    }

    public function rules(): array
    {
        return [
            'company_name' => 'required|exists:companies,name'
        ];
    }
}
