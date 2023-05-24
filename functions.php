<?php 

/* -- Theme Setup -- */

add_action( 'after_setup_theme', 'mogo_theme_setup' );

if ( ! function_exists( 'mogo_theme_setup' ) ) {
	function mogo_theme_setup() {
    add_theme_support('post-thumbnails');

    add_theme_support( 'custom-logo', [
      'height'      => 42,
      'width'       => 214,
      'flex-width'  => false,
      'flex-height' => false,
      'header-text' => '',
      'unlink-homepage-logo' => true, // WP 5.5
    ] );
	}
}

/* -- Register scripts and styling -- */

add_action('wp_enqueue_scripts', 'mogo_enqueue_files');

function mogo_enqueue_files() {
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, '4.1');
  wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', null, '8.4');
  wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.min.css', null, null);

  wp_enqueue_script('jquery');

  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.1', true);
  wp_enqueue_script('swiper-js', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', null, '8.4', true);

  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'bootstrap-js', 'swiper-js'), '1.0', true);
}

/* -- Register nav menus -- */

register_nav_menus(array(
  'header-menu' => 'Header Menu',
));

function mogo_logo() {
  if( is_front_page() ) {
     return '<p>' . get_bloginfo('name') . '</p>';
  } else {
     return '<a href="' . get_home_url() . '">' . get_bloginfo('name') . '</a>';
  }
}

/* -- Add Search Form -- */

add_filter( 'get_search_form', 'mogo_search_form' );

function mogo_search_form( $form ) {
	$form = '
	<form role="search" class="button_item_search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<input type="text" placeholder="Search" autocomplete="off" value="' . get_search_query() . '" name="s" id="s" />
      <button type="submit" id="searchsubmit">
         <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 18 18"><g><g><path fill="#fff" d="M17.8 16.15a1.65 1.65 0 0 1-2.817 1.166l-4.836-4.835c-.982.58-2.124.919-3.347.919a6.6 6.6 0 1 1 6.6-6.6 6.558 6.558 0 0 1-.919 3.347l4.836 4.836c.298.298.483.71.483 1.167zm-11-14.3a4.95 4.95 0 1 0 0 9.9 4.95 4.95 0 0 0 0-9.9z"/></g></g></svg>
      </button>
	</form>';

	return $form;
}

/* -- Register Post Types -- */

add_action('init', 'mogo_register_post_types');

function mogo_register_post_types() {
  register_post_type('team',
    array(
      'labels' => array(
          'name' => __('Team'),
          'singular_name' => __('Team')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'team'),
      'show_in_rest' => true,
      'supports' => array('title', 'thumbnail', 'custom-fields', 'page-attributes'),
      'menu_icon' => 'dashicons-groups'
    ),
  );
}

/* -- Get Post Views Count -- */

function mogo_get_post_views($postID){
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
      return "0";
  }
  return $count;
}

/* -- Set Post Views Count -- */

function mogo_set_post_views($postID)
{
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    } else {
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}

/* -- Count posts -- */

function mogo_posts_count($post_type) {
  $count_posts = wp_count_posts($post_type);

  if ( $count_posts ) {
    $published_posts = $count_posts->publish;

    return $published_posts;
  }

  return '0';
}

/* -- Count posts Shortcode -- */

add_shortcode( 'postsqty', 'mogo_check_qty_of_posts' );

function mogo_check_qty_of_posts($atts) {
  $a = shortcode_atts(array(
      'posttype' => '',
      'num' => '',
  ), $atts);

  $postsqty = mogo_posts_count($a['posttype']);
  if($postsqty > $a['num']) {
    ob_start(); ?>
    <div class="col-12 text-right mt-5">
      <a class="link_page" href="<?php echo get_post_type_archive_link($a['posttype']) ?>"><?php _e('View all ->'); ?></a>
    </div>
    <?php $res = ob_get_clean();
  } else {
    $res = '';
  }

  return $res;
}