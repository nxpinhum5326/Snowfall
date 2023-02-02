<?php

namespace felix;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

class Snow extends PluginBase
{
    private static Snow $api;
    
    public const TEXT = C::GOLD."Auto".C::WHITE." Snow".C::GRAY." is".C::GREEN." on";
    
    public function onEnable(): void
    {
        self::$api = $this;
        self::$api->getServer()->getPluginManager()->registerEvents(new SnowListener(), self::$api);
        $this->getLogger()->info("SnowPM enabled by felix5326 a.k.a nepinhum5326");
    }
}
