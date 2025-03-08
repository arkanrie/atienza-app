<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\TaskService;

class ProductController extends Controller
{
   

    public function __construct( protected TaskService $taskService)
    {
        
    }

    public function index(ProductService $productService)
    {
        $newProduct = [
            'id' => 4,
            'name' => 'orange',
            'category' => 'fruit' // Fixed missing quotes
        ];

        $productService->insert($newProduct);
        // $this->taskService->add('add to cart');
        // $this->taskService->add('checkout');

        $data = [
            'products' => $productService->listProducts(), // Removed extra space in 'products '
            'tasks' => $this->taskService->getAllTask(),
        ];  

        return view('product.index', $data); // Added missing semicolon
    }

    public function show(ProductService $productService, string $id)
    {
        $product = collect($productService->listProducts())->filter(function($item) use ($id){
        return $item['id'] == $id;
    })->first();

    return $product;
}

    

}
