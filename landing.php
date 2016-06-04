<?php
/**
* Template Name: Landing page
*/

$design_options = get_option('experiensa_design_settings');
get_template_part('templates/landing/slider');

$display_showcase = (isset($design_options['display_showcase'])?$design_options['display_showcase']:false);
if($display_showcase!==false && $display_showcase=='TRUE'){
    $showcase_options = (isset($design_options['showcase_options'])?$design_options['showcase_options']:false);
    if($showcase_options !== false && !empty($showcase_options)){
        /*echo "<pre>";
        print_r($showcase_options);
        echo "</pre>";*/
        $showcase_posttype = $showcase_options['showcase_posttype'];
        $showcase_category = $showcase_options['showcase_category'];
        $showcase_component = $showcase_options['showcase_component'];
        $showcase_color = $showcase_options['showcase_color'];
        $showcase_inverted = $showcase_options['showcase_inverted'];
        $showcase_title = $showcase_options['showcase_title'];
        $showcase_subtitle = $showcase_options['showcase_subtitle'];
        $showcase_title_alignment = $showcase_options['showcase_title_alignment'];
        for($i=0;$i < count($showcase_category);$i++){
            $showcase['posttype'] = $showcase_posttype[$i];
            $showcase['category'] = $showcase_category[$i];
            $showcase['component'] = $showcase_component[$i];
            $showcase['color']= $showcase_color[$i];
            $showcase['inverted'] = $showcase_inverted[$i];
            $showcase['title'] = $showcase_title[$i];
            $showcase['subtitle'] = $showcase_subtitle[$i];
            $showcase['title_alignment'] = $showcase_title_alignment[$i];
            Showcase::display_showcase($showcase);
            /*echo "<pre>";
            print_r($showcase);
            echo "</pre>";*/

        }
    }
}
/*echo "<pre>";
print_r($design_options);
echo "</pre>";
$showcase_options = $design_options['showcase_options'];
if(isset($showcase_options) && !empty($showcase_options)){
    echo "hola";
}*/
/*
foreach ($order as $key) {
    switch ($key) {
        case 'destination':
            get_template_part('templates/landing/destinations');
            break;
        case 'promotion':
            get_template_part('templates/landing/promotions');
            break;
        case 'theme':
            echo 'hola';
            get_template_part('templates/landing/themes');
            break;
        case 'country':
            get_template_part('templates/landing/countries');
            break;
        case 'content':
            while (have_posts()) {
                the_post();
                get_template_part('templates/content', 'page');
            }
            break;
        default:
        while (have_posts()) {
            the_post();
            get_template_part('templates/content', 'page');
        }
        break;
    }
}*/
get_template_part('templates/landing/partners');

?>
