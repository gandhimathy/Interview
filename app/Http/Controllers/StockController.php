<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyStock;
use DB;

class StockController extends Controller
{
    public function updateCsv()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "interview-company";
        $connection = mysqli_connect($host, $user, $password, $db);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $table = "company_stock";

        $csvFile = fopen('StocksInfo.csv', 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            fgetcsv($csvFile);
            while(($line = fgetcsv($csvFile, 2000, ",")) !== FALSE){
                    $stock = new CompanyStock();
                    $stock->name = $line[1];
                    $stock->currentMarketPrice = $line[2]; 
                    $stock-> marketCap = $line[3];
                    $stock->stockPE = $line[4];
                    $stock->DividentYield = $line[5];
                    $stock->ROCE = $line[6];
                    $stock->ROEpreviousAnnual = $line[7];
                    $stock->DebtToEquity = $line[8];
                    $stock->EPS = $line[9];
                    $stock->reserves = $line[10];
                    $stock->Debt = $line[11];
                    $stock->save();

                // fclose($csvFile);

            }
        return "Uploaded Successfully";
    }
    public function getSuggestions( Request $request)
    {
        // return $keyword;
        if (request('keyword')) {
            $keyword = request('keyword');
        } else {
            $keyword = "";
        }
        $stocks = DB::select('CALL getSuggestion(?)', array($keyword));
        $stocks_dt = collect($stocks);
        $stocks_list = \json_decode($stocks_dt, true);
        return $stocks_list;
    }
    public function getData(Request $request)
    {
        $id = request('id');
        $data = CompanyStock::select('*')->where('id','=',$id)->get();
        return $data;
    }
}
