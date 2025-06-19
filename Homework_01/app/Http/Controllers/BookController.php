<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $books = [
        [
            'id' => '1',
            'title' => "The Great Gatsby",
            'authorId' => 101,
            'isbn' => "9780743273565",
            'publicationYear' => 1925,
            'genre' => "Classic",
            'availableCopies' => 5
        ],
        [
            'id' => '2',
            'title' => "To Kill a Mockingbird",
            'authorId' => 102,
            'isbn' => "9780060935467",
            'publicationYear' => 1960,
            'genre' => "Fiction",
            'availableCopies' => 3
        ],
        [
            'id' => '3',
            'title' => "1984",
            'authorId' => 103,
            'isbn' => "9780451524935",
            'publicationYear' => 1949,
            'genre' => "Dystopian",
            'availableCopies' => 4
        ],
        [
            'id' => '4',
            'title' => "Pride and Prejudice",
            'authorId' => 104,
            'isbn' => "9780141439518",
            'publicationYear' => 1813,
            'genre' => "Romance",
            'availableCopies' => 2
        ],
        [
            'id' => '5',
            'title' => "The Hobbit",
            'authorId' => 105,
            'isbn' => "9780345339683",
            'publicationYear' => 1937,
            'genre' => "Fantasy",
            'availableCopies' => 6
        ]
    ];


    public function index()
    
    {
        $book = new Book();
        return response()->json([
            'message' => "get all books",
            'data' => Book::all(),
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $book = Book::create([
            'title'=>$request->title,
            'author'=>$request-> author,
            'published_year'=>$request->published_year

        ]);
        if($book){
             return response()->json([
            'message' => 'create successfuly',
            'data' => $book
                
        ], 201); 
        }
        return response()->json([
            'message'=>'Book create failed'
        ],203);
      
    }


    public function show( string $id)
    {
        $book = Book::where('id',$id)->get();
        if($book){
            return response()-> json([
                'message'=>"Book show success",
                'data'=>$book
            ],200);
        }
        return response()->json([
            'message'=> "book cannot show"
        ],203);
    }

    public function update(Request $request, $id)
    {
       $book = Book::where('id',$id)->update([
        'title'=>$request->title,
            'author'=>$request-> author,
            'published_year'=>$request->published_year
       ]);
       if($book){
           return response()->json([
                'message'=> "book updated successfully",
                'data'=>$book
            ],201);
       }
            return response()->json(['message' => 'Book not found'], 404);
        }
   
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $book = Book::where('id',$id)->delete([

        ]);
        if($book){
            return response()->json([
                'message'=>"delete book success",
                'data' => $book
            ],200);
        }
        

        // If book not found
        return response()->json([
            'message' => 'Book not found, cannot delete'
        ], 404);
    }
}
