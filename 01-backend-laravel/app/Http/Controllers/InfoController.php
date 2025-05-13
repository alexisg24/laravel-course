<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Services\EncryptService;
use App\Business\Services\ProductService;
use App\Business\Services\SingletonService;
use App\Business\Services\UserService;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InfoController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected EncryptService $encryptService,
        protected UserService $userService,
        protected MessageServiceInterface $hiService,
        protected SingletonService $singleton
    ) {}

    public function message()
    {
        return response()->json($this->hiService->hi());
    }

    public function tax(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(["message" => "Product not found"], Response::HTTP_NOT_FOUND);
        }

        return response()->json($this->productService->calculateTax($product->price));
    }

    public function encrypt(string $data)
    {
        return response()->json($this->encryptService->encrypt($data));
    }

    public function decrypt(string $data)
    {
        return response()->json($this->encryptService->decrypt($data));
    }

    public function encryptEmail(int $id)
    {
        return response()->json($this->userService->encryptEmail($id));
    }

    public function singleton(SingletonService $singletonService2)
    {
        return response()->json($this->singleton->value . " " . $singletonService2->value);
    }

    public function encryptEmail2(int $id)
    {
        $userService = app()->make(UserService::class);
        return response()->json($userService->encryptEmail($id));
    }
}
