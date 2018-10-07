<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/06
 * Time: 22:49
 */

namespace VectorNetworkProject\DataProvider\Tables;


use poggit\libasynql\DataConnector;
use VectorNetworkProject\DataProvider\Tables\Accounts\Accounts;
use VectorNetworkProject\DataProvider\Tables\CorePvP\CorePvP;
use VectorNetworkProject\DataProvider\Tables\Dual\Dual;
use VectorNetworkProject\DataProvider\Tables\FFAPvP\FFAPvP;

class TableManager
{
	/** @var DataConnector */
	protected $connector;

	/** @var Accounts */
	protected $accounts;
	/** @var FFAPvP */
	protected $ffapvp;
	/** @var Dual */
	protected $dual;
	/** @var CorePvP */
	protected $corepvp;

	public function __construct(DataConnector $connector)
	{
		$this->connector = $connector;
		$this->accounts = new Accounts($connector);
		$this->ffapvp = new FFAPvP($connector);
		$this->dual = new Dual($connector);
		$this->corepvp = new CorePvP($connector);
	}

	/**
	 * @return Accounts
	 */
	public function getAccounts(): Accounts
	{
		return $this->accounts;
	}

	/**
	 * @return FFAPvP
	 */
	public function getFFAPvP(): FFAPvP
	{
		return $this->ffapvp;
	}

	/**
	 * @return Dual
	 */
	public function getDual(): Dual
	{
		return $this->dual;
	}

	/**
	 * @return CorePvP
	 */
	public function getCorePvP(): CorePvP
	{
		return $this->corepvp;
	}
}