<?php

function getHeader() {
  return '<!doctype html>
  <html lang="fr">
  <head>
  <meta charset="utf-8">
  <title>Canographia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
  </head>
  <body>
  <div id="logo"></div>
  <div id="title"><h1>Le projet</h1></div>
  <div class="text">
  <p>Canographia est un service de cartographie participative dans le cadre du plan Canopée de la Métropole de Lyon : planter 300 000 arbres d’ici 2030.</p>
  </div>
  ';
}

function getFooter($fakeData) {
  return '
  </body>' . getJSData($fakeData) . '
  <script src="cime_city.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery-ui.js"></script>
  <script type="text/javascript" src="js/js.js"></script>
  <script src="js/map-functions.js"></script>
  </html>';
}

function getAccueil() {
  return
  '
  <!--UI  DE LA PAGE POUR UPLOAD LES PHOTOS -->
  <div class="container-screen">
  '. getFormulaireEnvoi() .'
  </div>';
}

function getCarte(){
  $code = '
  <div id = "map" style="width:100vw; height: 80vh"></div>

  <div id="coords" style="width:90vw; margin: 10px 10% 0 10%; border: solid black 1px; padding: 3%">
  <div id="gps"></div><br>
  <div id="code"></div><br>
  <button id="imprimer" style="display:none;">Imprimer</button>
  </div>
  ';
  return $code . getInterface();
}

function getFormulaireEnvoi(){
  return '
  <form method="post" enctype="multipart/form-data" action="index.php">
  <div class="cgu">
  <label class="container">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
  <p>En contribuant à Canographia, vous acceptez que votre carte soit ajoutée à la base de données de la Métropole de Lyon.</p>
  </label>
  </div>
  <div class="send">
  <input type="text" value="Z4FG6" name="code">
  <input type="hidden" name="action" value="upload">
  <label for="photo">Sélectionnez la photo à envoyer</label>
  <input type="file" id="photo" name="photo" accept="image/png, image/jpeg image/*,.pdf">
  <button>Envoyer</button>
  </div>
  </form>
  ';
}

function getMessageOk(){
  return "<div id='feedback'><p>Votre photo a été ajoutée à la carte</p></div>";
}
