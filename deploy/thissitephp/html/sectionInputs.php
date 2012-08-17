<?php

function sectionInputs($data) {
    $input = function($label, $id) use($data) {
        return sprintf('<div><label for="%2$s">%1$s</label>'
            . '<input type="text" name="%2$s" id="%2$s" value="%3$s"/></div>',
            $label, $id, htmlspecialchars($data[$id]));
    };

    $textarea = function($label, $id) use($data) {
        return sprintf('<div><label for="%2$s">%1$s</label>'
            . '<textarea name="%2$s" id="%2$s">%3$s</textarea></div>',
            $label, $id, htmlspecialchars($data[$id]));
    };

    $displayMode = function() use($data) {
        ob_start();
        $options = array('Show All', 'Hide Link', 'Hide All');
        print '<div id="display_mode"><label>Display Mode</label>';

        for($i = 0; $i < count($options); ++$i) {
            $checked = ($data['display_mode'] == $i + 1) ? ' checked' : '';
            printf('<div><input type="radio" name="display_mode" id="radio%1$d" value="%1$d"%2$s/>'
                . '<label for="radio%1$d">%3$s</label></div>',
                $i + 1, $checked, $options[$i]);
        }

        print '</div>';
        return ob_get_clean();
    };

    return $input('Link Title', 'link_title')
        . $input('URL ID', 'url_id')
        . $input('HTML Title', 'html_title')
        . $textarea('HTML Description', 'html_description')
        . $textarea('Content', 'content')
        . $input('Link Order', 'link_order')
        . $displayMode();
}

?>
