<?php

namespace nepinhum;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Snowfall extends PluginBase
{
  
  private static Snowfall $instance;

	protected function onLoad(): void
	{
    self::$instance = $this;
	}
	public function onEnable(): void
	{
		self::$instance->getServer()->getPluginManager()->registerEvents(new SnowListener(), self::$instance);
	}

	public static function getInstance(): Snowfall
	{
    return self::$instance;
	}
  
}
