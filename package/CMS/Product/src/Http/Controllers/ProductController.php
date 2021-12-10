<?php

namespace CMS\Product\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Product\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    private $_productRepo;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->_productRepo = $productRepositoryInterface;
    }

    public function list(Request $request)
    {
        $builder = $this->_productRepo->list($request);
        return $builder;
    }

    public function show(Request $request)
    {
        $builder = $this->_productRepo->find($request);
        return $builder;
    }

    public function delete(Request $request)
    {
        $builder = $this->_productRepo->delete($request);
        return $builder;
    }

    public function update(Request $request, $id)
    {
        $builder = $this->_productRepo->update($request);
        return $builder;
    }

    public function create(Request $request)
    {
        $builder = $this->_productRepo->create($request);
        return $builder;
    }
}