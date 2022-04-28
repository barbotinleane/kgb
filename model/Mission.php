<?php

require_once ('Model.php');

class Mission
{
    use Model;

    private string $id;
    private string $title;

    public function __construct($title) {
        $this->title = $title;
    }
}