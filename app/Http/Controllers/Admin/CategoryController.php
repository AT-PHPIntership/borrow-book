<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Session;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::sortable()->paginate()->appends(\Request::except('page'));
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Http\Requests\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        Session::flash('message_success', trans('category.messages.create_success'));
        return redirect()->back();
    }

    /**
     * Update Category.
     *
     * @param Http\Requests\CategoryRequest $request request
     * @param App\Models\Category           $id      id of Category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return response()->json(['category' => $category, 'msg' => trans('category.messages.update_success')]);
    }

    /**
     * Delete category.
     *
     * @param App\Models\Category $category data of category want to delete
     *
     * @return Response
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            Category::destroy($category->id);
            DB::commit();
            Session::flash('message_success', trans('category.messages.delete_success'));
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('message_fail', trans('category.messages.delete_fail'));
        }
        return redirect()->route('admin.categories.index');
    }
}
