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

/*
 * ACF Gruppe-Feld in Variable speichern – Rückgabewert ist ein Array
 * https://www.advancedcustomfields.com/resources/group/
 */
$erfolge = get_field('erfolge');
if (!empty($erfolge)) : ?>
    <div class="<?php echo $class_name ?>">
    
            <h1><?php
                
                echo $erfolge['headline'];
                
                ?></h1>
                <?php if ($erfolge['name']) {
                    echo ' <h2>'  . $erfolge['headline'] . '</h2>';
                }
                ?>
                 <?php if ($erfolge['race1']) {
                    echo ' <p class="textareaclass">'  . $erfolge['race1'] . '</p>';
                }
                ?>
                 <?php if ($erfolge['race2']) {
                    echo ' <p class="textareaclass">'  .  $erfolge['race2'] . '</p>';
                }
                ?>
                 <?php if ($erfolge['race3']) {
                    echo ' <p class="textareaclass">'  . $erfolge['race3'] . '</p>';
                }
                ?>
                 <?php if ($erfolge['race4']) {
                    echo ' <p class="textareaclass">'  . $erfolge['race4'] . '</p>';
                }
                ?>
                 <?php if ($erfolge['race5']) {
                    echo ' <p class="textareaclass">'  . $erfolge['race5'] . '</p>';
                }
                ?>
                 <?php if ($erfolge['race6']) {
                    echo ' <p class="textareaclass">'  .$erfolge['race6'] . '</p>';
                }
                ?>
                 <?php if ($erfolge['race7']) {
                    echo ' <p class="textareaclass">'  .$erfolge['race7'] . '</p>';
                }
                ?>
                <?php if ($erfolge['race8']) {
                    echo ' <p class="textareaclass">'  .$erfolge['race8'] . '</p>';
                }
                ?>
                
                
    </div>
     

<?php /* Bedingung: falls ACF Gruppen-Feld leer ist, sollte der Hinweis "Block bearbeiten" im Backend (Editor) angezeigt werden, sonst ist der Block nur in der "Listenansicht" (Editor) sichtbar/editierbar
 * Die Funktion "is_admin()" prüft ob der Code im Admin-Panel (wp-admin) ausgeführt wird
 * https://developer.wordpress.org/reference/functions/is_admin/
 *
 * Nützliche conditional Tags:  https://developer.wordpress.org/themes/basics/conditional-tags/
 */
elseif (is_admin()) : ?>
    <h2 class="empty-block"><?php _e('Block bearbeiten &raquo;', 'wifi') ?></h2>
<?php endif;