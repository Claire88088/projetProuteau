// création de la carte avec un fond de carte OSM
let myMap = L.map('mapid').setView([46.580224, 0.340375], 13);







var divAdresses = document.querySelectorAll('.adresses');
/*

overlayMaps = {
    "Travaux" (string) : travaux (objet de type layerGroup)
}

 */

var overlayMaps = {};

var divCalques = document.getElementById('calquesTab');
var infosCalquesJSON = divCalques.getAttribute('calques');
var infosCalquesArray = JSON.parse(infosCalquesJSON);
var nomCalque = infosCalquesArray[0];

console.log(nomCalque)

//var layersInTitleLayer = "";
/*
for (var i = 0; i<infosCalquesArray.length; i++) {
    overlayMaps[infosCalquesArray[i]]=infosCalquesArray[i];
    if (i != (infosCalquesArray-1)) {
        layersInTitleLayer += infosCalquesArray[i];
        layersInTitleLayer += ","
    }
    else {
        layersInTitleLayer += infosCalquesArray[i];
    }
}
*/
/*
L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20,

    layers: [layersInTitleLayer]
}).addTo(myMap);
*/

// on créé des marqueurs
var maison = L.marker([46.580224, 0.340375]);

// on créé un layerGroup = groupe de calque  regroupant les marqueurs
//var cities = L.layerGroup([maison]);
/*
for (var i = 0; i<infosCalquesArray.length; i++) {
    // on récupère le nom de la propriété du overlayMaps
    infosCalqueString = infosCalquesArray[i]
        // on créé un layerGroup = groupe de calque  regroupant les marqueurs qui sera la valeur du overlayMaps (ce sera d'ailleurs un objet)
    var objet = L.layerGroup([maison]);

    // on ajoute ce layerGroup à un overlayMaps
    //overlayMaps[infosCalquesArray[i]]=infosCalquesArray[i];
    overlayMaps += objet;

    // on créé la variable du TitleLayer
    /*if (i != (infosCalquesArray-1)) {
        layersInTitleLayer += infosCalquesArray[i];
        layersInTitleLayer += ","
    }
    else {
        layersInTitleLayer += infosCalquesArray[i];
    }
    console.log(layersInTitleLayer);*/
/*}
*/

// on créé un layerGroup = groupe de calque  regroupant les marqueurs
var myLayerGroup = L.layerGroup([maison]);

// on ajoute ce layerGroup à un overlayMaps
overlayMaps[nomCalque] = myLayerGroup;
console.log(overlayMaps);


// on ajoute le overlayMaps = superposition de cartes à la couche contrôle qu'on ajoute à la carte


L.control.layers(null, overlayMaps).addTo(myMap);


L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20,
    maxZoom: 20,
    //layers: [Travaux, Autoroute]
    //layers: [layersInTitleLayer]
}).addTo(myMap);