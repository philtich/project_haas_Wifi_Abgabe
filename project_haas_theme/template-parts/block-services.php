<?php
/*
 * Ausgabe des ACF-Block
 * https://www.advancedcustomfields.com/resources/blocks/#3-render-the-block
 * */

/* Erstellen des ID-Attributs, falls ein "HTML-Anker" in den erweiterten Block-Einstellungen im Editor eingegeben wurden
 * „$block['anchor']“ liefert die ID (HTML-Anker) aus dem Editor
 *
 * https://developer.wordpress.org/reference/functions/esc_attr/
 */
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

/* Erstellen des Klassen-Attributs
 * „$block['className']“ liefert die "zusätzlichen CSS Klassen" aus den erweiterten Block-Einstellungen im Editor
 */
$class_name = 'services';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

/*
 * ACF Repeater-Feld in Variable speichern – Rückgabewert ist ein Array
 * https://www.advancedcustomfields.com/resources/repeater/
 */
$services = get_field('services');
if (!empty($services)) : ?>
    <section <?php echo $anchor; ?>class="<?php echo $class_name; ?>">
        <h2 class="is-style-headline"><?php _e('Mein Coaching-Angebot','wifi'); ?></h2>
        <div class="serve1">
        <div class="columns">
            <?php
            /*
            * Ausgabe des ACF Repeater-Field Array mit foreach-Schleife
            * https://www.advancedcustomfields.com/resources/repeater/#foreach-loop
            *
            * Innerhalb der Schleife sind keine Bedingungen notwendig, da alle ACF Felder als Pflichtfelder angelegt wurden
            */
            foreach ($services as $service) : ?>
            
                <div class="service column">
                <figure class="service-icon">
                    <?php echo wp_get_attachment_image($service['image'], 'medium_large', false, ['class' => 'service-icon']) ?>
                    </figure>
                    <h3 class="service-title"><?php echo $service['title']?></h3>
                    <a href="<?php echo $service['link']?>"><span class="screen-reader-text"><?php echo $service['title']?></span></a>
                </div>
           
            <?php endforeach; ?>
        </div>
        </div>
    </section>
<?php /* Bedingung: falls ACF Repeater-Feld leer ist, sollte der Hinweis "Block bearbeiten" im Backend (Editor) angezeigt werden, sonst ist der Block nur in der "Listenansicht" (Editor) sichtbar/editierbar
 * Die Funktion "is_admin()" prüft ob der Code im Admin-Panel (wp-admin) ausgeführt wird
 * https://developer.wordpress.org/reference/functions/is_admin/
 *
 * Nützliche conditional Tags:  https://developer.wordpress.org/themes/basics/conditional-tags/
 */
elseif (is_admin()) : ?>
    <h2 class="empty-block"><?php _e('Block bearbeiten &raquo;', 'wifi') ?></h2>
<?php endif;
