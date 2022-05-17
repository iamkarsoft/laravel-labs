<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
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
            $list = $node->filter('.table-cell--inner div.table-cell li.data-list__item:nth-child(5n)')->text();
            $price = $node->filter('.table-cell--inner div.table-cell li.data-list__item:nth-child(4n)')->text();
            $current_bid = $node->filter('.table-cell--inner div.table-cell li.data-list__item:nth-child(3n)')->text();

            if(! $list){
                $price = $node->filter('.table-cell--inner div.table-cell li.data-list__item:nth-child(3n)')->text();
                $current_bid = NULL;
            }

            // $data['id']  = Str::uuid()->toString();
            $data['name'] = $node->filter('div.table-cell--heading h4')->text();
            $data['reference'] = $node->filter('.table-cell--inner div.table-cell ul.data-list span[title~="Stock"]')->text();



            $data['country_of_origin'] = $node->filter('.table-cell--inner div.table-cell ul.data-list span[title~="Country Of Origin:"]')->text();

            $data['market'] = $node->filter('.table-cell--inner div.table-cell:nth-child(4n) ul.data-list li:nth-child(4n) span[title~="Market:"]')->text();

            $data['price'] = $price;

            $data['acv'] = $node->filter('.table-cell--inner div.table-cell:nth-child(4n) ul.data-list li:nth-child(8n) span[title~="ACV:"]')->text();

            $data['source'] = 'IAA';
            $data['current_bid']= $current_bid;
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
                     'current_bid'=>$d['current_bid'],
                     'country_of_origin' => $d['country_of_origin']
                 ]);
             }
        }

        return 'Done';


    }


   public function iaascrape(){

      $getCarDuties = Http::get('http://localhost:3131/scrape/iaa')['results'];

      // dump($getCarDuties);

        foreach ($getCarDuties as $duty) {

                // dump($duty[0]['reference']);

             $car = Cars::where('reference', $duty[0]['reference'])->get();


            $reference = $car->pluck('reference');

           // dd($reference->isEmpty());

             if($reference->isEmpty()) {
                Cars::create([
                     'name' => $duty[0]['name'],
                     'reference' => $duty[0]['reference'],
                     'price' => $duty[0]['price'],
                     'source' => $duty[0]['source'],
                     'acv' => $duty[0]['acv'],
                     'market' => $duty[0]['market'],
                     'current_bid'=>$duty[0]['current_bid'],
                     'country_of_origin' => $duty[0]['country_of_origin']
                 ]);
            }else{
                Cars::where('reference',$reference)->update([
                    'name' => $duty[0]['name'],
                     'reference' => $duty[0]['reference'],
                     'price' => $duty[0]['price'],
                     'source' => $duty[0]['source'],
                     'acv' => $duty[0]['acv'],
                     'market' => $duty[0]['market'],
                     'current_bid'=>$duty[0]['current_bid'],
                     'country_of_origin' => $duty[0]['country_of_origin']
                 ]);
            }
        }

        return 'done';

   }
}
