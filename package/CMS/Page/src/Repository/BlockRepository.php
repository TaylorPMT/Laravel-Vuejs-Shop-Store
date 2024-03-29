<?php

namespace CMS\Page\Repository;

use App\Repository\BaseInterface;
use App\Repository\BaseRepository;
use CMS\Page\Models\Block;
use Illuminate\Support\Str;

class BlockRepository extends BaseRepository implements BlockRepositoryInterface
{
    protected $_model;

    public function __construct(Block $model)
    {
        $this->_model = $model;
    }

    public function queryCollection($condition = [])
    {
        $select_filter = [
            '*'
        ];

        $builder = $this->_model;

        $builder = $builder->selectRaw(implode(',', $select_filter))->orderBy('created_at');
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
            $builder = $this->_model->where('id', $request->id)->first();
            $builder->delete();
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

    public function configPage()
    {
        $builder = config('block');
        return $this->responseJson(false, 200, 'Thành công', $builder);
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

    public function getListAll($request)
    {
        $builder = $this->queryCollection();
        $builder = $builder->where(function ($query) use ($request) {
            if ($request->get('key_word')) {
                $query->where('name', 'LIKE', "%$request->key_word%");
            }
        });
        $builder =  $builder->get();
        return $this->responseJson(false, 200, 'Thành công', $builder);
    }

    public function findArray($request)
    {
        $list_id = $request->list_id;
        $list = [];
        collect($list_id)->map(function ($value, $key) use (&$list) {
            $id = json_decode($value);
            $list[] = collect(config('block'))->whereIn('id', $id->id)->first();
        });
        $builder = $list;
        return $this->responseJson(false, 200, 'Thành công', $builder);
    }

    public function loadBlockData($list_id)
    {
        $builder = $this->queryCollection();

        $builder = $builder->whereIn('id', $list_id)->get();
        return $builder;
    }
}
