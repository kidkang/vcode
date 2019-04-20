<?php 
namespace Kd\Vcode\Type;
abstract class Type{
    protected $config;
    protected $code;
    public function __construct($config){
        $this->config = $config;
    }
    public function get(){
        $this->setCode();
        return $this->code;
    }


    public function setCode(){
        $this->code = str_pad(random_int(1, 999999), 6, 0, STR_PAD_LEFT);

    }

    public function send($account){
        $this->executeSend($account);
    }
    /**
     * 发送code 到指定的方式上
     * @return [type] [description]
     */
    abstract public function executeSend($account);
}