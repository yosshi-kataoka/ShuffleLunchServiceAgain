<?php

namespace ShuffleLunchService;

require 'core/AutoLoader.php';

$loader = new AutoLoader();
$loader->registerDir(__DIR__ . '/core');
$loader->registerDir(__DIR__ . '/controller');
// $loader->registerDir(__DIR__ . '/lib');
// registerDir配下にあるクラスをregister()にて登録する
$loader->register();
