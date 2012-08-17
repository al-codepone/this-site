<?php

function navItems($sections) {
    ob_start();    

    foreach($sections as $section) {
        printf('<li><a href="%s%s">%s</a></li>',
            ROOT, $section['url_id'], $section['link_title']);
    }

    return ob_get_clean();
}

?>
