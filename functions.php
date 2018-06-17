<?php
function renderTemplate($link, $array) {
    $content = "";
    if(file_exists($link)) {
        extract($array);
        ob_start();
        require_once $link;
        $content = ob_get_clean();
        return $content;
    }

    return $content;
}
;?>