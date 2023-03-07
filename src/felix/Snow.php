<?php

namespace felix;

use pocketmine\plugin\PluginBase;

class Snow extends PluginBase
{
    private static Snow $api;
    
    public function onEnable(): void
    {
        self::$api = $this;
        self::$api->getServer()->getPluginManager()->registerEvents(new SnowListener(), self::$api);
    }
}
