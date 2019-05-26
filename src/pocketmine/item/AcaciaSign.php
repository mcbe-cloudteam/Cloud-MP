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

class AcaciaSign extends Item{
	public function __construct(){
		parent::__construct(Item::ACACIA_SIGN, 0, "Acacia Sign");
	}

	public function getBlock() : Block{
		return BlockFactory::get(Block::ACACIA_STANDING_SIGN);
	}

	public function getMaxStackSize() : int{
		return 16;
	}
}
