<?php

namespace CMS\Frontend\Http\Controllers;

use App\Helpers\FullSiteSearch;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;


class SearchController extends BaseController
{

    public function search(Request $request)
    {
        $keyword = $request->key_word;
        $data = FullSiteSearch::search($keyword);
        return $this->responseJson(false, 200, 'Thành công', $data);
    }

    public function searchPage(Request $request)
    {
        $keyword = $request->key_word;
        $data = FullSiteSearch::search($keyword);
        $data =  self::paginate(collect($data), 10);

        return view('Frontend.main.search', compact('data'));
    }
}