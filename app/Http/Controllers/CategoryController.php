<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = category::latest()->get();

        return view('createCategories', compact('categories'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $data = [

            'name' => $request->name,

        ];


        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->back()

            ->with('success', 'Category Added Successfully');
    }



    public function edit($id)
    {
        $categories = category::latest()->get();

        $editCategory = category::findOrFail($id);

        return view('viewCategories', compact(
            'categories',
            'editCategory'
        ));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $editCategory = Category::findOrFail($id);

        $data = [

            'name' => $request->name,

        ];

        if ($request->hasFile('image')) {



            if ($editCategory->image) {

                Storage::disk('public')->delete($editCategory->image);
            }


            $data['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $editCategory->update($data);

        return redirect()

            ->route('categories.index')

            ->with('success', 'Category Updated Successfully');
    }


    public function destroy($id)
    {
        $editCategory = Category::findOrFail($id);

        $editCategory->delete();

        return redirect()->back()

            ->with('success', 'Category Deleted Successfully');
    }


    public function apiCategories()
    {
        $categories = Category::withCount('products')
            ->latest()
            ->get()
            ->map(function ($cat) {

                $cat->image_url = $cat->image
                    ? asset('storage/' . $cat->image)
                    : null;

                return $cat;
            });

        return response()->json($categories);
    }   
}