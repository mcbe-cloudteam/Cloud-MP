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

class Shield extends Tool{
	public function __construct(){
		parent::__construct(513, 0, "Shield");
	}
	
	public function getMaxDurability() : int{
		return 337;
	}
	
	public function getMaxStackSize() : int{
		return 1;
	}
}
