<?php

require_once(THIS_SITE_PHP . 'database/SectionData.php');
require_once(THIS_SITE_PHP . 'html/navigation/Navigation.php');

class DefaultNavigation extends Navigation {
    public function draw() {
        $ob = '<ul>';

        foreach($this->getSections() as $section) {
            if($section->display_mode == 1) {
                $ob .= sprintf('<li>%s</li>', $this->getSectionLink($section));
            }
        }

        $ob .= '</ul>';
        return $ob;
    }

    protected function getSectionUrl(SectionData $sectionData) {
        return ROOT . $sectionData->url_id;
    }
}

?>
