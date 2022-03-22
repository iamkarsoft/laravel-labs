<?php

namespace App\Spiders\Processors;

use App\Models\Cars;
use RoachPHP\ItemPipeline\ItemInterface;
use App\Helper\ItemProcessor;


class SaveCarDetailsToDbProcessor extends ItemProcessor
{

    public function processItem(ItemInterface $item): ItemInterface
    {

            Cars::create([
                'name' => $item->get('name'),
                'reference' => $item->get('reference'),
                'price' => $item->get('price'),
                'source' => $item->get('source'),
                'acv' => $item->get('acv'),
                'market' => $item->get('market'),
                'country_of_origin' => $item->get('country_of_origin')
            ]);
        return $item;

    }
}
