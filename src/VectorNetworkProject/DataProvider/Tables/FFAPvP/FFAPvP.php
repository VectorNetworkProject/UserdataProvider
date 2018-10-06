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
	/**
	 * プレイヤーを登録します。
	 *
	 * @param IPlayer $player
	 * @param callable|null $handler
	 * @param callable|null $errorHandler
	 */
	public function register(IPLayer $player, ?callable $handler = null, ?callable $errorHandler = null): void
	{

	}

	/**
	 * プレイヤーを登録解除します
	 *
	 * @param IPlayer $player
	 * @param callable|null $handler
	 * @param callable|null $errorHandler
	 */
	public function unregister(IPLayer $player, ?callable $handler = null, ?callable $errorHandler = null): void
	{

	}

	public function getRankingByKill(int $limit, ?callable $handler = null, ?callable $errorHandler = null): void
	{

	}

	public function getRankingByExp(int $limit, ?callable $handler = null, ?callable $errorHandler = null): void
	{

	}
}