<?php get_header(); // WordPress Funktion zum Einbinden der header.php  ?>
    <main id="content" class="container">
        <?php
        /* Mit the_title() wird der Beitrags-Titel ausgegeben
         * https://developer.wordpress.org/reference/functions/the_title/
         */
        the_title('<h1 class="is-style-headline">', '</h1>');
        ?>
        <div class="meta">
            <?php /*
            * "the_time()" gibt das Veröffentlichkeits-Datum & Zeit aus. Als Parameter übergeben wir das Format als PHP
            * https://developer.wordpress.org/reference/functions/the_time/
            * https://www.php.net/manual/de/function.date.php
            */ ?>
            <time class="date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('d.m.Y'); ?></time>
            <?php /*
            * "the_category()" gibt alle Kategorien mit Link zum Kategorie-Archiv aus, in die der Beitrag kategorisiert wurde (Chsckbox). Als Parameter übergeben wir den Seperator (was zwischen den Kategorien angezeigt werden soll). In unserem Fall einen Beistrich und ein Leerzeichen (', ')
            * https://developer.wordpress.org/reference/functions/the_category/
            */
            the_category(', '); ?>
        </div>
        <?php /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge
        * https://developer.wordpress.org/themes/basics/the-loop/
        */
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content(); // gibt den gesamten Inhalt des Editors aus
            }
        }

        /*
         * "the_tags()" gibt alle Schlagwörter mit Link zum Schlagwort-Archiv aus, die im Beitrag getagged wurden. Als Parameter übergeben wir "before" (was vor der Schlagwort-Ausgabe stehen soll), den "Seperator" (was zwischen den Schlagwörtern angezeigt werden soll) und "after" (was nach der Schlagwortausgabe stehen soll)
         * https://developer.wordpress.org/reference/functions/the_tags/
         */
        the_tags('<div class="meta tags">#', ' #', '</div>');
        ?>

    </main>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php
