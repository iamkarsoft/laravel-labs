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
use Symfony\Component\Panther\Client;

class IaaSpider extends BasicSpider
{
    public array $startUrls = [
        //
        'https://www.iaai.com/Search?url=%2fphPQHAwgKKUMQESmxpuQ98DIa4rE6zo0cNZ06cVu%2fA%3d'
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
        $links = $response->filter('.btn-page')->links();
foreach ($links as $link) {
        yield $this->request('GET', $link->getUri());
        $cars = $response->filter('.table-cell--data')->each(function (Crawler $crawler) {

//            $client = Client::createChromeClient();

            return [
                'name' => $crawler->filter('div.table-cell--heading h4')->text(),
                'reference' => $crawler->filter('.table-cell--inner div.table-cell ul.data-list span[title~="Stock"]')->text(),
                'country_of_origin' => $crawler->filter('.table-cell--inner div.table-cell ul.data-list span[title~="Country Of Origin:"]')->text(),
                'acv' => $crawler->filter('.table-cell--inner div.table-cell:nth-child(4n) ul.data-list li:nth-child(8n) span[title~="ACV:"]')->text(),
                'market' => $crawler->filter('.table-cell--inner div.table-cell:nth-child(4n) ul.data-list li:nth-child(4n) span[title~="Market:"]')->text(),
                'price' => $crawler->filter('.table-cell-horizontal-center ul.data-list >li.data-list__item:nth-child(3n)')->text(),

            ];
        });

        foreach ($cars as $car) {

            yield $this->item([
                'name' => $car['name'],
                'reference' => $car['reference'],
                'market' => $car['market'],
                'price' => $car['price'],
                'source' => 'IAA',
                'acv' => $car['acv'],
                'country_of_origin' => $car['country_of_origin']
            ]);
        }
    }

    }
}
