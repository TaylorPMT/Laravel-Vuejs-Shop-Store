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

    function create_product_detail_link($slug, $params = []): string
    {
        $query = '';
        if (!empty($params)) {
            $query = http_build_query($params);
        }

        return url($slug . '?' . $query);
    }

    function is_display($status): bool
    {
        return true;
    }
}
