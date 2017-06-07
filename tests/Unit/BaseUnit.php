<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/5/31
 * Time: 23:29
 */

namespace Tests\Unit;


use Tests\TestCase;

class BaseUnit extends TestCase
{

    protected function getToken(){
        \Log::info('user:');
        try{
            $key = md5(env('APP_KEY'));
            $createToken = $this->call('get', '/getToken?key=' . $key);
            $user = $createToken->getContent();
            \Log::info($user);
            $user = json_decode($user);
            return $user->token;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return null;
        }
    }

}