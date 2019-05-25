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

class StoneSlab3 extends StoneSlab{
	public const TYPE_END_STONE_BRICK = 0;
	public const TYPE_SMOOTH_RED_SANDSTONE = 1;
	public const TYPE_POLISHED_ANDESITE = 2;
	public const TYPE_ANDESITE = 3;
	public const TYPE_POLISHED_DIORITE = 4;
	public const TYPE_DIORITE = 5;
	public const TYPE_POLISHED_GRANITE = 6;
	public const TYPE_GRANITE = 7;
	public const TYPE_END_STONE_BRICK2 = 8;
	public const TYPE_SMOOTH_RED_SANDSTONE2 = 9;
	public const TYPE_POLISHED_ANDESITE2 = 10;
	public const TYPE_ANDESITE2 = 11;
	public const TYPE_POLISHED_DIORITE2 = 12;
	public const TYPE_DIORITE2 = 13;
	public const TYPE_POLISHED_GRANITE2 = 14;
	public const TYPE_GRANITE2 = 15;

	protected $id = self::STONE_SLAB3;

	public function getDoubleSlabId() : int{
		return self::DOUBLE_STONE_SLAB3;
	}

	public function getName() : string{
		static $names = [
			self::TYPE_END_STONE_BRICK => "End Stone Brick",
			self::TYPE_SMOOTH_RED_SANDSTONE => "Smooth Red SandStone",
			self::TYPE_POLISHED_ANDESITE => "Polished Andesite",
			self::TYPE_ANDESITE => "Andesite",
			self::TYPE_POLISHED_DIORITE => "Polished Diorite",
			self::TYPE_DIORITE => "Diorite",
			self::TYPE_POLISHED_GRANITE => "Polished Granite",
			self::TYPE_GRANITE => "Granite",
			self::TYPE_END_STONE_BRICK2 => "End Stone Brick",
			self::TYPE_SMOOTH_RED_SANDSTONE2 => "Smooth Red SandStone",
			self::TYPE_POLISHED_ANDESITE2 => "Polished Andesite",
			self::TYPE_ANDESITE2 => "Andesite",
			self::TYPE_POLISHED_DIORITE2 => "Polished Diorite",
			self::TYPE_DIORITE2 => "Diorite",
			self::TYPE_POLISHED_GRANITE2 => "Polished Granite",
			self::TYPE_GRANITE2 => "Granite"
		];

		return (($this->meta & 0x08) > 0 ? "Upper " : "") . ($names[$this->getVariant()] ?? "") . " Slab";
	}
}
