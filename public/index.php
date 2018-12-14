<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 04.12.2018
 * Time: 11:03
 */

$isSignedIn = false;

session_start();

require_once '../lib/Dispatcher.php';
require_once '../lib/view.php';

$dispatcher = new Dispatcher();
$dispatcher->dispatch();