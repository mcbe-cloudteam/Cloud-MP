<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\block;

class StoneSlab4 extends StoneSlab{
	public const TYPE_MOSSY_STONE_BRICK = 0;
	public const TYPE_SMOOTH_QUARTZ = 1;
	public const TYPE_STONE = 2;
	public const TYPE_CUT_SANDSTONE = 3;
	public const TYPE_CUT_RED_SANDSTONE = 4;
	public const TYPE_MOSSY_STONE_BRICKS1 = 5;
	public const TYPE_MOSSY_STONE_BRICKS2 = 6;
	public const TYPE_MOSSY_STONE_BRICKS3 = 7;
	public const TYPE_MOSSY_STONE_BRICK2 = 8;
	public const TYPE_SMOOTH_QUARTZ2 = 9;
	public const TYPE_STONE2 = 10;
	public const TYPE_CUT_SANDSTONE2 = 11;
	public const TYPE_CUT_RED_SANDSTONE2 = 12;
	public const TYPE_MOSSY_STONE_BRICKS12 = 13;
	public const TYPE_MOSSY_STONE_BRICKS22 = 14;
	public const TYPE_MOSSY_STONE_BRICKS32 = 15;

	protected $id = self::STONE_SLAB4;

	public function getDoubleSlabId() : int{
		return self::DOUBLE_STONE_SLAB4;
	}

	public function getName() : string{
		static $names = [
			self::TYPE_MOSSY_STONE_BRICK => "Mossy Stone Brick",
			self::TYPE_SMOOTH_QUARTZ => "Smooth Quartz",
			self::TYPE_STONE => "Stone",
			self::TYPE_CUT_SANDSTONE => "Cut Sandstone",
			self::TYPE_CUT_RED_SANDSTONE => "Cut Red Sandstone",
			self::TYPE_MOSSY_STONE_BRICKS1 => "Mossy Stone Brick",
			self::TYPE_MOSSY_STONE_BRICKS2 => "Mossy Stone Brick",
			self::TYPE_MOSSY_STONE_BRICKS3 => "Mossy Stone Brick",
			self::TYPE_MOSSY_STONE_BRICK2 => "Mossy Stone Brick",
			self::TYPE_SMOOTH_QUARTZ2 => "Smooth Quartz",
			self::TYPE_STONE2 => "Stone",
			self::TYPE_CUT_SANDSTONE2 => "Cut Sandstone",
			self::TYPE_CUT_RED_SANDSTONE2 => "Cut Red Sandstone",
			self::TYPE_MOSSY_STONE_BRICKS12 => "Mossy Stone Brick",
			self::TYPE_MOSSY_STONE_BRICKS22 => "Mossy Stone Brick",
			self::TYPE_MOSSY_STONE_BRICKS32 => "Mossy Stone Brick"
		];

		return (($this->meta & 0x08) > 0 ? "Upper " : "") . ($names[$this->getVariant()] ?? "") . " Slab";
	}
}
