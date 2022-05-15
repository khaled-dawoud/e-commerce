<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //withCount using for create new fake column called products_count and u can use it instead of releation name
    public function index()
    {
        $categories = Category::with('products')->withCount('products')->orderBy('id', 'desc')->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate input
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // upload the file
        $new_image = rand() . rand() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/images'), $new_image);

        // Save data to database
        Category::create([
            'name' => $request->name,
            'image' => $new_image,
            'parent_id' => $request->parent_id,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->where('id', '<>', $category->id)->get(); // one
        return view('admin.categories.edit', compact('categories', 'category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate input
        $request->validate([
            'name' => 'required',
            'image' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        //old Image
        $category = Category::findOrFail($id);
        $new_image = $category->image;

        //chang image
        if ($request->hasFile('image')) {
            // upload the file
            $new_image = rand() . rand() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images'), $new_image);
        }

        // Save data to database
        $category->update([
            'name' => $request->name,
            'image' => $new_image,
            'parent_id' => $request->parent_id,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        //Delete Image
        if (file_exists(public_path('uploads/images/' . $category->image))) {
            File::delete(public_path('uploads/images/' . $category->image));
        }

        //Set Parent Id To Null
        Category::where('parent_id', $category->id)->update(['parent_id' => null]); //الشبكة
        // Category::where('parent_id', $category->id)->delete();

        //Delete Item
        $category->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('admin.categories.index')->with($notification);
    }
}
