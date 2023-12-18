<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function detail(string $id)
    {
        $product = Product::find($id);
        $product->load('category');
        $product->load('brand');
        return view('frontend.pages.product-detail', compact('product'));
    }

    /**
     * Display a listing of the resource.
     */

    public function list() {
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $products = Product::where('user_id', $user_id)->get();
            return view('frontend.member.product.list', compact('products'));
        }
        return redirect('/member/login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check()) {
            $categories = Category::all();
            $categories->load('brands');
            $brands = Brand::all();
            $brands->load('category');
            return view('frontend.member.product.create', compact('categories', 'brands'));
        }
        return redirect('/member/login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if(Auth::check()) {
            $data = $request->all();
            if($request->hasFile('image')) {
                $images = [];
                foreach($request->file('image') as $image) {
                    $name = $image->getClientOriginalName();
                    Image::make($image->getRealPath())->resize(85, 84)->save(public_path('upload/product/85x84/' . $name));
                    Image::make($image->getRealPath())->resize(329, 380)->save(public_path('upload/product/329x380/' . $name));
                    Image::make($image->getRealPath())->resize(658, 760)->save(public_path('upload/product/658x760/' . $name));
                    $images[] = $name;
                }
                $data['image'] = json_encode($images);
            }
            return Product::create($data) ? redirect('/member/product/list') : redirect()->back()->with('error', 'Product creation failed.');
        }
        return redirect('/member/login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Auth::check()) {
            $product = Product::find($id);
            $categories = Category::all();
            $categories->load('brands');
            $brands = Brand::all();
            $brands->load('category');
            return view('frontend.member.product.edit', compact('product', 'categories', 'brands'));
        }
        return redirect('/member/login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $data = $request->all();
        $delete_image = $data['delete_image'] ?? null;
        $existingImages = json_decode($product->image, true) ?? [];
        // validate image
        Validator::extend('image_update', function ($attribute, $value, $parameters, $validator) use (
            $delete_image,
            $existingImages
        ) {
            $existingCount = count(array_diff($existingImages, (array) $delete_image));
            $newImagesCount = is_array($value) ? count($value) : 0;
            $totalImagesCount = $existingCount + $newImagesCount;
            return $totalImagesCount <= 3;
        });
        if (!empty($delete_image)) {
            $this->validate($request, [
                'image' => 'require|array|max:3|image_update',
            ], [
                'image.image_update' => 'The image may not have more than 3 items.',
                'image.require' => 'The image field is required.',
            ]);

//            foreach ($delete_image as $image) {
//                $imagePath1 = public_path('upload/product/85x84/' . $image);
//                if (file_exists($imagePath1)) {
//                    unlink($imagePath1);
//                }
//                $imagePath2 = public_path('upload/product/329x380/' . $image);
//                if (file_exists($imagePath2)) {
//                    unlink($imagePath2);
//                }
//                $imagePath3 = public_path('upload/product/658x760/' . $image);
//                if (file_exists($imagePath3)) {
//                    unlink($imagePath3);
//                }
//            }
            if ($request->hasFile('image')) {
                $images = [];
                foreach ($request->file('image') as $image) {
                    $name = $image->getClientOriginalName();
                    Image::make($image->getRealPath())->resize(85, 84)->save(public_path('upload/product/85x84/' . $name));
                    Image::make($image->getRealPath())->resize(329, 380)->save(public_path('upload/product/329x380/' . $name));
                    Image::make($image->getRealPath())->resize(658, 760)->save(public_path('upload/product/658x760/' . $name));
                    $images[] = $name;
                }
                $data['image'] = json_encode(array_merge($existingImages, $images));
            } else {
                $data['image'] = json_encode($existingImages);
            }
        }

        return redirect('/member/product/list')->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::check()) {
            $product = Product::find($id);
            if($product) {
                $product->delete();
                return redirect()->back()->with('success', 'Product deleted successfully.');
            }
            return redirect()->back()->with('error', 'Product not found.');
        }
        return redirect('/member/login');
    }
}
