<?php

namespace nepinhum;

use pocketmine\plugin\PluginBase;

class Snowfall extends PluginBase
{
    private static Snowfall $instance;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        self::$instance->getServer()->getPluginManager()->registerEvents(new SnowListener(), $this);
    }
    public static function getInstance(): Snowfall
    {
        return self::$instance;
    }
}
