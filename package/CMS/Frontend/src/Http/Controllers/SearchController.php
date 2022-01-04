<?php

namespace CMS\Frontend\Http\Controllers;

use App\Helpers\FullSiteSearch;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;


class SearchController extends BaseController
{

    public function search(Request $request)
    {
        $data = FullSiteSearch::search($request->keyword);
        return $this->responseJson(false, 200, 'Thành công', $data);
    }
}