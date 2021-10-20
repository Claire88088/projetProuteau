// création de la carte avec un fond de carte OSM
let myMap = L.map('mapid').setView([46.580224, 0.340375], 13);

L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20,
    layers: []
}).addTo(myMap);





var adr = document.querySelectorAll('.adresses');
var adresses = adr.forEach(function(adrs) {
    adrs2 = adrs.attributes[1].value
    console.log(adrs2);
});

var overlayMaps = [];

var clq = document.querySelectorAll('.calques');
for (let i = 0; i < clq.length; i++) {
    clqs = clq[i].attributes[1].value;
    console.log(clqs);

     overlayMaps[i] = clqs;
}
console.log(overlayMaps);

L.control.layers(null, overlayMaps).addTo(myMap);


