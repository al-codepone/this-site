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

function page_updated($pageID, $urlID) {
    return
        '<div class="success">Page updated</div>' .
        c\ulist(
            c\hlink(ROOT . $urlID, 'View Page'),
            c\hlink(EDIT_PAGE . $pageID, 'Edit Page'));
}

function cms_navs($pages, $currentPageID, $isNewPage) {
    list($listItems, $selectOptions, $selectedValue)
        = nav_elements($pages, $currentPageID, EDIT_PAGE, 'page_id', true);

    $newPageLink = c\a(
        array_merge(
            current_link($isNewPage),
            array('href' => NEW_PAGE)),
        NEW_PAGE_TITLE);

    $listItems = array_merge(
        array($newPageLink => array('id' => 'new_page')),
        $listItems);

    $selectOptions = array_merge(
        array(NEW_PAGE => NEW_PAGE_TITLE),
        $selectOptions);

    if($isNewPage) {
        $selectedValue = NEW_PAGE;
    }

    return array(
        c\ulist($listItems),
        c\drop_down(
            $selectOptions,
            array('onchange' => 'pageSelected(this);'),
            $selectedValue));
}

function current_link($isCurrent) {
    return $isCurrent ?  array('id' => 'current_link') : array();
}

function edit_page(array $formData, $currentPage, $errors = array()) {
    return
    c\form(
        array('method' => 'post', 'id' => 'page_form'),
        '<input type="hidden" name="delete_flag" value="0"/>',
        c\ulist($errors, array('class' => 'error')),
        c\div(c\hlink(
            ROOT . $currentPage['url_id'],
            'View Page')),

        page_inputs($formData),
        c\div(
            '<input type="submit" value="Save"/>',
            '<input type="button" value="Delete" onclick="deletePage();"/>'));
}

function nav_elements($pages, $currentPageID, $baseURL, $key, $forceShow = false) {
    $listItems = array();
    $selectOptions = array();
    $selectedValue = null;

    foreach($pages as $page) {
        $isCurrent = ($page['page_id'] == $currentPageID);
        $url = $baseURL . $page[$key];

        if($forceShow || $page['display_mode'] == 1) {
            $listItems[] = c\a(
                array_merge(
                    current_link($isCurrent),
                    array('href' => $url)),
                $page['link_title']);

            $selectOptions[$url] = $page['link_title'];

            if($isCurrent) {
                $selectedValue = $url;
            }
        }

        if($isCurrent) {
            $currentTitle = $page['link_title'];
            $currentURL = $url;
        }
    }

    if(is_null($selectedValue) && !is_null($currentTitle)) {
        $selectOptions[$currentURL] = $currentTitle;
        $selectedValue = $currentURL;
    }

    return array($listItems, $selectOptions, $selectedValue);
}

function navs($pages, $currentPageID) {
    list($listItems, $selectOptions, $selectedValue)
        = nav_elements($pages, $currentPageID, ROOT, 'url_id');

    return array(
        c\ulist($listItems),
        c\drop_down(
            $selectOptions,
            array('onchange' => 'pageSelected(this);'),
            $selectedValue));
}

function new_page(array $formData, $errors = array()) {
    return c\form(
        array('method' => 'post'),
        c\ulist($errors, array('class' => 'error')),
        page_inputs($formData),
        c\div('<input type="submit" value="Create New Page"/>'));
}

function new_page_created($pageID, $urlID) {
    return
        '<div class="success">New page created</div>' .
        c\ulist(
            c\hlink(ROOT . $urlID, 'View Page'),
            c\hlink(EDIT_PAGE . $pageID, 'Edit Page'),
            c\hlink(NEW_PAGE, NEW_PAGE_TITLE));
}

function head(array &$data) {
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
