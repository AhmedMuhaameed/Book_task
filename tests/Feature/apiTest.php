<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Maatwebsite\Excel\Facades\Excel;

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

        $response->assertStatus(200);
    }

    public function test_if_uploaded_file_empty()
    {
        $response = $this->post('/import_excel', [])->assertRedirect('/');
    }
}
