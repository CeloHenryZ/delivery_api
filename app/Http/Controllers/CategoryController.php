<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\ImagesService;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where("isActive", 1)->get();

        if($categories->isEmpty()){
            return response()->json(["message" => "No category found"], 200);
        }

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        $finalImageName = (new ImagesService())->hashFile($request->category_image);

        $upload = $request->category_image->storeAs('categories', $finalImageName);

        $category = Category::create([
            "category_name"  => $request->category_name,
            "category_image" => $finalImageName,
            "isActive"       => 1
        ]);

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function show($id_category)
    {
        $category = Category::find($id_category);

        if($category == null){
            return response()->json(["message" => "Category not found"], 405);
        }

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_category)
    {
        $category = Category::find($id_category);

        if($category == null){
            return response()->json(["message" => "category not found"], 405);
        }

        if($request->category_name != null){
            $category->category_name = $request->category_name;
        }

        if($request->category_image != null){

            $request->validate(['category_image' => [File::image()]]);
            $finalImageName = (new ImagesService())->hashFile($request->category_image);
            $upload = $request->category_image->storeAs('categories', $finalImageName);

            $category->category_image = $finalImageName;
        }

        if($request->category_name == null && $request->category_image == null){
            return response()->json(["message" => "no data changed"]);
        }

        $category->save();

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
