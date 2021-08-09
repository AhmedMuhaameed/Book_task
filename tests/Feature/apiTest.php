<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Book;
class apiTest extends TestCase
{
    /**RefreshDatabase
     * A basic feature test example.
     *
     * @return void
     */

    public function test_if_get_data_works_corretly()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function test_invalid_file_type()
    {
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/import_excel', [
            'file' => $file,
        ]);

        $response->assertSessionHasErrors('file');
    }
    public function test_if_uploaded_file_empty()
    {
        $file = UploadedFile::fake()->create('document.xls',0);

        $response = $this->post('/import_excel', [
            'file' => $file,
        ]);

        $response->assertSessionMissing('success');
    }

    public function test_if_uploaded_file_correct()
    {
        // Session::start();
        $file = UploadedFile::fake()->create('document.xls');


        $response = $this->post('/import_excel', [
            'file' => $file,
        ]);

        $response->assertSessionHasNoErrors('file');
    }
}
