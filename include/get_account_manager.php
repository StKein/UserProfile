<?php
include_once __DIR__."/../engine/db.php";
include_once __DIR__."/../models/AccountManager.php";

$account_manager = new AccountManager( $db );
?>