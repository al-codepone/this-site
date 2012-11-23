<?php

require_once(CITYPHP . 'html/radio.php');

function displayMode($value) {
    ob_start();
    $options = array('Show All', 'Hide Link', 'Hide All');
    print '<div id="display_mode"><label>Display Mode</label>';

    foreach($options as $i => $option) {
        print radio($option, 'display_mode', "dmradio$i", $i + 1, $value == $i + 1);
    }

    print '</div>';
    return ob_get_clean();
}

?>
