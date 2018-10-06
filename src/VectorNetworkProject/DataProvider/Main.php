<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/02
 * Time: 1:00
 */

namespace VectorNetworkProject\DataProvider;


use pocketmine\plugin\PluginBase;
use poggit\libasynql\libasynql;
use VectorNetworkProject\DataProvider\Tables\Accounts\Accounts;

class Main extends PluginBase
{
	/**
	 * @var Accounts
	 */
	private $accouts;
	public function onEnable()
	{
		$this->saveDefaultConfig();
		$database = libasynql::create($this, $this->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql",
			"mysql" => "mysql.sql"
		]);
		$this->accounts = new Accounts($database);
	}
}