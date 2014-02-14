<?php
/**
 * Custom functions
 */
add_shortcode('cases_q', 'cases_shortcode_query');
function cases_shortcode_query($atts, $content){
  extract(shortcode_atts(array( // a few default values
   'posts_per_page' => '1',
   'post_type' => 'cases',
   'caller_get_posts' => 1)
   , $atts));

  global $post;

  $posts = new WP_Query($atts);
  $output = '';
    if ($posts->have_posts())
        while ($posts->have_posts()):
            $posts->the_post();
            $out = '<div class="cases_box">
                <h4>cases Name: <a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h4>
                <p class="cases_desc">'.get_the_content().'</p>';
                // add here more...
            $out .='</div>';
    /* these arguments will be available from inside $content
        get_permalink()  
        get_the_content()
        get_the_category_list(', ')
        get_the_title()
        and custom fields
        get_post_meta($post->ID, 'field_name', true);
    */
    endwhile;
  else
    return; // no posts found

  wp_reset_query();
  return html_entity_decode($out);
}

?>