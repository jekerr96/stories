<?php


namespace local\db\Story;

use local\db\ElementBase;
use local\Helper;

class Element extends ElementBase {
    protected $rowClass = Row::class;
    protected $tableName = "STORIES";
    protected $selectFields = ["NAME", "PREVIEW", "DETAIL", "PUBLICATION_DATE"];
    protected $relativeTables = ["STORIES_GENRES" => "ID_STORIES"];
    protected $filter = [];

    const READY = 1;
    const MODERATE = 2;
    const DRAFT = 0;

    public function getStoriesWithFilter() {
        $arrInclude = [];
        $arrExclude = [];
        $includeParams = explode(",", $_GET["include"]);
        $excludeParams = explode(",", $_GET["exclude"]);
        $search = $_GET["q"];

        foreach ($includeParams as $item) {
            if (!$item) continue;
            $arrInclude[(int)$item] = $item;
        }

        foreach ($excludeParams as $item) {
            if (!$item) continue;
            $arrExclude[(int)$item] = $item;
        }

        $include = implode(",", $arrInclude);
        $exclude = $arrExclude;

        $storySubquery = new static();
        $includeFilter = "";
        $excludeFilter = "";
        $filter = "";

        if ($include) {
            $includeFilter .= "STORIES_GENRES.ID_GENRES IN ($include)";
        }

        if ($exclude) {
            $subquery = $storySubquery->select([], true)->filter(["STORIES_GENRES.ID_GENRES" => $exclude])->subQuery();
            $excludeFilter .= "STORIES_GENRES.ID_STORIES NOT IN ($subquery)";
        }

        if ($includeFilter && $excludeFilter) {
            $filter .= "$includeFilter AND $excludeFilter";
        } else {
            $filter .= "$includeFilter $excludeFilter";
        }

        if ($search) {
            if ($filter) {
                $filter .= "NAME LIKE '%$search%'";
            } else {
                $filter .= "NAME LIKE '%$search%'";
            }

        }

        $stories = $this->filter(["STRING" => $filter])->page(20, Helper::getCurPage())->getList();

        return $stories;
    }
}