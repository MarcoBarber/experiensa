<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.right.menu.open').on("click",function(e){
            e.preventDefault();
            jQuery('.ui.vertical.menu').toggle();
        });

        jQuery('.ui.dropdown').dropdown();
    });
</script>
<!-- Dian Layout -->
<div id="header-nav" class="ui grid">
    <div class="computer tablet only row">
        <div class="ui <?= Header::get_menu_style(); ?> menu navbar grid borderless header-menu pc">
            <?= Header::header_logo_item();?>
            <?= Header::get_website_name_tagline(); ?>
            <?php
            echo Header::get_phone_item('item');
            echo Header::get_quote_item('item');
            Menu::get_menu($page_id);
            echo Header::get_language_item('item');
            ?>
        </div>
    </div>
    <?php get_template_part('templates/partials/header/mobile'); ?>
</div>