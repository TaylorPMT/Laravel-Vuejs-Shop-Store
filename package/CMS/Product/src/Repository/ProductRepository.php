<?php

namespace CMS\Product\Repository;

use App\Repository\BaseRepository;
use CMS\Product\Models\Product;
use Illuminate\Support\Str;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $_model;

    public function __construct(Product $model)
    {
        $this->_model = $model;
    }

    public function queryCollection($condition = [])
    {
        $select_filter = [
            'id',
            'name',
            'sku',
            'image',
            'description',
            'content',
            'category_id',
            'link'
        ];

        $builder = $this->_model;
        $builder = $builder->selectRaw(implode(',', $select_filter));
        $builder = $builder->with([
            'category'
        ]);
        return $builder;
    }

    public function list($request)
    {
        $builder = $this->queryCollection();
        $builder = $builder->where(function ($query) use ($request) {
            if ($request->get('key_word')) {
                $query->where('name', 'LIKE', "%$request->key_word%")->orWhere('sku', 'LIKE', "%$request->key_word%");
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
            $builder =  $this->_model->find($request->id)->update($this->formatData($request->all()));
            return $this->responseJson(false, 200, 'Thành công', $builder);
        } catch (\Exception $e) {
            return $this->responseJson(true, 500, $this->_messagesErrorsException, $e->getMessage());
        }
    }

    public function create($request)
    {
        try {
            $builder = $this->_model->create($this->formatData($request->all()));
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
}