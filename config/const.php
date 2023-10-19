<?php

declare(strict_types=1);

define('ROOT', $_SERVER['DOCUMENT_ROOT']); // корень сайта
define('SITE_URL', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']); // адресс сайта
define('SITE_HOSTNAME', $_SERVER['HTTP_HOST']); // имя хоста сайта
define('CONFIG_ROOT', ROOT.'/config/'); // папка с настройками сайта
define('COMPONENTS_ROOT', ROOT.'/app/Components/'); // папка с дополнениями для сайта
define('PUBLIC_ROOT', ROOT.'/public/'); // папка с дополнениями для сайта
define('IMAGES_ROOT', '/public/images/'); // папка с дополнениями для сайта
define('AVATARS_ROOT', '/public/avatars/'); // папка с дополнениями для сайта
define('CONTROLLERS_ROOT', ROOT.'/app/Controllers/'); // папка с дополнениями для сайта
define('VIEW_ROOT', ROOT.'/views/'); // папка с дополнениями для сайта
define('MODELS_ROOT', ROOT.'/app/models/'); // папка с моделями для системы
define('TEMPLATE_ROOT', '/template/'); // папка с дополнениями для сайта

