<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImportRequest;
use App\Services\ProductsImport;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * @param ProductImportRequest $request
     * @return RedirectResponse
     */
    public function csvImport(ProductImportRequest $request)
    {
        try {
            Excel::import(new ProductsImport, $request->file('import_file'), null, \Maatwebsite\Excel\Excel::CSV);
            return back()->with('success', 'CSV file imported successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'CSV file import failed.');
        }
    }
}
