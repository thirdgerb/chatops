<?php

use Commune\Components;

use Commune\Blueprint\CommuneEnv;
use \Commune\Support\Utils\StringUtils;
use Commune\Chatbot\Hyperf\Providers as HfProviders;
use Commune\Framework;

/**
 * Host 的配置.
 */
return new \Commune\Host\IHostConfig([
    'id' => 'CommuneChatOps',
    'name' => 'CommuneChatOps',
    'ghost' => include __DIR__ . '/ghost.php',

    'providers' => [

        /* 注册配置类服务 */

        // 将 Hyperf 容器的单例平移到 Commune
        HfProviders\HyperfDIBridgeServiceProvider::class,

        // 注册配置中心
        Framework\Providers\OptionRegistryServiceProvider::class,

        // 基于 Hyperf Database 模块实现的 storage.
        HfProviders\HfOptionStorageServiceProvider::class,

        /* process services */

        // 基于 Hyperf redis 实现的 cache
        HfProviders\HfCacheServiceProvider::class => [
            'redis' => 'default',
        ],

        // ghost 消息保存, 仅仅使用 cache
        Framework\Providers\MessageDBCacheOnlyProvider::class => [
            // 所有消息缓存 30 秒.
            'cacheTtl' => 30,
        ],

        // 文件缓存. 不一定用到.
        Framework\Providers\FileCacheServiceProvider::class,

        // i18n 多语言模块
        Framework\Providers\TranslatorBySymfonyProvider::class => [
            'storage' => null
        ],

        // 注册 mind set 相关配置的 category
        \Commune\Ghost\Providers\MindsetStorageConfigProvider::class => [
            'storage' => null,
        ],

        // 异常上报模块.
        Framework\Providers\ExpReporterByConsoleProvider::class,

        // sound like 模块, 用于拼音检查.
        Framework\Providers\SoundLikeServiceProvider::class,

        // messenger
        // todo 用协程的做法仍然不成熟, 考虑用子进程或者任务.
        Framework\Providers\ShlMessengerBySwlCoTcpProvider::class => [
            'ghostHost' => env('TCP_GHOST_HOST', '127.0.0.1'),
            'ghostPort' => env('TCP_GHOST_PORT', '12315'),
            'connectTimeout' => 0.3,
            'receiveTimeout' => 0.3,
        ],

        // 广播模块
        HfProviders\HfBroadcasterServiceProvider::class => [
            'redis' => 'default',
            'listeningShells' => [],
        ],

        Framework\Providers\LoggerByMonologProvider::class => [
            'name' => 'chatops',
        ],

        // nlu 服务注册
        \Commune\NLU\NLUServiceProvider::class,

        /* req services */


    ],

    'components' => [
        // markdown 文库
        Components\Markdown\MarkdownComponent::class => [
            'groups' => [
                [
                    'groupName' => 'chatops',
                    'resourceDir' => StringUtils::gluePath(
                        CommuneEnv::getResourcePath(),
                        'markdown'
                    ),
                    // 命名空间 + 文件的相对路径 = document id
                    'namespace' => 'chatops.markdown',
                ],
            ],

        ],
    ],


]);
