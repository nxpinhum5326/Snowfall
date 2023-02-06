<?php
/**
* @author: felix5326(aka nepinhum5326)
*/
namespace felix;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

class Snow extends PluginBase
{
    private static Snow $api;
    
    public function onEnable(): void
    {
        self::$api = $this;
        self::$api->getServer()->getPluginManager()->registerEvents(new SnowListener(), self::$api);
    
    }
}
