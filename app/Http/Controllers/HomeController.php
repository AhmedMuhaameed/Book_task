<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\reportAdmin;

use App\Book;
use App\Author;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BookImport;

class HomeController extends Controller
{
    //
    public function index(){
        $data = Book::all();
        return view('home',compact('data'));
    }

    function _checkDatabaseDuplicates($array)
    {
        for ($i = 1; $i <= count($array); $i++) {
            $book = Book::where('name', '=', $array[$i][0])->exists();
            if ($book === false) {
                $author = Author::where('name', '=', $array[$i][2])->first();
                if ($author === null) {
                    $author = new Author();
                    $author->name = $array[$i][2];
                    $author->save();
                }

                $book = new Book();
                $book->name = $array[$i][0];
                $book->description = $array[$i][1];
                $book->author_id = $author->getAttributeValue('id');
                $book->save();
            }
        }

        return $book;
    }

    function import(Request $request)
    {
        //validate excel file
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlxs',
        ]);

        //get path of the uploaded file
        $path = $request->file('file');
        
        //get data from excel file
        $books = Excel::toArray(new BookImport(), $path);
        
        //if the data from excel not empty
        if (count($books[0]) > 1) {
            
            //delete heading row
            unset($books[0][0]);

            //filter data coming from excel from duplicates
            $excelData = array_unique($books[0], SORT_REGULAR);

            //check if there's a duplicate data in database and save only the new one
            $this->_checkDatabaseDuplicates($excelData);

            //send email to admin
            Mail::to('test@test.com')->send(new reportAdmin("Upload Done successfully"));

            return back()->with('success', 'Excel Data Imported successfuly');
        }

        Mail::to('test@test.com')->send(new reportAdmin("Sorry Upload Failed"));
        return back()->with('fail', 'File is empty');
    }
}
