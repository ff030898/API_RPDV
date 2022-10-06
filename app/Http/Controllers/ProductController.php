<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProducts;
use App\Http\Resources\ProductsResource;
use App\Services\ProductsService;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    protected $productService;
    protected $storeUpdate;

    public function __construct(ProductsService $productService, StoreUpdateProducts $storeUpdate)
    {
        $this->productService = $productService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index($id)
    {
        $products = $this->productService->getProducts($id);

        return response()->json(ProductsResource::collection($products));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateProduct());
    
        $product = $this->productService->createNewProduct($request);
        return response()->json(['Produto inserido com sucesso!'], 201);
       
    }

  
    public function show($id)
    {
        $product = $this->productService->getProduct($id);
        if($product){
        return response()->json(new ProductsResource($product));
        }else{
            return response()->json(['Produto não foi encontrado!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateProduct());

        $product = $this->productService->updateProduct($id, $request);
        return response()->json(new ProductsResource($product));
        
    }

   
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['Produto excluido com sucesso!'], 204);
    }
}