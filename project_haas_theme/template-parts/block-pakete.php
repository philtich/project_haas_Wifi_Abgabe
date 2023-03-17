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
$pakete = get_field('pakete');
if (!empty($pakete)) : ?>
    
    <section class="blocks">    
    <?php if ($pakete['headline']) {
                    echo ' <h3>'  . $pakete['headline'] . '</h3>';
                }
                ?>
                
                 <?php if ($pakete['leistung1']) {
                    echo ' <p>'   . $pakete['leistung1'] . '</p>';
                }
                ?>
            
                <?php if ($pakete['leistung2']) {
                    echo ' <p>'   . $pakete['leistung2'] . '</p>';
                }
                ?>
                <?php if ($pakete['leistung3']) {
                    echo ' <p>'   . $pakete['leistung3'] . '</p>';
                }
                ?>
                <?php if ($pakete['leistung4']) {
                    echo ' <p>'   . $pakete['leistung4'] . '</p>';
                }
                ?>
                <?php if ($pakete['leistung5']) {
                    echo ' <p>'   . $pakete['leistung5'] . '</p>';
                }
                ?>

          
                 
            
                 <?php if ($pakete['preis']) {
                    echo ' <p class="textareaclass" style="font-weight: bold; text-decoration: underline" >' . '€' . $pakete['preis'] . ' pro Monat' . '</p>';
                }
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