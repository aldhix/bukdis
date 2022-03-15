<?php

namespace App\Helpers;

class ArrayReplaceHelper
{
    public static function request($search, $replace,$request)
    {
        $req = $request->toArray();
        foreach($req as $key_old => $value){
            $key_new = str_replace($search,$replace,$key_old);
            $req[$key_new] = $req[$key_old];
            unset($req[$key_old]);
        }
        return $req;
    }
}
