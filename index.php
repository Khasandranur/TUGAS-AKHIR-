<?php

require_once(__DIR__ . './helper/factory.php');
require_once(__DIR__ . './helper/url.php');

$emptySearch = true;
$movies = Factory::getMovies();
$request = URLHelper::getMovieRequest();

?>

<!DOCTYPE HTML>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Daftar Film</title>
     <link rel="icon" href="./assets/favicon.png" type="image/png" />
     <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.2/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
     <style>
          li>ul {
               transform: translatex(100%) scale(0)
          }

          li:hover>ul {
               transform: translatex(101%) scale(1)
          }

          li>button svg {
               transform: rotate(-90deg)
          }

          li:hover>button svg {
               transform: rotate(-270deg)
          }

          .group:hover .group-hover\:scale-100 {
               transform: scale(1)
          }

          .group:hover .group-hover\:-rotate-180 {
               transform: rotate(180deg)
          }

          .scale-0 {
               transform: scale(0)
          }

          .min-w-32 {
               min-width: 8rem
          }

          .link {
               color: #6366F1;
               transition: 0.5 ease !important;
          }

          .link:hover {
               color: #484cad;
          }

          .item-link:hover {
               cursor: pointer;
          }
     </style>
</head>

<body>
     <?php include './components/header.php' ?>
     <section class="text-gray-600 body-font">
          <div class="container px-3 mx-auto mb-3">
               <div class="flex flex-wrap">
                    <?php foreach ($movies as $movie) : ?>
                         <?php
                         if ((!empty($request->genre) && !empty($request->year)) && ($movie->genre != $request->genre || $movie->year != $request->year)) continue;
                         if (!empty($request->genre) && $movie->genre != $request->genre && empty($request->year)) continue;
                         if (empty($request->genre) && !empty($request->year) && $movie->year != $request->year) continue;
                         $emptySearch = false;
                         ?>
                         <div class="p-4 md:w-1/4">
                              <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                   <img class="lg:h-60 md:h-36 w-full object-cover object-center" src="<?= $movie->thumbnail ?>" alt="blog">
                                   <div class="p-6">
                                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1"><?= $movie->genre ?></h2>
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3"><?= $movie->title ?></h1>
                                        <p class="leading-relaxed mb-3"><?= strlen($movie->description) > 150 ? substr($movie->description, 0, 150) . '...' : $movie->description ?></p>
                                        <div class="flex items-center flex-wrap ">
                                             <a class="link inline-flex items-center md:mb-2 lg:mb-0" href="<?= $movie->link ?>" rel="noreferrer noopener" target="_blank">Selengkapnya
                                                  <svg class="w-4 h-4 ml-2 mt-1" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                       <path d="M5 12h14"></path>
                                                       <path d="M12 5l7 7-7 7"></path>
                                                  </svg>
                                             </a>
                                             <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                                  <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                       <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                       <line x1="16" y1="2" x2="16" y2="6"></line>
                                                       <line x1="8" y1="2" x2="8" y2="6"></line>
                                                       <line x1="3" y1="10" x2="21" y2="10"></line>
                                                  </svg><?= $movie->year ?>
                                             </span>
                                             <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                                  <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                       <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                  </svg><?= $movie->rating ?>
                                             </span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
               <?php if (empty($movie) || $emptySearch) : ?>
                    <div class="mt-4 text-center text-lg">
                         <span>😥 Maaf, kami tidak dapat menemukan film apapun...</span>
                    </div>
               <?php endif; ?>
     </section>
</body>

</html>