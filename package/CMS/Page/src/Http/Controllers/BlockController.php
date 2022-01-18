<?php

namespace CMS\Page\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Page\Repository\BlockRepositoryInterface;
use Illuminate\Http\Request;

class BlockController extends BaseController
{
    private $_block;
    public function __construct(BlockRepositoryInterface $block_repo)
    {
        $this->_block = $block_repo;
    }
    public function getList(Request $request)
    {
        return $this->_block->list($request);
    }

    public function getBlockConfig(Request $request)
    {
        return $this->_block->configPage();
    }

    public function createBlock(Request $request)
    {
        $builder = $this->_block->create($request);
        return $builder;
    }

    public function show(Request $request, $id)
    {
        $builder = $this->_block->find($request);
        return $builder;
    }

    public function update(Request $request, $id)
    {
        $builder = $this->_block->update($request);
        return $builder;
    }

    public function getListAll(Request $request)
    {
        $builder = $this->_block->getListAll($request);
        return $builder;
    }

    public function findArray(Request $request)
    {
        $builder = $this->_block->findArray($request);
        return $builder;
    }
}