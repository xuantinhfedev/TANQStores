<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category;
        $uploatPath = 'uploads/category/';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $uploatPath.$filename;
        }
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true?'1':'0';
        $category->save();

        return redirect('admin/category')->with('message', 'Danh mục được thêm mới thành công');
    }

    public function edit(Category $category){

        // dd($category);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category){

        $category = Category::findOrFail($category);

        $validatedData = $request->validated();
        $uploatPath = 'uploads/category/';
        if($request->hasFile('image')){
            $path = 'uploads/category/'.$category->image;
            // dd($path);
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $uploatPath.$filename;
        }
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true?'1':'0';
        $category->update();

        return redirect('admin/category')->with('message', 'Danh mục được cập nhật thành công');
    }

    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        return redirect('admin/category')->with('message', 'Xóa bản ghi thành công!!');
    }
}
