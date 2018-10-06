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
	public const INIT = 'userdataprovider.accounts.register';
	public const REGISTER = 'userdataprovider.accounts.unregister';
	public const UNREGISTER = 'userdataprovider.accounts.unregister';
	public const GET = 'userdataprovider.accounts.get';

	public function register(IPlayer $player, ?callable $handler = null, ?callable $errorHandler = null)
	{
		$this->connector->executeInsert(self::REGISTER, [$player->getName()], $handler, $errorHandler);
	}

	public function unregister(IPlayer $player, ?callable $handler = null, ?callable $errorHandler = null)
	{
		$this->connector->executeChange(self::UNREGISTER, [$player->getName()], $handler, $errorHandler);
	}

	public function get(IPlayer $player, ?callable $handler = null, ?callable $errorHandler = null){
		$this->connector->executeSelect(self::GET, [$player->getName()], $handler, $errorHandler);
	}
}