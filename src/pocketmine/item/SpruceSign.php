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

class SpruceSign extends Item{
	public function __construct(){
		parent::__construct(Item::SPRUCE_SIGN, 0, "Spruce Sign");
	}

	public function getBlock() : Block{
		return BlockFactory::get(Block::SPRUCE_STANDING_SIGN);
	}

	public function getMaxStackSize() : int{
		return 16;
	}
}
