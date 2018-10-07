<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/06
 * Time: 22:46
 */

namespace VectorNetworkProject\DataProvider\Tables\FFAPvP;

use pocketmine\IPlayer;
use VectorNetworkProject\DataProvider\Tables\TableBase;

class FFAPvP extends TableBase
{
	public const INIT					= 'userdataprovider.ffapvp.init';
	public const REGISTER				= 'userdataprovider.ffapvp.register';
	public const UNREGISTER				= 'userdataprovider.ffapvp.unregister';
	public const GET					= 'userdataprovider.ffapvp.get';
	public const ADD_COUNT				= 'userdataprovider.ffapvp.add';
	public const GET_RANKING_BY_KILL	= 'userdataprovider.ffapvp.getrankingbykill';
	public const GET_RANKING_BY_EXP		= 'userdataprovider.ffapvp.getrankingbyexp';

	public function init(): void
	{
		$this->connector->executeGeneric(self::INIT);
	}

	/**
	 * プレイヤーを登録します。
	 *
	 * @param IPlayer $player
	 * @param callable|null $onInserted
	 * @param callable|null $onError
	 */
	public function register(IPLayer $player, ?callable $onInserted = null, ?callable $onError = null): void
	{
		$this->connector->executeInsert(self::REGISTER, [$player->getname()], $onInserted, $onError);

	}

	/**
	 * プレイヤーを登録解除します
	 *
	 * @param IPlayer $player
	 * @param callable|null $onSuccess
	 * @param callable|null $onError
	 */
	public function unregister(IPLayer $player, ?callable $onSuccess = null, ?callable $onError = null): void
	{
		$this->connector->executeChange(self::UNREGISTER, [$player->getName()], $onSuccess, $onError );
	}

	/**
	 * プレイヤーの情報を取得します
	 *
	 * @param IPlayer $player
	 * @param callable|null $onSuccess
	 * @param callable|null $onError
	 */
	public function get(IPlayer $player, callable $onSuccess = null, ?callable $onError = null): void
	{
		$this->connector->executeSelect(self::GET, [$player->getName()], $onSuccess, $onError);
	}

	/**
	 * プレイヤーのそれぞれのカウントを増やします
	 *
	 * @param IPlayer $player
	 * @param int $kill
	 * @param int $death
	 * @param int $exp
	 */
	public function add(IPlayer $player, int $kill = 0, int $death = 0, int $exp = 0)
	{
		$this->connector->executeChange(self::ADD_COUNT, [$player->getName(), $kill, $death, $exp]);
	}

	/**
	 * プレイヤーのキル数を増やします
	 *
	 * @param IPlayer $player
	 * @param int $kill
	 */
	public function addKill(IPlayer $player, int $kill)
	{
		$this->add($player, $kill);
	}

	/**
	 * プレイヤーのデス数を増やします
	 *
	 * @param IPlayer $player
	 * @param int $death
	 */
	public function addDeath(IPlayer $player, int $death)
	{
		$this->add($player, 0, $death);
	}

	/**
	 * プレイヤーのEXPを増やします
	 *
	 * @param IPlayer $player
	 * @param int $exp
	 */
	public function addExp(IPlayer $player,int $exp)
	{
		$this->add($player, 0, 0, $exp);
	}

	/**
	 * キル数のランキングを取得します
	 *
	 * @param int $limit
	 * @param callable|null $onSelect
	 * @param callable|null $onError
	 */
	public function getRankingByKill(int $limit, ?callable $onSelect = null, ?callable $onError = null): void
	{
		$this->connector->executeSelect(self::GET_RANKING_BY_KILL, [$limit], $onSelect, $onError);
	}

	/**
	 * EXPのランキングを取得します
	 *
	 * @param int $limit
	 * @param callable|null $onSelect
	 * @param callable|null $onError
	 */
	public function getRankingByExp(int $limit, ?callable $onSelect = null, ?callable $onError = null): void
	{
		$this->connector->executeSelect(self::GET_RANKING_BY_EXP, [$limit], $onSelect, $onError);
	}
}