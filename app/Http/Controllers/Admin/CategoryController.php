<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.categories.index',[
            'categories'  => Category::paginate(10),
            'serialNo'    => 1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'name'   => 'required|max:30|unique:categories,name',
            'image'  => 'max:512',
        ]);
        $image_name = 'category.png';
        if($request->hasFile('image')){ 
            $image_name = time(). '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories'),$image_name);
        }
        $category = Category::create([
            'name' => $request->input('name'),
            'image' => $image_name
        ]);
        $request->session()->flash('success','You have created the Category');
        return redirect(route('admin.category.index'));
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
        return view('Admin.categories.edit',[
            'category' => Category::find($id)
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        try{
            $category = Category::find($id);
            $category->delete();
        }
        catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Category has some records associated with it. Cannot delete!');
            return redirect(route('admin.category.index'));
        }
        $request->session()->flash('success','You have deleted the Category');
        return redirect(route('admin.category.index'));
    }
}
