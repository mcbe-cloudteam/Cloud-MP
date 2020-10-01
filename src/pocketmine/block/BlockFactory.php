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

use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\network\mcpe\protocol\types\RuntimeBlockMapping;
use function min;

/**
 * Manages block registration and instance creation
 */
class BlockFactory{
	/** @var \SplFixedArray<Block> */
	private static $fullList = null;

	/** @var \SplFixedArray<bool> */
	public static $solid = null;
	/** @var \SplFixedArray<bool> */
	public static $transparent = null;
	/** @var \SplFixedArray<float> */
	public static $hardness = null;
	/** @var \SplFixedArray<int> */
	public static $light = null;
	/** @var \SplFixedArray<int> */
	public static $lightFilter = null;
	/** @var \SplFixedArray<bool> */
	public static $diffusesSkyLight = null;
	/** @var \SplFixedArray<float> */
	public static $blastResistance = null;

	/**
	 * Initializes the block factory. By default this is called only once on server start, however you may wish to use
	 * this if you need to reset the block factory back to its original defaults for whatever reason.
	 */
	public static function init() : void{
		self::$fullList = new \SplFixedArray(16384);

		self::$light = new \SplFixedArray(16384);
		self::$lightFilter = new \SplFixedArray(16384);
		self::$solid = new \SplFixedArray(16384);
		self::$hardness = new \SplFixedArray(16384);
		self::$transparent = new \SplFixedArray(16384);
		self::$diffusesSkyLight = new \SplFixedArray(16384);
		self::$blastResistance = new \SplFixedArray(16384);

		/* 새로운 블럭 추가 */
		self::registerBlock(new Element(Block::UNKNOW_ELEMENT, 0, "???")); /* 36 */
		
		self::registerBlock(new HardGlass(253, 0, "Hard Glass"));
		self::registerBlock(new HardGlassPane(190, 0, "Hard Glass Pane"));

		self::registerBlock(new ChemicalHeat(192, 0, "Chemical Heat"));
		self::registerBlock(new ChemicalTable(238, 0, "Chemical Table"));

		self::registerBlock(new ColoredTorchRg(202, 0, "Colored Torch Rg"));

		self::registerBlock(new ColoredTorchBp(204, 0, "Colored Torch Bp"));

		self::registerBlock(new UnderWaterTorch());

		self::registerBlock(new HardStainedGlass(254, 0, "Hard Stained Glass"));
		self::registerBlock(new HardStainedGlassPane(191, 0, "Hard Stained Glass Pane"));

		/* -단위 아이템 추가 */
		self::registerBlock(new PrismarineStairs()); /* 257 */
	    self::registerBlock(new DarkPrismarineStairs()); /* 258 */
		self::registerBlock(new PrismarineBricksStairs()); /* 259 */
		self::registerBlock(new NewBlock(260, 0, "Stripped Spruce Log"));
		self::registerBlock(new NewBlock(261, 0, "Stripped Birch Log"));
		self::registerBlock(new NewBlock(262, 0, "Stripped Jungle Log"));
		self::registerBlock(new NewBlock(263, 0, "Stripped Acaica Log"));
		self::registerBlock(new NewBlock(264, 0, "Stripped Dark Oak Log"));
		self::registerBlock(new NewBlock(265, 0, "Stripped Oak Log"));
		self::registerBlock(new BlueIce()); /* 266 */
		self::registerBlock(new NewBlock(267, 0, "H"));

		self::registerBlock(new NewBlock(385, 0, "Seagrass"));
		self::registerBlock(new NewBlock(386, 0, "Coral"));
		self::registerBlock(new NewBlock(387, 0, "Coral Block"));
		self::registerBlock(new NewBlock(388, 0, "Coral Fan"));
		self::registerBlock(new NewBlock(389, 0, "Coral Fan Hang"));
		self::registerBlock(new NewBlock(390, 0, "Coral Fan Hang 1"));
		self::registerBlock(new NewBlock(391, 0, "Coral Fan Hang 2"));
		self::registerBlock(new NewBlock(392, 0, "Coral Fan Hong 3"));
		self::registerBlock(new Kelp()); /* 393 */
		
		self::registerBlock(new AcaciaButton()); /* 395 */
		self::registerBlock(new BirchButton()); /* 396 */
		self::registerBlock(new DarkOakButton()); /* 397 */
		self::registerBlock(new JungleButton()); /* 398 */
		self::registerBlock(new SpruceButton()); /* 399 */
		
		self::registerBlock(new AcaciaTrapdoor()); /* 400 */
		self::registerBlock(new BirchTrapdoor()); /* 401 */
		self::registerBlock(new DarkOakTrapdoor()); /* 402 */
		self::registerBlock(new JungleTrapdoor()); /* 403 */
		self::registerBlock(new SpruceTrapdoor()); /* 404 */
		
		self::registerBlock(new AcaciaPressurePlate()); /* 405 */
		self::registerBlock(new BirchPressurePlate()); /* 406 */
		self::registerBlock(new DarkOakPressurePlate()); /* 407 */
		self::registerBlock(new JunglePressurePlate()); /* 408 */
		self::registerBlock(new SprucePressurePlate()); /* 409 */
		
		self::registerBlock(new CarvedPumpkin()); /* 410 */
		self::registerBlock(new NewBlock(411, 0, "Sea Pickle"));
		self::registerBlock(new NewBlock(412, 0, "Conduit"));
		self::registerBlock(new NewBlock(413, 0, "Turtle Egg"));
		
		self::registerBlock(new Barrier()); /* 416 */
		self::registerBlock(new StoneSlab3()); /* 417 - 0~15 */
		self::registerBlock(new NewBlock(418, 0, "Bamboo"));
		self::registerBlock(new NewBlock(419, 0, "Bamboo Sapling"));
		self::registerBlock(new NewBlock(420, 0, "Scaffolding"));
		self::registerBlock(new StoneSlab4()); /* 421 - 0~15 */
		self::registerBlock(new DoubleStoneSlab3()); /* 422 - 0~15 */
		self::registerBlock(new DoubleStoneSlab4()); /* 423 - 0~15 */
		self::registerBlock(new NewBlock(424, 0, "Granite Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(425, 0, "Diorite Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(426, 0, "Andesite Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(427, 0, "Polished Granite Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(428, 0, "Polished Diorite Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(429, 0, "Polished Andesite Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(430, 0, "Mossy Stone Brick Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(431, 0, "Smooth Red SandStone Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(432, 0, "Smooth SandStone Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(433, 0, "End Brick Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(434, 0, "Mossy CobbleStone Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(435, 0, "Normal Stone Stairs")); /* 0~7 */
		self::registerBlock(new SpruceStandingSign()); /* 436 */
		self::registerBlock(new SpruceWallSign()); /* 437 */
		self::registerBlock(new NewBlock(438, 0, "Smooth Stone"));
		self::registerBlock(new NewBlock(439, 0, "Red Nether Brick Stairs")); /* 0~7 */
		self::registerBlock(new NewBlock(440, 0, "Smooth Quartz Stairs")); /* 0~7 */
		self::registerBlock(new BirchStandingSign()); /* 441 */
		self::registerBlock(new BirchWallSign()); /* 442 */
		self::registerBlock(new JungleStandingSign()); /* 443 */
		self::registerBlock(new JungleWallSign()); /* 444 */
		self::registerBlock(new AcaciaStandingSign()); /* 445 */
		self::registerBlock(new AcaciaWallSign()); /* 446 */
		self::registerBlock(new DarkOakStandingSign()); /* 447 */
		self::registerBlock(new DarkOakWallSign()); /* 448 */

		self::registerBlock(new NewBlock(450, 0, "Grindstone"));
		self::registerBlock(new NewBlock(451, 0, "Blast Furnace"));
		//self::registerBlock(new NewBlock(452, 0, "Stonecutter"));
		self::registerBlock(new NewBlock(453, 0, "Smoker"));

		self::registerBlock(new NewBlock(455, 0, "Cartography Table"));
		self::registerBlock(new NewBlock(456, 0, "Fletching Table"));
		self::registerBlock(new NewBlock(457, 0, "Smithing Table"));
		self::registerBlock(new Barrel()); /* 458 */
		self::registerBlock(new Loom()); /* 459 */

		self::registerBlock(new NewBlock(461, 0, "Bell"));
		self::registerBlock(new NewBlock(462, 0, "Sweet Berry Bush"));
		self::registerBlock(new NewBlock(464, 0, "Campfire"));
		
		self::registerBlock(new Wood3()); /* 467 */
		self::registerBlock(new Composter()); /* 468 */
		self::registerBlock(new NewBlock(469, 0, "Lit Blast Furnace"));
		/* 새로운 블럭 추가 */

		self::registerBlock(new Air());
		self::registerBlock(new Stone());
		self::registerBlock(new Grass());
		self::registerBlock(new Dirt());
		self::registerBlock(new Cobblestone());
		self::registerBlock(new Planks());
		self::registerBlock(new Sapling());
		self::registerBlock(new Bedrock());
		self::registerBlock(new Water());
		self::registerBlock(new StillWater());
		self::registerBlock(new Lava());
		self::registerBlock(new StillLava());
		self::registerBlock(new Sand());
		self::registerBlock(new Gravel());
		self::registerBlock(new GoldOre());
		self::registerBlock(new IronOre());
		self::registerBlock(new CoalOre());
		self::registerBlock(new Wood());
		self::registerBlock(new Leaves());
		self::registerBlock(new Sponge());
		self::registerBlock(new Glass());
		self::registerBlock(new LapisOre());
		self::registerBlock(new Lapis());
		//TODO: DISPENSER
		self::registerBlock(new Sandstone());
		self::registerBlock(new NoteBlock());
		self::registerBlock(new Bed());
		self::registerBlock(new PoweredRail());
		self::registerBlock(new DetectorRail());
		//TODO: STICKY_PISTON
		self::registerBlock(new Cobweb());
		self::registerBlock(new TallGrass());
		self::registerBlock(new DeadBush());
		//TODO: PISTON
		//TODO: PISTONARMCOLLISION
		self::registerBlock(new Wool());

		self::registerBlock(new Dandelion());
		self::registerBlock(new Flower());
		self::registerBlock(new BrownMushroom());
		self::registerBlock(new RedMushroom());
		self::registerBlock(new Gold());
		self::registerBlock(new Iron());
		self::registerBlock(new DoubleStoneSlab());
		self::registerBlock(new StoneSlab());
		self::registerBlock(new Bricks());
		self::registerBlock(new TNT());
		self::registerBlock(new Bookshelf());
		self::registerBlock(new MossyCobblestone());
		self::registerBlock(new Obsidian());
		self::registerBlock(new Torch());
		self::registerBlock(new Fire());
		self::registerBlock(new MonsterSpawner());
		self::registerBlock(new WoodenStairs(Block::OAK_STAIRS, 0, "Oak Stairs"));
		self::registerBlock(new Chest());
		//TODO: REDSTONE_WIRE
		self::registerBlock(new DiamondOre());
		self::registerBlock(new Diamond());
		self::registerBlock(new CraftingTable());
		self::registerBlock(new Wheat());
		self::registerBlock(new Farmland());
		self::registerBlock(new Furnace());
		self::registerBlock(new BurningFurnace());
		self::registerBlock(new SignPost());
		self::registerBlock(new WoodenDoor(Block::OAK_DOOR_BLOCK, 0, "Oak Door", Item::OAK_DOOR));
		self::registerBlock(new Ladder());
		self::registerBlock(new Rail());
		self::registerBlock(new CobblestoneStairs());
		self::registerBlock(new WallSign());
		self::registerBlock(new Lever());
		self::registerBlock(new StonePressurePlate());
		self::registerBlock(new IronDoor());
		self::registerBlock(new WoodenPressurePlate());
		self::registerBlock(new RedstoneOre());
		self::registerBlock(new GlowingRedstoneOre());
		self::registerBlock(new RedstoneTorchUnlit());
		self::registerBlock(new RedstoneTorch());
		self::registerBlock(new StoneButton());
		self::registerBlock(new SnowLayer());
		self::registerBlock(new Ice());
		self::registerBlock(new Snow());
		self::registerBlock(new Cactus());
		self::registerBlock(new Clay());
		self::registerBlock(new Sugarcane());
		self::registerBlock(new Jukebox());
		self::registerBlock(new WoodenFence());
		self::registerBlock(new Pumpkin());
		self::registerBlock(new Netherrack());
		self::registerBlock(new SoulSand());
		self::registerBlock(new Glowstone());
		self::registerBlock(new Portal());
		self::registerBlock(new LitPumpkin());
		self::registerBlock(new Cake());
		//TODO: REPEATER_BLOCK
		//TODO: POWERED_REPEATER
		self::registerBlock(new InvisibleBedrock());
		self::registerBlock(new Trapdoor());
		self::registerBlock(new MonsterEgg());;
		self::registerBlock(new StoneBricks());
		self::registerBlock(new BrownMushroomBlock());
		self::registerBlock(new RedMushroomBlock());
		self::registerBlock(new IronBars());
		self::registerBlock(new GlassPane());
		self::registerBlock(new Melon());
		self::registerBlock(new PumpkinStem());
		self::registerBlock(new MelonStem());
		self::registerBlock(new Vine());
		self::registerBlock(new FenceGate(Block::OAK_FENCE_GATE, 0, "Oak Fence Gate"));
		self::registerBlock(new BrickStairs());
		self::registerBlock(new StoneBrickStairs());
		self::registerBlock(new Mycelium());
		self::registerBlock(new WaterLily());
		self::registerBlock(new NetherBrick(Block::NETHER_BRICK_BLOCK, 0, "Nether Bricks"));
		self::registerBlock(new NetherBrickFence());
		self::registerBlock(new NetherBrickStairs());
		self::registerBlock(new NetherWartPlant());
		self::registerBlock(new EnchantingTable());
		self::registerBlock(new BrewingStand());
		//TODO: CAULDRON_BLOCK
		self::registerBlock(new EndPortal());
		self::registerBlock(new EndPortalFrame());
		self::registerBlock(new EndStone());
		self::registerBlock(new DragonEgg());
		self::registerBlock(new RedstoneLamp());
		self::registerBlock(new LitRedstoneLamp());
		//TODO: DROPPER
		self::registerBlock(new ActivatorRail());
		self::registerBlock(new CocoaBlock());
		self::registerBlock(new SandstoneStairs());
		self::registerBlock(new EmeraldOre());
		self::registerBlock(new EnderChest());
		self::registerBlock(new TripwireHook());
		self::registerBlock(new Tripwire());
		self::registerBlock(new Emerald());
		self::registerBlock(new WoodenStairs(Block::SPRUCE_STAIRS, 0, "Spruce Stairs"));
		self::registerBlock(new WoodenStairs(Block::BIRCH_STAIRS, 0, "Birch Stairs"));
		self::registerBlock(new WoodenStairs(Block::JUNGLE_STAIRS, 0, "Jungle Stairs"));
		self::registerBlock(new CommandBlock());
		self::registerBlock(new Beacon());
		self::registerBlock(new CobblestoneWall());
		self::registerBlock(new FlowerPot());
		self::registerBlock(new Carrot());
		self::registerBlock(new Potato());
		self::registerBlock(new WoodenButton());
		self::registerBlock(new Skull());
		self::registerBlock(new Anvil());
		self::registerBlock(new TrappedChest());
		self::registerBlock(new WeightedPressurePlateLight());
		self::registerBlock(new WeightedPressurePlateHeavy());
		//TODO: COMPARATOR_BLOCK
		//TODO: POWERED_COMPARATOR
		self::registerBlock(new DaylightSensor());
		self::registerBlock(new Redstone());
		self::registerBlock(new NetherQuartzOre());
		self::registerBlock(new Hopper());
		self::registerBlock(new Quartz());
		self::registerBlock(new QuartzStairs());
		self::registerBlock(new DoubleWoodenSlab());
		self::registerBlock(new WoodenSlab());
		self::registerBlock(new StainedClay());
		self::registerBlock(new StainedGlassPane());
		self::registerBlock(new Leaves2());
		self::registerBlock(new Wood2());
		self::registerBlock(new WoodenStairs(Block::ACACIA_STAIRS, 0, "Acacia Stairs"));
		self::registerBlock(new WoodenStairs(Block::DARK_OAK_STAIRS, 0, "Dark Oak Stairs"));
		self::registerBlock(new Slime());

		self::registerBlock(new IronTrapdoor());
		self::registerBlock(new Prismarine());
		self::registerBlock(new SeaLantern());
		self::registerBlock(new HayBale());
		self::registerBlock(new Carpet());
		self::registerBlock(new HardenedClay());
		self::registerBlock(new Coal());
		self::registerBlock(new PackedIce());
		self::registerBlock(new DoublePlant());
		self::registerBlock(new StandingBanner());
		self::registerBlock(new WallBanner());
		//TODO: DAYLIGHT_DETECTOR_INVERTED
		self::registerBlock(new RedSandstone());
		self::registerBlock(new RedSandstoneStairs());
		self::registerBlock(new DoubleStoneSlab2());
		self::registerBlock(new StoneSlab2());
		self::registerBlock(new FenceGate(Block::SPRUCE_FENCE_GATE, 0, "Spruce Fence Gate"));
		self::registerBlock(new FenceGate(Block::BIRCH_FENCE_GATE, 0, "Birch Fence Gate"));
		self::registerBlock(new FenceGate(Block::JUNGLE_FENCE_GATE, 0, "Jungle Fence Gate"));
		self::registerBlock(new FenceGate(Block::DARK_OAK_FENCE_GATE, 0, "Dark Oak Fence Gate"));
		self::registerBlock(new FenceGate(Block::ACACIA_FENCE_GATE, 0, "Acacia Fence Gate"));
		//TODO: REPEATING_COMMAND_BLOCK
		//TODO: CHAIN_COMMAND_BLOCK

		self::registerBlock(new WoodenDoor(Block::SPRUCE_DOOR_BLOCK, 0, "Spruce Door", Item::SPRUCE_DOOR));
		self::registerBlock(new WoodenDoor(Block::BIRCH_DOOR_BLOCK, 0, "Birch Door", Item::BIRCH_DOOR));
		self::registerBlock(new WoodenDoor(Block::JUNGLE_DOOR_BLOCK, 0, "Jungle Door", Item::JUNGLE_DOOR));
		self::registerBlock(new WoodenDoor(Block::ACACIA_DOOR_BLOCK, 0, "Acacia Door", Item::ACACIA_DOOR));
		self::registerBlock(new WoodenDoor(Block::DARK_OAK_DOOR_BLOCK, 0, "Dark Oak Door", Item::DARK_OAK_DOOR));
		self::registerBlock(new GrassPath());
		self::registerBlock(new ItemFrame());
		//TODO: CHORUS_FLOWER
		self::registerBlock(new Purpur());

		self::registerBlock(new PurpurStairs());

		self::registerBlock(new UndyedShulkerBox());
		self::registerBlock(new EndStoneBricks());
		//TODO: FROSTED_ICE
		self::registerBlock(new EndRod());
		//TODO: END_GATEWAY

		self::registerBlock(new Magma());
		self::registerBlock(new NetherWartBlock());
		self::registerBlock(new NetherBrick(Block::RED_NETHER_BRICK, 0, "Red Nether Bricks"));
		self::registerBlock(new BoneBlock());

		self::registerBlock(new ShulkerBox());
		self::registerBlock(new GlazedTerracotta(Block::PURPLE_GLAZED_TERRACOTTA, 0, "Purple Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::WHITE_GLAZED_TERRACOTTA, 0, "White Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::ORANGE_GLAZED_TERRACOTTA, 0, "Orange Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::MAGENTA_GLAZED_TERRACOTTA, 0, "Magenta Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::LIGHT_BLUE_GLAZED_TERRACOTTA, 0, "Light Blue Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::YELLOW_GLAZED_TERRACOTTA, 0, "Yellow Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::LIME_GLAZED_TERRACOTTA, 0, "Lime Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::PINK_GLAZED_TERRACOTTA, 0, "Pink Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::GRAY_GLAZED_TERRACOTTA, 0, "Grey Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::SILVER_GLAZED_TERRACOTTA, 0, "Light Grey Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::CYAN_GLAZED_TERRACOTTA, 0, "Cyan Glazed Terracotta"));

		self::registerBlock(new GlazedTerracotta(Block::BLUE_GLAZED_TERRACOTTA, 0, "Blue Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::BROWN_GLAZED_TERRACOTTA, 0, "Brown Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::GREEN_GLAZED_TERRACOTTA, 0, "Green Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::RED_GLAZED_TERRACOTTA, 0, "Red Glazed Terracotta"));
		self::registerBlock(new GlazedTerracotta(Block::BLACK_GLAZED_TERRACOTTA, 0, "Black Glazed Terracotta"));
		self::registerBlock(new Concrete());
		self::registerBlock(new ConcretePowder());

		//TODO: CHORUS_PLANT
		self::registerBlock(new StainedGlass());

		self::registerBlock(new Podzol());
		self::registerBlock(new Beetroot());
		self::registerBlock(new Stonecutter());
		self::registerBlock(new GlowingObsidian());
		self::registerBlock(new NetherReactor());
		self::registerBlock(new InfoUpdate(Block::INFO_UPDATE, 0, "update!"));
		self::registerBlock(new InfoUpdate(Block::INFO_UPDATE2, 0, "ate!upd"));
		//TODO: MOVINGBLOCK
		//TODO: OBSERVER
		//TODO: STRUCTURE_BLOCK

		self::registerBlock(new Reserved6(Block::RESERVED6, 0, "reserved6"));

		for($id = 0, $size = self::$fullList->getSize() >> 4; $id < $size; ++$id){
			if(self::$fullList[$id << 4] === null){
				self::registerBlock(new UnknownBlock($id));
			}
		}
	}

	public static function isInit() : bool{
		return self::$fullList !== null;
	}

	/**
	 * Registers a block type into the index. Plugins may use this method to register new block types or override
	 * existing ones.
	 *
	 * NOTE: If you are registering a new block type, you will need to add it to the creative inventory yourself - it
	 * will not automatically appear there.
	 *
	 * @param Block $block
	 * @param bool  $override Whether to override existing registrations
	 *
	 * @throws \RuntimeException if something attempted to override an already-registered block without specifying the
	 * $override parameter.
	 */
	public static function registerBlock(Block $block, bool $override = false) : void{
		$id = $block->getId();

		if(!$override and self::isRegistered($id)){
			throw new \RuntimeException("Trying to overwrite an already registered block $id");
		}

		for($meta = 0; $meta < 16; ++$meta){
			$variant = clone $block;
			$variant->setDamage($meta);
			self::$fullList[($id << 4) | $meta] = $variant;
		}

		self::$solid[$id] = $block->isSolid();
		self::$transparent[$id] = $block->isTransparent();
		self::$hardness[$id] = $block->getHardness();
		self::$light[$id] = $block->getLightLevel();
		self::$lightFilter[$id] = min(15, $block->getLightFilter() + 1); //opacity plus 1 standard light filter
		self::$diffusesSkyLight[$id] = $block->diffusesSkyLight();
		self::$blastResistance[$id] = $block->getBlastResistance();
	}

	/**
	 * Returns a new Block instance with the specified ID, meta and position.
	 *
	 * @param int      $id
	 * @param int      $meta
	 * @param Position $pos
	 *
	 * @return Block
	 */
	public static function get(int $id, int $meta = 0, Position $pos = null) : Block{
		if($meta < 0 or $meta > 0xf){
			throw new \InvalidArgumentException("Block meta value $meta is out of bounds");
		}

		try{
			if(self::$fullList !== null){
				$block = clone self::$fullList[($id << 4) | $meta];
			}else{
				$block = new UnknownBlock($id, $meta);
			}
		}catch(\RuntimeException $e){
			throw new \InvalidArgumentException("Block ID $id is out of bounds");
		}

		if($pos !== null){
			$block->x = $pos->getFloorX();
			$block->y = $pos->getFloorY();
			$block->z = $pos->getFloorZ();
			$block->level = $pos->level;
		}

		return $block;
	}

	/**
	 * @internal
	 * @return \SplFixedArray
	 */
	public static function getBlockStatesArray() : \SplFixedArray{
		return self::$fullList;
	}

	/**
	 * Returns whether a specified block ID is already registered in the block factory.
	 *
	 * @param int $id
	 *
	 * @return bool
	 */
	public static function isRegistered(int $id) : bool{
		$b = self::$fullList[$id << 4];
		return $b !== null and !($b instanceof UnknownBlock);
	}

	/**
	 * @internal
	 * @deprecated
	 *
	 * @param int $id
	 * @param int $meta
	 *
	 * @return int
	 */
	public static function toStaticRuntimeId(int $id, int $meta = 0) : int{
		return RuntimeBlockMapping::toStaticRuntimeId($id, $meta);
	}

	/**
	 * @deprecated
	 * @internal
	 *
	 * @param int $runtimeId
	 *
	 * @return int[] [id, meta]
	 */
	public static function fromStaticRuntimeId(int $runtimeId) : array{
		return RuntimeBlockMapping::fromStaticRuntimeId($runtimeId);
	}
}
