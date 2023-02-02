<?php

namespace felix;

use pocketmine\event\Listener;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\world\biome\Biome;
use pocketmine\data\bedrock\BiomeIds;
use pocketmine\math\Vector3;
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
        $player->sendMessage(Snow::TEXT ."");
    }
    
    /**
     * @param ChunkLoadEvent $event
     */
    public function onChunkLoad(ChunkLoadEvent $event): void
    {
        $chunk = $event->getChunk();
        for ($x = 0; $x < 16; ++$x) {
            for ($z = 0; $z < 16; ++$z) {
                $chunk->setBiomeId($x, $z, BiomeIds::ICE_PLAINS);
            }
        }
    }
}
