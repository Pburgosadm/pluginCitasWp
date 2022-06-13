<?php
if (!defined('ABSPATH')){
    die('Direct access not permitted.');
}

function function_campos_citas(){
    add_meta_box('cita-metabox', 'Campo para Citas', 'campos_personalizados_citas', 'post', 'normal', 'high');
}

function campos_personalizados_citas_save_data($post_id){
    // We check if the nonce has been defined.
    if (!isset($_POST['citas_metabox_nonce'])){
        return $post_id;
    }
    $nonce = $_POST['citas_metabox_nonce'];

    if (!wp_verify_nonce($nonce, 'citas_metabox')){
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return $post_id;
    }

    // We check user permissions
    if ($_POST['post_type'] == 'page'){
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    }else{
        if (!current_user_can('edit_post', $post_id)) return $post_id;
    }

    // Ok, now it's safe to save the data
    // If there are old entries, we recover them
    $old_cita_carrera = get_post_meta($post_id, 'cita_carrera', true);

    $cita_carrera = $_POST['cita_carrera'];

    // We update the meta field in the database.
    update_post_meta($post_id, 'cita_carrera', $cita_carrera, $old_cita_carrera);

}


function fun_citas_test($atts){

        $short_atts = shortcode_atts(array(
            'post_id' => 0,
        ), $atts);

        $terms_val = $short_atts['post_id'];

        if ($terms_val == 0) {
            $terms_val = get_the_ID(); //explode(',', $short_atts['ids']);

        }

        $cf_citas = get_post_meta($terms_val, 'cita_carrera', true);
        ob_start();

        if ($cf_citas) {
?>

            <div class="citas">
                
                <h4>Citas:</h4>
                
                <?php
                echo $cf_citas;
                ?>
            </div>

<?php
        }
        $output2 = ob_get_clean();

        return $output2;
}

function shortcodes_init(){
    add_shortcode('citas_test', 'fun_citas_test');
}
    

