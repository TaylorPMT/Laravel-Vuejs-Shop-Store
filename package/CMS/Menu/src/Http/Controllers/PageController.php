<?php

namespace CMS\Menu\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Menu\Repository\MenuInterface;
use Illuminate\Http\Request;

class PageController extends BaseController
{

    public $_menu_repo;
    public function __construct(MenuInterface $category_repo)
    {
        $this->_menu_repo = $category_repo;
    }

    public function list(Request $request)
    {
        $builder = $this->_menu_repo->config_page($request);
        return $builder;
    }

    public function show(Request $request)
    {
        $builder = $this->_menu_repo->find($request);
        return $builder;
    }

    public function delete(Request $request)
    {
        $builder = $this->_menu_repo->delete($request);
        return $builder;
    }

    public function update(Request $request, $id)
    {
        $builder = $this->_menu_repo->updatePage($request);
        return $builder;
    }

    public function create(Request $request)
    {
        $builder = $this->_menu_repo->create($request);
        return $builder;
    }

    public function order(Request $request)
    {
        $builder = $this->_menu_repo->order($request);
        return $builder;
    }
}