<?php
namespace Kd\Vcode;

class Code
{
    private $config;
    public function __construct($config){
        $this->config = $config;
        //var_dump($config);
    }

    public function create($method){
        $way = __NAMESPACE__.'\\Type\\'.ucfirst($method);
        if(class_exists($way)){
            return new $way($this->config);
        }

        throw new VcodeException("class [$way] Not Exists");


    }
    public static function __callStatic ($method ,$params ){
        $app = new self(...$params);
        return $app->create($method);
    }
}
