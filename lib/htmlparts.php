<?php

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