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
        return $builder;
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
        return $builder->first();
    }

    public function delete($request){
        $builder = $this->queryCollection();
        $builder = $builder->with(['products'=> function ($query){
            return $query->count();
        }])->find($request->id);

    }
}
