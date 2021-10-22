<?php

namespace CMS\Films\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class FilmController extends BaseController
{
    public function list(Request $request)
    {
        $order_by = $request->get('order_by') ?? 'created_at';
        $sort_by  = $request->get('sort_by') ?? 'desc';
        $paginate = $request->get('per_page') ?? 1;
        $onEachSide = $request->get('page') ?? 20;
        $data = Film::with(['getChapters' => function ($query) {
            $query->select('StrId', 'chapters')->orderBy('chapters', 'DESC');
        }])->orderBy($order_by, $sort_by)->paginate($paginate)->onEachSide($onEachSide);
        return $this->responseJson(null, 200, 'Thành công', $data);
    }
    public function download(Request $request, $id)
    {
        Artisan::call('command:dowload');
        return $this->responseJson(null, 200, 'Thành công', '');
    }
}
