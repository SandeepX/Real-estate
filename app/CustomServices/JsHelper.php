<?php
/**
 * Created by PhpStorm.
 * User: Prajwal
 * Date: 7/10/2019
 * Time: 4:00 PM
 */

namespace App\CustomServices;


class JsHelper
{
    public static function includeAsJsString($template)
    {
        $string = view($template);
        return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string) $string), "\0..\37'\\")));
    }


}