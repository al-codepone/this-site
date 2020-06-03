<?php

function page_inputs(array $data) {
    return
    c\dlinput(
        'Link Title',
        array(
            'id' => 'link_title',
            'value' => $data['link_title'])) .

    c\dlinput(
        'URL ID',
        array(
            'id' => 'url_id',
            'value' => $data['url_id'])) .

    c\dlinput(
        'HTML Head Title',
        array(
            'id' => 'html_title',
            'value' => $data['html_title'])) .

    c\dltextarea(
        'HTML Meta Description',
        array('id' => 'html_description'),
        $data['html_description']) .

    c\dltextarea(
        'HTML Meta Keywords',
        array('id' => 'html_keywords'),
        $data['html_keywords']) .

    c\dltextarea(
        'Page Content',
        array('id' => 'page_content'),
        $data['page_content']) .

    c\dlinput(
        'Link Order',
        array(
            'id' => 'link_order',
            'value' => $data['link_order'])) .

    c\dsradio_buttons(
        'Display Mode',
        'display_mode',
        array(1 => 'Show All', 'Hide Link', 'Hide All'),
        $data['display_mode']);
}

function page_updated($page_id, $url_id) {
    return
        '<div class="success">Page updated</div>' .
        c\ulist(
            c\hlink(ROOT . $url_id, 'View Page'),
            c\hlink(EDIT_PAGE . $page_id, 'Edit Page'));
}

function cms_navs($pages, $current_page_id, $is_new_page) {
    list($list_items, $select_options, $selected_value)
        = nav_elements($pages, $current_page_id, EDIT_PAGE, 'page_id', true);

    $new_page_link = c\a(
        array_merge(
            current_link($is_new_page),
            array('href' => NEW_PAGE)),
        NEW_PAGE_TITLE);

    $list_items = array_merge(
        array($new_page_link => array('id' => 'new_page')),
        $list_items);

    $select_options = array_merge(
        array(NEW_PAGE => NEW_PAGE_TITLE),
        $select_options);

    if($is_new_page) {
        $selected_value = NEW_PAGE;
    }

    //
    $list_nav = c\div(
        ['id' => 'nav'],
        c\ulist($list_items));

    //
    $select_nav = IS_ALT_NAV
        ? c\div(
            ['id' => 'alt-nav'],
            c\drop_down(
                $select_options,
                array('onchange' => 'pageSelected(this);'),
                $selected_value))

        : '';

    //
    return array(
        $list_nav,
        $select_nav);
}

function current_link($is_current) {
    return $is_current ?  array('id' => 'current_link') : array();
}

function edit_page(array $form_data, $current_page, $errors = array()) {
    return
    c\form(
        array('method' => 'post', 'id' => 'page_form'),
        '<input type="hidden" name="delete_flag" value="0"/>',
        c\ulist($errors, array('class' => 'error')),
        c\div(c\hlink(
            ROOT . $current_page['url_id'],
            'View Page')),

        page_inputs($form_data),
        c\div(
            '<input type="submit" value="Save"/>',
            '<input type="button" value="Delete" onclick="deletePage();"/>'));
}

function nav_elements($pages, $current_page_id, $base_url, $key, $force_show = false) {
    $list_items = array();
    $select_options = array();
    $selected_value = null;

    foreach($pages as $page) {
        $is_current = ($page['page_id'] == $current_page_id);
        $url = $base_url . $page[$key];

        if($force_show || $page['display_mode'] == 1) {
            $list_items[] = c\a(
                array_merge(
                    current_link($is_current),
                    array('href' => $url)),
                $page['link_title']);

            $select_options[$url] = $page['link_title'];

            if($is_current) {
                $selected_value = $url;
            }
        }

        if($is_current) {
            $current_title = $page['link_title'];
            $current_url = $url;
        }
    }

    if(is_null($selected_value) && !is_null($current_title)) {
        $select_options[$current_url] = $current_title;
        $selected_value = $current_url;
    }

    return array($list_items, $select_options, $selected_value);
}

function navs($pages, $current_page_id) {
    list($list_items, $select_options, $selected_value)
        = nav_elements($pages, $current_page_id, ROOT, 'url_id');

    //
    $list_nav = count($list_items) > 1
        ? c\div(['id' => 'nav'], c\ulist($list_items))
        : '';

    //
    $select_nav = (count($select_options) > 1) && IS_ALT_NAV
        ? c\div(
            ['id' => 'alt-nav'],
            c\drop_down(
                $select_options,
                array(
                    'onchange' => 'pageSelected(this);',
                    'id' => 'select-nav'),
                $selected_value))

        : '';

    //
    return array(
        $list_nav,
        $select_nav);
}

function new_page(array $form_data, $errors = array()) {
    return c\form(
        array('method' => 'post'),
        c\ulist($errors, array('class' => 'error')),
        page_inputs($form_data),
        c\div('<input type="submit" value="Create New Page"/>'));
}

function new_page_created($page_id, $url_id) {
    return
        '<div class="success">New page created</div>' .
        c\ulist(
            c\hlink(ROOT . $url_id, 'View Page'),
            c\hlink(EDIT_PAGE . $page_id, 'Edit Page'),
            c\hlink(NEW_PAGE, NEW_PAGE_TITLE));
}

function head(array $data) {
    $title = $data['html_title'] !== ''
        ? c\title(c\esc($data['html_title']))
        : '';

    $desc = $data['html_description'] !== ''
        ? '<meta name="description" content="' . c\esc($data['html_description']) . '"/>'
        : '';

    $keywords = $data['html_keywords'] !== ''
        ? '<meta name="keywords" content="' . c\esc($data['html_keywords']) . '"/>'
        : '';

    return $title . $desc . $keywords;
}

function avoid_select_nav_cache($url_id) {
    return c\script('
        var selectNav = document.getElementById("select-nav");
        selectNav.value = ' . json_encode(ROOT . $url_id) . ';');
}

function logos() {
    ob_start();
    
    if(IS_LOGO) { ?>

<div id="logo"><a href="<?=ROOT?>"><img src="<?=IMG?>logo.png" width="<?=LOGO_WIDTH?>" height="<?=LOGO_HEIGHT?>"/></a></div>

    <?php }

    if(IS_ALT_LOGO) { ?>

<div id="alt-logo"><a href="<?=ROOT?>"><img src="<?=IMG?>alt-logo.png" width="<?=ALT_LOGO_WIDTH?>" height="<?=ALT_LOGO_HEIGHT?>"/></a></div>

    <?php }

    return ob_get_clean();
}
