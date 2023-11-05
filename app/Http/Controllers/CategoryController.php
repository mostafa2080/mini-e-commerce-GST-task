<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.categories.add');
    }

    public function store(AddCategoryRequest $request)
    {
        $data = $request->validated();
        if ($data['image']) {
            $image = $request->file('image');
            $imageName = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/category_images'), $imageName);
            $data['image'] = $imageName;
        }
        $category = Category::create($data);

        $notification = [
            'message' => 'Category Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('list.categories')->with($notification);
    }

    public function listCategories()
    {
        $categories = Category::latest()->get();
        $categories = generateImageLinks('category_images', $categories);
        return response()->json($categories);
    }
}
