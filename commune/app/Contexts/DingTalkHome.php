<?php


namespace Commune\App\Contexts;


use Commune\Blueprint\Ghost\Context\CodeContextOption;
use Commune\Blueprint\Ghost\Context\Depending;
use Commune\Blueprint\Ghost\Context\StageBuilder;
use Commune\Blueprint\Ghost\Dialog;
use Commune\Ghost\Context\ACodeContext;

/**
 * @title 钉钉对话机器人默认入口
 */
class DingTalkHome extends ACodeContext
{
    public static function __option(): CodeContextOption
    {
        return new CodeContextOption([]);
    }

    public static function __depending(Depending $depending): Depending
    {
        return $depending;
    }

    public function __on_start(StageBuilder $stage): StageBuilder
    {
        return $stage->always(function(Dialog $dialog) {
            return $dialog->send()
                ->info('hello world')
                ->over()
                ->await();
        });
    }


}