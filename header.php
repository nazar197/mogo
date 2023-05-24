<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="header" style="background: <?php echo is_front_page() ? 'transparent' : '#f38181'; ?>;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-6 col-md-2 logo order-md-1">
          <?php echo mogo_logo()?>
      </div>

      <div class="col-6 block_active_menu col-md-3 col-lg-2 order-md-3">
          <ul class="button_list">
            <li class="button_item">
              <button type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 18 15"><g><g><path fill="#fff" d="M17.726 3.663h.001l-2.475 5.5a.824.824 0 0 1-.697.485l-7.128.475.412 1.176H15.6a1.65 1.65 0 1 1-1.65 1.65h-7.7A1.65 1.65 0 1 1 4.6 11.3h1.49L2.916 2.225h-1.89a.825.825 0 0 1 0-1.65H3.5c.36 0 .663.232.776.554l.003-.002.48 1.373h12.216a.825.825 0 0 1 .751 1.163zm-12.39.487l1.526 4.357 7.089-.473 1.748-3.884z"/></g></g></svg>
              </button>
            </li>
            <li class="button_item">
              <button type="button" class="active_search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 18 18"><g><g><path fill="#fff" d="M17.8 16.15a1.65 1.65 0 0 1-2.817 1.166l-4.836-4.835c-.982.58-2.124.919-3.347.919a6.6 6.6 0 1 1 6.6-6.6 6.558 6.558 0 0 1-.919 3.347l4.836 4.836c.298.298.483.71.483 1.167zm-11-14.3a4.95 4.95 0 1 0 0 9.9 4.95 4.95 0 0 0 0-9.9z"/></g></g></svg>
              </button>
              <?php get_search_form(); ?>
            </li>
            <li class="menu_active d-md-none">
              <button type="button">
                <span></span>
                <span></span>
                <span></span>
              </button>
            </li>
          </ul>
      </div>

      <div class="col-12 block_header col-md-7 col-lg-8 order-md-2">
        <div class="close_button d-md-none">
          <button type="button">
            <span></span>
            <span></span>
          </button>
        </div>
        <nav>
          <?php
            wp_nav_menu( array(
                'theme_location'  => 'header-menu',
                'menu_id'         => 'primary-menu',
                'depth'           => 2,
                'container'       => false,
                'menu_class'      => 'navbar-nav mr-auto',
            ) );
          ?>
        </nav>
      </div>
    </div>
  </div>
</header>