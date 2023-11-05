<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/logout/page')->with($notification);
    } // End Method


    public function AdminLogin()
    {

        return view('admin.admin_login');
    } // End Method

    public function AdminLogoutPage()
    {
        return view('admin.admin_logout');
    } // End Method

    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        // dd($adminData);
        return view('admin.profile', compact('adminData'));
    }
}
