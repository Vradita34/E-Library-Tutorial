<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Category;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::orderByDesc('created_at')->get();
        return view('Admin.Books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.Books.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => "required|string",
            'synopsis' => "required|string",
            'author' => "required|string",
            'release_date' => "required|date",
            'read_duration' => "required|integer|min:1|max:14",
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:3124',
            'file' => 'required|file|mimes:pdf,docx',
            'categories' => 'required|array',
            'categories.*' => 'required|exists:categories,id',
        ]);

        try {
            if ($request->file('cover')) {
                $data['cover'] = $request->file('cover')->store('covers', 'public');
            }

            $data['file'] = $request->file('file')->store('files', 'public');
            $data['publisher'] = auth()->user()->username;

            // Create the book entry
            $book = Books::create($data);



            $book->categories()->attach($data['categories']);

        } catch (Exception $e) {
            return redirect()->route('books.create')->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('books.index')->with('success', 'Book successfully created!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Books::findOrFail($id);
        $categories = Category::all();
        return view('Admin.Books.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => "required|string",
            'synopsis' => "required|string",
            'author' => "required|string",
            'release_date' => "required|date",
            'read_duration' => "required|integer|min:1|max:14",
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:3124',
            'file' => 'nullable|file|mimes:pdf,docx',
            'categories' => 'nullable|array',
            'categories.*' => 'required|exists:categories,id',
        ]);

        try {
            $book = Books::findOrFail($id);

            $book->title = $validate['title'];
            $book->synopsis = $validate['synopsis'];
            $book->author = $validate['author'];
            $book->release_date = $validate['release_date'];
            $book->read_duration = $validate['read_duration'];

            if($request->hasFile('cover')){
                if($book->cover && Storage::disk('public')->exists($book->cover)){
                    Storage::disk('public')->delete($book->cover);
                }
                $book->cover = $request->file('cover')->store('covers','public');
            }
            if($request->hasFile('file')){
                if($book->file && Storage::disk('public')->exists($book->file)){
                    Storage::disk('public')->delete($book->file);
                }
                $book->file = $request->file('file')->store('files','public');
            }
            $book->save();
            if($request->has('categories')){
                $book->categories->sync($validate['categories']);
            }
            return redirect()->route('books.edit',$id)->with('success','Update  Book Successfully');
        } catch (Exception $e) {
            return redirect()->route('books.edit',$id)->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $book = Books::findOrFail($id);
            if($book->cover !== null){
                Storage::disk('public')->delete($book->cover);
            }
            if($book->file !== null){
                Storage::disk('public')->delete($book->file);
            }
            $book->categories()->detach();
            $book->delete();
            return redirect()->back()->with('success',"Delete Book Success");
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
