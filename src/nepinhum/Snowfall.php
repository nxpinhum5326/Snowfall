<?php

declare(strict_types=1);

namespace nepinhum;

use pocketmine\block\BlockTypeIds;
use pocketmine\block\Fence;
use pocketmine\block\FenceGate;
use pocketmine\block\Slab;
use pocketmine\block\Stair;
use pocketmine\block\utils\SlabType;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Wall;
use pocketmine\plugin\PluginBase;
use pocketmine\world\Position;

class Snowfall extends PluginBase {
    private static Snowfall $instance;

    public function onLoad(): void {
        self::$instance = $this;
    }

    public function onEnable(): void {
		self::$instance->getServer()->getCommandMap()->register("snowfall", new SnowCmd($this));
        self::$instance->getServer()->getPluginManager()->registerEvents(new SnowListener($this->getServer()), $this);
		$this->saveDefaultConfig();
    }

	/** GitHub: note3crafter/SnowMod */
	public function createLayer(Position $position): void {
		$down = $position->getWorld()->getBlock($position);

		if (!$down->isSolid()) {
			return;
		}

		$blocks = [
			BlockTypeIds::MYCELIUM, BlockTypeIds::PODZOL, BlockTypeIds::COBBLESTONE,
			BlockTypeIds::DEAD_BUSH, BlockTypeIds::WATER, BlockTypeIds::LAVA,
			BlockTypeIds::WOOL, BlockTypeIds::ACACIA_FENCE_GATE, BlockTypeIds::BIRCH_FENCE_GATE,
			BlockTypeIds::DARK_OAK_FENCE_GATE, BlockTypeIds::JUNGLE_FENCE_GATE,
			BlockTypeIds::OAK_FENCE_GATE, BlockTypeIds::SPRUCE_FENCE_GATE,
			BlockTypeIds::SMOOTH_STONE, BlockTypeIds::FARMLAND
		];

		if (in_array($down->getTypeId(), $blocks)) {
			return;
		}

		if (
			$down instanceof Stair ||
			($down instanceof Slab && $down->getSlabType() === SlabType::BOTTOM) ||
			$down instanceof Fence || $down instanceof FenceGate || $down instanceof Wall
		) {
			return;
		}

		$up = $position->getWorld()->getBlock($position->add(0, 1, 0));
		if ($up->getTypeId() !== BlockTypeIds::AIR) {
			return;
		}

		$position->getWorld()->setBlock($position->add(0, 1, 0), VanillaBlocks::SNOW_LAYER(), true);
	}


	public static function getInstance(): Snowfall {
        return self::$instance;
    }
}