<?php date_default_timezone_set('Europe/Zurich'); ?>

<?php while (have_posts()) : the_post(); ?>
    <? $voyage_expiry_date = get_post_meta($post->ID, 'voyage_expiry_date', true); ?>
    <?php $voyage_expiry_date_formatted = DateTime::createFromFormat('d/m/Y', $voyage_expiry_date)->format('Y-m-d'); ?>

    <?php if ($voyage_expiry_date_formatted >= date("Y-m-d")): ?>
        <?php $gallery = get_post_meta($post->ID, 'voyage_gallery', false); ?>
        <?php if ($gallery): ?>
            <?php $overlay = get_stylesheet_directory_uri() .  '/bower_components/vegas/dist/overlays/07.png';?>
            <script type="text/javascript">
            jQuery(function() {
                jQuery('.voyage-slider').vegas({
                    overlay: '<?= $overlay ?>',
                    slides: [
                        <?php foreach ($gallery as $image): ?>
                        <?php if ($image): ?>
                        { src: '<?= wp_get_attachment_url( $image ); ?>' },
                        <?php else: ?>
                        { src: '<?= get_stylesheet_directory_uri() . '/assets/images/mauritius.jpg'; ?>' },
                        <?php endif; ?>
                        <?php endforeach ?>
                    ]
                });
            });
            </script>
        <?php endif; ?>

        <div class="voyage-slider" style="height:100vh;">
            <div class="ui container">
                <br><br>
                <?php get_template_part('templates/voyage/preview'); ?>
            </div>
        </div>

        <div class="ui container">
            <article <?php post_class(); ?>>
                <?php get_template_part('templates/voyage/flights'); ?>
                <?php get_template_part('templates/voyage/accommodation'); ?>
                <?php get_template_part('templates/voyage/itinerary'); ?>
                <?php get_template_part('templates/voyage/conditions'); ?>
                <?php //get_template_part('templates/voyage/contact'); ?>
            </article>
        </div>
    <?php else: ?>
        <br>
        <br>
        <br>
        <div class="ui container">
            <div class="ui red message">
                <?php _e('Sorry for the inconvenience. This offer is not longer available','sage'); ?>
            </div>
        </div>
        <br>
        <br>
    <?php endif; ?>

<?php endwhile; ?>
