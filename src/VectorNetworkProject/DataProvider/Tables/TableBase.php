<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/06
 * Time: 23:27
 */

namespace VectorNetworkProject\DataProvider\Tables;


use poggit\libasynql\base\DataConnectorImpl;

abstract class TableBase
{
	/** @var DataConnectorImpl */
	protected $connector;
	public final function __construct(DataConnectorImpl $connector)
	{
		$this->connector = $connector;
	}

	/**
	 * テーブルを初期化用します
	 * 初期化用のクエリ(CREATE TABLE IF NOT EXISTS...)を呼んでください
	 * TableBaseのコンストラクタで呼ぶので気にする必要はないです
	 */
	public abstract function init(): void;
}