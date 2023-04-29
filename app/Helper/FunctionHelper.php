<?php

namespace App\Helper;

class FunctionHelper
{
    public static function formatDate($date){
        return $date->format('l, dS F Y  H:m:s');
    }
}
