<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
   
    public function index()
    
    {
        $book = new Book();
        return response()->json([
            'message' => 'get all books',
            'data' => Book::all(),
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateBookRequest $request){
        $book = Book::create($request->all());

        return response()->json([
            'message'=>'Book create successfully',
            'data'=> $book
        ],201);


    }


    public function show( string $id)
    {
        $book = Book::where('id',$id)->get();
        if($book){
            return response()-> json([
                'message'=>'Book show success',
                'data'=>$book
            ],200);
        }
       
    }

    public function update(UpdateBookRequest $request, $id)
    {
       $book = Book::where('id',$id)->update([
        'title'=>$request->title,
            'author'=>$request-> author,
            'published_year'=>$request->published_year
       ]);
       if($book){
           return response()->json([
                'message'=> 'book updated successfully',
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
        $book = Book::where('id',$id)->delete();
        if($book){
            return response()->json([
                'message'=>'delete book success',
                'data' => $book
            ],200);
        }
        

        // If book not found
        return response()->json([
            'message' => 'Book not found, cannot delete'
        ], 404);
    }
}
