<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public $authors = [
        [
            "id" => "A101",
            "name" => "J.R.R. Tolkien",
            "bio" => "English author best known for 'The Hobbit' and 'The Lord of the Rings'.",
            "nationality" => "British"
        ],
        [
            "id" => "A102",
            "name" => "George Orwell",
            "bio" => "English novelist and essayist, famous for '1984' and 'Animal Farm'.",
            "nationality" => "British"
        ],
        [
            "id" => "A103",
            "name" => "Harper Lee",
            "bio" => "American author known for her novel 'To Kill a Mockingbird'.",
            "nationality" => "American"
        ]
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => "get all authors",
            'data' => $this->authors
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return response()->json([
            'message' => "creat author successfully",
            'data' => [
                'id' => $request->id,
                'name' => $request->name,
                'bio' => $request->bio,
                'nationality' => $request->nationality

            ]
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        foreach ($this->authors as $author) {
            if ($author['id'] == $id) {
                return response()->json([
                    'message' => 'Author found',
                    'data' => $author
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Author not found',

        ], 404);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        foreach ($this->authors as $index => $author) {
            if ($author['id'] == $id) {
                // If no data is sent, return the current book data
                if (empty($request->all())) {
                    return response()->json([
                        'message' => 'Showing current book.',
                        'book' => $author
                    ]);
                }
                // If data is sent, overwrite with request data
                $this->authors[$index] = $request->all();

                return response()->json([
                    'message' => 'author updated successfully',
                    'book' => $this->authors[$index]
                ]);
            }
        }
        return response()->json(['message' => 'Author not found'], 404);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        foreach ($this->authors as $index => $author) {
            if ($author['id'] == $id) {
                return response()->json([
                    'message' => "Delete author success",
                    'id' => $id
                ], 200);
            }
        }
        return response()->json([
            'message' => 'Author not found, cannot delete'
        ], 404);
    }
}
