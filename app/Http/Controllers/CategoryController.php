<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(["message" => "Successfully deleted!", "error" => false]);
    }

    public function changestatus($id)
    {
        $category = Category::findOrFail($id);
        $status = $category->status;
        if ($status == 1) {
            $category->status = 0;
        } else {
            $category->status = 1;
        }
        $category->save();
        return response()->json(["message" => "Successfully updated!", "error" => false]);
    }

    public function update()
    {
        $name = request('name');
        $categoryId = request('categoryId');

        $check = Category::where('name', $name)->where('id', '!=', $categoryId)->where('status', 1)->count();
        if ($check > 0) {
            //Category exists
            return response()->json(["message" => "Category exists!", "error" => true]);
        } else {
            // Save Category
            $category = Category::find($categoryId);
            $category->name = $name;
            $category->save();
            return response()->json(["message" => "Successfully Update!", "error" => false]);

        }
    }

    public function store()
    {
        $name = request('name');
        $check = Category::where('name', $name)->where('status', 1)->count();
        if ($check > 0) {
            //Category exists
            return response()->json(["message" => "Category exists!", "error" => true]);
        } else {
            // Save Category
            $category = new Category;
            $category->name = $name;
            $category->save();
            return response()->json(["message" => "Successfully added!", "error" => false]);

        }
    }
}
