<?php

namespace CMS\Menu\Repository;


use App\Repository\BaseRepository;
use CMS\Menu\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class MenuRepository extends BaseRepository implements MenuInterface
{

    protected $_model;

    public function __construct(Menu $model)
    {
        $this->_model = $model;
    }

    public function queryCollection($condition = [])
    {
        $select_filter = [
            '*'
        ];

        $builder = $this->_model;

        $builder = $builder->selectRaw(implode(',', $select_filter))->orderBy('order');
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
            $builder = collect(config('page'))->where('id', $request->id)->first();
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

    public function updatePage($request)
    {
        try {
            $data = collect($request->list_id)->map(function ($val, $index) {
                return $val['id'];
            })->toArray();

            if (empty(config('page.' . $request->id))) {
                return $this->responseJson(true, 500, $this->_messagesErrorsException, 'Không tìm thấy file config');
            }
            config()->set('page.' . $request->id . '.page_config', $data);

            $text = '<?php return ' . var_export(config('page'), true) . ';';

            file_put_contents(base_path('package/CMS/Admin/config/page.php'), $text);
            Artisan::call('cache:clear');
            return $this->responseJson(false, 200, 'Thành công', '');
        } catch (\Exception $e) {
            return $this->responseJson(true, 500, $this->_messagesErrorsException, $e->getMessage());
        }
    }

    public function formatData($data)
    {

        $list = collect($data)->map(function ($value, $key) use ($data) {
            return $value;
        })->toArray();
        return $list;
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

    public function formatOrder($data)
    {
        foreach ($data as $order => $id) {
            $builder = $this->_model->find($id['order'])->update([
                'order' => $order,
            ]);
        }
        return true;
    }

    public function order($request)
    {
        DB::beginTransaction();
        try {
            $builder = $this->formatOrder($request->all());
            DB::commit();
            return $this->responseJson(false, 200, 'Thành công', $builder);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseJson(true, 500, $this->_messagesErrorsException, $e->getMessage());
        }
    }
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function config_page()
    {
        $builder = $this->paginate(config('page'));

        return $this->responseJson(false, 200, 'Thành công', $builder);
    }

    public function blockPage($id_block)
    {
        $builder = collect(config('page'))->where('id', $id_block)->pluck('page_config')->values();

        return $builder[0];
    }
}