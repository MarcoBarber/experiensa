<?php
class Voyage{

    public static function price($id){
        $settings       = get_option('agency_settings');
        $reseller       = get_post_meta($id, 'voyage_resell', false);
        $display_from   = get_post_meta($id, 'voyage_display_from', false);
        $price          = get_post_meta($id,'voyage_price', true);

        $currency = ($settings['agency_currency']) ? ' ' . $settings['agency_currency'] : '';
        $from = ($display_from === 'TRUE') ? __('From','sage') . ' ' : '';

        if ( $reseller === 'TRUE' ) {
            $margin     = get_post_meta($id,'voyage_tour_operator_margin',true);
            return $from . ceil($price + (($margin * $price)/100)) . $currency;
        } else {
            return $from . get_post_meta($id,'voyage_price',true) . $currency;
        }
    }
}
?>
