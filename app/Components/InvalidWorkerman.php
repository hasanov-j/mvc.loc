<?php

declare(strict_types=1);

namespace App\Components;

use _PHPStan_95cdbe577\Nette\Neon\Exception;
use Workerman\Worker;

class InvalidWorkerman
{
    const CONFIG_FILE = './config/workerman.php';

    public static ?Worker $worker = null;


    public static ?InvalidWorkerman $self = null;

    private function __construct()
    {
        $params = include self::CONFIG_FILE;

        $host = $params['host'];
        $port = $params['port'];

        self::$worker = new Worker("websocket://{$host}:{$port}");

    }

    public static function connect()
    {
        return self::$self ?? new self();
    }

    public function sendMessage(string|array $message)
    {
        foreach (self::$worker->connections as $clientConnection)
        {
            if(is_string($message)){
                $clientConnection->send($message);
            }else if(is_array($message)){
                $clientConnection->send(json_encode($message));
            }else{
                throw new Exception('Something no good bro');
            }
        }
    }
}