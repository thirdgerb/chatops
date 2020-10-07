<?php

use Commune\Chatbot\Hyperf\Platforms\Http\HfHttpConfig;
use Commune\DingTalk\Providers\GroupBotsServiceProvider;
use Commune\App\Contexts\DingTalkHome;

return new \Commune\DingTalk\DingTalkPlatformConfig([
    'id' => 'ding_talk',
    'name' => 'DingTalk',
    'desc' => '钉钉机器人的对接平台',
    'bootShell' => 'ding_talk',
    'bootGhost' => false,

    'providers' => [
        \Commune\Framework\Providers\LoggerByMonologProvider::class => [
            'name' => 'dingtalk',
            'forceRegister' => true,
        ],
        GroupBotsServiceProvider::class => [

            /**
             * 钉钉群组的对话机器人配置
             * @see \Commune\DingTalk\Configs\GroupBotConfig
             */
            'groupBots' => [
                [
                    'id' => 'default',
                    'url' => '/ding-talk/bots/defaults',
                    'botName' => '钉钉测试机器人',
                    'appKey' => env('DING_TALK_BOT_KEY', ''),
                    'appSecret' => env('DING_TALK_BOT_SECRET', ''),
                    'entry' => DingTalkHome::genUcl()->encode(),
                ],
            ]
        ]
    ],
    'options' => [
        HfHttpConfig::class => [
            'server' => [
                'name' => 'dingtalk',
                'host' => env('DING_TALK_HOST', '127.0.0.1'),
                'port' => env('DING_TALK_PORT', 9830),
            ],
            'processes' => [],
            'routes' => [],
        ],
    ],

]);
