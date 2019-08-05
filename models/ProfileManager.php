<?php
/***
    Class for managing profiles (user information)
    Handles getting current profile data and updating it
 ***/
class ProfileManager{

    private
        $db;


    const
        ALLOWED_IMAGE_EXTENSIONS = array( "gif", "jpeg", "jpg", "png" ),
        IMAGE_MAX_WIDTH = 300;


    public function __construct( mysqli $db ){
        $this->db = $db;
    }


    public function getProfileData(){
        $data = $this->db->query(
            "SELECT `name`, `surname`, `birth_date`, `image` ".
            "FROM `user_info` ".
            "WHERE `user_id` = ".$this->db->real_escape_string( $_SESSION["user"] )
        );

        return ( $data->num_rows > 0 ) ? $data->fetch_assoc() : array();
    }

    public function updateProfile( $data ){
		if( !$this->validateProfileData( $data ) ){
		    throw new Exception("ResponseInvalidProfileDataError");
        }
        $query =
            "UPDATE `user_info` ".
            "SET `name` = '".$this->db->real_escape_string( $data["name"] )."', ".
                "`surname` = '".$this->db->real_escape_string( $data["surname"] )."', ".
                "`birth_date` = '".$this->db->real_escape_string( $data["birth_date"] )."'";
        if( $data["image"] ){
            $query .= ", `image` = '".$this->db->real_escape_string( $data["image"] )."'";
        }
        $query .= " WHERE `user_id` = ".$this->db->real_escape_string( $_SESSION["user"] );
        $suc = $this->db->query( $query );
        if( !$suc ){
            throw new Exception("ResponseUpdateProfileError");
        }

        return true;
    }

    /*
        $file - file from $_FILES of post request
        Uploads posted image file. Returns filename if successful, otherwise false
    */
    public function uploadImage( $file ){
        if( !file_exists( $file["tmp_name"] ) || !( $image_data = getimagesize( $file["tmp_name"] ) ) ){
            // File doesn't exist or can't be read
            return false;
        }

        $file_extension = mb_substr( $file["name"], mb_strrpos( $file["name"], "." ) + 1 );
        if( !in_array( $file_extension, self::ALLOWED_IMAGE_EXTENSIONS ) ){
            // Extension not allowed
            return false;
        }

        $file["name"] = basename( $file["name"] );
        if( $image_data[0] > self::IMAGE_MAX_WIDTH ){
            $this->resizeImage( $file, $image_data, $file_extension );
        }

        return ( $file["tmp_name"] && move_uploaded_file( $file["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/upload/user_images/".$file["name"] ) ) ? $file["name"] : false;
    }


    private function validateProfileData( $data ){
        return (
            mb_strlen( $data["name"] ) >= 2 &&
            mb_strlen( $data["surname"] ) >= 6 &&
            ( time() - strtotime( $data["date"] ) >= 86400 * 365 * 12 && time() - strtotime( $data["date"] ) < 86400 * 365 * 90 )
        );
    }

    /*
        Resize posted image file to avoid storing unnecessarily big images
     */
    private function resizeImage( &$file, $image_data, $file_extension ){
        $result_image_height = $image_data[1] * self::IMAGE_MAX_WIDTH / $image_data[0];
        $result_image = imagecreatetruecolor( self::IMAGE_MAX_WIDTH, $result_image_height );
        imagefill( $result_image, 0, 0, imagecolorallocatealpha( $result_image, 255, 255, 255, 127 ) );
        switch( $file_extension ){
            case "jpg":
            case "jpeg":
                $uploaded_image = imagecreatefromjpeg( $file["tmp_name"] );
                break;
            case "png":
                $uploaded_image = imagecreatefrompng( $file["tmp_name"] );
                break;
            case "gif":
                $uploaded_image = imagecreatefromgif( $file["tmp_name"] );
                break;
        }
        imagecopyresampled(
            $result_image, $uploaded_image,
            0, 0, 0, 0,
            self::IMAGE_MAX_WIDTH, $result_image_height, $image_data[0], $image_data[1]
        );
        imagedestroy( $uploaded_image );
        switch( $file_extension ){
            case "jpg":
            case "jpeg":
                imagejpeg( $result_image, $file["tmp_name"] );
                break;
            case "png":
                imagepng( $result_image, $file["tmp_name"] );
                break;
            case "gif":
                imagegif( $result_image, $file["tmp_name"] );
                break;
        }
    }

}
?>