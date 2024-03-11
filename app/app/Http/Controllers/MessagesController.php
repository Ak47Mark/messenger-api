<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Events\NewMessage;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with('sender')->get();
        return response()->json($messages);
    }

    public function messagePage()
    {
        $messages = Message::all();
        $users = User::where('id', '!=', auth()->guard('api')->id())->get();
        return view('messenger.index', ['messages' => $messages, 'users' => $users]);
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
                'message' => 'required|max:255',
                'receiver_id' => 'required|exists:users,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 400);
        }

        $message = new Message();
        $message->message = $request->message;
        $message->sender_id = auth()->guard('api')->id();
        $message->receiver_id = $request->receiver_id;
        $message->save();
        return response()->json($message, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $myid = auth()->id();
        $user = $id;

        $messages = Message::with('sender')->where(function ($query) use ($myid, $user) {
            $query->where('receiver_id', $user)
                    ->where('sender_id', $myid);
        })->orWhere(function ($query) use ($myid, $user) {
            $query->where('receiver_id', $myid)
                    ->where('sender_id', $user);
        })->get();
        return response()->json($messages);
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
