<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view(
            'createProduct',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'price' => 'required|numeric',

            'image' => 'nullable|image',

        ]);

        $product = new Product();

        $product->name = $request->name;

        $slug = Str::slug($request->name);

        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $product->slug = $slug;

        $product->price = $request->price;

        $product->discount_price =
            $request->discount_price;

        $product->category_id =
            $request->category_id;

        $product->description =
            $request->description;


        $product->short_title =
            $request->short_title;

        $product->sku =
            $request->sku;

        $product->warranty =
            $request->warranty;

        $product->box_contents =
            $request->box_contents;

        $product->key_features =
            $request->key_features;

        $product->specifications =
            $request->specifications;

        $product->brand =
            $request->brand;

        $product->storage =
            $request->storage;

        $product->color =
            $request->color;

        $product->display_size =
            $request->display_size;

        $product->condition =
            $request->condition;

        $product->rating =
            $request->rating;

        $product->is_featured =
            $request->is_featured ? 1 : 0;

        $product->is_active =
            $request->is_active ? 1 : 0;

        $product->stock =
            $request->stock;

        $product->status = 'approved';

        $product->user_id = auth()->id();



        if ($request->hasFile('image')) {

            $product->image =
                $request->file('image')
                    ->store('products', 'public');
        }

        $product->save();



        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $img) {

                $path = $img->store(
                    'products',
                    'public'
                );

                ProductImage::create([

                    'product_id' => $product->id,

                    'image' => $path

                ]);
            }
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Product Added Successfully'
            );
    }

    public function show($id)
    {
        return redirect()
            ->route('products.index');
    }

    public function index()
    {
        if (
            auth()->user()->hasRole('admin')
        ) {

            $products = Product::with(
                'category',
                'user',
                'images'
            )
                ->latest()
                ->get();

        } else {

            $products = Product::with(
                'category',
                'user',
                'images'
            )
                ->where(
                    'user_id',
                    auth()->id()
                )
                ->latest()
                ->get();
        }

        return view(
            'product',
            compact('products')
        );
    }

    public function edit(Product $product)
    {
        if (

            auth()->user()->hasRole('agent') &&

            $product->user_id != auth()->id()

        ) {

            abort(403);
        }

        $categories = Category::all();

        return view(
            'product.edit',
            compact(
                'product',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        Product $product
    ) {

        if (

            auth()->user()->hasRole('agent') &&

            $product->user_id != auth()->id()

        ) {

            abort(403);
        }

        $request->validate([

            'name' => 'nullable',

            'price' => 'nullable|numeric',

            'image' => 'nullable|image',
            'short_title' => 'nullable|string|max:255',

            'sku' => 'nullable|string|max:255',

            'warranty' => 'nullable|string|max:255',

            'box_contents' => 'nullable|string',

            'key_features' => 'nullable|string',

            'specifications' => 'nullable|string',

            'status' =>
                'nullable|in:approved,unapproved'

        ]);



        if ($request->has('status')) {

            $product->status =
                $request->status;
        }



        if ($request->hasFile('image')) {

            if (

                $product->image &&

                \Storage::disk('public')
                    ->exists($product->image)

            ) {

                \Storage::disk('public')
                    ->delete($product->image);
            }

            $product->image =
                $request->file('image')
                    ->store('products', 'public');
        }



        if ($request->filled('name'))
            $product->name = $request->name;

        if ($request->filled('price'))
            $product->price = $request->price;

        if ($request->filled('discount_price'))
            $product->discount_price =
                $request->discount_price;

        if ($request->filled('category_id'))
            $product->category_id =
                $request->category_id;

        if ($request->filled('description'))
            $product->description =
                $request->description;


        if ($request->filled('short_title'))
            $product->short_title =
                $request->short_title;

        if ($request->filled('sku'))
            $product->sku =
                $request->sku;

        if ($request->filled('warranty'))
            $product->warranty =
                $request->warranty;

        if ($request->filled('box_contents'))
            $product->box_contents =
                $request->box_contents;

        if ($request->filled('key_features'))
            $product->key_features =
                $request->key_features;

        if ($request->filled('specifications'))
            $product->specifications =
                $request->specifications;

        if ($request->filled('stock'))
            $product->stock =
                $request->stock;

        if ($request->filled('brand'))
            $product->brand =
                $request->brand;

        if ($request->filled('storage'))
            $product->storage =
                $request->storage;

        if ($request->filled('color'))
            $product->color =
                $request->color;

        if ($request->filled('display_size'))
            $product->display_size =
                $request->display_size;

        if ($request->filled('condition'))
            $product->condition =
                $request->condition;

        if ($request->filled('rating'))
            $product->rating =
                $request->rating;

        $product->is_featured =
            $request->is_featured ? 1 : 0;

        $product->is_active =
            $request->is_active ? 1 : 0;

        $product->save();



        if ($request->hasFile('images')) {

            // DELETE OLD IMAGES

            foreach ($product->images as $oldImage) {

                if (

                    \Storage::disk('public')
                        ->exists($oldImage->image)

                ) {

                    \Storage::disk('public')
                        ->delete($oldImage->image);
                }

                $oldImage->delete();
            }

            foreach ($request->file('images') as $img) {

                $path = $img->store(
                    'products',
                    'public'
                );

                ProductImage::create([

                    'product_id' => $product->id,

                    'image' => $path

                ]);
            }
        }

        return back()->with(
            'success',
            'Product Updated Successfully'
        );
    }

    public function destroy(Product $product)
    {
        if (

            auth()->user()->hasRole('admin')

            ||

            (
                auth()->user()->hasRole('agent')

                &&

                $product->user_id == auth()->id()
            )

        ) {



            if (

                $product->image &&

                \Storage::disk('public')
                    ->exists($product->image)

            ) {

                \Storage::disk('public')
                    ->delete($product->image);
            }


            foreach ($product->images as $img) {

                if (

                    \Storage::disk('public')
                        ->exists($img->image)

                ) {

                    \Storage::disk('public')
                        ->delete($img->image);
                }

                $img->delete();
            }

            $product->delete();

            return back()->with(
                'success',
                'Product Deleted'
            );
        }

        abort(403);
    }

    public function unapproved()
    {
        if (
            auth()->user()->hasRole('admin')
        ) {

            $products = Product::with(
                'category',
                'user',
                'images'
            )
                ->where(
                    'status',
                    'unapproved'
                )
                ->latest()
                ->get();

        } else {

            $products = Product::with(
                'category',
                'user',
                'images'
            )
                ->where(
                    'status',
                    'unapproved'
                )
                ->where(
                    'user_id',
                    auth()->id()
                )
                ->latest()
                ->get();
        }

        return view(
            'unapproved',
            compact('products')
        );
    }

    public function inventory()
    {
        if (
            auth()->user()->hasRole('admin')
        ) {

            $products = Product::with(
                'category',
                'user',
                'images'
            )
                ->latest()
                ->get();

        } else {

            $products = Product::with(
                'category',
                'user',
                'images'
            )
                ->where(
                    'user_id',
                    auth()->id()
                )
                ->latest()
                ->get();
        }

        return view(
            'inventory',
            compact('products')
        );
    }

    public function apiProducts(Request $request)
    {
        $query = Product::with('category');

      
        if ($request->has('category') && $request->category !== '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $products = $query->latest()->get()->map(function ($product) {
            $product->image_url = $product->image
                ? asset('storage/' . $product->image)
                : null;
            return $product;
        });

        return response()->json($products);
    }
}