<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/06
 * Time: 22:46
 */

namespace VectorNetworkProject\DataProvider\Tables;


use poggit\libasynql\base\DataConnectorImpl;

abstract class TableBase
{
	/** @var DataConnectorImpl */
	protected $connector;
	public final function construct(DataConnectorImpl $connector)
	{
		$this->connector = $connector;
	}
}