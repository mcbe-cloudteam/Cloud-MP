<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

class CarrotonaStick extends Item{
	public function __construct(){
		parent::__construct(Item::CARROT_ON_A_STICK, 0, "Carrot on a Stick");
	}
	
	public function getMaxStackSize() : int{
		return 1;
	}
}
