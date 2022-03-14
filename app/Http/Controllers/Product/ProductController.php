<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\ProductRepository;
use App\Domains\Product\ProductBidHistoryRepository;
use App\Helpers\Const\PageName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Jobs\AuctionWinnerJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    private $productRepository;
    private $productBidHistoryRepository;

    public function __construct(ProductRepository $productRepository, ProductBidHistoryRepository $productBidHistoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->productBidHistoryRepository = $productBidHistoryRepository;
    }

    public function index()
    {

    }

    public function myProduct(Request $request)
    {
        $products = $this->productRepository->filter($request, PageName::MY_PRODUCT);

        return view('product.my-product.index', compact('products'));
    }

    public function productPage($id)
    {
        $product = $this->productRepository->getById($id);
        $lastbid = $this->productBidHistoryRepository->getLargestBidding($product);
        if ($product == null) {
            return redirect('/');
        }

        return view('product.product-page.index', compact('product', 'lastbid'));
    }

    public function store(CreateProductRequest $request)
    {
        $product = $this->productRepository->insert([
            'user_id' => auth()->user()->id,
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

    public function destroy(DeleteProductRequest $request)
    {
        $product = $this->productRepository->getById($request->get('id'));

        if (Gate::allows('delete-product', $product)) {
            $this->productRepository->delete($product->id);
            return redirect()->back()->with('success', 'Successfully delete product');
        }

        return redirect()->back()->withErrors('401 UNAUTHORIZED');
    }
}
