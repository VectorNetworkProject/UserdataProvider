<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/06
 * Time: 22:49
 */

namespace VectorNetworkProject\DataProvider\Tables;


use poggit\libasynql\base\DataConnectorImpl;
use VectorNetworkProject\DataProvider\Tables\Accounts\Accounts;

class TableManager
{
	/** @var DataConnectorImpl */
	protected $connector;

	protected $accounts;
	protected $ffapvp;
	public function construct(DataConnectorImpl $connector)
	{
		$this->connector = $connector;
		$this->accounts = new Accounts($connector);
	}
}