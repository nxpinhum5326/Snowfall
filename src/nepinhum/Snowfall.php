<?php

namespace nepinhum;

use pocketmine\plugin\PluginBase;

class Snowfall extends PluginBase
{
	protected static Snowfall $instance;

	protected function onLoad(): void
	{
		self::$instance = $this;
	}

	protected function onEnable(): void
	{
		self::$instance->getServer()->getPluginManager()->registerEvents(new SnowListener(), $this);
	}

	protected static function getInstance(): Snowfall
	{
		return self::$instance;
	}
}
