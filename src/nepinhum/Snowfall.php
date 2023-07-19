<?php

namespace nepinhum;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Snowfall extends PluginBase {

	/**
	 * @var Snowfall
	 */
	protected static Snowfall $instance;

	protected function onLoad(): void {
    self::$instance = $this;
	}

	protected function onEnable(): void {
		self::$instance->getServer()::getInstance()->getPluginManager()->registerEvents(new SnowListener(), $this);
	}

	/**
	 * @return Snowfall
	 */
	public static function getInstance(): Snowfall {
		return self::$instance;
	}
}
