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
require_once 'lib/htmlparts.php';

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

$codeHTML = getHeader();

//
// mini Controleur d'action
// le parammètre de controle de navigation s'appelle 'nav"
// Le point d'entrée de l'application est donc "index.php?nav=" ou "index.php" ou "index.php?nav=index"

// Traitements
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'upload': 
            stockerImage();
            $codeHTML .= getMessageOk();
            $_GET['nav'] = "";
        break;
    }
}

// Navigation
if (isset($_GET['nav'])) {
switch ($_GET['nav']) {
    case 'carte':
        $codeHTML .= getCarte();
        break;        
        
    default:
        // $codeHTML .= getAccueil();
        break;
    }
} else {
    if(!isset($_POST['action']) || $_POST['action'] == "") {
        $codeHTML .= getAccueil();
    }
}

// Footer
$codeHTML .= getFooter($fakeData);

// Deliver HTML to browser
echo $codeHTML;