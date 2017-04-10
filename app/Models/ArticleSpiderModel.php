<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class ArticleSpiderModel
{
    //
    public $webAddress;
    public $statusCode = null;
    public static $instance;

    protected function __construct($webAddress)
    {
        $this->webAddress = $webAddress;
    }

    public static function getSingle($webAddress) {

        //if (is_null(self::$instance)){

            self::$instance = new static($webAddress);
        //}

        return self::$instance;
    }

    public  function getContents(){

        $client = new Client();
        $res = $client->request('GET', $this->webAddress);
        $this->statusCode = $res->getStatusCode();
        return $res->getBody();
    }

}
