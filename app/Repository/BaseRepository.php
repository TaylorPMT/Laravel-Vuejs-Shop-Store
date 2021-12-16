<?php

namespace App\Repository;

class BaseRepository
{
    protected $_messagesErrorsException = 'Lỗi phát sinh';
    protected $_messagesSuccess = 'Xử lý thành công';
    protected $_messagesFails = 'Xử lý thất bại thử lại sau';
    public function querySelectList($builder, $request)
    {
        $order_by = $request->get('order_by') ?? 'created_at';
        $sort_by  = $request->get('sort_by') ?? 'desc';
        $paginate = $request->get('per_page') ?? 20;
        $onEachSide = $request->get('page') ?? 20;
        $builder = $builder
            ->orderBy($order_by, $sort_by)
            ->paginate($paginate)
            ->onEachSide($onEachSide);
        return $builder;
    }
    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null)
    {
        return response()->json([
            'error' => $error,
            'response_code' => $responseCode,
            'message' => $message,
            'data' => $data
        ]);
    }
}