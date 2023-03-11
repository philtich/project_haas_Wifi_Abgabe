<?php
/*
 * In der functions.php werden über Actions, Filter & Hooks sämtliche WordPress Funktionen de-/aktiviert bzw. angepasst
 * https://developer.wordpress.org/themes/basics/theme-functions/
 * https://kinsta.com/de/blog/wordpress-hooks/
 *
 * Offizielle Doku zu WordPress Themes: https://developer.wordpress.org/themes/
 * Offizielle Doku zum Gutenberg Editor: https://developer.wordpress.org/block-editor/
 *
 * Auch eigene PHP-Funktionen, die man in den Teplates verwenden möchte, können in die functions.php geschrieben werden
 */

/* ---- Theme Setups ----
* Dieser Hook wird bei jedem Laden der Seite aufgerufen, nachdem das Theme initialisiert wurde. Es wird im Allgemeinen verwendet, um grundlegende Setup-, Registrierungs- und Initiierungsaktionen für ein Theme auszuführen.
* https://developer.wordpress.org/reference/hooks/after_setup_theme/
*/
add_action('after_setup_theme', function () {

    // Title Tag in <head> : <title>...</title>
    add_theme_support('title-tag');

    /* Pfad zur Sprachdatei
    * load_textdomain() gibt den Namen der Übersetzungsdatei (beliebiger Name) und den Pfad an, wo diese zu finden ist.
    * https://developer.wordpress.org/reference/functions/load_textdomain/
    * get_template_directory() liefert den absoluten Server-Pfad zum Theme-Verzeichnis (ZB: "/var/www/html/wp-content/themes/webdev-theme") https://developer.wordpress.org/reference/functions/get_template_directory/
    *
    * Sämtliche Texte die wir in unserer functions.php oder in Templates schreiben und im Frontend oder Backend angezeigt werden, sollten über die Textdomain übersetzbar sein!
    * die Ausgabe im PHP wird in der Funktion als echo "_e('Zu übersetzender Text','TEXTDOMAIN')" oder return "__('Zu übersetzender Text','TEXTDOMAIN')" eingebunden
    * https://developer.wordpress.org/reference/functions/_e/
    */
    load_textdomain('wifi', get_template_directory() . '/assets/languages');

        // Aktivierung von Beitragsbildern
    //add_theme_support('post-thumbnails');

   // Eigene Bildgrößen im Theme definieren bzw. registrieren (https://developer.wordpress.org/reference/functions/add_image_size/)
    add_image_size('project', 730, 487, array('center', 'center'));  // 730x487 = 3:2


    // WordPress HTML5-Markup
    add_theme_support('html5', array(
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
        'comment-list',
        'comment-form'
    ));






    /*
    * register_nav_menus() registriert Navigations Menüs (ohne diese Funktion gibt es im Admin-Menü: "Design > Menüs" nicht zur Aswahl
    * im array werden die "Positionen im Theme" definiert
    * https://developer.wordpress.org/reference/functions/register_nav_menus/
    */
    register_nav_menus(array(
        'primary' => __('Haupt Navigation', 'wifi'),
        'footer' => __('Footer Navigation', 'wifi'),
    ));


    /* -- Customizer --
     * Custom Logo über Customizer zu ändern
     * https://developer.wordpress.org/themes/functionality/custom-logo/
     */
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 100,

        /* Bei SVG (können nicht beschnitten werden) MUSS beides true sein */
        'flex-height' => true,
        'flex-width' => true
    ));


    /* -- Gutenberg Editor --
    * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
    * Offizielle Doku zum Gutenberg Editor: https://developer.wordpress.org/block-editor/
    */

    // Theme für Gutenberg optimiert - Lade default Block styles
    add_theme_support('wp-block-styles');

    // aktiviere wide & fullwidth Layouts
    add_theme_support('align-wide');

    // Custom CSS für Gutenberg (Backend)
    add_theme_support('editor-styles');
    add_editor_style('assets/style-editor.css');
    add_editor_style('assets/icons/style.min.css');

    // Responsive Embeds (ZB. YouTube Videos, Iframes) erlauben
    add_theme_support('responsive-embeds');

    //eigene Schriftgröße im Editor deaktivieren
    //add_theme_support('disable-custom-font-sizes');

    // eigene Farbauswahl-Palette deaktivieren
    //add_theme_support('disable-custom-colors');

    // eignen Farbverlauf im Editor deaktivieren
    //add_theme_support('disable-custom-gradients');

    //Farbpalette im Editor hinzufügen
    /*
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Font-Color', 'wifi'),
            'slug' => 'color-1',
            'color' => '#383838'
        ),
        array(
            'name' => __('Background Color', 'wifi'),
            'slug' => 'color-2',
            'color' => '#fff'
        )
    ));
    */

    // Adminbar im Frontend deaktivieren (wenn aktiviert, sollten die Syles für Navigation angepasst werden)
    add_filter('show_admin_bar', '__return_false');

});


/*
 * Zusätzlichen Mimes (Dokumenttypen) für den Upload erlauben
 * https://developer.wordpress.org/reference/hooks/upload_mimes/
 */
add_filter('upload_mimes', function ($mimes = array()) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
});


/* ---- CSS & JS in <head> bzw. vor dem </body> einfügen [ wp_head() , wp_footer() ] ----
* https://developer.wordpress.org/reference/functions/wp_enqueue_script/
* der "Handle" muss eindeutig sein
* Liste aller Scripten, die WordPress bereits inkludiert hat: https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-and-js-libraries-included-and-registered-by-wordpress
*/
$theme_version = wp_get_theme()->get( 'Version' );
$version = is_string( $theme_version ) ? $theme_version : false;

add_action('wp_enqueue_scripts', function () use ($version) {
    
    // CSS (style.css) im Head einfügen
    wp_enqueue_style('icons-css', get_template_directory_uri() . '/assets/icons/style.min.css');
    wp_enqueue_style('webdev-css', get_template_directory_uri() . '/style.css');

    // Splidejs styles nur registrieren nicht ausgeben
    wp_register_style('splide-css', get_template_directory_uri() . '/assets/css/splide.min.css');

    // JS im Footer einfügen
    wp_enqueue_script('webdev-js', get_template_directory_uri() . '/assets/scripts.js', [], $version, true);

    // Splidejs js nur registrieren nicht ausgeben
    wp_register_script('splide-js', get_template_directory_uri() . '/assets/js/splide.min.js',[], $version, true);

});



add_filter('show_admin_bar', '__return_false');



/* --- Funktonen für das Plugin ACF-Pro --- */

/* Bedingung: Prüfe ob ACF Pro installiert und aktiviert ist
* die PHP Funktion "function_exists()" prüft ob es diese Funktion mit dem Funktionsnamen gibt - "acf_add_options_page()" wird über das Plugin ACF-Pro deklariert
* wenn (if) das Plugin ACF-Pro installiert ist, existiert diese Funktion und wir können ACF-Option-Pages und/oder ACF-Gutenberg-Blöcke erstellen
* sonst (else) geben wir im WordPress Adminbereich eine Fehlermeldung aus, dass diese Plugin benötigt wird
* https://www.php.net/manual/de/function.function-exists.php
*/

if (function_exists('acf_add_options_page')) {

    /* ACF Feldgruppen und Feldeinstellungen als .json-Dateien im Theme speichern (Verzeichnis "acf-fields") und von dort laden
     * ACHTUNG: das Verzeichnis "acf-fields" muss existieren, damit die Dateien dort gespeichert werden können!
     * https://www.advancedcustomfields.com/resources/local-json/
     */
     add_filter('acf/settings/save_json', function ( $path ) {
         $path = get_template_directory() . '/acf-fields';
         return $path;
     });
     add_filter('acf/settings/load_json', function ( $paths ) {
         unset($paths[0]);
         $paths[] = get_stylesheet_directory() . '/acf-fields';
         return $paths;
     });
    }

/* ACF Option Page erstellen
    * https://www.advancedcustomfields.com/resources/acf_add_options_page/
    */
    acf_add_options_page(array(
        'page_title' => 'Social Links',
        'menu_title' => 'Social Links',
        'menu_slug' => 'webdev-social-links',
        'capability' => 'edit_posts',
        'position' => 50,
        'icon_url' => 'dashicons-admin-links', // https://developer.wordpress.org/resource/dashicons/
        'update_button' => __( 'Änderungen speichern', 'wifi' ),
        'updated_message' => __( 'Änderungen wurden gespeichert', 'wifi' )
    ));

    
/* ACF Option Page erstellen
    * https://www.advancedcustomfields.com/resources/acf_add_options_page/
    */
    acf_add_options_page(array(
        'page_title' => 'Adresse',
        'menu_title' => 'Adresse',
        'menu_slug' => 'webdev-adress',
        'capability' => 'edit_posts',
        'position' => 51,
        'icon_url' => 'yes', // https://developer.wordpress.org/resource/dashicons/
        'update_button' => __( 'Änderungen speichern', 'wifi' ),
        'updated_message' => __( 'Änderungen wurden gespeichert', 'wifi' )
    ));

  /* Hinzufügen von Gutenberg-Block-Kategorie */ 
  add_filter( 'block_categories_all', function($categories){

    return array_merge(
            array(
                array(
                    'slug' => 'wifi',
                    'title' => 'wifi'
                )
                ),
                $categories
            );

}, 10, 2 );

/* ACF-Gutenberg-Blöcke erstellen : */ 

add_action ( 'acf/init', function (){


    if ( function_exists('acf_register_block_type')  ) {
        
        /* register block "Header" */ 
        acf_register_block_type(array(
                'name' => 'haas_header',
                'title' =>  __('Header', 'wifi'),
                'description' => __('Haas Header', 'wifi'),
                'supports' => array('anchor' => false),
                'category' => 'wifi',
                'keywords' => array('header', 'haas'),
                'post_types' => array('page'),
                'align' => false,
                'mode' => false,
                'icon' => 'welcome-widget-menus',
                'render_template' => 'template-parts/block-header.php'
        ) );


              /* register block "Services" */ 
              acf_register_block_type(array(
                'name' => 'haas_services',
                'title' =>  __('Services', 'wifi'),
                'description' => __('Services 3 Spalten', 'wifi'),
                'supports' => array('anchor' => true),
                'category' => 'wifi',
                'keywords' => array('services', 'spalten', 'columns', 'teaser', 'Leistungen'),
                'post_types' => array('page'),
                'align' => false,
                'mode' => false,
                'icon' => 'yes',
                'render_template' => 'template-parts/block-services.php'
        ) );

        /* register block "Textarea" */ 
        acf_register_block_type(array(
            'name' => 'haas_textarea',
            'title' =>  __('Textarea', 'wifi'),
            'description' => __('Haas Textarea', 'wifi'),
            'supports' => array('anchor' => false),
            'category' => 'wifi',
            'keywords' => array('textarea', 'haas'),
            'post_types' => array('page'),
            'align' => false,
            'mode' => false,
            'icon' => 'welcome-widget-menus',
            'render_template' => 'template-parts/block-textarea.php'
    ) );

    /* register block "Steckbrief" */ 
    acf_register_block_type(array(
        'name' => 'haas_steckbrief',
        'title' =>  __('Steckbrief', 'wifi'),
        'description' => __('Haas Steckbrief', 'wifi'),
        'supports' => array('anchor' => false),
        'category' => 'wifi',
        'keywords' => array('steckbrief', 'haas'),
        'post_types' => array('page'),
        'align' => false,
        'mode' => false,
        'icon' => 'welcome-widget-menus',
        'render_template' => 'template-parts/block-steckbrief.php'
) );

 /* register block "Erfolge" */ 
 acf_register_block_type(array(
    'name' => 'haas_erfolge',
    'title' =>  __('Erfolge', 'wifi'),
    'description' => __('Haas Erfolge', 'wifi'),
    'supports' => array('anchor' => false),
    'category' => 'wifi',
    'keywords' => array('erfolge', 'haas'),
    'post_types' => array('page'),
    'align' => false,
    'mode' => false,
    'icon' => 'welcome-widget-menus',
    'render_template' => 'template-parts/block-erfolge.php'
) );

/* register block "Partner" */ 
acf_register_block_type(array(
    'name' => 'haas_partner',
    'title' =>  __('Partner', 'wifi'),
    'description' => __('Haas Partner', 'wifi'),
    'supports' => array('anchor' => false),
    'category' => 'wifi',
    'keywords' => array('partner', 'haas'),
    'post_types' => array('page'),
    'align' => false,
    'mode' => false,
    'icon' => 'welcome-widget-menus',
    'render_template' => 'template-parts/block-partner.php'
) );

         

                     /* register block "Latest Posts" */ 
                     acf_register_block_type(array(
                        'name' => 'webdev_latestposts',
                        'title' =>  __('Letzte Blog-Beiträge', 'wifi'),
                        'description' => __('Letzte Beiträge', 'wifi'),
                        'supports' => array ('anchor' => true),
                        'category' => 'wifi',
                        'keywords' => array('posts', 'Beiträge', 'blog', 'news'),
                        'post_types' => array('page', 'posts'),
                        'align' => false,
                        'mode' => false,
                        'icon' => 'pressthis',
                        'render_template' => 'template-parts/block-posts.php'
                ) );
    }



} );


