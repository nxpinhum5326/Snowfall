<?php

namespace nepinhum;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;
use pocketmine\data\bedrock\BiomeIds;
use pocketmine\Server;
use pocketmine\world\Position;
use pocketmine\world\World;

class SnowListener implements Listener {
	private Server $server;
	public function __construct(Server $server) {
		$this->server = $server;
	}

	function onJoin(PlayerJoinEvent $event): bool {
		if (Snowfall::getInstance()->getConfig()->get("snow") === false) {
			return false;
		}

        $player = $event->getPlayer();

        $player->getNetworkSession()->sendDataPacket(LevelEventPacket::create(
            LevelEvent::START_RAIN,
            100000,
            null
        ));

		return true;
    }

    function onChunkLoad(ChunkLoadEvent $event): bool {
		if (Snowfall::getInstance()->getConfig()->get("snow") === false) {
			for ($x = 0; $x < 16; ++$x)
				for ($z = 0; $z < 16; ++$z)
					for($y = World::Y_MIN; $y < World::Y_MAX; $y++)
						$event->getChunk()->setBiomeId($x, $y, $z, BiomeIds::PLAINS);

			return false;
		}

		for ($x = 0; $x < 16; ++$x)
			for ($z = 0; $z < 16; ++$z)
				for($y = World::Y_MIN; $y < World::Y_MAX; $y++)
					$event->getChunk()->setBiomeId($x, $y, $z, BiomeIds::ICE_PLAINS);

		foreach ($this->server->getOnlinePlayers() as $player) {
			$x = mt_rand(round($player->getPosition()->getX() - 15), round($player->getPosition()->getX() + 15));
			$z = mt_rand(round($player->getPosition()->getZ() - 15), round($player->getPosition()->getZ() + 15));
			$hb = $player->getPosition()->getWorld()->getHighestBlockAt($x, $z);
			$y = ($hb === null) ? ($player->getPosition()->getWorld()->getHighestBlockAt((int)$player->getPosition()->getX(), (int)$player->getPosition()->getZ()) ?? (int)$player->getPosition()->getY()) : $hb;
			Snowfall::getInstance()->createLayer(new Position($x, $y, $z, $player->getWorld()));
		}

		return true;
    }
}