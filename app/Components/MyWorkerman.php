<?php

declare(strict_types=1);

namespace App\Components;

use Workerman\Worker;

class MyWorkerman
{
    public static ?Worker $worker = null;

    public static int $activeUsersCount = 0;

    public static function getConnection(): Worker
    {
        $paramsPath = './config/workerman.php';

        $params = include $paramsPath;
        $host = $params['host'];
        $port = $params['port'];

        if (null === self::$worker) {

            try {
                // Create a Websocket server
                self::$worker = new Worker("websocket://{$host}:{$port}");

                // Emitted when new connection come
                self::$worker->onConnect = function ($connection) {
                    self::$activeUsersCount++;
                };

            } catch (\Exception $e) {
                ConsoleColorize::print(
                    text: $e->getMessage(),
                    color: ConsoleColorize::RED
                );
                die;
            }
        }

        return self::$worker;
    }


    public static function onMessageEventListener(Worker $workerman): void
    {

        $workerman->onMessage=function ($connection,$jsonData) use ($workerman){
            $data=json_decode($jsonData,true);
            if(!array_key_exists('time_at',$data)){
                $data['time_at']=date("Y-m-d H:i:s");
            }
            //file_put_contents('./websocket_log.json', $newJsonData . PHP_EOL, FILE_APPEND);
            $newJsonData=json_encode($data,JSON_PRETTY_PRINT);
            foreach ($workerman->connections as $clientConnection) {
                if($clientConnection!=$connection){
                    $clientConnection->send($newJsonData);
                }
            }
        };

    }

//
//    public static function onCloseEventListener(Worker $workerman): array
//    {
//        $clientInfo = [];
//
//        $workerman->onClose = function ($connection) {
//
//            if (self::$activeUsersCount !== 0) {
//                self::$activeUsersCount--;
//            }
//
//            $clientInfo['clientIp'] = $connection->getRemoteIp();
//
//            $clientInfo['connectCloseTime'] = date('Y-m-d H:i:s');
//        };
//
//        return $clientInfo;
//    }
}