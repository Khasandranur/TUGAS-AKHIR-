<?php

class Factory
{
    public static function getMovies()
    {
        return json_decode(file_get_contents(__DIR__ . '/../data/movies.json'));
    }
}
