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

/**
 * L'application gère les aspects suivants :
 * - la page a-t-elle reçu une valeur « upload » ? si oui, on affiche un formulaire d'envoi de photo
 * - la page a-t-elle reçu une photo ? si oui, on stocke la photo dans un répertoire normalisé et on renvoie sur la page
 * - la page n'a rien reçu : affichage de la carte avec ses layers (images)
 */

