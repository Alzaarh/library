<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'desc' => 'required',
        ]);

        Book::create($data);
    }

    public function update(Book $book, Request $request)
    {
        $book->update($request->input());
    }
}