<?php

namespace CMS\News\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\News\Repository\NewRepositoryInterface;
use Illuminate\Http\Request;

class NewsCategoryController extends BaseController
{
    public $_category_repo;
    public function __construct(NewRepositoryInterface $category_repo)
    {
        $this->_category_repo = $category_repo;
    }

    public function list(Request $request)
    {
        $builder = $this->_category_repo->list($request);
        return $builder;
    }

    public function show(Request $request)
    {
        $builder = $this->_category_repo->find($request);
        return $builder;
    }

    public function delete(Request $request)
    {
        $builder = $this->_category_repo->delete($request);
        return $builder;
    }

    public function update(Request $request, $id)
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