<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/07
 * Time: 15:32
 */

namespace VectorNetworkProject\DataProvider\Tables\CorePvP;

use pocketmine\IPlayer;
use VectorNetworkProject\DataProvider\Tables\TableBase;

class CorePvP extends TableBase
{
	public const INIT = 'userdataprovider.corepvp.init';
	public const REGISTER = 'userdataprovider.corepvp.register';
	public const UNREGISTER = 'userdataprovider.corepvp.unregister';
	public const GET = 'userdataprovider.corepvp.get';
	public const ADD = 'userdataprovider.corepvp.add';
	public const GET_RANKING_BY_KILL = 'userdataprovider.corepvp.getrankingbykill';
	public const GET_RANKING_BY_WIN = 'userdataprovider.corepvp.getrankingbywin';
	public const GET_RANKING_BY_EXP = 'userdataprovider.corepvp.getrankingbyexp';

	public function init(): void
	{
		$this->connector->executeGeneric(self::INIT);
	}

	/**
	 * @param IPlayer $player
	 * @param callable|null $onSuccess
	 * @param callable|null $onError
	 */
	public function regsiter(IPlayer $player, ?callable $onSuccess = null, ?callable $onError = null): void
	{
		$this->connector->executeInsert(self::REGISTER, [$player->getname()], $onSuccess, $onError);
	}

	/**
	 * @param IPlayer $player
	 * @param callable $onSuccess
	 * @param callable|null $onError
	 */
	public function unregister(IPlayer $player, callable $onSuccess, ?callable $onError = null): void
	{
		$this->connector->executeInsert(self::UNREGISTER, [$player->getname()], $onSuccess, $onError);
	}

	/**
	 * @param IPlayer $player
	 * @param callable $onSuccess
	 * @param callable|null $onError
	 */
	public function get(IPlayer $player, callable $onSuccess, ?callable $onError = null)
	{
		$this->connector->executeSelect(self::GET, [$player->getName()], $onSuccess, $onError);;
	}

	/**
	 * @param IPlayer $player
	 * @param int $kill
	 * @param int $death
	 * @param int $win
	 * @param int $lose
	 * @param int $exp
	 * @param callable|null $onSuccess
	 * @param callable|null $onError
	 */
	public function add(
		IPlayer $player,
		int $kill = 0,
		int $death = 0,
		int $win = 0,
		int $lose = 0,
		int $exp = 0,
		?callable $onSuccess = null,
		?callable $onError = null
	): void
	{
		$this->connector->executeSelect(self::GET, [$player->getname(), $kill, $death, $win, $lose, $exp], $onSuccess, $onError);
	}

	/**
	 * @param int $limit
	 * @param callable $onSuccess
	 * @param callable|null $onError
	 */
	public function getRankingByKill(int $limit, callable $onSuccess, ?callable $onError = null): void
	{
		$this->connector->executeSelect( self::GET_RANKING_BY_KILL, [$limit], $onSuccess, $onError);
	}

	/**
	 * @param int $limit
	 * @param callable $onSuccess
	 * @param callable|null $onError
	 */
	public function getRankingByWin(int $limit, callable $onSuccess, ?callable $onError = null): void
	{
		$this->connector->executeSelect( self::GET_RANKING_BY_WIN, [$limit], $onSuccess, $onError);
	}

	/**
	 * @param int $limit
	 * @param callable $onSuccess
	 * @param callable|null $onError
	 */
	public function getRankingByExp(int $limit, callable $onSuccess, ?callable $onError = null): void
	{
		$this->connector->executeSelect( self::GET_RANKING_BY_EXP, [$limit], $onSuccess, $onError);
	}
}