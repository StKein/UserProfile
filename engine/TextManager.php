<?php
class TextManager{

    private
        $language_dir,
        $language_pack;


    const
        DEFAULT_LANGUAGE = "russian";


    public function __construct(){
        $this->language_dir = $_SERVER["DOCUMENT_ROOT"]."/engine/language/";
        if( file_exists( $this->language_dir.$_SESSION["language"].".lang" ) ){
            $this->language_pack = file_get_contents( $this->language_dir.$_SESSION["language"].".lang" );
        } else {
            $this->language_pack = file_get_contents( $this->language_dir."russian.lang" );
        }
        $this->language_pack = json_decode( $this->language_pack, true );
    }


    public function getText( $text_type ){
        return $this->language_pack[ $text_type ];
    }

    public function getAvailableLanguages(){
        $files = scandir( $this->language_dir );
        $languages = array();
        for( $i = 0; $i < count( $files ); $i++ ){
            if( mb_strlen( $files[ $i ] ) >= 6 ){
                $language = mb_substr( $files[ $i ], 0, mb_strpos( $files[ $i ], ".lang" ) );
                $languages[] = $language;
            }
        }

        return $languages;
    }

}
$text_manager = new TextManager();
?>