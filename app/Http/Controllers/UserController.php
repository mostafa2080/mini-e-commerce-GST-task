<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.usersList', compact('users'));
    } // End Method

    public function InactiveUser($id)
    {
        User::findOrFail($id)->update(['status' => 'inactive']);
        $notification = array(
            'message' => 'User Inactivated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function activeUser($id)
    {
        User::findOrFail($id)->update(['status' => 'active']);
        $notification = array(
            'message' => 'User Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method


    public function getUserData()
    {
        $user = auth()->user();
        return response()->json(['user' => $user], 200);
    }

    public function updateUserData(UpdateUserRequest $request, User $user)
    {
        if ($user->id !== auth()->user()->id && auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validated();
        $user->update($data);

        return response()->json(['message' => 'User data updated successfully'], 200);
    } //End Method
}
