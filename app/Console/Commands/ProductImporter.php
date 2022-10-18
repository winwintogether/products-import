<?php

namespace App\Console\Commands;

use App\Services\ProductsImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ProductImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:import {file_path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run product:import (file_path ) to import product data from supported files (csv, xls, xlsx, ods, xml) to handle large files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file_path = $this->argument('file_path');

        if($this->importData($file_path)) {
            $this->info('Products import successful!');
        } else {
            $this->error('Products import failed!');
        }

        return Command::SUCCESS;
    }

    public function import($file)
    {
        try {
            return $this->importData($file);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function importData($file)
    {
        $fileExtention = pathinfo($file, PATHINFO_EXTENSION);

        $readerType = [
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'ods' => \Maatwebsite\Excel\Excel::ODS,
            'xls' => \Maatwebsite\Excel\Excel::XLS,
            'xlsx' => \Maatwebsite\Excel\Excel::XLSX,
            'xml' => \Maatwebsite\Excel\Excel::XML,
        ];

        if (!array_key_exists($fileExtention, $readerType)) {
            Log::error('File type does not supported');
            return false;
        }

        return Excel::import(new ProductsImport, $file, null, $readerType[$fileExtention]);
    }
}
