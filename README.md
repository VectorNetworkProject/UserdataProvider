# DataProvider
[![Build Status](https://scrutinizer-ci.com/g/VectorNetworkProject/DataProvider/badges/build.png?b=master)](https://scrutinizer-ci.com/g/VectorNetworkProject/DataProvider/build-status/master)

データを格納するためのプラグイン  
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