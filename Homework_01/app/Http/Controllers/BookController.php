<?php

namespace App\Http\Controllers;

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
        return response()->json([
            'message' => "get all books",
            'data' => $this->books
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return response()->json([
            'message' => 'create successfuly',
            'data' => [
                'id' => $request->id,
                'title' => $request->title,
                'authorId' => $request->authorId,
                'isbn' => $request->isbn,
                'publicationYear' => $request->publicationYear,
                'genre' => $request->genre,
                'availableCopies' => $request->availableCopies


            ]
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function find($books, $id)
    {
        foreach ($books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }
        return 'Book not found';
    }
    public function show(Request $request, string $id)
    {
        return response()->json([
            'message' => 'Book found',
            'data' => $this->find($this->books, $id)
        ], 200);
    }

    public function update(Request $request, $id)
    {
        foreach ($this->books as $index => $book) {
            if ($book['id'] == $id) {
                // If no data is sent, return the current book data
                if (empty($request->all())) {
                    return response()->json([
                        'message' => 'Showing current book.',
                        'book' => $book
                    ]);
                }
                // If data is sent, overwrite with request data
                $this->books[$index] = $request->all();

                return response()->json([
                    'message' => 'Book updated successfully',
                    'book' => $this->books[$index]
                ]);
            }
        }
        return response()->json(['message' => 'Book not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        foreach ($this->books as $index => $book) {
            if ($book['id'] == $id) {
                return response()->json([
                    'message' => "Delete success",
                    'id' => $id
                ], 200);
            }
        }

        // If book not found
        return response()->json([
            'message' => 'Book not found, cannot delete'
        ], 404);
    }
}
