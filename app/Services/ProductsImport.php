<?php

namespace App\Services;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{

    /**
     * @param $collection
     * @return void
     */
    public function collection( $collection ): void
    {
        foreach ($collection as $row) {
            $product = Product::updateOrCreate(
                ['sku' => $row['sku']],
                [
                    'name' => $row['name'],
                    'sku' => $row['sku'],
                    'fdw_sku' => $row['fdw_sku'],
                    'stock' => $row['stock'],
                    'cog' => $row['cog'],
                    'price' => $row['price'],
                    'length' => $row['length'],
                    'width' => $row['width'],
                    'height' => $row['height'],
                    'weight' => $row['weight']
                ]
            );

            $this->addColours($product, $row);
            $this->addAsins($product, $row);
        }
    }

    /**
     * @param $product
     * @param $row
     * @return void
     */
    public function addColours($product, $row): void
    {
        $colours = [];
        for ($i = 0; $i < 3; $i++) {
            if ($row["colour_" . $i] != "") {
                $colours[] = $row["colour_" . $i];
            }
        }

        foreach ($colours as $colour) {
            $product->attributes()->updateOrCreate(
                ["value" => $colour],
                [
                    "name" => "colour",
                    "value" => $colour
                ]
            );
        }
    }

    /**
     * @param $product
     * @param $row
     * @return void
     */
    public function addAsins($product, $row): void
    {
        $country_code = ["uk", "ca", "us", "fr", "de", "es", "it", "nl", "se"];
        foreach ($country_code as $code) {
            if ($row["asin_" . $code] != "") {
                $product->asins()->updateOrCreate(
                    ["country_code" => $code],
                    ["asin" => $row["asin_" . $code]]
                );
            }
        }
    }
}
