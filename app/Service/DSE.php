<?php

namespace App\Service;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Company;
use App\StockInfo;
use App\Sector;

class DSE
{
    public static function fetch(){
        DSE::fetchSharePrice();
        DSE::fetchPE();
    }
    private static function fetchSharePrice(){
        $client = new Client();
        $crawler = $client->request('GET', "http://dsebd.org/latest_share_price_all_by_change.php");
        $crawler->filter('table')->children()->each(function (Crawler $row, $i) {
            if($i != 0){
                $company = Company::where('ticker', $row->children()->eq(1)->text())->first();
                if(!$company){
                    $sector = Sector::firstOrcreate([
                            'name' => 'Unassigned'
                        ]);
                    $company = Company::create([
                            'name' => $row->children()->eq(1)->text(),
                            'ticker' => $row->children()->eq(1)->text(),
                            'sector_id' => $sector->id
                    ]);
                }
                $stockinfo = StockInfo::firstOrcreate([
                    'company_id' => $company->id,
                ]);

                $stockinfo->company_id = $company->id;
                $stockinfo->last_trading_price = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(2)->text()));
                $stockinfo->closing_price = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(5)->text()));
                $stockinfo->yesterday_closing = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(6)->text()));
                $stockinfo->price_change = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(7)->text()));
                $stockinfo->turnover_bdt_mn = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(9)->text()));
                $stockinfo->volume = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(10)->text()));
                $stockinfo->trade = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(8)->text()));

                $stockinfo->touch();
                $stockinfo->save();
            } 
        });
    }

    private static function fetchPE(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.dsebd.org/latest_PE_all.php');
        $crawler->filter('table')->children()->each(function (Crawler $row, $i) {
            if($i != 0){
                $company = Company::where('ticker', $row->children()->eq(1)->text())->first();
                if(!$company){
                    $sector = Sector::firstOrcreate([
                            'name' => 'Unassigned'
                        ]);
                    $company = Company::create([
                            'name' => $row->children()->eq(1)->text(),
                            'ticker' => $row->children()->eq(1)->text(),
                            'sector_id' => $sector->id
                    ]);
                }

                $stockinfo = StockInfo::firstOrcreate([
                    'company_id' => $company->id
                ]);

                $stockinfo->company_id = $company->id;
                $stockinfo->close_price_from_pe = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(2)->text()));
                $stockinfo->ycp = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(3)->text()));
                $stockinfo->pe_1_basic = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(4)->text()));
                $stockinfo->pe_2_diluted = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(5)->text()));
                $stockinfo->pe_3_basic = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(6)->text()));
                $stockinfo->pe_4_diluted = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(7)->text()));
                $stockinfo->pe_5 = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(8)->text()));
                $stockinfo->pe_6 = floatval(preg_replace('/[^\d.]/', '', $row->children()->eq(9)->text()));

                $stockinfo->touch();
                $stockinfo->save();

            } 
        });
    }

}
