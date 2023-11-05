<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;


class BannerController extends Controller
{
    public function create()
    {
        return view('admin.banners.add');
    }

    public function store(AddBannerRequest $request)
    {
        $data = $request->validated();

        if ($data['image']) {
            $image = $data['image'];
            $imageName = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/banner_images'), $imageName);
            $data['image'] = $imageName;
        }
        Banner::create($data);
        $notification = [
            'message' => 'Banner Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    } // End Method


    public function listBanners()
    {
        $banners = Banner::latest()->get();

        $banners = generateImageLinks('banner_images', $banners);
        return response()->json([
            'Banners' => $banners
        ]);
    } //End Method
}
