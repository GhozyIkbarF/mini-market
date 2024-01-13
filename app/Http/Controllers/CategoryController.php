<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->paginate(5);
        return view('pages.category.index', compact('categories'));
    }

    public function store(Request $request)
    {  
        $request->validate([
            'name' => 'required',
        ]);
      
            $category = new Category;
            $category->name = $request->name;
            $category->save();
            if($category){
                return redirect('/category')->with('success', 'free added successfully.');
            }
            return back()->with('error', 'Failed to add free.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
      
            $free = Category::find($id);
            $free->name = $request->name;
            $free->save();
            if($free){
                return redirect('/category')->with('success', 'free updated successfully.');
            }
            return back()->with('error', 'Failed to update free.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        if($category){
            return redirect('/category')->with('success', 'free deleted successfully.');
        }
        return back()->with('error', 'Failed to delete free.');
    }
}
