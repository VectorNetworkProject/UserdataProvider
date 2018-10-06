<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/07
 * Time: 0:50
 */

namespace VectorNetworkProject\DataProvider\Tables\Dual;

use pocketmine\IPlayer;
use VectorNetworkProject\DataProvider\Tables\TableBase;

class Dual extends TableBase
{
	public const INIT = 'userdataprovider.dual.init';
	public const REGISTER = 'userdataprovider.dual.register';
	public const UNREGISTER = 'userdataprovider.dual.unregister';
	public const GET = 'userdataprovider.dual.get';
	public const ADD_COUNT = 'userdataprovider.dual.addcount';
	public const GET_RANKING = 'userdataprovider.dual.getranking';

	public function init(): void
	{
		$this->connector->executeGeneric(self::INIT);
	}

	/**
	 * @param IPlayer $player
	 * @param callable $onInserted
	 * @param callable|null $onError
	 */
	public function register(IPlayer $player, callable $onInserted, ?callable $onError = null): void
	{
		$this->connector->executeInsert(self::REGISTER, [$player->getName()], $onInserted, $onError);
	}

	/**
	 * @param IPlayer $player
	 * @param callable|null $onSelect
	 * @param callable|null $onError
	 */
	public function unregister(IPlayer $player, ?callable $onSelect, ?callable $onError = null): void
	{
		$this->connector->executeChange(self::REGISTER, [$player->getName()], $onSelect, $onError);
	}

	/**
	 * @param IPlayer $player
	 * @param callable $onSelect
	 * @param callable|null $onError
	 */
	public function get(IPlayer $player, callable $onSelect, ?callable $onError = null): void
	{
		$this->connector->executeSelect(self::GET, [$player->getName()], $onSelect, $onError);
	}

	public function addCount(IPlayer $player, int $kill, int $death, int $win, int $lose, callable $onSelect, ?callable $onError = null): void
	{
		$this->connector->executeChange(self::ADD_COUNT, [$player->getName(), $kill, $death, $win, $lose], $onSelect, $onError);
	}

	public function getRanking(int $limit, callable $onSelect, ?callable $onError = null): void
	{
		$this->connector->executeSelect(self::GET_RANKING, [$limit], $onSelect, $onError);
	}
}