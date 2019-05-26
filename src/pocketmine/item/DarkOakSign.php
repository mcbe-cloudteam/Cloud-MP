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

class DarkOakSign extends Item{
	public function __construct(){
		parent::__construct(Item::DARK_OAK_SIGN, 0, "Dark Oak Sign");
	}

	public function getBlock() : Block{
		return BlockFactory::get(Block::DARK_OAK_STANDING_SIGN);
	}

	public function getMaxStackSize() : int{
		return 16;
	}
}
