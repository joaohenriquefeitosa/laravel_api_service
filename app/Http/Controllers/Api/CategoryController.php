<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;    
    }

    public function index(Request $request)
    {
        $category = $this->category->getResults($request->name);
        
        return response()->json($category);
    }

    public function show($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($category);
    }

    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());
        return response()->json($category, 201);
    }

    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);
        
        $category->update($request->all());
        
        return response()->json($category);
    }

    public function delete($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        $category->delete();

        return response()->json([], 204);
    }
}
