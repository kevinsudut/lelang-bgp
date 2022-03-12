<?php

namespace App\Http\Controllers;

use App\Domains\Product\ProductRepository;
use App\Helpers\Const\PageName;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        $products = $this->productRepository->filter($request, PageName::HOME);

        return view('home', compact('products'));
    }
}
