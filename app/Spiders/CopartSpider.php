<?php

namespace App\Spiders;

use App\Spiders\Processors\SaveCarDetailsToDbProcessor;
use App\Spiders\Processors\ValidateReferenceProcessor;
use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;
use Symfony\Component\DomCrawler\Crawler;

class CopartSpider extends BasicSpider
{
    public array $startUrls = [
        //
        'https://www.copart.com/vehicle-search-make/bmw?displayStr=BMW&from=%2F&searchCriteria=%7B%22query%22:%5B%22*%22%5D,%22filter%22:%7B%22FETI%22:%5B%22buy_it_now_code:B1%22%5D%7D,%22searchName%22:%22%22,%22watchListOnly%22:false,%22freeFormSearch%22:false%7D'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        //
        ValidateReferenceProcessor::class,
        SaveCarDetailsToDbProcessor::class
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $cars = $response->filter('div.p-datatable-wrapper')->each(function (Crawler $crawler) {
            return [
                'name' => 'name',
                'reference'=> $crawler->filter('.p-datatable.p-datatable-responsive .p-datatable-tbody>tr>td .p-column-title')->text(),
//                'country_of_origin'=>$crawler->filter(),
//                'price'=>$crawler->filter(),
//                'market'=>$crawler->filter(),
//                'acv'=>$crawler->filter()
            ];
        });

        dd($cars);

        foreach ($cars as $car) {
            yield $this->item([
                'name' => 'Testing',
                'reference' => $car['reference'],
                'market' => $car['market'],
                'price' => $car['price'],
                'acv' => $car['acv'],
                'source' => 'Copart',
                'country_of_origin' => $car['country_of_origin']
            ]);
        }
    }
}
