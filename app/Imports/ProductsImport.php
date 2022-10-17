<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{

    /**
     * @param $rows
     * @return void
     */
    public function collection($rows)
    {
        foreach ($rows as $row) {
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
            $this->addAssins($product, $row);
        }
    }

    /**
     * @param $product
     * @param $row
     * @return void
     */
    public function addColours($product, $row)
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
    public function addAssins($product, $row)
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
