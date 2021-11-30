<?php
if (!isset($_SESSION) || empty($_SESSION)) {
    session_start();
}
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';