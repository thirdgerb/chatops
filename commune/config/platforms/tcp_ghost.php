<?php

use Commune\Chatbot\Hyperf\Config\Platforms\TcpGhostPlatformConfig;

return new TcpGhostPlatformConfig([
    'id' => 'tcp_ghost',
    'name' => 'ghost服务端',
    'desc' => '基于 Swoole 协程实现的 Ghost Tcp 服务端. 使用 Babel 类传输协议.',
    'bootShell' => null,
    'bootGhost' => true,
]);
