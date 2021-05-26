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

<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="/daftar-film">
            <img class="ml-3" src="../assets/favicon.png" /><span class="ml-2 text-xl link">Daftar Film</span>
        </a>
        <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400 flex flex-wrap items-center text-base justify-center mt-1">
            <span>
                <div class="group inline-block">
                    <button class="outline-none focus:outline-none px-3 py-1 bg-white rounded-sm flex items-center min-w-32">
                        <span class="pr-1 font-semibold flex-1">
                            <?= empty($request->genre) ? 'Pilih Genre' : $request->genre ?>
                        </span>
                        <span>
                            <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </button>
                    <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32">
                        <?php foreach ($genres as $genre) : ?>
                            <a href="/daftar-film?year=<?= $request->year ?>&genre=<?= $genre ?>">
                                <li class="item-link rounded-sm px-3 py-1 hover:bg-gray-100"><?= $genre ?></li>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </span>
            <span>
                <div class="group inline-block">
                    <button class="outline-none focus:outline-none px-3 py-1 bg-white rounded-sm flex items-center min-w-32">
                        <span class="pr-1 font-semibold flex-1">
                            <?= empty($request->year) ? 'Pilih Tahun' : $request->year ?>
                        </span>
                        <span>
                            <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </button>
                    <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32">
                        <?php foreach ($years as $year) : ?>
                            <a class="w-100" href="/daftar-film?year=<?= $year ?>&genre=<?= $request->genre ?>">
                                <li class="item-link rounded-sm px-3 py-1 hover:bg-gray-100"><?= $year ?></li>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </span>
        </nav>
    </div>
</header>