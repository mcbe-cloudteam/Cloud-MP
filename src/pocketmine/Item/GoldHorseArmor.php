<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;

class GoldHorseArmor extends Armor{
	public function __construct(){
		parent::__construct(Item::GOLD_HORSE_ARMOR, 0, "Gold Horse Armor");
	}
	
	public function getDefensePoints() : int{
		return 2;
	}

    public function getArmorSlot() : int{
        return Armor::SLOT_HELMET;
    }

    public function getMaxDurability() : int{
        return 78;
    }

    public function getEnchantability() : int{
		return 25;
	}
}
