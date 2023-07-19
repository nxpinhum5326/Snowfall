<?php

namespace nepinhum;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\world\ChunkLoadEvent;

use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;

use pocketmine\data\bedrock\BiomeIds;
class SnowListener implements Listener
{
    function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();

        $player->getNetworkSession()->sendDataPacket(LevelEventPacket::create(
            eventId: LevelEvent::START_RAIN,
            eventData: 100000,
            position: null
        ));
    }

    function onChunkLoad(ChunkLoadEvent $event): void
    {
        $chunk = $event->getChunk();

        for ($x = 0; $x < 16; ++$x)
            for ($z = 0; $z < 16; ++$z) 
                $chunk->setBiomeId($x, $chunk->getHighestBlockAt($x, $z), $z, BiomeIds::ICE_PLAINS);
    }
}
