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
	public const INIT = 'userdataprovider.duel.init';
	public const REGISTER = 'userdataprovider.duel.register';
	public const UNREGISTER		= 'userdataprovider.duel.unregister';
	public const GET = 'userdataprovider.duel.get';
	public const ADD_COUNT = 'userdataprovider.duel.addcount';
	public const GET_RANKING	= 'userdataprovider.duel.getrankingbywin';

	public function init(): void
	{
		$this->connector->executeGeneric(self::INIT);
	}

	/**
	 * 	プレイヤーを登録します
	 *
	 * @param IPlayer $player
	 * @param callable $onInserted
	 * @param callable|null $onError
	 */
	public function register(IPlayer $player, callable $onInserted, ?callable $onError = null): void
	{
		$this->connector->executeInsert(self::REGISTER, [$player->getName()], $onInserted, $onError);
	}

	/**
	 * プレイヤーを登録解除します
	 *
	 * @param IPlayer $player
	 * @param callable|null $onSelect
	 * @param callable|null $onError
	 */
	public function unregister(IPlayer $player, ?callable $onSelect, ?callable $onError = null): void
	{
		$this->connector->executeChange(self::REGISTER, [$player->getName()], $onSelect, $onError);
	}

	/**
	 * プレイヤーの情報を取得します
	 *
	 * @param IPlayer $player
	 * @param callable $onSelect
	 * @param callable|null $onError
	 */
	public function get(IPlayer $player, callable $onSelect, ?callable $onError = null): void
	{
		$this->connector->executeSelect(self::GET, [$player->getName()], $onSelect, $onError);
	}

	/**
	 * プレイヤーのそれぞれのカウントを増やします
	 *
	 * @param IPlayer $player
	 * @param int $kill
	 * @param int $death
	 * @param int $win
	 * @param int $lose
	 * @param callable|null $onSelect
	 * @param callable|null $onError
	 */
	public function add(IPlayer $player, int $kill = 0, int $death = 0, int $win = 0, int $lose = 0, ?callable $onSelect = null, ?callable $onError = null): void
	{
		$this->connector->executeChange(self::ADD_COUNT, [$player->getName(), $kill, $death, $win, $lose], $onSelect, $onError);
	}

	/**
	 * プレイヤーのキル数を増やします
	 *
	 * @param IPlayer $player
	 * @param int $kill
	 */
	public function addKill(IPlayer $player, int $kill): void
	{
		$this->add($player, $kill);
	}

	/**
	 * プレイヤーのデス数を増やします
	 *
	 * @param IPlayer $player
	 * @param int $death
	 */
	public function addDeath(IPlayer $player, int $death): void
	{
		$this->add($player, 0, $death);
	}

	/**
	 * プレイヤーの勝利数を増やします
	 *
	 * @param IPlayer $player
	 * @param int $win
	 */
	public function addWin(IPlayer $player, int $win): void
	{
		$this->add($player, 0, 0, $win);
	}

	/**
	 * プレイヤーの敗北数を増やします
	 *
	 * @param IPlayer $player
	 * @param int $lose
	 */
	public function addLose(IPlayer $player, int $lose): void
	{
		$this->add($player, 0, 0, 0, $lose);
	}

	/**
	 * 勝利数のランキングを取得します
	 *
	 * @param int $limit
	 * @param callable $onSelect
	 * @param callable|null $onError
	 */
	public function getRankingByWin(int $limit, callable $onSelect, ?callable $onError = null): void
	{
		$this->connector->executeSelect(self::GET_RANKING, [$limit], $onSelect, $onError);
	}
}