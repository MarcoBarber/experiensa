<?php
$agency_options = get_option('agency_settings');
$logo = $agency_options['agency_logo'];
?>

<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.right.menu.open').on("click",function(e){
        e.preventDefault();
        jQuery('.ui.vertical.menu').toggle();
    });

    jQuery('.ui.dropdown').dropdown();
});
</script>

<div id="header-nav" class="ui grid">
    <div class="computer tablet only row">
        <div class="ui <?= Header::get_menu_style(); ?> menu navbar grid borderless header-menu">
            <a class="item" href="<?= esc_url(home_url('/')); ?>">
                <?php if ($logo): ?>
                    <img class="ui tiny image logo" src="<?= wp_get_attachment_url($logo); ?>"  />
                <?php else: ?>
                    <?= get_blog_name(); ?>
                <?php endif; ?>
            </a>
            <?= Header::get_website_name_tagline(); ?>
            <div class="right menu">
                <?php
                echo Header::get_phone_item('item');
                echo Header::get_quote_item('item');
                Menu::display_all_menus($page_id,'left',false);
                echo Header::get_language_item('item');
                ?>
            </div>
        </div>
    </div>
    <?php get_template_part('templates/partials/header/mobile'); ?>
</div>
