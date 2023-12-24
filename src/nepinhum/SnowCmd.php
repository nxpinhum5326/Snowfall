<?php

declare(strict_types=1);

namespace nepinhum;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class SnowCmd extends Command implements PluginOwned {
	private Snowfall $plugin;
	public function __construct(Snowfall $plugin) {
		$this->plugin = $plugin;

		parent::__construct(
			"snowfall",
			"Allows you to configure the snowfall(places layer(s) of snow on the ground) action.",
			"/snowfall <on|off>",
			["snow"]
		);
		$this->setPermission("snowfall.permission.command");
	}

	public function getOwningPlugin(): Plugin {
		return $this->plugin;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
		if (count($args) === 1) {
			switch (strtolower($args[0])) {
				case "on":
					if ($this->plugin->getConfig()->get("snow") !== true) {
						$this->plugin->getConfig()->set("snow");
						$this->plugin->getConfig()->save();
					}

					return true;
				case "off":
					if ($this->plugin->getConfig()->get("snow") !== false) {
						$this->plugin->getConfig()->set("snow", false);
						$this->plugin->getConfig()->save();
					}

					return true;
			}
		}

		throw new InvalidCommandSyntaxException();
	}
}