<?php


namespace local;


class Helper {
    public static function render($partial, array $params) {
        $renderer = static::getRenderer();
        $renderer->render($partial, $params);
    }

    public static function getUrl($params = []) {
        $query = array_merge($_GET, $params);

        foreach ($query as $key => $item) {
            if (!$item) unset($query[$key]);
        }

        $uriParams = "";

        if ($query) {
            $uriParams = "?" . http_build_query($query);
        }

        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . $uriParams;
    }

    /**
     * @param string $name
     * @return int
     */
    public static function getCurPage($name = "page") {
        return (int)$_GET[$name] ?: 1;
    }

    private static function getRenderer() {
        return new RenderPartial();
    }
}