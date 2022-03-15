<?php

namespace App\Helpers;

class RecordSearchHelper
{
    public static function value($search, $colom_search, $colom_result, $array )
	{
        $index = array_search($search, array_column($array, $colom_search));
        $value = is_numeric($index) ? $array[$index][$colom_result] : null;
        return $value;
	}
}
