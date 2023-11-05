<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\Image as ModelsImage;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }


    public function store(AddProductRequest $request)
    {

        $data = $request->validated();

        if ($request->file('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = date('YmdHi') . $mainImage->getClientOriginalName();
            $mainImage->move(public_path('upload/category_images'), $mainImageName);
            $data['main_image'] = $mainImageName;
        }
        if ($request->has('old_price')) {
            $data['old_price'] = $request->input('old_price');
        }
        $product = Product::create($data);

        if ($request->file('images')) {
            $image = $request->file('images');
            foreach ($image as $gallery_image) {

                $name_gen = hexdec(uniqid()) . '.' . $gallery_image->getClientOriginalExtension();

                Image::make($gallery_image)->resize(220, 220)->save('upload/product_images/product_gallery' . $name_gen);
                $save_url = 'upload/product_images/product_gallery' . $name_gen;

                ModelsImage::insert([

                    'url' => $save_url,
                    'product_id' => $product->id,
                    'created_at' => Carbon::now()

                ]);
            }
        } // End of the foreach

        $notification = array(
            'message' => 'Product Created Successfully! ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function index()
    {
        $products = Product::latest()->paginate(2);
        $products = generateImageLinks('product_images', $products);
        return response()->json($products);
    } //End Method

    public function getProductsByCategory(Category $category)

    {
        return response()->json([
            'category' => $category->load('products'),
        ]);
    } //End Method
}
