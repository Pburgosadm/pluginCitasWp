<?php
if (!defined('ABSPATH')){
    die('Direct access not permitted.');
}

function campos_personalizados_citas($post){
    //if they exist, the metadata values are retrieved
    $cita_carrera = get_post_meta($post->ID, 'cita_carrera', true);

    wp_nonce_field('citas_metabox', 'citas_metabox_nonce');

    $content = $cita_carrera;
    $custom_editor_id = "editorid";
    $custom_editor_name = "cita_carrera";
    $args = array(
            'media_buttons' => false, // This setting removes the media button.
            'textarea_name' => $custom_editor_name, // Set custom name.
            'textarea_rows' => get_option('default_post_edit_rows', 10) //Determine the number of rows.
        );
    wp_editor( $content, $custom_editor_id, $args );
}

  