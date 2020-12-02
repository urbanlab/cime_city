<?php

function getJSData($fakeData=array()){
    $codeHTML = '<script>';
    $codeHTML .= 'let origine_latitude = ' . $fakeData['Z4FG6']['coordonnées']['latitude'] . ';' . "\n";
    $codeHTML .= 'let origine_longitude = ' . $fakeData['Z4FG6']['coordonnées']['longitude'] . ';' . "\n";
    $codeHTML .= 'let origine_zoom = ' . $fakeData['Z4FG6']['zoom'] . ';' . "\n";
    return $codeHTML . '</script>';
}


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


function getFormulaireEnvoi(){
    return '
        <div id="logo"></div>
        <div id="title"><h1>Le projet</h1></div>
        <div class="text">
            <p>Canographia est un service de cartographie participative dans le cadre du plan Canopée de la Métropole de Lyon : planter 300 000 arbres d’ici 2030.</p>
        </div>

        <form method="post" enctype="multipart/form-data" action="index.php">
            <div class="cgu">
                <label class="container">
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                    <p>En contribuant à Canographia, vous acceptez que votre carte soit ajoutée à la base de données de la Métropole de Lyon.</p>
                </label>
            </div>
            <div class="send">
                <input type="text" value="Z4FG6" name="codeCarte">
                <input type="hidden" name="action" value="upload">
                <label for="photo">Sélectionnez la photo à envoyer</label>
                <input type="file" id="photo" name="photo" accept="image/png, image/jpeg image/*,.pdf">
                <button>Envoyer</button></div>
            </div>
        </form>
    ';
    // return '
    //     <form method="post" enctype="multipart/form-data" action="index.php">
    //         <label for="photo">Sélectionnez la photo à envoyer</label>
    //         <input type="text" value="Z4FG6" name="codeCarte">
    //         <input type="file" id="photo" name="photo" accept="image/*,.pdf">
    //         <button>Envoyer</button>
    //     </form>';
}


function stockerImage(){
    // todo vérifier taille (en Mb), dimensions, nom (caractères autorisés) type (image, pdf), etc...
    move_uploaded_file($_FILES['photo']['tmp_name'], getcwd() . '/photos/' . basename($_FILES['photo']['name']));
}

function getAccueil() {
    return     
    '
    <!--UI  DE LA PAGE POUR UPLOAD LES PHOTOS -->
  
    <div class="container-screen">
    '. getFormulaireEnvoi() .'
    </div>';
}
