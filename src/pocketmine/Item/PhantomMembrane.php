<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

class PhantomMembrane extends Item{
	public function __construct(){
		parent::__construct(Item::PHANTOM_MEMBRANE, 0, "Phantom Membrane");
	}

	public function getMaxStackSize() : int{
		return 64;
	}
}
