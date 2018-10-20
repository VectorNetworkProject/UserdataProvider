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
	public const INiT 		= 'userdataprovider.networklevel.init';
	public const REGISTER 	= 'userdataprovider.networklevel.register';
	public const UNREGISTER = 'userdataprovider.networklevel.unregister';
	public const GET 		= 'userdataprovider.networklevel.get';
	public const ADD 		= 'userdataprovider.networklevel.add';

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
		$this->connector->executeInsert(self::REGISTER, ['name' => $player->getName()], $onInserted, $onError);

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
		$this->connector->executeChange(self::UNREGISTER, ['name' => $player->getName()], $onSuccess, $onError);
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
		$this->connector->executeSelect(self::GET, ['name' => $player->getName()], $onSuccess, $onError);
	}

	/**
	 * プレイヤーのカウントを増やします
	 *
	 * @param IPlayer $player
	 * @param int $exp
	 * @param callable|null $onSuccess
	 * @param callable|null $onError
	 */
	public function add(IPlayer $player, int $exp = 0, ?callable $onSuccess = null, ?callable $onError = null): void
	{
		$this->connector->executeChange(self::ADD, ['name' => $player->getName(), 'exp' => $exp], $onSuccess, $onError);
	}
}