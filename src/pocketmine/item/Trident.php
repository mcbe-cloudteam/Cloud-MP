<?php

/*
 * 
 * Made By TrueToneTeam
 *  
*/

declare(strict_types=1);

namespace pocketmine\item;

use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\Tool;
use pocketmine\Player;

class Trident extends Tool{
	public const TAG_TRIDENT = "Trident";
	
	public function __construct(){
		parent::__construct(Item::TRIDENT, 0, "Trident");
	}
	
	public function onReleaseUsing(Player $player): bool{
		$diff = $player->getItemUseDuration();
		$p = $diff / 10;
		$force = \min((($p ** 2) + $p * 2) / 3, 1) * 2;
		
		if($force < 0.15 or $diff < 2){
			return false;
		}
		
		$nbt = Entity::createBaseNBT(
			$player->add(0, $player->getEyeHeight(), 0),
			$player->getDirectionVector()->multiply($force),
			($player->yaw > 180 ? 360 : 0) - $player->yaw,
			-$player->pitch
		);
		
		if($player->isSurvival()){
			$this->applyDamage(1);
		}
		
		$nbt->setTag($this->nbtSerialize(-1, self::TAG_TRIDENT));
		
		$entity = Entity::createEntity(Entity::TRIDENT, $player->getLevel(), $nbt, $player, $this);
		$entity->spawnToAll();
		
		if($player->isSurvival()){
			$this->setCount(0);
		}
		return true;
	}
	
	public function getMaxDurability() : int{
		return 250;
	}
	
	public function getMaxStackSize() : int{
		return 1;
	}
}
