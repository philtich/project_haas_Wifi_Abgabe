<?php
/*
 * Ausgabe des ACF-Block
 * https://www.advancedcustomfields.com/resources/blocks/#3-render-the-block
 * */

/*
 * Erstellen des Klassen-Attributs
 * „$block['className']“ liefert die "zusätzlichen CSS Klassen" aus den erweiterten Block-Einstellungen im Editor
 *
 * https://developer.wordpress.org/reference/functions/esc_attr/
 */
$class_name = 'header-media-text columns';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

/*
 * ACF Gruppe-Feld in Variable speichern – Rückgabewert ist ein Array
 * https://www.advancedcustomfields.com/resources/group/
 */
$header = get_field('header');
if (!empty($header)) : ?>
    <header class="blockheader" class="<?php echo $class_name ?>">
    <div class="header-text animate">
            <h1><?php
                /* Ausgage der ACF Text-Felder
                 * "headline" ist ein Pflichtfeld - daher keine Bedingung notwendig
                 */
                echo $header['headline'];
                
                ?></h1>
                <p><?php if ($header['highlight']) {
                    echo ' <span class="name2">' . $header['highlight'] . '</span>';
                }
                ?>
                </p>
                <p><?php if ($header['figcaption2']) {
                    echo ' <span class="name">' . $header['figcaption2'] . '</span>';
                }
                ?>
                </p>
            
        </div>
        <?php
        /*
        * Bild von ACF Feld ausgeben – Einstellung für Rückgabewert beim ACF Feld = ID (das bedeutet wir bekommen die Bild-ID als Rückgabewert)
        * https://www.advancedcustomfields.com/resources/image/
        *
        * Keine Bedingung notwendig, da dieses ACF-Feld als Pflichtfeld definiert wurde
        * wp_get_attachment_image() gibt ein Responsive-Image zurück (komplettes HTML-Element)
        * Parameter1: Bild-ID (aus dem ACF-Feld), Parameter2: Bildgröße, Parameter3: rückgabe als Icon, Parameter4: Attribute (array)
        * https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
        */
        echo wp_get_attachment_image($header['image'], 'medium_large', false, ['class' => 'column header-media animate'])
        ?>
        
    </header>
<?php /* Bedingung: falls ACF Gruppen-Feld leer ist, sollte der Hinweis "Block bearbeiten" im Backend (Editor) angezeigt werden, sonst ist der Block nur in der "Listenansicht" (Editor) sichtbar/editierbar
 * Die Funktion "is_admin()" prüft ob der Code im Admin-Panel (wp-admin) ausgeführt wird
 * https://developer.wordpress.org/reference/functions/is_admin/
 *
 * Nützliche conditional Tags:  https://developer.wordpress.org/themes/basics/conditional-tags/
 */
elseif (is_admin()) : ?>
    <h2 class="empty-block"><?php _e('Block bearbeiten &raquo;', 'wifi') ?></h2>
<?php endif;

?>