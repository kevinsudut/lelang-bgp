<?php

namespace App\Http\Controllers;

use App\Domains\Product\ProductRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('home');
    }
}
