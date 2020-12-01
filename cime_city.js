/**
 * @author : Pierre-Alexandre Racine (pierrealexandreracine -at(@)- gmail -dot(.)- com)
 * @owner : ERASME (https://www.erasme.org/)
 * @copyright : ERASME (https://www.erasme.org/)
 * @license  : ALFERO GPL ( https://www.gnu.org/licenses/agpl-3.0.fr.html )
 */

/***********************************************************************************************************************
 *                                              GESTION DE LA CARTE
 **********************************************************************************************************************/
// On crée une carte que l'on centre et zoome sur la région lyonnaise.
let mymap = L.map('carte_cime_city').setView([45.770617010400656, 4.828867547445176], 15);

L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '<a href="https://www.openstreetmap.org/">OpenStreetMap</a> | ' +
        '<a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox.streets'
}).addTo(mymap);

/***********************************************************************************************************************
 *                                              CODE GÉNÉRALISTE
 **********************************************************************************************************************/

/**
 * Modifie le contenu principal et le remplace soit par la carte, soit par une image.
 * @param idPhoto
 */
function modifierCanevas(idPhoto=''){
    if(idPhoto==='retour à la carte'){
        document.getElementById('emplacement_image').style.display = 'None';
        document.getElementById('carte_cime_city').style.display = 'Block';
    } else {
        document.getElementById('carte_cime_city').style.display = 'None';
        document.getElementById('emplacement_image').style.display = 'Block';
        document.getElementById('emplacement_image').style.backgroundImage = "url('photos/" + idPhoto + "')";
    }
}