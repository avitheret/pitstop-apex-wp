<?php
/**
 * Fallback template. On the homepage, render the full PitStop design so the
 * site works even before a static front page is assigned.
 */
get_header();

if ( is_front_page() || is_home() ) {
    include get_template_directory() . '/inc/static-front.php';
} else {
    echo '<main style="max-width:var(--maxw);margin:120px auto;padding:0 32px;color:var(--text);">';
    if ( have_posts() ) { while ( have_posts() ) { the_post(); the_content(); } }
    echo '</main>';
}

get_footer();
