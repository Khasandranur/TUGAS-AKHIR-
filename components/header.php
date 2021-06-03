<?php

require_once(__DIR__ . '/../helper/factory.php');
require_once(__DIR__ . '/../helper/url.php');

$movies = Factory::getMovies();
$request = URLHelper::getMovieRequest();
$genres = array();
$years = array();

foreach ($movies as $movie) {
    if (!in_array($movie->genre, $genres)) $genres[] = $movie->genre;
    if (!in_array($movie->year, $years)) $years[] = $movie->year;
}
?>
<nav class="navbar navbar-expand-lg navbar-light pt-3 pb-3 ps-2 ps-lg-5 pe-2 pe-lg-5">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse pt-3 pt-lg-0" id="navbarNavDropdown">
            <a class="navbar-brand" href="/daftar-film">
                <img src="./assets/favicon.png" class="pb-1" /><span class="ms-2 text-xl link">Waroenk Film</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown ms-4">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= empty($request->genre) ? 'Pilih Genre' : $request->genre ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach ($genres as $genre) : ?>
                            <li><a class="dropdown-item" href="/daftar-film?genre=<?= $genre ?>&year=<?= $request->year ?>"><?= $genre ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item dropdown ms-4">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= empty($request->year) ? 'Pilih Tahun' : $request->year ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach ($years as $year) : ?>
                            <li><a class="dropdown-item" href="/daftar-film?genre=<?= $request->genre ?>&year=<?= $year ?>"><?= $year ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>