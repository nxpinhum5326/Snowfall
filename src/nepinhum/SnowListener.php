<?php

namespace nepinhum;

use pocketmine\event\Event;
use pocketmine\event\Listener;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\data\bedrock\BiomeIds;

use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;

class SnowListener implements Listener
{
    
    /**
     * @param PlayerJoinEvent $event
     */
    public function onJoin(PlayerJoinEvent $event): void
	{
		$player = $event->getPlayer();

		$player->getNetworkSession()->sendDataPacket(LevelEventPacket::create(
			eventId: LevelEvent::START_RAIN,
			eventData: 100000,
			position: null
		));
	}
    
    /**
     * @param ChunkLoadEvent $event
     */
    public function onChunkLoad(ChunkLoadEvent $event): void
    {
        $chunk = $event->getChunk();
        for ($x = 0; $x < 16; ++$x) {
            for ($z = 0; $z < 16; ++$z) {
                $chunk->setBiomeId($x, $chunk->getHighestBlockAt($x, $z), $z, BiomeIds::ICE_PLAINS);
            }
        }
    }
}
