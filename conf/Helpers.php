<?php

class Helpers {

    public static function get_currency(){
        $agency_options = get_option('agency_settings');
        return $agency_options['agency_currency'];
    }

    /**
     * Get agency email
     * @return mixed
     */
    public static function get_email(){
        $agency_options = get_option('agency_settings');
        return $agency_options['agency_email'];
    }

    public static function check_internet_connection(){
        $connected = @fsockopen("www.google.com", 80);
        //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }
    public static function getWebsiteLogo(){
        $agency_options = get_option('agency_settings');
        $agency_logo = $agency_options['agency_logo'];
        if(empty($agency_logo))
            return false;
        if(empty($agency_logo[0]))
            return false;
        return $agency_logo[0];
    }

    /**
     * If WPML plugin is active get active language code
     * @return bool
     */
    public static function getActiveLanguageCode(){
        $code = false;
        //Check if WPML is installed
        if ( function_exists('icl_object_id') ) {
            //Active WPML language code
            $code = ICL_LANGUAGE_CODE;
        }
        return $code;
    }
}
