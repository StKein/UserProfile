<?php
/***
    DB connection file
    Include when DB queries are required
 ***/

// DB config is stored in .dbconf file
// If it's not present or unable to parse it, default config is used
try {
    $dbconf = json_decode( file_get_contents( __DIR__."/.dbconf" ), true );
} catch( Exception $e ){}
if( !$dbconf ){
    $dbconf = array();
    $dbconf["server"] = "localhost";
    $dbconf["user"] = "root";
    $dbconf["password"] = "";
    $dbconf["dbname"] = "regform";
}

// Connection to DB server
$db = new mysqli( $dbconf["server"], $dbconf["user"], $dbconf["password"] );
if( $db->connect_error ){
    exit( "DB server connection failed: ".$db->connect_error );
}

// Use specific DB. If it doesn't exist, create it
$db->query( "CREATE DATABASE IF NOT EXISTS `".$dbconf["dbname"]."`" );
$db->query( "USE `".$dbconf["dbname"]."`" );
if( $db->error ){
	exit( "DB creation/usage failed: ".$db->error );
}

// If required table(s) don't exist, create
$db->query(
    "CREATE TABLE IF NOT EXISTS `user`(".
        "`id` INT AUTO_INCREMENT PRIMARY KEY, ".
        "`login` VARCHAR(30) NOT NULL, ".
        "`password` VARCHAR(100) NOT NULL ".
    ")"
);
if( $db->error ){
	exit( "DB user table creation/usage failed: ".$db->error );
}
$db->query(
    "CREATE TABLE IF NOT EXISTS `user_info`( ".
        "`id` INT AUTO_INCREMENT PRIMARY KEY, ".
        "`user_id` INT NOT NULL, ".
        "`name` VARCHAR(30) NOT NULL DEFAULT '', ".
        "`surname` VARCHAR(40) NOT NULL DEFAULT '', ".
        "`birth_date` DATE NOT NULL, ".
        "`image` VARCHAR(100) NOT NULL DEFAULT '', ".
        "INDEX ind_user(`user_id`), ".
        "FOREIGN KEY(`user_id`) REFERENCES user(`id`) ON DELETE CASCADE ".
    ")"
);
if( $db->error ){
	exit( "DB user info table creation failed: ".$db->error );
}

// Trigger to automatically create user_id entry whenever user entry is created
$db->query( "DROP TRIGGER IF EXISTS `create_user_info`" );
$db->query(
	"CREATE TRIGGER `create_user_info` ".
    "AFTER INSERT ON `user` FOR EACH ROW ".
    "BEGIN ".
        "INSERT INTO `user_info` ".
        "SET `user_id` = NEW.`id`; ".
    "END"
);
if( $db->error ){
	exit( "DB trigger creation failed: ".$db->error );
}
?>