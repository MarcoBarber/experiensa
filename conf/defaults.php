<?php

//------------------------------------------------------------------------------
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

/**
* Function hide_custom_post_types
*
* Hide custom post types from admin menu
*/
function hide_custom_post_types(){
    $agency_options = get_option('agency_settings');
    if(isset($agency_options)) {
        $website_use = $agency_options['website_use'];
        $all_posttypes = [ "brochure", "partner", "feedback", "service", "host", "voyage", "estimate", "room" ];
        $to_hide = array();
        if (isset($website_use)) {
            $posttypes = array();
            switch ($website_use) {
                case 'travel':
                    $posttypes = $agency_options['travel_agency_posttypes'];
                    break;
                case 'hotel':
                    $posttypes = $agency_options['hotel_posttypes'];
                    break;
                default:
                    $posttypes = $agency_options['tourist_office_posttypes'];
                    break;
            }
            if (count($posttypes) == 1)
                $posttypes = array($posttypes);
            $to_hide = array_diff($all_posttypes, $posttypes);
        }
        foreach ($to_hide as $value) {
            if (post_type_exists($value))
                remove_menu_page('edit.php?post_type=' . $value);
        }
    }
}

add_action( 'admin_menu', 'hide_custom_post_types' );

function change_meta_box_titles() {
    global $wp_meta_boxes; // array of defined meta boxes
    // cycle through the array, change the titles you want
    $wp_meta_boxes['voyage']['normal']['core']['postexcerpt']['title'] = __('Description','sage');
    $wp_meta_boxes['partner']['normal']['core']['postexcerpt']['title'] = __('Description','sage');
    $wp_meta_boxes['host']['normal']['core']['postexcerpt']['title'] = __('Description','sage');
    $wp_meta_boxes['service']['normal']['core']['postexcerpt']['title'] = __('Description','sage');
    /*echo '<pre>';
    print_r($wp_meta_boxes);
    echo '</pre>';
    wp_die('');*/
}
add_action('add_meta_boxes', 'change_meta_box_titles');