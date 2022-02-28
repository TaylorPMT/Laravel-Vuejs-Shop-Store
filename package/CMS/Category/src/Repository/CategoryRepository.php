<?php

namespace CMS\Category\Repository;

use App\Repository\BaseRepository;
use CMS\Category\Models\Category;
use Illuminate\Support\Str;

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
        $builder = $builder->where(function ($query) use ($request) {
            if ($request->get('key_word')) {
                $query->where('name', 'LIKE', "%$request->key_word%");
            }
        });
        $builder = $this->querySelectList($builder, $request);
        return $this->responseJson(false, 200, 'Thành công', $builder);
    }

    public function find($request)
    {
        try {
            $error = false;
            $message = $this->_messagesSuccess;
            $builder =  $this->queryCollection();
            $builder = $builder->where(function ($query) use ($request) {
                $id = $request->id;
                if (!empty($id)) {
                    $query->where('id', $id);
                }
            });
            $builder = $builder->first();
            if (empty($builder)) {
                $error = true;
                $message = $this->_messagesFails;
            }

            return $this->responseJson($error, 200, $message, $builder);
        } catch (\Exception $e) {
            return $this->responseJson(true, 500, $this->_messagesErrorsException, $e->getMessage());
        }
    }

    public function delete($request)
    {
        try {
            $builder = $this->_model->secureDeleteTrait($request->id);
            return $this->responseJson(false, 200, 'Thành công', $builder);
        } catch (\Exception $e) {
            return $this->responseJson(true, 500, $this->_messagesErrorsException, $e->getMessage());
        }
    }

    public function update($request)
    {
        try {
            $data = $this->formatData($request->all());
            $builder =  $this->_model->find($request->id)->update($data);
            return $this->responseJson(false, 200, 'Thành công', $builder);
        } catch (\Exception $e) {
            return $this->responseJson(true, 500, $this->_messagesErrorsException, $e->getMessage());
        }
    }

    public function formatData($data)
    {
        $list = collect($data)->map(function ($value, $key) use ($data) {
            if ($key == 'link') {
                if (!empty($data['name'])) {
                    return Str::slug($data['name']);
                }
            }
            return $value;
        })->toArray();
        return $list;
    }

    public function create($request)
    {
        try {
            $data = $this->formatData($request->all());
            $builder = $this->_model->create($data);
            return $this->responseJson(false, 200, 'Thành công', $builder);
        } catch (\Exception $e) {
            return $this->responseJson(true, 500, $this->_messagesErrorsException, $e->getMessage());
        }
    }

    public function getShortCode($list_id, $list_quantity)
    {

        $list_quantity = !empty($list_quantity[0]) ? $list_quantity[0] : 4;
        $data = $this->queryCollection()->whereIn('id', $list_id)->with(['products'])->take($list_quantity)->get();
        $list = [];
        $data = $data->map(function ($value, $index) use (&$list) {
            if (!empty($value->products)) {
                $value->products->map(function ($value) use (&$list) {
                    return   $list[] = $value;
                });
            }
        });
        return $list;
    }
}
