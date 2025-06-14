<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public $users = [
        [
            'id' => 1,
            'name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com'
        ],
        [
            'id' => 2,
            'name' => 'Bob Smith',
            'email' => 'bob.smith@example.com'
        ],
        [
            'id' => 3,
            'name' => 'Carol Lee',
            'email' => 'carol.lee@example.com'
        ],
        [
            'id' => 4,
            'name' => 'David Kim',
            'email' => 'david.kim@example.com'
        ],
        [
            'id' => 5,
            'name' => 'Eva Brown',
            'email' => 'eva.brown@example.com'
        ]
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([

            'message' => "get all users",
            'data' => $this->users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)

    {
        return response()->json([
            'message' => 'create user successfuly',
            'data' => [
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email
            ]

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        foreach ($this->users as $user) {
            if ($user['id'] == $id) {
                return response()->json([
                    'message' => 'user found',
                    'data' => $user
                ], 200);
            }
        }

        return response()->json([
            'message' => 'user not found',

        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        foreach ($this->users as $index => $user) {
            if ($user['id'] == $id) {
                // If no data is sent, return the current user data
                if (empty($request->all())) {
                    return response()->json([
                        'message' => 'Showing current user.',
                        'user' => $user
                    ]);
                }
                // If data is sent, overwrite with request data
                $this->users[$index] = $request->all();

                return response()->json([
                    'message' => 'user updated successfully',
                    'user' => $this->users[$index]
                ]);
            }
        }
        return response()->json(['message' => 'user not found'], 404);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        foreach ($this->users as $index => $user) {
            if ($user['id'] == $id) {
                return response()->json([
                    'message' => "User delete success",
                    'id' => $id
                ], 200);
            }
        }

        // If user not found
        return response()->json([
            'message' => 'user not found, cannot delete'
        ], 404);
    }
}
