<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query("limit", 10);
        if ($limit > 100) {
            $limit = 100;
        }
        $page = $request->query("page", 1);
        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        $products = Product::skip($offset)->take($limit)->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:category,id',
            ], [
                //Custom messages
                "name.required" => "Name is required...",
            ]);

            $product = Product::create($validatedData);
            return response()->json($product, Response::HTTP_CREATED);
        } catch (ValidationException $th) {
            return response()->json(["error" => $th->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $validatedData = $request->validated();
            $product->update($validatedData);
            return response()->json($product, Response::HTTP_OK);
        } catch (Exception $th) {
            return response()->json(["error" => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(["message" => "Product deleted successfully"], Response::HTTP_OK);
    }
}
