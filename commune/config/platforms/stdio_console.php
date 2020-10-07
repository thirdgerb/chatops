<?php

use Commune\Platform\Shell\StdioConsolePlatformConfig;


return new StdioConsolePlatformConfig([
    'id' => 'stdio_console',

    'name' => 'stdio 本地端',
    'desc' => '使用 Clue\React\Stdio 实现的本地机器人',

    'bootShell' => 'console',
    'bootGhost' => true,

]);

