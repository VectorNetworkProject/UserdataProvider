# DataProvider
[![Build Status](https://scrutinizer-ci.com/g/VectorNetworkProject/DataProvider/badges/build.png?b=master)](https://scrutinizer-ci.com/g/VectorNetworkProject/DataProvider/build-status/master)

データを格納するためのプラグイン  
## テーブル

### **accounts**

| Column | Type  | Description |  
| :----: | :---: | :---------: |
| id | int | 登録したときに自動的に付与されます |
|name |string |プレイヤーの名前です。 |

　UserdataProviderで基本となる情報を扱うテーブルです。ここに記載されたIDをもとに各テーブルの管理を行います。  
　sqlite.sql上ではidをメインにやり取りしていますが、デベロッパーが扱う際はラップしたクラス群の関数を使ってください。

### **ffapvp**

| Column | Type  | Description |  
| :----: | :---: | :---------: |
| id | int | プレイヤーと対応するaccountsテーブルのid |
| kill | int | キル数 |
| death | int | デス数 |
| exp | int | EXP |

### **dual**

| Column | Type  | Description |
| :----: | :---: | :---------: |
| id | int | プレイヤーと対応するaccountsテーブルのid |
| kill | int | キル数 |
| death | int | デス数 |
| win | int | 勝利数 |
| lose | int| 敗北数 |

## 使い方
```PHP
public function onEnable()
{
    $this->accounts = $this->getServer()->getPluginManager()->getPlugin('UserdataProvider')->getManager()->getAccounts();
}

public funciton onPlayerJoin(PlayerJoinEvent $event)
{
    $this->accounts->get(
        $event->player,
        function(array $rows) use($player): void
        {
            if($rows[0] !== null)
            {
                $player->sendMessage("あなたのIDは$raws[0][id]です");
            }
        },
        function(SqlError $error, ?Exception $trace): void//	private function reportError(?callable $default, SqlError $error, ?Exception $trace) : void{    //https://github.com/poggit/libasynql/blob/master/libasynql/src/poggit/libasynql/base/DataConnectorImpl.php#L196
        {
            var_dump($error, $trace);
        }
    );
}
```

　クエリの終了時、またはエラー時の際の処理をクロージャで渡してください。   
　終了時の引数は`array $rows`で結果が`$rows[<順番>][<カラム名>]`で格納されます。エラー時の引数は上記の通り`SqlError $error, ?Ecxeption $trace`となります。`SqlError`については[SqlError](https://github.com/poggit/libasynql/blob/master/libasynql/src/poggit/libasynql/SqlError.php)を参照してください。  
　`$raws[<int>]`に格納されているデータは基本的に`accounts`の`name`カラムとそれぞれのテーブルのカラムを複合したものになります。`