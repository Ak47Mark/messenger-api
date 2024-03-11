<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'username' => 'required|min:3|max:255|unique:users,username',
                'email' => 'required|min:3|max:255|email|unique:users,email',
                'password' => 'required|min:3|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 400);
        }


        $user = new User();
        $user->fill($request->all());
        $user->status = "active";
        $user->save();

        return response()->json($user, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
