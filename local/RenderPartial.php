<?php


namespace local;


class RenderPartial {
    public function render($file, $params) {
        foreach ($params as $key => $param) {
            $this->$key = $param;
        }

        require $_SERVER["DOCUMENT_ROOT"] . $file;
    }
}