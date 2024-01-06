<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Termwind\render;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha_num'
        ]);

        if ($request->status) {
            $request->merge(['status' => true]);
        } else {
            $request->merge(['status' => false]);
        }
        $request->merge(['user_id' => Auth::user()->id]);
        Category::create($request->all());
        return response()->json([
            'status' => '200',
            'message' => 'Category Added Successfully!'
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.form.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|alpha_num'
        ]);

        if ($request->status) {
            $request->merge(['status', true]);
        } else {
            $request->merge(['status', false]);
        }

        $category->update($request->all());
        return response()->json([
            'status' => '200',
            'message' => 'Category Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' => '200',
            'message' => 'Category Deleted Successfully!'
        ]);
    }

    /**
     * Remove the multiple resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        Category::destroy($request->ids);
        return response()->json([
            'status' => '200',
            'message' => 'Categories Deleted Successfully!'
        ]);
    }

    /**
     * Update the multiple status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdate(Request $request)
    {
        Category::whereIn('id',$request->ids)->update(['status' => $request->status]);
        return response()->json([
            'status' => '200',
            'message' => 'Categories Updated Successfully!'
        ]);
    }
}
