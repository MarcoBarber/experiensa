<?php

class Catalog{
    public static function get_catalog(){
        $code = Helpers::getActiveLanguageCode();
        if(!$code){
            $lang_req = "";
        }else{
            $lang_req = '?lang='.$code;
        }
        $api_response = [];
        //Agency Catalog
        $agency_api_url = get_site_url() . '/wp-json/wp/v2/voyage';
        if (function_exists('curl_version')){//Using Curl
            //  Initiate curl
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            $real_url = $agency_api_url.$lang_req;
            curl_setopt($ch, CURLOPT_URL,$real_url);
            // Execute
            $agency_response=curl_exec($ch);
            if(!$agency_response){
                curl_setopt($ch, CURLOPT_URL,$agency_api_url);
                $agency_response=curl_exec($ch);
            }
            // Closing
            curl_close($ch);
        }else{
            if(ini_get('allow_url_fopen')) {
                $agency_response = @file_get_contents($agency_api_url . $lang_req);
                if(!$agency_response)
                    $agency_response = @file_get_contents($agency_api_url);
            }else
                $agency_response = "";
        }
        $agency_response = json_decode($agency_response);
        $api_response[] =$agency_response;

        //Partners Catalog
        $partners = Partners::partnerApiList();
        if(!empty($partners) && Helpers::check_internet_connection()){
            for ($i=0; $i < count($partners); $i++) {
                // Check if  $partners[$i]['website'] dont have '/' on last char
                $api_url=$partners[$i]['website'];
                if(substr($partners[$i]['website'], -1)!='/') {
                    $api_url .= '/';
                }
                $api_url .= 'wp-json/wp/v2/voyage';
                //Check if $api_url is a valid url
                if (!(filter_var($api_url, FILTER_VALIDATE_URL) === FALSE)){
                    $file_headers = @get_headers($api_url);
                    //check if url have response HTTP/1.1 200 OK
                    if(!empty($file_headers) && strpos($file_headers[0],'OK')!==FALSE) {
                        //Using Curl
                        if (function_exists('curl_version')){
                            //  Initiate curl
                            $ch = curl_init();
                            // Disable SSL verification
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            // Will return the response, if false it print the response
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // Set the url
                            $real_url = $api_url.$lang_req;
                            curl_setopt($ch, CURLOPT_URL,$real_url);
                            // Execute
                            $partner_response=curl_exec($ch);
                            if(!$partner_response){
                                curl_setopt($ch, CURLOPT_URL,$api_url);
                                $partner_response=curl_exec($ch);
                            }
                            // Closing
                            curl_close($ch);
                        }else{
                            if(ini_get('allow_url_fopen')) {
                                $partner_response = @file_get_contents($api_url . $lang_req);
                                if(!$partner_response)
                                    $partner_response = @file_get_contents($api_url);
                            }else
                                $partner_response = "";
                        }
                        $partner_response = json_decode($partner_response);
                        $api_response[] = $partner_response;
                    }
                }
            }
        }

        $voyages = array();

        for ($i=0; $i < count($api_response); $i++) {
            for ($j = 0; isset($api_response[$i]) && $j < count($api_response[$i]); $j++) {
                $voyage = $api_response[$i][$j];
                $tab = [
                    'id'                => $voyage->id,
                    'title'             => $voyage->title->rendered,
                    'excerpt'           => $voyage->excerpt->rendered,
                    'cover_image'       => $voyage->cover_image,
                    'currency'          => $voyage->currency,
                    'price'             => $voyage->price,
                    'itinerary'         => $voyage->itinerary,
                    'duration'          => $voyage->duration,
                    'country'           => (isset($voyage->country)?$voyage->country:""),
                    'location'          => (isset($voyage->location)?$voyage->location:""),
                    'theme'             => (isset($voyage->theme)?$voyage->theme:""),
                    'api_link'          => $voyage->link,
                    'website'           => $voyage->website,
                    'website_name'      => $voyage->website_name,
                ];
                $voyages[] = $tab;
            }
        }
        return $voyages;
        // Restore original Post Data
        wp_reset_postdata();
}


    public static function display_trip_detail($trip,$mail,$return=false){
        $display = "<div class=\"ui modal\">";
        $display .=     "<div class=\"header\">";
        $display .=         "<h2>".$trip['title']."</h2>";
        $display .=     "</div>";
        $display .=     "<div class=\"content\">";
        $display .=         "<div class=\"ui two column grid stackable\">";
        $display .=             "<div class=\"six wide column\">";
        if(!empty($trip['price']))
            $display .=            "<b>". __('Price','sage').":</b> ".$trip['price']. ' ' . Helpers::get_currency()."<br>";
        if(!empty($trip['duration']))
            $display .=            "<b>". __('Duration','sage') .":</b> ".$trip['duration']."<br>";
        if(!empty($trip['country']))
            $display .=            "<b>". __('Country','sage') .":</b> ".$trip['country']."<br>";
        if(!empty($trip['location']))
            $display .=            "<b>". __('Location','sage') .":</b> ".$trip['location']."<br>";
        if(!empty($trip['theme']))
            $display .=            "<b>". __('Theme','sage') .":</b> ".$trip['theme']."<br>";
        $display .=                 "<p>". $trip['excerpt'] ."</p>";
        $display .=             "</div>";
        $display .=             "<div class=\"ten wide column ui image\">";
        if(!$trip['cover_image']->feature_image && empty($trip['cover_image']->gallery)){
            $display .=             "<img src=\"".get_stylesheet_directory_uri().'/assets/images/travel-no-image.jpg'."\" alt=\"\" />";
        }else{
            if($trip['cover_image']->feature_image){
                $display .=         "<img src=\"".$trip['cover_image']->feature_image."\" alt=\"\" />";
            }else{
                $display .=         "<img src=\"".$trip['cover_image']->gallery[0]."\" alt=\"\" />";
            }
        }
        $display .=             "</div>";
        $display .=         "</div>";
        $display .=     "</div>";
        $display .=     "<div class=\"content\">";
        $display .=         "<div class=\"description\">";
        $display .=         "</div>";
        $display .=     "</div>";
        if(!empty($trip['itinerary'])) {
            $display .= "<div class=\"content\">";
            $display .=     "<h3>".__("Itinerary","sage")."</h3>";
            $display .=     "<div class=\"description\">". $trip['itinerary'] ."</div>";
            $display .= "</div>";
        }
        $display.="<div class=\"actions\">";
        $display.=  "<div class=\"ui black deny button\">";
        $display .= __('Close','sage');
        $display.=  "</div>";
        $display.=  "<a class=\"ui positive right labeled icon button\" href='".$mail."'>";
        $display.=      __("Contact us","sage");
        $display.=      "<i class=\"checkmark icon\"></i>";
        $display.=  "</a>";
        $display.="</div>";
        //End Modal
        $display.="</div>";
        if(!$return)
            echo $display;
        else
            return $display;
    }
}
