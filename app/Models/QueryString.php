<?php

namespace App\Models;

class QueryString
{
    public $search;
    public $direction;
    public $active;
    public $pageIndex = 0;
    public $pageSize = 10;

    public function __construct(
        string $search = null,
        string $direction = null,
        string $active = null,
        int $pageIndex = null,
        int $pageSize = null
    ) {
        $this->search = $search;
        $this->direction = $direction;
        $this->active = $active;
        $this->pageIndex = $pageIndex;
        $this->pageSize = $pageSize;
    }
}
