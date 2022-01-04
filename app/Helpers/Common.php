<?php

function convert_date($date, $format = 'd-m-Y')
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->format($format);
    }
    return '';
}