<?php get_header(); ?>

<!--SLIDER-->
<section class="container-fluid" id="slider_banner">
  <?php if (have_rows('slider_list')) : ?>
    <div class="swiper swiper_hero_banner">
      <div class="swiper-wrapper">
        <?php while (have_rows('slider_list')) : the_row(); ?>
          <div class="swiper-slide banner_item" style="background: url(<?php echo get_sub_field('slider_bg') ?>) #ebebeb center center / cover no-repeat;">
            <div class="container">
              <h3 class="kaushan_script"><?php echo get_sub_field('slider_title') ?></h3>
              <h2><?php echo get_sub_field('slider_subtitle') ?></h2>
              <a href="<?php echo get_sub_field('slider_link') ?>"><?php _e('Learn more'); ?></a>
              <span class="d-none"><?php echo get_sub_field('slider_bullet_title') ?></span>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="swiper-pagination container"></div>
    </div>
  <?php endif; ?>
</section>
<!--END SLIDER-->

<!--BLOG-->
<section class="container-fluid" id="blog">
  <div class="container blog">
    <div class="row">
      <div class="col-12 text-center">
        <h3 class="kaushan_script"><?php the_field('blog_title'); ?></h3>
        <h2 class="heading_underline"><?php the_field('blog_subtitle'); ?></h2>
      </div>
      <div class="col-12 blog_list row">
        <?php
          $args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 3,
          );

          $query = new WP_Query($args);

          if ($query->have_posts()) {
            while ($query->have_posts()) {
              $query->the_post(); 
        ?>
          <article class="col-lg-4 blog_item my-2">
            <a class="blog_image" href="<?php the_permalink(); ?>">
              <?php echo get_the_post_thumbnail(); ?>
              <time datetime="<?php the_time('Y-m-j H:i:s'); ?>" class="blog_date">
                <strong><?php the_time('j'); ?></strong><br/>
                <em><?php the_time('F'); ?></em>
              </time>
            </a>
            <h3 class="blog_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php the_excerpt() ?>
            <ul class="blog_views">
              <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12">
                  <g>
                    <g>
                      <path fill="#95e1d3" d="M19.71 5.776l-.002.024-.001.013-.002.017-.003.02v.003a.753.753 0 0 1-.203.41c-.204.247-.427.479-.651.707-1.211 1.23-2.601 2.327-4.123 3.122-.973.509-2.012.919-3.09 1.116a8.967 8.967 0 0 1-3.55-.05c-2.04-.444-3.887-1.545-5.503-2.863-.75-.611-1.488-1.28-2.108-2.032-.272-.33-.272-.719 0-1.048.203-.247.426-.48.65-.708 1.212-1.23 2.602-2.326 4.124-3.122C6.22.877 7.258.466 8.337.27a8.978 8.978 0 0 1 3.55.05c2.04.444 3.887 1.546 5.503 2.863.75.611 1.488 1.28 2.108 2.033.108.11.18.255.203.409v.003c.002.006.003.014.003.02l.003.018v.012l.002.025.002.037-.001.037zM9.99 1.942a3.645 3.645 0 1 0 0 7.29 3.645 3.645 0 0 0 0-7.29zm0 5.467a1.822 1.822 0 1 1 0-3.644 1.822 1.822 0 0 1 0 3.644z" />
                    </g>
                  </g>
                </svg>
                <?php 
                  $post_views_count = get_post_meta(get_the_ID(), 'post_views_count', true);
                  if (!empty($post_views_count)) {
                      echo '<span>' . $post_views_count . '</span>';
                  } else {
                      echo '0';
                  }
                ?>
              </li>
              <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15">
                  <g>
                    <g>
                      <path fill="#95e1d3" d="M8.416 12.358c-.573 0-1.134-.165-1.676-.243-2.191 2.77-5.647 2.225-5.647 2.225 2.44-1.155 2.391-3.069 1.957-3.324C1.134 9.89-.018 8.176-.018 6.256c0-3.391 3.727-6.14 8.434-6.14 4.708 0 7.577 2.749 7.577 6.14 0 3.391-2.87 6.102-7.577 6.102zM4.242 4.875a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm3.75 0a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm3.75 0a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                    </g>
                  </g>
                </svg>
                <?php echo get_comments_number(get_the_ID()) ?>
              </li>
            </ul>
          </article>
        <?php 
            }
          }
          wp_reset_postdata();
        ?>

        <?php echo do_shortcode( '[postsqty posttype="post" num="3"] '); ?>

      </div>
    </div>
  </div>
</section>
<!--END BLOG-->

<!--SERVICE-->
<section class="container-fluid" id="what_we_do">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center what_we_do">
        <h3 class="kaushan_script"><?php the_field('whatwedo_title'); ?></h3>
        <h2 class="heading_underline"><?php the_field('whatwedo_subtitle'); ?></h2>
        <div class="descr_wrap"><?php echo wp_kses_post(get_field('whatwedo_description')); ?></div>
      </div>
      <div class="col-12 col-md-6">
        <img class="img_res" src="<?php echo esc_url(get_field('whatwedo_img')['url']); ?>" alt="<?php echo esc_attr(get_field('whatwedo_img')['alt']); ?>">
      </div>
      <div class="accordion col-12 col-md-6 accordion_list" id="accordionExample">
        <?php if (have_rows('whatwedo_accordions')) : ?>
          <?php $i = 0; ?>
          <?php while (have_rows('whatwedo_accordions')) : the_row(); ?>
            <div class="accordion_item">
              <div class="card_head" id="heading<?php echo $i ?>">
                <button class="d-flex align-items-center <?php echo $i == 0 ? '' : 'collapsed' ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i ?>" aria-expanded="true" aria-controls="collapse<?php echo $i ?>">
                  <img src="<?php echo esc_url(get_sub_field('whatwedo_accordion_icon')['url']); ?>" alt="<?php echo esc_attr(get_sub_field('whatwedo_accordion_icon')['alt']); ?>">
                  <span class="accordion_item_title"><?php echo get_sub_field('whatwedo_accordion_title') ?></span>
                </button>
              </div>
              <div id="collapse<?php echo $i ?>" class="collapse <?php echo $i == 0 ? 'show' : '' ?>" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExample">
                <div class="card_body">
                  <?php echo wp_kses_post(get_sub_field('whatwedo_accordion_description')); ?>
                </div>
              </div>
            </div>
            <?php $i++; ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<!--END SERVICE-->

<!--TEAM-->
<section class="container-fluid" id="team">
  <div class="container team">
    <div class="row">
      <div class="col-12 text-center team">
        <h3 class="kaushan_script"><?php the_field('team_title'); ?></h3>
        <h2 class="heading_underline"><?php the_field('team_subtitle'); ?></h2>
        <div class="descr_wrap"><?php the_field('team_description'); ?></div>
      </div>
      <div class="col-12 team_list row">
        <?php
        $args = array(
          'post_type'      => 'team',
          'post_status'    => 'publish',
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
          'posts_per_page' => 3,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post(); ?>
            <div class="col-12 col-md-4 justify-content-center team_item">
              <div class="team_author_img">
                <?php echo get_the_post_thumbnail() ?>
                <ul class="network_hover_list">
                  <?php if (get_field('member_facebook')) { ?>
                    <li>
                      <a href="<?php the_field('team_facebook') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="26" viewBox="0 0 13 26">
                          <g>
                            <g>
                              <path fill="#fff" d="M12.09.199V4.32s-3.038-.303-3.799.861c-.416.636-.169 2.5-.206 3.838h4.03c-.341 1.564-.585 2.624-.836 3.978H8.063v12.804H2.48V13.047H.106V9.02h2.349c.12-2.946.165-5.864 1.629-7.35C5.728-.001 7.297.199 12.089.199z" />
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                  <?php } ?>
                  <?php if (get_field('member_twitter')) { ?>
                    <li>
                      <a href="<?php the_field('member_twitter') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22">
                          <g>
                            <g>
                              <path fill="#f38181" d="M17.513.601c2.034-.036 3.117.705 4.15 1.648.879-.076 2.02-.566 2.692-.908l.653-.357c-.384 1.037-.904 1.85-1.704 2.466-.178.136-.354.321-.577.408v.013c1.14-.011 2.08-.526 2.973-.805v.013c-.469.745-1.104 1.502-1.781 2.044l-.82.651c.015 1.207-.018 2.359-.244 3.373-1.311 5.895-4.787 9.898-10.288 11.612-1.976.615-5.168.868-7.432.306-1.122-.278-2.136-.593-3.088-1.008a12.305 12.305 0 0 1-1.486-.767L.1 19.009c.51.015 1.108.156 1.678.064.517-.084 1.023-.062 1.5-.166 1.188-.261 2.243-.606 3.151-1.137.441-.259 1.11-.56 1.423-.933-.59.01-1.125-.127-1.563-.281-1.7-.6-2.688-1.703-3.332-3.36.515.057 1.998.19 2.345-.102-.648-.036-1.271-.411-1.717-.69-1.367-.855-2.481-2.289-2.473-4.496l.538.255c.344.145.693.222 1.102.307.173.036.52.137.718.063h-.026c-.264-.307-.695-.512-.96-.843-.878-1.09-1.7-2.766-1.18-4.764a6.1 6.1 0 0 1 .564-1.367l.026.012c.102.214.33.371.474.55.448.555 1 1.054 1.563 1.494 1.918 1.5 3.645 2.422 6.42 3.104.703.174 1.516.306 2.357.307-.236-.687-.16-1.8.025-2.465.468-1.673 1.483-2.88 2.973-3.525a6.31 6.31 0 0 1 1.166-.359l.64-.076z" />
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                  <?php } ?>
                  <?php if (get_field('member_pinterest')) { ?>
                    <li>
                      <a href="<?php the_field('member_pinterest') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="26" viewBox="0 0 21 26">
                          <g>
                            <g>
                              <path fill="#f38181" d="M9.05 16.854c-.208.833-.419 1.706-.637 2.56-.215.842-.405 1.696-.718 2.47-.519 1.281-1.178 2.52-2.043 3.521-.575.667-.453.4-.626.365-.132-.027-.143-.157-.17-.345-.14-1.018-.044-2.195.008-3.34.06-1.303.334-2.387.589-3.47.484-2.063.946-4.087 1.435-6.164.032-.138.12-.366.09-.445-.222-.577-.366-1.095-.429-1.7a5.41 5.41 0 0 1 .14-1.944c.276-1.058.912-1.995 1.893-2.338.624-.216 1.315-.118 1.735.132.432.259.729.667.867 1.246.148.615.039 1.35-.08 1.891-.267 1.219-.618 2.134-.937 3.31-.158.583-.337 1.182-.19 1.812.137.578.438.976.848 1.275.426.31.93.48 1.625.455 1.228-.043 2.081-.828 2.651-1.568.913-1.185 1.465-2.784 1.675-4.686.068-.614.117-1.319.07-2.014-.088-1.284-.49-2.317-1.127-3.117-.606-.762-1.466-1.37-2.512-1.71-1.037-.34-2.472-.452-3.747-.234-2.318.397-3.952 1.714-4.915 3.533a7.079 7.079 0 0 0-.837 3.41c0 1.05.26 1.865.678 2.5.133.201.328.367.458.597.185.326-.028.811-.12 1.164-.11.425-.12 1.012-.617 1.022-.206.004-.464-.146-.638-.243-1.305-.721-2.097-2.033-2.422-3.734a8.935 8.935 0 0 1 0-3.238c.19-.967.544-1.858.937-2.581a9.238 9.238 0 0 1 3.459-3.563C6.559 1.023 7.818.56 9.35.337a16.432 16.432 0 0 1 1.605-.131 9.638 9.638 0 0 1 4.326.809 8.85 8.85 0 0 1 2.98 2.146c.838.915 1.448 1.98 1.834 3.309.202.692.398 1.432.398 2.287 0 .858-.181 1.613-.308 2.368-.474 2.828-1.819 5.141-3.838 6.458a6.636 6.636 0 0 1-1.754.81c-.667.193-1.428.339-2.243.282a4.599 4.599 0 0 1-1.983-.577c-.54-.305-.994-.679-1.316-1.244z" />
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                  <?php } ?>
                  <?php if (get_field('member_instagram')) { ?>
                    <li>
                      <a href="<?php the_field('member_instagram') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                          <g>
                            <g>
                              <path fill="#f38181" d="M22.7 25.8H3.5a3.2 3.2 0 0 1-3.2-3.2V3.4A3.2 3.2 0 0 1 3.5.2h19.2a3.2 3.2 0 0 1 3.2 3.2v19.2a3.2 3.2 0 0 1-3.2 3.2zM13.1 8.04a4.957 4.957 0 0 0-4.498 2.88h-.005l-.022.054a4.908 4.908 0 0 0-.128.322c-.02.052-.04.103-.057.155a4.998 4.998 0 0 0-.095.34c-.014.054-.03.106-.042.16a4.99 4.99 0 0 0-.061.368c-.007.05-.017.099-.023.15a4.96 4.96 0 1 0 9.861 0c-.005-.051-.015-.1-.022-.15a4.985 4.985 0 0 0-.061-.368c-.012-.054-.028-.106-.042-.16a5.004 5.004 0 0 0-.095-.34c-.017-.052-.038-.103-.057-.155a4.916 4.916 0 0 0-.128-.322l-.022-.055h-.005A4.957 4.957 0 0 0 13.1 8.04zm9.92-3.68a1.28 1.28 0 0 0-1.28-1.28h-2.56a1.28 1.28 0 0 0-1.28 1.28v2.56c0 .707.573 1.28 1.28 1.28h2.56a1.28 1.28 0 0 0 1.28-1.28zm0 6.56h-2.36a7.84 7.84 0 0 1-7.56 9.92 7.84 7.84 0 0 1-7.56-9.92H3.18v10.72c0 .707.573 1.28 1.28 1.28h17.28a1.28 1.28 0 0 0 1.28-1.28z" />
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
              <div class="team_author_info text-center">
                <h3 class="mb-0"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                <p class="mb-0"><?php the_field('member_position') ?></p>
              </div>
            </div>
        <?php }
        }
        wp_reset_postdata();
        ?>
      </div>

      <?php echo do_shortcode( '[postsqty posttype="team" num="3"] '); ?>

    </div>
  </div>
</section>
<!--END TEAM-->

<?php get_footer(); ?>