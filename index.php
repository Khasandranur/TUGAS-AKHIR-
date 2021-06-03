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
     <title>Waroenk Film</title>
     <link rel="icon" href="./assets/favicon.png" type="image/png" />
     <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
     <style>
          .navbar-brand {
               font-weight: bold;
          }

          .card-title {
               font-weight: 700;
          }

          .card-body {
               font-weight: 350;
          }

          .link {
               color: #6366F1;
               transition: 0.5 ease !important;
               text-decoration: none;
          }

          .link:hover {
               color: #484cad;
          }

          .card .card-img-top {
               height: 20rem;
          }

          .card-icon {
               width: 1rem;
               padding-bottom: 0.1rem;
          }

          .empty-hint {
               font-size: 1.1rem;
               font-weight: 350;
          }
     </style>
</head>

<body>
     <?php include './components/header.php' ?>
     <div class="container">
          <div class="row row-cols-1 row-cols-lg-4 g-5 pt-2 pb-4 ps-4 pe-4">
               <?php foreach ($movies as $movie) : ?>
                    <?php
                    if ((!empty($request->genre) && !empty($request->year)) && ($movie->genre != $request->genre || $movie->year != $request->year)) continue;
                    if (!empty($request->genre) && $movie->genre != $request->genre && empty($request->year)) continue;
                    if (empty($request->genre) && !empty($request->year) && $movie->year != $request->year) continue;
                    $emptySearch = false;
                    ?>
                    <div class="col d-flex justify-content-center">
                         <div class="card" style="width: 18rem;">
                              <img src="<?= $movie->thumbnail ?>" class="card-img-top img-fluid" alt="<?= $movie->title ?>">
                              <div class="card-body">
                                   <h5 class="card-title"><?= strlen($movie->title) > 22 ? substr($movie->title, 0, 22) . '...' : $movie->title ?></h5>
                                   <p class="card-text"><?= strlen($movie->description) > 120 ? substr($movie->description, 0, 120) . '...' : $movie->description ?></p>
                                   <div class="row">
                                        <div class="col">
                                             <a class="link d-flex items-center" href="<?= $movie->link ?>" rel="noreferrer noopener" target="_blank">Selengkapnya
                                                  <svg class="card-icon ms-1 mt-1" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                       <path d="M5 12h14"></path>
                                                       <path d="M12 5l7 7-7 7"></path>
                                                  </svg>
                                             </a>
                                        </div>
                                        <div class="col text-end">
                                             <span class="inline-flex items-center font-monospace">
                                                  <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                       <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                       <line x1="16" y1="2" x2="16" y2="6"></line>
                                                       <line x1="8" y1="2" x2="8" y2="6"></line>
                                                       <line x1="3" y1="10" x2="21" y2="10"></line>
                                                  </svg><small class="ms-1"><?= $movie->year ?></small>
                                             </span>
                                             <span class="inline-flex items-center font-monospace">
                                                  <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                       <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                  </svg><small class="ms-1"><?= $movie->rating ?></small>
                                             </span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               <?php endforeach; ?>
          </div>
          <?php if (empty($movie) || $emptySearch) : ?>
               <div class="mt-5 text-center empty-hint">
                    <span>😥 Maaf, kami tidak dapat menemukan film apapun...</span>
               </div>
          <?php endif; ?>
     </div>
</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js" integrity="sha512-sH8JPhKJUeA9PWk3eOcOl8U+lfZTgtBXD41q6cO/slwxGHCxKcW45K4oPCUhHG7NMB4mbKEddVmPuTXtpbCbFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>