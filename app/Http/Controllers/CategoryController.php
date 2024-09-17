<?php

namespace App\Http\Controllers;

use App\Models\category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('created_at')->get();
        return view('Admin.Categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view('Admin.Categories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        try{
            Category::create($validate);
            return redirect()->route('categories.create')->with('success','Create Category Success');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Admin.Categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validate = $request->validate([
            'name' => 'required|string',
        ]);
        try{
            $category = Category::findOrFail($id);
            $category->name = $validate['name'];
            $category->save();
            return redirect()->back()->with('success','Update Category Success');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->back()->with('success','Delete Successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error','Delete error with'. $e->getMessage());
        }
    }
}
