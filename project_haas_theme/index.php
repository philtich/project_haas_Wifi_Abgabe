<?php /*
  * index Template == default for all (für uns Beitragsseite -> Einstellung lesen)
  * https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>
<?php get_header(); // WordPress Funktion zum Einbinden der header.php ?>


    <main id="content" class="container">
    

        <h1 class="is-style-headline">
            
            
            <?php /*
            * Mit get_option() können die WP Option-Fields abgerufen werden
            * die Option "page_for_posts" liefert die ID der Seite, die als Beiitragsseite eingestellt wurde
            * https://developer.wordpress.org/reference/functions/get_option/
            */
            $pagePosts = get_option('page_for_posts');
            if (!empty($pagePosts)) {
                /* get_the_title() liefert als return den Seitentitel als Parameter kann der Funktion die Post-ID oder das Post-Object übergeben werden */
                echo get_the_title($pagePosts);
            } else {
                /* die WordPress Funktion "bloginfo()" gibt nütliche Informationen zur Website zurück. Über den Parameter 'show' können einzelne Werte ausgegeben werden.
                 * bloginfo('name') gibt den "Titel der Website" (Einstellungen->Allgemein) zurück
                 * https://developer.wordpress.org/reference/functions/bloginfo/
                 */
                bloginfo('name');
            }
            ?></h1>
        <?php /*
            * Zeige die Archiv Beschreibung (Textfeld "Beschreibung" bei Kategorien, Schlagwörtern)
            * https://developer.wordpress.org/reference/functions/the_archive_description/
            */
        the_archive_description('<p>', '</p>'); ?>
        <?php /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge
                * https://developer.wordpress.org/themes/basics/the-loop/
                */
        if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="post">
                    <?php
                    /*  Mit the_title() wird der Beitrags-Titel ausgegeben
                      * https://developer.wordpress.org/reference/functions/the_title/
                      *
                      * sprintf — gibt einen formatierten String zurück
                      * https://www.php.net/manual/en/function.sprintf.php
                      *
                      * esc_url prüft URLs und bereinigt diese (z.B.: Codieren von Leerzeichen)
                      * https://developer.wordpress.org/reference/functions/esc_url/
                      *
                      * the_permalink() gibt die URL zum Beitrag (Detailseite) aus
                      * https://developer.wordpress.org/reference/functions/the_permalink/
                      */
                    the_title(sprintf('<h2 class="post-title"><a href="%s">', esc_url(get_permalink())), '</a></h2>'); ?>
                    <div class="meta">
                        <?php /*
                       * "the_time()" gibt das Veröffentlichkeits-Datum & Zeit aus. Als Parameter übergeben wir das Format als PHP
                       * https://developer.wordpress.org/reference/functions/the_time/
                       * https://www.php.net/manual/de/function.date.php
                       */ ?>
                        <time class="date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'd.m.Y' ); ?></time>
                        <?php /*
                        * "the_category()" gibt alle Kategorien mit Link zum Kategorie-Archiv aus, in die der Beitrag kategorisiert wurde (Chsckbox). Als Parameter übergeben wir den Seperator (was zwischen den Kategorien angezeigt werden soll). In unserem Fall einen Beistrich und ein Leerzeichen (', ')
                        * https://developer.wordpress.org/reference/functions/the_category/
                        */
                        the_category(', '); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <h2><?php _e('Es wurden keine Beiträge gefunden', 'wifi'); ?></h2>
        <?php endif; ?>


        <nav class="pagination">
            <?php /*
                * Pagination in der Beitrags-Übersicht
                * es werden X-Beiträge auf der Beitrags-Übersicht angezeigt, wenn mehr Beiträge vorhanden sind wird die Pagination (Vorherige/Nächste Seite und die Seiten-Nummern) angezeigt
                * wie viele Beiträge pro Seite angezeigt werden, kann im WordPress unter "Einstellungen -> lesen" im Punkt "Blogseiten zeigen maximal X Beiträge", eingestellt werden
                * https://developer.wordpress.org/reference/functions/paginate_links/
                */
            echo paginate_links(array(
                'prev_text' => '<span class="icon-arrow-left" aria-label="' . __('Vorherige Seite', 'wifi') . '"></span>',
                'next_text' => '<span class="icon-arrow-right" aria-label="' . __('Nächste Seite', 'wifi') . '"></span>'
            )); ?>
        </nav>

        
    </main>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php ?>