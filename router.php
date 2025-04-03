<?php

$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$_GET['_url'] = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '/';

require_once __DIR__ . '/public/index.php';
