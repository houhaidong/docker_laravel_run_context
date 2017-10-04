<?php

$config['charset'] = 'utf8';
$config['prefix'] = '';
$config['driver'] = 'MySQLi';
$config['master'] = array (
  'charset' => 'utf8',
  'host' => 'db',
  'username' => 'root',
  'password' => 'root',
  'dbname' => 'app',
  'port' => '3306',
);
$config['slave'] = false;
$config['port'] = '3306';
