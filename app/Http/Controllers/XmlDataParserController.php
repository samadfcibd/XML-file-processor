<?php

namespace App\Http\Controllers;

use App\DataParserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class XmlDataParserController extends Controller implements DataParserInterface
{
    public function parseData($file): Collection
    {
        $xml = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOCDATA);


        // Process data
        $data = collect();
        foreach ($xml->children() as $item) {
            $data->push([
                'entity_id' => (int) $item->entity_id,
                'category_name' => (string) $item->CategoryName,
                'sku' => (string) $item->sku,
                'name' => (string) $item->name,
                'description' => $this->convertEmptyStringToNullValue((string) $item->description),
                'short_description' => (string) $item->shortdesc,
                'price' => (float) $item->price,
                'link' => (string) $item->link,
                'image' => (string) $item->image,
                'brand' => (string) $item->Brand,
                'rating' => (int) $item->Rating,
                'caffeine_type' => (string) $item->CaffeineType,
                'count' => (int) $item->Count,
                'flavored' => $this->convertEmptyStringToNullValue((string) $item->Flavored),
                'seasonal' => $this->convertEmptyStringToNullValue((string) $item->Seasonal),
                'instock' => (string) $item->Instock,
                'facebook' => (string) $item->Facebook,
                'is_kc_up' => (string) $item->IsKCup,
            ]);
        }

        return $data;
    }

    private function convertEmptyStringToNullValue($value)
    {
        return $value == '' ? null : $value;
    }

    private function quoteString($value)
    {
        return empty($value) ? null : "'" . str_replace("'", "''", $value) . "'";
    }   
}
