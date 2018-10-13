<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/13
 * Time: 23:26
 */

namespace VectorNetworkProject\DataProvider\Tables\NetworkLevel;

use pocketmine\IPlayer;
use VectorNetworkProject\DataProvider\Tables\TableBase;

class NetworkLevel extends TableBase
{
	public const INiT = 'databaseprovider.networklevel.init';
	public const REGISTER = 'databaseprovider.networklevel.register';
	public const UNREGISTER = 'databaseprovider.networklevel.unregister';
	public const GET = 'databaseprovider.networklevel.get';
	public const ADD = 'databaseprovider.networklevel.add';

	public function init(): void
	{
		$this->connector->executeGeneric(self::INiT);
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
		$this->connector->executeChange(self::UNREGISTER, [$player->getName()], $onSuccess, $onError);
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
	 * @param int $exp
	 */
	public function add(IPlayer $player, int $exp = 0) {
		$this->connector->executeChange(self::ADD, [$player->getName(), $exp]);
	}
}