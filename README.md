# DataProvider
[![Build Status](https://scrutinizer-ci.com/g/VectorNetworkProject/DataProvider/badges/build.png?b=master)](https://scrutinizer-ci.com/g/VectorNetworkProject/DataProvider/build-status/master)

データを格納するためのプラグイン  
##使い方
```PHP
public function onEnable()
{
    $this->accounts = $this->getServer()->getPluginManager()->getPlugin('UserdataProvider')->getManager()->getAccounts();
}

public funciton onPlayerJoin(PlayerJoinEvent $event)
{
    $this->accounts->get(
        $event->player,
        function (array $rows) use($player)
        {
            $player->sendMessage("あなたのIDは$raws[0][id]です");
        }
    );
}
```