<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all categories
        return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //Validate data
         $data = $request->only('name');
         $validator = Validator::make($data, [
             'name' => 'required|string',
         ]);
 
         //Send failed response if request is not valid
         if ($validator->fails()) {
             return response()->json(['error' => $validator->messages()], 200);
         }
 
         //Request is valid, create new product
         $category = Category::create([
             'name' => $request->name,
             'user_id' => $this->user->id,
         ]);
 
         //Product created, return success response
         return response()->json([
             'success' => true,
             'message' => 'Category created successfully',
             'data' => $category
         ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, category not found.'
            ], 400);
        }
    
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //Validate data
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update product
        $category = $category->update([
            'name' => $request->name,
            'user_id' => $this->user->id,
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
