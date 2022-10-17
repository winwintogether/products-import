<?php
use Illuminate\Http\UploadedFile;

test('see import form', function () {
    $this->get(route('product.index'))
        ->assertSee('Import Product');
});

test('can import product from csv', function () {
    $file = UploadedFile::fake()
        ->createWithContent(
            'products.csv',
            file_get_contents(base_path('tests/data/products.csv')),
        );
    $response = $this->post(route('product.import'), [
        'csv_file' => $file,
    ]);
    $response->assertSessionHas('success', 'CSV file imported successfully.');
});
