<?php
namespace App\Repository;
class BaseRepository {

    public function querySelectList($builder,$request){
        $order_by = $request->get('order_by') ?? 'created_at';
        $sort_by  = $request->get('sort_by') ?? 'desc';
        $paginate = $request->get('per_page') ?? 1;
        $onEachSide = $request->get('page') ?? 20;
        $builder = $builder
        ->orderBy($order_by,$sort_by)
        ->paginate($paginate)
        ->onEachSide($onEachSide);
        return $builder;
    }
}
