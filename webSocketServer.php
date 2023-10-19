<?php

declare(strict_types=1);

require 'vendor\\autoload.php';

use App\Components\MyWorkerman;
use Workerman\Worker;

$workerman=MyWorkerman::getConnection();
MyWorkerman::onMessageEventListener($workerman);
Worker::runAll();

/*InvalidWorkerman::connect()->sendMessage('first connect');
Worker::runAll();*/