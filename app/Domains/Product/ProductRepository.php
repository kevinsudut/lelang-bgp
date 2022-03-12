<?php

namespace App\Domains\Product;

use App\Domains\Core\Repository;
use App\Helpers\Const\PageName;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductRepository extends Repository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function newModel()
    {
        return new Product();
    }

    public function fill(array $data, Model $model)
    {
        $model->user_id = $data['user_id'];
        $model->name = $data['name'];
        $model->description  = $data['description'];
        $model->image = $data['image'];
        $model->start_time = $data['start_time'];
        $model->end_time = $data['end_time'];
        $model->start_bid = $data['start_bid'];
        $model->minimum_bid = $data['minimum_bid'];
        return $model;
    }

    public function filter(Request $request, $source)
    {
        $query = $this->model;

        if ($request->get('start_time') != null) {
            $query = $query->where('start_time', '>=', $request->get('start_time'));
        }

        if ($request->get('end_time') != null) {
            $query = $query->where('end_time', '<=', $request->get('end_time'));
        }

        if (is_numeric($request->get('minimum_bid')) && $request->get('minimum_bid') > 0) {
            $query = $query->where('start_bid', '>=', $request->get('minimum_bid'));
        }

        if (is_numeric($request->get('maximum_bid')) && $request->get('maximum_bid') > 0) {
            $query = $query->where('start_bid', '<=', $request->get('maximum_bid'));
        }

        if ($source == PageName::MY_PRODUCT) {
            $query = $query->where('user_id', auth()->user()->id);
        }

        $query = $query->orderBy('start_time')->orderBy('end_time');

        return $query->paginate(8);
    }
}
