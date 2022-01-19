<?php

function convert_date($date, $format = 'd-m-Y')
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->format($format);
    }
    return '';
}
function addVersionTo($pathFile, $timestamp = '')
{
    $path            = public_path($pathFile);
    $timestamp       = !empty($timestamp) ? $timestamp : \File::lastModified($path);
    $url             = asset($pathFile);
    $param_separator = (strpos($url, '?') !== false) ? '&' : '?';
    return $pathFile . $param_separator . 'v=' . $timestamp;
}