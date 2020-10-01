<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

class LingeringPotion extends Item{
	public function __construct(int $meta = 0){
		parent::__construct(Item::LINGERING_POTION, 0, "Lingering Potion");
	}

	public function getMaxStackSize() : int{
		return 1;
	}
}