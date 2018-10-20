<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/05
 * Time: 21:41
 */

namespace VectorNetworkProject\DataProvider\Tables\Accounts;

use pocketmine\IPlayer;
use VectorNetworkProject\DataProvider\Tables\TableBase;

class Accounts extends TableBase
{
	public const ACCOUNT_INIT = 'userdataprovider.accounts.init';
	public const ACCOUNT_REGISTER = 'userdataprovider.accounts.register';
	public const ACCOUNT_UNREGISTER = 'userdataprovider.accounts.unregister';
	public const ACCOUNT_GET = 'userdataprovider.accounts.get';

	public function init(): void
	{
		$this->connector->executeGeneric(self::ACCOUNT_INIT);
	}

	/**
	 * プレイヤーを登録します
	 *
	 * @param IPlayer $player
	 * @param callable|null $onInserted
	 * @param callable|null $onError
	 */
	public function register(IPlayer $player, ?callable $onInserted = null, ?callable $onError = null) {
		$this->connector->executeInsert(self::ACCOUNT_REGISTER, ['name' => $player->getName()], $onInserted, $onError);
	}

	/**
	 * プレイヤーを登録解除します
	 *
	 * @param IPlayer $player
	 * @param callable|null $onSuccess
	 * @param callable|null $onError
	 */
	public function unregister(IPlayer $player, ?callable $onSuccess = null, ?callable $onError = null) {
		$this->connector->executeChange(self::ACCOUNT_UNREGISTER, ['name' => $player->getName()], $onSuccess, $onError);
	}

	/**
	 * プレイヤーの情報を取得します
	 *
	 * @param IPlayer $player
	 * @param callable|null $onSelect
	 * @param callable|null $onError
	 */
	public function get(IPlayer $player, ?callable $onSelect = null, ?callable $onError = null) {
		$this->connector->executeSelect(self::ACCOUNT_GET, ['name' => $player->getName()], $onSelect, $onError);
	}
}