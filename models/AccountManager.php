<?php
/***
    Class for managing user accounts
    Handles checking if entered login is available and creating new account
 ***/
class AccountManager{

    private $db;


    public function __construct( mysqli $db ){
        $this->db = $db;
    }
	
	
	/*
	    Check if no accounts with entered login are in DB
	*/
    public function accountIsAvailable( $login ){
        $account_data = $this->db->query(
            "SELECT `id` ".
            "FROM `user` ".
            "WHERE `login` = '".$this->db->real_escape_string( $login )."'"
        );

        return ( $account_data->num_rows == 0 );
    }
	
	/*
	    Check if account is in DB
	    If it is, return its id, otherwise return 0
	 */
	public function getAccountId( $login, $password ){
        $account_data = $this->db->query(
            "SELECT `id` ".
            "FROM `user` ".
            "WHERE `login` = '".$this->db->real_escape_string( $login )."' AND ".
				"`password` = '".md5( $this->db->real_escape_string( $password ) )."'"
        );

        return ( $account_data->num_rows > 0 ) ? ( $account_data->fetch_assoc() )["id"] : 0;
	}
	
    public function createAccount( $login, $password ){
        $suc = $this->db->query(
            "INSERT INTO `user` ".
            "SET `login` = '".$this->db->real_escape_string( $login )."', ".
                "`password` = '".md5( $this->db->real_escape_string( $password ) )."'"
        );
        if( !$suc ){
            throw new Exception("ResponseCreateAccountError");
            return false;
        }

        return true;
    }

}
?>