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
    public function import(ProductImportRequest $request)
    {
        try {
            $this->importData($request->file('import_file'));
            return back()->with('success', 'Products file imported successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Products file import failed.');
        }
    }

    public function importData($file)
    {
        $fileExtention = $file->getClientOriginalExtension();

        $readerType = [
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'ods' => \Maatwebsite\Excel\Excel::ODS,
            'xls' => \Maatwebsite\Excel\Excel::XLS,
            'xlsx' => \Maatwebsite\Excel\Excel::XLSX,
            'xml' => \Maatwebsite\Excel\Excel::XML,
        ];

        Excel::import(new ProductsImport, $file, null, $readerType[$fileExtention]);
    }
}
