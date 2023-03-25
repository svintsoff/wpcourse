<?php
remove_filter('the_content', 'wpautop');

function my_extra_fields() {
    add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'post', 'normal', 'high'  );
}
add_action('add_meta_boxes', 'my_extra_fields', 1);

function extra_fields_box_func( $post ){
    ?>
    <p>Краткое описание статьи (description):
        <textarea type="text" name="extra[description]" style="width:100%;height:50px;"><?php echo get_post_meta($post->ID, 'description', 1); ?></textarea>
    </p>

    <p><select name="extra[select]">
            <?php $sel_v = get_post_meta($post->ID, 'select', 1); ?>
            <option value="0">----</option>
            <option value="1" <?php selected($sel_v, '1')?> >Важно</option>
            <option value="2" <?php selected($sel_v, '2')?> >Не важно</option>
        </select> - важность статьи</p>

    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

function my_extra_fields_update( $post_id ){
    if (
        empty( $_POST['extra'] )
        || ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
        || wp_is_post_autosave($post_id)
        || wp_is_post_revision($post_id)
    )
        return false;

    // Все ОК! Теперь, нужно сохранить/удалить данные
    $_POST['extra'] = array_map('sanitize_text_field', $_POST['extra']); // чистим все данные от пробелов по краям
    foreach($_POST['extra'] as $key => $value){
        if( empty($value) ){
            delete_post_meta($post_id, $key); // удаляем поле если значение пустое
            continue;
        }

        update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
    }

    return $post_id;
}
add_action('save_post', 'my_extra_fields_update', 0);

function enqueue_styles() {
    wp_enqueue_style( 'whitesquare-style', get_stylesheet_uri());
    wp_register_style('font-style', 'http://fonts.googleapis.com/css?family=Oswald:400,300');
    wp_enqueue_style( 'font-style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

function enqueue_scripts () {
    wp_register_script('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
    wp_enqueue_script('html5-shim');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
}