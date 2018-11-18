<?php
//CUSTOMIZE VISUAL COMPOSER WITH ICONS IN ADMIN PANEL

if(!function_exists('ahashop_required_custom_icons')) {
    function ahashop_required_custom_icons() {
        ?>
        <style type="text/css" media="screen">

            .vc_element-icon.icon-element {
                background-image: url(<?php echo AHASHOP_REQUIRED_URL; ?>inc/shortcodes/min_icon.jpg) !important;
                background-position: 0 0 !important;
            }
            .wpb_content_element.min_element_extended > .wpb_element_wrapper > h4.wpb_element_title > span.icon-element {
                background-image: url(<?php echo AHASHOP_REQUIRED_URL; ?>inc/shortcodes/min_icon.jpg);

            }

        </style>
    <?php }
    add_action( 'admin_head', 'ahashop_required_custom_icons' );
}
?>