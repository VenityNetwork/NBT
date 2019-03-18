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

namespace pocketmine\nbt\tag;

use pocketmine\nbt\NBT;
use pocketmine\nbt\NbtStreamReader;
use pocketmine\nbt\NbtStreamWriter;
use function func_num_args;

final class IntTag extends Tag{
	/** @var int */
	private $value;

	/**
	 * @param int $value
	 */
	public function __construct(int $value){
		self::restrictArgCount(__METHOD__, func_num_args(), 1);
		if($value < -0x80000000 or $value > 0x7fffffff){
			throw new \InvalidArgumentException("Value $value is too large!");
		}
		$this->value = $value;
	}

	public function getType() : int{
		return NBT::TAG_Int;
	}

	public static function read(NbtStreamReader $reader) : self{
		return new self($reader->readInt());
	}

	public function write(NbtStreamWriter $writer) : void{
		$writer->writeInt($this->value);
	}

	/**
	 * @return int
	 */
	public function getValue() : int{
		return $this->value;
	}
}
