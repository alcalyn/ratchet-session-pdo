<?php

require_once '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

$pdo = new PDO('mysql:host=database;dbname=ratchet', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbOptions = [
    'db_table'          => 'sessions',
    'db_id_col'         => 'sess_id',
    'db_data_col'       => 'sess_data',
    'db_time_col'       => 'sess_time',
    'db_lifetime_col'   => 'sess_lifetime',
];

$storage = new NativeSessionStorage([], new PdoSessionHandler($pdo));
$session = new Session($storage);

$session->set('foo', 'bar');
