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
$class_name = 'textareaclass';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

$class_name = 'blocks';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

/*
 * ACF Gruppe-Feld in Variable speichern – Rückgabewert ist ein Array
 * https://www.advancedcustomfields.com/resources/group/
 */
$steckbrief = get_field('steckbrief');
if (!empty($steckbrief)) : ?>
    
    
            <h1 class="w3-animate-zoom"><?php
                
                echo $steckbrief['headline'];
                
                ?></h1>

                 
    <section class="blocks w3-animate-zoom"> 
                <?php if ($steckbrief['name']) {
                    echo ' <h3>'  . $steckbrief['name'] . '</h3>';
                }
                ?>
                 <?php if ($steckbrief['geburtstag']) {
                    echo ' <p class="textareaclass">'  . '<b>Geboren am: </b>' .$steckbrief['geburtstag'] . '</p>';
                }
                ?>
                 <?php if ($steckbrief['geburtsort']) {
                    echo ' <p class="textareaclass">'  . '<b>Geburtsort:</b> ' .$steckbrief['geburtsort'] . '</p>';
                }
                ?>
                 <?php if ($steckbrief['ausbildung']) {
                    echo ' <p class="textareaclass">'  .  '<b>Ausbildungen: </b><br>' . $steckbrief['ausbildung'] . '</p>';
                }
                ?>
                 <?php if ($steckbrief['hobbies']) {
                    echo ' <p class="textareaclass">'  . '<b>Hobbies: </b>' .$steckbrief['hobbies'] . '</p>';
                }
                ?>
                 <?php if ($steckbrief['lebensmotto']) {
                    echo ' <p class="textareaclass">'  . '<b>Lebensmotto: </b>' .$steckbrief['lebensmotto'] . '</p>';
                }
                ?>
                
            
        <br>
            
        
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
        echo wp_get_attachment_image($steckbrief['image'], 'medium_large', false, ['class' => 'textareaimage'])
        ?>
        </section>
   
     

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