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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$fakeData = array();
$fakeData['Z4FG6']=array(
    'coordonnées'=>array(
        'latitude'=>45.770617010400656,
        'longitude'=>4.828867547445176
    )
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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Cime City</title>
        <link rel="stylesheet" href="cime_city.css">
        <link rel="shortcut icon" href="#" /> <!-- virer l erreur favicon sous ff -->
        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin=""/
            >
        <!-- Make sure you put this AFTER Leaflet\'s CSS -->
        <script
            src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin="">
        </script>
    </head>
    <body>';


if( isset($_GET['envoi']) && $_GET['envoi']=='image' ){ // A-t-on reçu une demande formulaire ?
    // C'est une demande d'envoi de formulaire
    $codeHTML .= getFormulaireEnvoi();
} elseif ( isset($_FILES['photo'])){ // A-t-on reçu une photo ?
    stockerImage();
    $codeHTML .= getCarte();
} else {
    $codeHTML .= getCarte();
}


echo $codeHTML .= '
    </body>
    <script src="cime_city.js"></script>
</html>';



function getCarte(){
    $code = '<div id="blocPrincipal">';
    $code .= '<div class="canevas" id="emplacement_image"></div>';
    $code .= '<div class="canevas" id="carte_cime_city" ></div>';
    $code .= '</div>';
    return $code . getInterface();
}

function getInterface(){
    /*
     * L'interface va chercher la liste des photos et un clic sur un objet de la liste mettra la photo  à la pace de
     * la carte.
     */
    $listePhotos = array('retour à la carte'); // élément toujours présent.
    $photos = scandir(getcwd() . '/photos/');
    foreach ($photos as $photo){
        if ($photo!='.' && $photo!= '..'){
            array_push($listePhotos, $photo);
        }
    }
    $code = '<div id="interface"><ul>';

    foreach ($listePhotos as $nomPhoto){
        $code.= '<li 
        class="nom_photo"
        id="' . $nomPhoto . '"
        onclick="modifierCanevas(this.id);"
        >' . ($nomPhoto==='retour à la carte'?'retour à la carte':pathinfo($nomPhoto)['filename'])  . '</li>';
    }
    return $code.= '</ul></div>';
}

function stockerImage(){
    // todo vérifier taille (en Mb), dimensions, nom (caractères autorisés) type (image, pdf), etc...
    move_uploaded_file($_FILES['photo']['tmp_name'], getcwd() . '/photos/' . basename($_FILES['photo']['name']));
}

function getFormulaireEnvoi(){
    return '
        <form method="post" enctype="multipart/form-data" action="index.php">
            <label for="photo">Sélectionnez la photo à envoyer</label>
            <input type="text" value="Z4FG6" name="codeCarte">
            <input type="file" id="photo" name="photo" accept="image/*,.pdf">
            <button>Envoyer</button>
        </form>';
}