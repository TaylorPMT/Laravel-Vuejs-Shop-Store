<?php

namespace CMS\Category\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Category\Http\Requests\CategoryRequests;
use CMS\Category\Repository\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

    public $_category_repo;
    public function __construct(CategoryInterface $category_repo)
    {
        $this->_category_repo = $category_repo;
    }

    public function list(Request $request)
    {
        $builder = $this->_category_repo->list($request);
        return $builder;
    }

    public function show(CategoryRequests $request)
    {
        $builder = $this->_category_repo->find($request);
        return $builder;
    }

    public function delete(Request $request)
    {
        $builder = $this->_category_repo->delete($request);
        return $builder;
    }

    public function update(CategoryRequests $request, $id)
    {
        $builder = $this->_category_repo->update($request);
        return $builder;
    }

    public function create(Request $request)
    {
        $builder = $this->_category_repo->create($request);
        return $builder;
    }
}