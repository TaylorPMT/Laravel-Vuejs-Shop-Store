<?php

namespace CMS\Menu\Repository;

use App\Repository\BaseInterface;

interface MenuInterface extends BaseInterface
{
    public function order($data);
}
