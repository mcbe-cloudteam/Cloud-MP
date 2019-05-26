<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

class Elytra extends Armor{
	public function __construct(int $meta = 0){
		parent::__construct(Item::ELYTRA, $meta, "Elytra Wings");
	}

	public function getDefensePoints() : int{
		return 0;
	}

	public function getMaxDurability() : int{
		return 431;
	}

	public function getArmorSlot() : int{
		return 1;
	}
	
	public function getMaxStackSize() : int{
		return 1;
	}
}
