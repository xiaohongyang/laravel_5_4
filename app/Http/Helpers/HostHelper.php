<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/4/1
 * Time: 17:41
 */

namespace App\Http\Helpers;


class HostHelper
{

    public static function getImage($img) {

        $img = is_null($img) || !strlen(trim($img)) ? 'static/img/icon_upload.png' : $img;

        return env('APP_IMG_URL') . DIRECTORY_SEPARATOR . $img;
    }

}