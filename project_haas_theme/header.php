<!DOCTYPE html>
<?php /* die WordPress Funktion "language_attributes()" gibt das Attribut "lang" mit der in WordPress eingestellten Sprache zurück (ZB: lang="de_DE" ) */ ?>
<html lang="<?php language_attributes(); ?>" class="no-js">
<head>
    <?php /* die WordPress Funktion "bloginfo()" gibt nütliche Informationen zur Website zurück. Über den Parameter 'show' können einzelne Werte ausgegeben werden.
        * bloginfo('charset') gibt den Zeichensatz der eingestellten Sprache zurück (ZB: UTF-8 )
        * https://developer.wordpress.org/reference/functions/bloginfo/
        * Hinweis: wird dieses Theme nur für Sprachen in UTF-8 entwickelt, könnte dieser Hardcoded eingefügt werden (also ohne Funktionsaufruf)
        */
    ?>
    <meta charset="<?php bloginfo('charset'); ?>>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); //erlaubt WordPress und den installierten Plugins hier Code (Scripten, links, meta, title, etc.) auszugeben ?>
</head>
<?php /* body_class() liefert viele nützliche Klassen-Namen aus WordPress. ZB: logged-in, admin-bar, template, post-id, etc.
     * https://developer.wordpress.org/reference/functions/body_class/
     */ ?>
<body <?php body_class(); ?>>
<a href="#content" class="screen-reader-text"><?php _e('Skip to Content', 'ize'); ?></a>
<nav id="navbar">
    <div class="container">
        <div id="brand">
            <?php /* Ausgabe des Logos aus dem Customizer
                    * Bedingung (if) überprüft ob die Funktion existiert - nur der Fall, wenn in der functions.php der Theme-Support 'custom-logo' aktiviert wurde
                    * the_custom_logo() gibt den <a> Tag inkl. href zur Startseite und verschachtelt den <img> Tag mit dem Logo und alt-Attribut aus
                    * https://developer.wordpress.org/reference/functions/the_custom_logo/
                    */
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            } ?>
        </div>


        <input type="checkbox" id="nav-toggle">
        <label for="nav-toggle" id="nav-button">
            <span class="nav-button-icon" aria-hidden="true"></span>
            <span class="screen-reader-text"><?php _e('Navigation öffnen/schließen', 'wifi'); ?></span>
        </label>
        <?php /*
                * Ausgabe des Menüs, dass im WordPress als "Haupt Navigation" festgelegt wurde (Design -> Menüs oder Cusotmizer -> Menüs / Position im Theme: Checkbox "Haupt Navigation")
                * https://developer.wordpress.org/reference/functions/wp_nav_menu/
                */
        wp_nav_menu(array(
            'theme_location' => 'primary',  // wurde in der functions.php festgelegt "register_nav_menus()"
            'container' => false,           // true würde eine <div> um die <ul> des wp_nav_menu() erzeugen
            'menu_class' => 'nav-menu',     // Klassenname der ul: <ul class="nav-menu">
            'menu_id' => 'nav-main',        // IDname der ul: <ul id="nav-main">
            'depth' => 2,                   // Anzahl der Menüebenen die ausgegeben werden
            'fallback_cb' => false          // wenn im WordPress kein Menü als "Footer Navigation" zugewiesen wurde (Checkbox), wird keine Navigation ausgegeben. Default wäre die Ausgebe der WordPress Funktion "wp_page_menu()" (https://developer.wordpress.org/reference/functions/wp_page_menu/)
        )); ?>
    </div>
</nav>