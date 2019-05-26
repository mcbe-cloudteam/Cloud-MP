<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

class Trident extends Tool{
	public function __construct(){
		parent::__construct(Item::TRIDENT, 0, "Trident");
	}
	
	public function getMaxDurability() : int{
		return 250;
	}
	
	public function getMaxStackSize() : int{
		return 1;
	}
}
