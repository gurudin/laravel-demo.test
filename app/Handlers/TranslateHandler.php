<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class TranslateHandler
{
    public function translateText($text)
    {
        $client  = new Client(['timeout' => 5]);
        $service = $this->getTranslateService();
        $url     = $service['url'];
        
        if (empty($service['key']) || empty($service['secret'])) {
            return $this->pinyin($text);
        }

        $isBaidu   = $service['driver'] === 'baidu';
        $salt      = time();
        $sign      = md5($service['key'] . $text . $salt . $service['secret']);
        $parameter = [
            'q'    => $text,
            'from' => $isBaidu ? 'zh' : 'zh-CHS',
            'to'   => $isBaidu ? 'en' : 'EN',
            $isBaidu ? 'appid' : 'appKey' => $service['key'],
            'salt' => $salt,
            'sign' => $sign,
        ];

        $query    = http_build_query($parameter);
        // $response = $client->get($url . $query);
        $res = $client->get($url, ['query' => $parameter]);
dd($url);
        $result   = json_decode($response->getBody(), true);
        if ($isBaidu) {
            $text = $result['trans_result'][0]['dst'] ?: '';
        } else {
            $text = $result['translation'][0] ?: '';
        }

        return str_slug($text);
    }

    private function pinyin($text)
    {
        return str_slug(app(Pinyin::class)->permalink($text));
    }

    private function getTranslateService()
    {
        $driver = config('services.translate.driver', 'baidu');
        $url    = config("services.translate.{$driver}.url");
        $key    = config("services.translate.{$driver}.key");
        $secret = config("services.translate.{$driver}.secret");

        return [
            'driver' => $driver,
            'url'    => $url,
            'key'    => $key,
            'secret' => $secret,
        ];
    }
}
