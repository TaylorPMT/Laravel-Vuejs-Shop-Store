<?php

namespace CMS\Frontend\Repository;

use App\Repository\BaseRepository;
use CMS\Category\Models\Category;
use CMS\Category\Repository\CategoryInterface;
use CMS\Menu\Models\Menu;

class FrontendRepository extends BaseRepository implements CategoryInterface
{
    public $_category;
    public $_menus;
    public function __construct(Category $category, Menu $menu)
    {
        $this->_category = $category;
        $this->_menus = $menu;
    }

    public function category()
    {
        $data = $this->_category->get();
        return $data;
    }

    public function menus()
    {

        $data = $this->_menus->orderBy('order', 'asc')->get();

        return $data;
    }
}