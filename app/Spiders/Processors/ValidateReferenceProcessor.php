<?php

namespace App\Spiders\Processors;

use App\Models\Cars;
use RoachPHP\ItemPipeline\ItemInterface;
use App\Helper\ItemProcessor;

class ValidateReferenceProcessor extends ItemProcessor
{
    public function processItem(ItemInterface $item): ItemInterface
    {

        // get references of cars in db
        $car = Cars::where('reference', $item->get('reference'))->get();

        // pluck the references
        $reference = $car->pluck('reference');

        //check if the references exist in db
        if ($reference !== null) {

            // loop through all of the refs
            foreach ($reference as $ref) {
                if ($ref === $item->get('reference')) {
                    // drop them
                    return $item->drop('Already exists in database');
                }
            }
        }
        return $item;
    }
}
