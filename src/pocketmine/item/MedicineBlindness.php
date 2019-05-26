<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\EffectInstance;

class MedicineBlindness extends Food{
	
	public function __construct(int $meta = 0){
		parent::__construct(Item::MEDICINE, $meta, "Medicine");
	}
	
	public function getMaxStackSize() : int{
		return 1;
	}
	
	public function requiresHunger() : bool{
		return false;
	}

	public function getFoodRestore() : int{
		return 1;
	}

	public function getSaturationRestore() : float{
		return 3;
	}

	public function getAdditionalEffects() : array{
		return [
			new EffectInstance(Effect::getEffect(Effect::CONDUIT_POWER), 100),
			new EffectInstance(Effect::getEffect(Effect::LEVITATION), 100)
		];
	}
}
