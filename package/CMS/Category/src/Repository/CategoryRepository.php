<?php

namespace CMS\Category\Repository;

use App\Repository\BaseRepository;
use CMS\Category\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryInterface
{

    protected $_model;

    public function __construct(Category $model)
    {
        $this->_model = $model;
    }

    public function queryCollection($condition = [])
    {
        $select_filter = [
            'id',
            'name',
            'image',
            'description',
            'content',
            'parent_id',
            'link',
            'orders'
        ];

        $builder = $this->_model;
        $builder = $builder->selectRaw(implode(',', $select_filter));
        return $builder;
    }

    public function list($request)
    {
        $builder = $this->queryCollection();
        $builder = $this->querySelectList($builder, $request);
        return $this->responseJson(false, 200, 'Thành công', $builder);
    }

    public function find($request)
    {
        $builder =  $this->queryCollection();
        $builder = $builder->where(function ($query) use ($request) {
            $id = $request->id;
            if (!empty($id)) {
                $query->where('id', $id);
            }
        });
        $builder = $builder->first();
        return $this->responseJson(false, 200, 'Thành công', $builder);
    }

    public function delete($request)
    {
        $builder = $this->_model->secureDeleteTrait($request->id);
        return $this->responseJson(false, 200, 'Thành công', $builder);
    }

    public function update($request)
    {
        $builder =  $this->_model->find($request->id)->update($request->all());
        return $this->responseJson(false, 200, 'Thành công', $builder);
    }
}