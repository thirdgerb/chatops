<?php


use Commune\Chatbot\Hyperf;
use Commune\Support\Utils\StringUtils;
use Commune\Blueprint\CommuneEnv;
use Commune\Components;
use Commune\App\Contexts;

return new Hyperf\Config\HfGhostConfig([
    'id' => 'CommuneChatOps',
    'name' => 'Commune运维机器人',

    'defaultContextName' => Contexts\DingTalkHome::genUcl()->encode(),
    'sceneContextNames' => [
    ],

    'mindPsr4Registers' => [
        "Commune\\App\\" => StringUtils::gluePath(
            CommuneEnv::getBasePath(),
            'app'
        ),

    ],

    'components' => [
        // markdown 文库
        Components\Markdown\MarkdownComponent::class => [

            'reset' => CommuneEnv::isResetRegistry(),
            'groups' => [
                Components\Markdown\Options\MDGroupOption::defaultOption(),
            ],
        ],


    ],


    // 默认的 nlu 中间件为空
    'comprehendPipes' => [
    ],
    // 默认的 fallback 为空.
    'defaultHeedFallback' =>[
    ],

]);
