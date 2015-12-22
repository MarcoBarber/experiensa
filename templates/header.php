<?php
use Roots\Sage\Nav;
$menu_name = 'primary_navigation';

$agency_options = get_option('agency_settings');
$logo = $agency_options['agency_logo'];
$phone = $agency_options['agency_phone'];

?>

<header class="ui borderless <?= get_menu_style(); ?> small menu grid">
    <div class="mobile only row">
        <a class="item" href="<?= esc_url(home_url('/')); ?>">
            <?php 
            if ($logo):
                echo 'echo <img class="ui tiny image logo" src="' . wp_get_attachment_url($logo) . '" width="120" />';
            else:
                bloginfo('name');
            endif;
            ?>
        </a>
        <div class="menu right">
            <a class="item mobile-menu ui button">
                <i class="sidebar icon"></i>
            </a>
        </div>
    </div>
    <div class="tablet only row">

    </div>
    <div class="computer only row">
        <a class="item" href="<?= esc_url(home_url('/')); ?>">
            <?php if ($logo): ?>
                <img class="ui mini image logo" src="<?php echo wp_get_attachment_url($logo);?>" /> &nbsp;
                <?php bloginfo('name'); ?>
            <?php else: ?>
                <?php bloginfo('name'); ?>
            <?php endif; ?>
        </a>
        <div class="right menu">
            <?php  if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) :
                $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                foreach ( (array) $menu_items as $key => $menu_item ) :
                    $class = $menu_item->classes; ?>
                    <a href="<?php echo $menu_item->url; ?>" class="item <?php if(get_the_ID() == $menu_item->object_id){echo 'active';}else{echo 'bla';}?>">
                        <?php echo $menu_item->title; ?>
                    </a>
                    <?php
                endforeach;
            endif;
            ?>
            <?php get_phone_button(); ?>
            <?php get_quote_button(); ?>
            <?php get_language_button(); ?>
        </div>
    </div>
</header>
