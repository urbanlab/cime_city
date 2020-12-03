<?php

function getJSData($fakeData=array()){
    $codeHTML = '<script>';
    $codeHTML .= 'let origine_latitude = ' . $fakeData['Z4FG6']['coordonnées']['latitude'] . ';' . "\n";
    $codeHTML .= 'let origine_longitude = ' . $fakeData['Z4FG6']['coordonnées']['longitude'] . ';' . "\n";
    $codeHTML .= 'let origine_zoom = ' . $fakeData['Z4FG6']['zoom'] . ';' . "\n";
    return $codeHTML . '</script>';
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
    move_uploaded_file($_FILES['photo']['tmp_name'], getcwd() . '/photos/' .basename( $_POST['code'] . '_' . $_FILES['photo']['name']));
    // basename($_FILES['photo']['name'])
}
