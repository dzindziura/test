<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
 function scratchcode_create_payment_table() {

    global $wpdb;

    $table_name = $wpdb->prefix . "Email";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      email VARCHAR(150) NOT NULL,
      PRIMARY KEY id (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action('init', 'scratchcode_create_payment_table');



add_shortcode('email_select', 'email_select' );
function email_select(){
	global $wpdb;
	$result = $wpdb->get_results("SELECT email FROM wp_Email");
	echo '<div>';
	foreach ($result as $value) {
		echo '</br>';
		echo $value->email;
	}
	echo "</div>";
}
// ПРОСМОТРЫ
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Просмотры');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
        if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}
add_action('admin_menu', function(){
   add_theme_page('Настроїти', 'Настроїти', 'edit_theme_options', 'customize.php');
});
add_action('customize_register', function($customizer){
    $customizer->add_section(
        'example_section_one',
        array(
            'title' => 'Мої настройки',
            'description' => 'Приклад секції',
            'priority' => 11,
        )
    );
		$customizer->add_setting(
    'example_textbox',
    array('default' => 'testText')
);
$customizer->add_control(
    'example_textbox',
    array(
        'label' => 'Настройка текста',
        'section' => 'example_section_one',
        'type' => 'text',
    )
);
});
add_theme_support( 'post-thumbnails' );
