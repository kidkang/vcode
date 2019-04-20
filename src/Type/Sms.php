<?php
namespace Kd\Vcode\Type;

use Overtrue\EasySms\EasySms;

class Sms extends Type
{
    //sms发送方式
    public function executeSend($phone)
    {
        $result = $this->getEasySms()->send($phone, [
            'template' => $this->config['template'],
            'data'     => [
                'code' => $this->code,
            ],
        ]);
        // 生成4位随机数，左侧补0
        // try {

        // } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
        //     //没有配置错误信息记录
        //     $e = $exception->getException('aliyun');
        //     throw new \Kd\Vcode\VcodeException($e->getMessage(), $e->getCode());
        // }
    }

    public function getEasySms()
    {
        return new EasySms([
            // HTTP 请求的超时时间（秒）
            'timeout'  => 5.0,
            // 默认发送配置
            'default'  => [
                // 网关调用策略，默认：顺序调用
                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

                // 默认可用的发送网关
                'gateways' => [
                    'aliyun',
                ],
            ],
            // 可用的网关配置
            'gateways' => [
                'errorlog' => [
                    'file' => '/tmp/easy-sms.log',
                ],
                'aliyun'   => [
                    'access_key_id'     => $this->config['key'],
                    'access_key_secret' => $this->config['secret'],
                    'sign_name'         => $this->config['sign_name'],
                ],
            ],
        ]);
    }
}
