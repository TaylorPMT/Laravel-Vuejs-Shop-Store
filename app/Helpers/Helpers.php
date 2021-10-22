<?php

namespace App\Helpers;

trait Helpers
{

    function split_files_with_basename(array $files, $suffix = '.php')
    {
        $result = [];
        foreach ($files as $row) {
            $baseName = basename($row, $suffix);
            $result[$baseName] = $row;
        }
        return $result;
    }
}
