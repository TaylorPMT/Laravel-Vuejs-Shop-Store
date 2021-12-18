<?php

namespace CMS\Frontend\Repository;

use App\Repository\BaseRepository;
use CMS\Category\Models\Category;
use CMS\Category\Repository\CategoryInterface;

class FrontendRepository extends BaseRepository implements CategoryInterface
{
    public $_category;
    public function __construct(Category $category)
    {
        $this->_category = $category;
    }
    public function category()
    {
        $data = $this->_category->get();
        return $data;
    }
}