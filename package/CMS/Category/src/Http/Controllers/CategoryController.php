<?php
namespace CMS\Category\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Category\Repository\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends BaseController{

    public $_category_repo ;
    public function __construct(CategoryInterface $category_repo)
    {
        $this->_category_repo = $category_repo;
    }

    public function list(Request $request){
        $builder = $this->_category_repo->list($request);
        return $this->responseJson(null, 200, 'Thành công', $builder);
    }

    public function show(Request $request){
        $builder = $this->_category_repo->find($request);
        return $this->responseJson(null, 200, 'Thành công', $builder);
    }

    public function delete(Request $request){
        $builder = $this->_category_repo->delete($request);
        return $this->responseJson(null, 200, 'Thành công', $builder);
    }
}
