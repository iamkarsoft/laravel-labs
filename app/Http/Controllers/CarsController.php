<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarsController extends Controller
{
    //
    public function gouttescrape()
    {
        $client = new Client();
        $data = [];

        $crawl_iaa = $client->request('GET', 'https://www.iaai.com/Search?url=%2fphPQHAwgKKUMQESmxpuQ98DIa4rE6zo0cNZ06cVu%2fA%3d');
//        $crawl_iaa = $client->request('GET', 'https://copart.com');

        $data_scraped = $crawl_iaa->filter('.table-cell--data')->each(function ($node) {
            $data['id']  = Str::uuid()->toString();
            $data['name'] = $node->filter('div.table-cell--heading h4')->text();
            $data['reference'] = $node->filter('.table-cell--inner div.table-cell ul.data-list span[title~="Stock"]')->text();

            $data['country_of_origin'] = $node->filter('.table-cell--inner div.table-cell ul.data-list span[title~="Country Of Origin:"]')->text();

            $data['market'] = $node->filter('.table-cell--inner div.table-cell:nth-child(4n) ul.data-list li:nth-child(4n) span[title~="Market:"]')->text();

            $data['price'] = $node->filter('.table-cell-horizontal-center ul.data-list >li.data-list__item:nth-child(3n)')->text();

            $data['acv'] = $node->filter('.table-cell--inner div.table-cell:nth-child(4n) ul.data-list li:nth-child(8n) span[title~="ACV:"]')->text();

            $data['source'] = 'IAA';
//            $data['name'] = $node->filter('.table-cell--heading h4')->each(function ($node) {
//                return $node->text();
//            });

            return $data;
        });

//        dump($data_scraped);
//        $filtered = collect($data_scraped);
//        DB::table('scrapers')->insert($data_scraped);
//        Cars::create($data_scraped);
        foreach ($data_scraped as $d){
//            dd($d['reference']);

             $car = Cars::where('reference', $d['reference'])->get();
//          dump($car);
//             dump($car);

            $reference = $car->pluck('reference');

//            dd($reference->isEmpty());

             if($reference->isEmpty()) {
//                 return 'empty';
                 Cars::create([
                     'name' => $d['name'],
                     'reference' => $d['reference'],
                     'price' => $d['price'],
                     'source' => $d['source'],
                     'acv' => $d['acv'],
                     'market' => $d['market'],
                     'country_of_origin' => $d['country_of_origin']
                 ]);
             }
        }

        return 'Done';


    }

    public function roachscrape()
    {
        $client = new Client();
        $crawl_iaa = $client->request('GET', 'https://www.copart.com/vehicle-search-make/bmw?displayStr=BMW&from=%2F&searchCriteria=%7B%22query%22:%5B%22*%22%5D,%22filter%22:%7B%22MAKE%22:%5B%22lot_make_desc:%5C%22BMW%5C%22%22%5D,%22FETI%22:%5B%22buy_it_now_code:B1%22%5D%7D,%22searchName%22:%22%22,%22watchListOnly%22:false,%22freeFormSearch%22:false%7D');
        $data['lots'] = $crawl_iaa->filter('.search_result_lot_number')->each(function ($node) {
            return $node->text();
        });
    }
}
