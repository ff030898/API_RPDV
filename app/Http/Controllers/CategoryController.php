<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    protected $categoryService;
    protected $storeUpdate;

    public function __construct(CategoryService $categoryService, StoreUpdateCategory $storeUpdate)
    {
        $this->categoryService = $categoryService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index()
    {
        $categories = $this->categoryService->getCategories();

        return response()->json(CategoryResource::collection($categories));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateCategory());
    
        $category = $this->categoryService->createNewCategory($request);
        return response()->json(['Categoria inserida com sucesso!'], 201);
       
    }

  
    public function show($id)
    {
        $category = $this->categoryService->getCategory($id);
        if($category){
        return response()->json(new CategoryResource($category));
        }else{
            return response()->json(['Categoria não foi encontrado!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateCategory());

        $category = $this->categoryService->updateCategory($id, $request);
        return response()->json(new CategoryResource($category));
        
    }

   
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return response()->json(['Categoria excluida com sucesso!'], 204);
    }
}