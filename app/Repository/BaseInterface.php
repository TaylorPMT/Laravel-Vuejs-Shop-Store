<?php

namespace App\Repository;

interface BaseInterface
{
    public function list($request);
    public function find($request);
    public function delete($request);
    public function update($request);
}