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

class BirchSign extends Item{
	public function __construct(){
		parent::__construct(Item::BIRCH_SIGN, 0, "Birch Sign");
	}

	public function getBlock() : Block{
		return BlockFactory::get(Block::BIRCH_STANDING_SIGN);
	}

	public function getMaxStackSize() : int{
		return 16;
	}
}
