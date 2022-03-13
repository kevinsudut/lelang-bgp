<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\ProductRepository;
use App\Helpers\Const\PageName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Jobs\AuctionWinnerJob;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {

    }

    public function myProduct(Request $request)
    {
        $products = $this->productRepository->filter($request, PageName::MY_PRODUCT);

        return view('product.my-product.index', compact('products'));
    }

    public function addProduct(Request $request)
    {
        return view('product.add-product.index');
    }

    public function store(CreateProductRequest $request)
    {
        $product = $this->productRepository->insert([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => $request->file('image')->store('product'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'start_bid' => $request->get('start_bid'),
            'minimum_bid' => $request->get('minimum_bid'),
        ]);

        $jobEndTime = Carbon::parse($product->end_time)->addSeconds(5);
        AuctionWinnerJob::dispatch($product->id)->delay($jobEndTime);

        return redirect()->back()->with('success', 'Successfully add a new product');
    }
}
