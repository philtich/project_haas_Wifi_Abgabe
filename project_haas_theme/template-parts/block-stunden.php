
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
$stunden = get_field('stunden');
if (!empty($stunden)) : ?>
    
    <section class="blocks">      
    <?php if ($stunden['headline']) {
                    echo ' <h3>'  . $stunden['headline'] . '</h3>';
                }
                ?>
                
                 <?php if ($stunden['leistung1']) {
                    echo ' <p>'   . $stunden['leistung1'] . '</p>';
                }
                ?>
            
                <?php if ($stunden['leistung2']) {
                    echo ' <p>'   . $stunden['leistung2'] . '</p>';
                }
                ?>
                <?php if ($stunden['leistung3']) {
                    echo ' <p>'   . $stunden['leistung3'] . '</p>';
                }
                ?>
                <?php if ($stunden['leistung4']) {
                    echo ' <p>'   . $stunden['leistung4'] . '</p>';
                }
                ?>
                <?php if ($stunden['leistung5']) {
                    echo ' <p>'   . $stunden['leistung5'] . '</p>';
                }
                ?>

         
                 
            
                 <?php if ($stunden['preis']) {
                    echo ' <p style="font-weight: bold; text-decoration: underline" >' . '€' . $stunden['preis'] . ' pro Stunde' . '</pstyle=>';
                }
                ?>
                 
            
<br>
     
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