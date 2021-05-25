<?php

class URLHelper
{
    public static function getMovieRequest()
    {
        return new MovieRequest(empty($_GET["genre"]) ? '' : $_GET["genre"], empty($_GET["year"]) ? '' : $_GET["year"]);
    }
}

class MovieRequest
{
    public $genre = '';
    public $year = '';

    public function __construct(string $genre, string $year)
    {
        if (!empty(trim($genre))) $this->genre = str_replace('genre=', '', trim($genre));
        if (!empty(trim($year))) $this->year = (int)str_replace('year=', '', trim($year));
    }
}
