<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            Product::create($validated);
            return response()->json([
                'message' => 'created'
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => 'Failed creating product'
            ], 400);
        }
    }

    public function update(int $productId, UpdateProductRequest $request): JsonResponse
    {
        $validated = $request->validated();
//        dd($productId, $validated);

        try {
            $product = Product::find($productId);
            $product->update($validated);
            $product->save();

            return response()->json([
                'message' => 'Product updated'
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => 'Failed updating product'
            ]);
        }
    }

    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();
            return response()->json([
                'message' => 'deleted'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Failed deleting product!'
            ], 400);
        }
    }
}
