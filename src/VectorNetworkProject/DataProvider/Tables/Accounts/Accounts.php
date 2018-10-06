<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/05
 * Time: 21:41
 */

namespace VectorNetworkProject\DataProvider\Tables\Accounts;


use poggit\libasynql\base\DataConnectorImpl;
use pocketmine\IPlayer;

class Accounts
{
	public const INIT = '';
	/** @var DataConnectorImpl */
	private $connector;
	public function __construct(DataConnectorImpl $dc)
	{
		$this->connector = $dc;
	}

	public function register(IPlayer $player, ?callable $handler = null)
	{
		$this->connector->executeInsert('userdataprovider.accounts.register', [$player->getName()], $handler);
	}

	public function unregister(IPlayer $player, ?callable $handler = null)
	{
		$this->connector->executeChange('userdataprovider.accounts.unregister', [$player->getName()], $handler);
	}
}