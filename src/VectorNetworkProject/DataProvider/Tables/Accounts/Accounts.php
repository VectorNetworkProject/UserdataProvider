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

	public function register(IPlayer $player, ?callable $handler = null, ?callable $errorHandler = null)
	{
		$this->connector->executeInsert(self::ACCOUNT_REGISTER, [$player->getName()], $handler, $errorHandler);
	}

	public function unregister(IPlayer $player, ?callable $handler = null, ?callable $errorHandler = null)
	{
		$this->connector->executeChange(self::ACCOUNT_UNREGISTER, [$player->getName()], $handler, $errorHandler);
	}

	public function get(IPlayer $player, ?callable $handler = null, ?callable $errorHandler = null){
		$this->connector->executeSelect(self::ACCOUNT_GET, [$player->getName()], $handler, $errorHandler);
	}
}