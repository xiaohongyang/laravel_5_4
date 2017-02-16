<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/16
 * Time: 22:01
 */

namespace App\Providers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{


    public function boot() {

        //customer validation customerStrLess3
        \Validator::extend('customerStrLess3', function($attribute, $value, $parameters, $validator){
            return strlen($value) < 3;
        });

        //customer validation error message
        \Validator::replacer('customerStrLess3', function($message, $attribute, $rule, $parameter) {
            return $attribute . "长度必须小于3个字符";
        });
    }

    public function register(){

    }
}