<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function csvImport(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);
        Excel::import(new ProductsImport, $request->file('csv_file'), null, \Maatwebsite\Excel\Excel::CSV);
        return back()->with('success', 'CSV file imported successfully.');
    }
}
