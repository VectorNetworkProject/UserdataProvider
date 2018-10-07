<?php
/**
 * Created by PhpStorm.
 * User: UramnOIL
 * Date: 2018/10/06
 * Time: 23:27
 */

namespace VectorNetworkProject\DataProvider\Tables;


use poggit\libasynql\DataConnector;

abstract class TableBase
{
	/** @var DataConnector */
	protected $connector;
	public final function __construct(DataConnector $connector)
	{
		$this->connector = $connector;
		$this->init();
	}

	/**
	 * テーブルを初期化用します
	 * 初期化用のクエリ(CREATE TABLE IF NOT EXISTS...)を呼んでください
	 * TableBaseのコンストラクタで呼ぶので気にする必要はないです
	 */
	public abstract function init(): void;
}