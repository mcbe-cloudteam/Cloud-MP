<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\Liquid;
use pocketmine\event\player\PlayerBucketFillEvent;
use pocketmine\math\Vector3;
use pocketmine\Player;

class BannerPattern extends Item{

	public function __construct(int $meta = 0){
		parent::__construct(self::BANNER_PATTERN, $meta, "Banner Pattern");
	}

	public function getMaxStackSize() : int{
		return 1;
	}
}
