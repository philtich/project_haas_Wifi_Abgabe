<?php

$anchor ='';
if(!empty($block['anchor'])){
    $anchor ='id="' . esc_attr($block['anchor']). '" ';
}

$class_name = 'posts';
if(!empty($block['className'])){
    $class_name .= '' . esc_attr($block['className']);
}

$settings = get_field('post_settings');

$args = [
    'post-type' => 'post',
    'ignore_sticky_posts' =>true,
    'posts_per_page'=>$settings['number']
];

$news_query = new WP_Query($args);

if($news_query->have_posts()): ?>
<section <?php echo $anchor;?> class="<?php echo $class_name; ?>">
<h2 class="is-style-headline"><?php _e('Mein Blog', 'wifi') ?></h2>
<?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
<article class="post">
<?php the_title(sprintf('<h3 class="post-title"><a href="%s">', esc_url(get_permalink())), '</a></h3>');?>
<div class="meta">
    <time class="date" datetime="<?php the_time('Y-m-d');?>"><?php the_time('d.m.Y')?></time>
    <?php the_category(', ');?>
</div>
    <?php the_excerpt( );?>


</article>
<?php endwhile;?>

</section>

<?php /*
        * Bedingung: falls ein Link ausgewählt wurde, sollte der Button zur Projektseite angezeigt werden
        */
        if (!empty($settings['link'])): ?>
            <div class="actions">
                <a href="<?php echo $settings['link']; ?>" class="btn"><?php _e('All Projects', 'wifi') ?></a>
            </div>
        <?php endif; ?>
    </section>
<?php
/* Bedingung: falls ACF Repeater-Feld leer ist, sollte der Hinweis "Block bearbeiten" im Backend (Editor) angezeigt werden, sonst ist der Block nur in der "Listenansicht" (Editor) sichtbar/editierbar
 * Die Funktion "is_admin()" prüft ob der Code im Admin-Panel (wp-admin) ausgeführt wird
 * https://developer.wordpress.org/reference/functions/is_admin/
 *
 * Nützliche conditional Tags:  https://developer.wordpress.org/themes/basics/conditional-tags/
 */
elseif (is_admin()) : ?>
    <h2 class="empty-block"><?php _e('Block bearbeiten &raquo;', 'wifi') ?></h2>
<?php endif;
/*
 * Restore original Post Data
 * Notwendig wenn die Abfrage-Parameter "new WP_Query()" geändert wurden
 */
wp_reset_postdata();



