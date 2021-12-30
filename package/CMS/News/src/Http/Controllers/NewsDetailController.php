<?php

namespace CMS\News\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\News\Repository\NewsDetailRepositoryInterface;
use Illuminate\Http\Request;

class NewsDetailController extends BaseController
{
    public $_news_repo;
    public function __construct(NewsDetailRepositoryInterface $_news_repo)
    {
        $this->_news_repo = $_news_repo;
    }

    public function list(Request $request)
    {
        $builder = $this->_news_repo->list($request);
        return $builder;
    }

    public function show(Request $request)
    {
        $builder = $this->_news_repo->find($request);
        return $builder;
    }

    public function delete(Request $request)
    {
        $builder = $this->_news_repo->delete($request);
        return $builder;
    }

    public function update(Request $request, $id)
    {
        $builder = $this->_news_repo->update($request);
        return $builder;
    }

    public function create(Request $request)
    {
        $builder = $this->_news_repo->create($request);
        return $builder;
    }
}