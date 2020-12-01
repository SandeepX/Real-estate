<?php
/**
 * Created by PhpStorm.
 * User: Prajwal
 * Date: 7/19/2019
 * Time: 3:31 PM
 */

namespace App\CustomServices;


class ViewOldDataHelper
{
    public static function getData($key, $data = [])
    {
        //dd($key);
        if (old($key))
            return old($key);
        elseif ($data)
            return $data->$key;
        else
            return '';
    }
}