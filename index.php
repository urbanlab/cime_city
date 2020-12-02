<?php
/**
 * @author : Pierre-Alexandre Racine (pierrealexandreracine -at(@)- gmail -dot(.)- com)
 * @owner : ERASME (https://www.erasme.org/)
 * @copyright : ERASME (https://www.erasme.org/)
 * @license  : ALFERO GPL ( https://www.gnu.org/licenses/agpl-3.0.fr.html )
 * Project : TODO
 * Date: 01/12/2020
 * Time: 09:40
 */

require_once 'lib/upload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$fakeData = array();
$fakeData['Z4FG6']=array(
    'coordonnées'=>array(
        'latitude'=>45.770617010400656,
        'longitude'=>4.828867547445176
    ),
    'zoom'=>15
);


/**
 * L'application est très simple et gère les aspects suivants :
 * - la page a-t-elle reçu une valeur « upload » ? si oui, on affiche un formulaire d'envoi de photo
 * - la page a-t-elle reçu une photo ? si oui, on stocke la photo dans un répertoire normalisé et on renvoie sur la page
 * - la page n'a rien reçu : affichage de la carte avec ses layers (images)
 */

$codeHTML = '<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Canographia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/uploadpicture.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>

</head>

<body>';

// '<!doctype html>
// <html lang="fr">
//     <head>
//         <meta charset="utf-8" />
//         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
//         <title>Cime City</title>
//         <link rel="stylesheet" href="cime_city.css">
//         <link rel="shortcut icon" href="#" /> <!-- virer l erreur favicon sous ff -->
//         <link
//             rel="stylesheet"
//             href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
//             integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
//             crossorigin=""
//             >
//         <!-- Make sure you put this AFTER Leaflet\'s CSS -->
//         <script
//             src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
//             integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
//             crossorigin="">
//         </script>
//     </head>
//     <body>';

//
// mini Controleur d'action
// le parammètre de controle de navigation s'appelle 'nav"
// Le point d'entrée de l'application est donc "index.php?nav=" ou "index.php" ou "index.php?nav=index"

// Traitements
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'upload': 
            stockerImage();
            $codeHTML .= getCarte();
        break;
    }
}

// Navigation
if (isset($_GET['nav'])) {
switch ($_GET['nav']) {
    // case 'image':
    //     $codeHTML .= getFormulaireEnvoi();
    //     break;        
        
    default:
        $codeHTML .= getAccueil();
        break;
    }
} else {
    $codeHTML .= getAccueil();
    
}

// Footer
$codeHTML .='
</body>' . getJSData($fakeData) . '
<script src="cime_city.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/js.js"></script>

</body>
</html>';

// Deliver HTML to browser
echo $codeHTML;