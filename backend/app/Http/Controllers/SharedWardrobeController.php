<?php

namespace App\Http\Controllers;

use App\Models\SharedWardrobe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SharedWardrobeController extends Controller
{
    public function index()
    {
        $sharedWardrobes = SharedWardrobe::with('friend')->where('user_id', auth()->id())->get();
        return response()->json($sharedWardrobes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|exists:users,id',
        ]);

        $sharedWardrobe = SharedWardrobe::create([
            'user_id' => auth()->id(),
            'friend_id' => $request->friend_id,
        ]);

        return response()->json($sharedWardrobe, 201);
    }

    public function invite(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $invitationLink = url('/register?referrer=' . auth()->id());

        Mail::send([], [], function ($message) use ($request, $invitationLink) {
            $message->to($request->email)
                ->subject('Invitation to Join Wardrobe Management System')
                ->setBody('You have been invited to join the Wardrobe Management System. Click the link to register: ' . $invitationLink, 'text/html');
        });

        return response()->json(['message' => 'Invitation sent successfully.']);
    }

    public function destroy(SharedWardrobe $sharedWardrobe)
    {
        $this->authorize('delete', $sharedWardrobe);
        $sharedWardrobe->delete();
        return response()->json(null, 204);
    }
}
