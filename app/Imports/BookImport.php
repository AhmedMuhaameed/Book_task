<?php

namespace App\Imports;

use App\Book;
use App\Author;

// use App\Inserted;
use Maatwebsite\Excel\Concerns\ToModel;

class BookImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Book([
            'name' => $row[0],
            'description' => $row[1],
            'author_name' => $row[2],
        ]);
    }
}
