let krokIndex = 1;
let pole = ['',
    '../../../Obrazky/VF1.png',
    '../../../Obrazky/VF2.png',
    '../../../Obrazky/VF3.png',
    '../../../Obrazky/VF4.png',
    '../../../Obrazky/VF5.png',
    '../../../Obrazky/VF6.png',
    '../../../Obrazky/VF7.png',
    '../../../Obrazky/VF8.png'];
let poleText = ['',
    'Na farmu potrebujeme:',
    'Postavíme 12X12 štvorec, Tip. Výpočty sa dajú robiť pomocou faklí (torch), tak ako na obrázku',
    'Výška stavby je 4 blocky',
    'Do rámu vložíme dvere',
    'Do vnutra za dverami postavime blocky, a do trávy vložíme vodu ako na obrazku aby bola rovnomerne zavlchčená zem.',
    'Na vodu položime koberce aby sa villigari, nezasekli vo vode',
    'Zasadíme semiačka',
    'Na záver môžme dať na vrch sklo aby bolo vidno dnu, či farma funguje. Pre štart farmy treba, hodit mrkvu pred villagerov.']
let imgT;

function nacitaj() {
    document.getElementById("pk").onclick = znizKI;
    document.getElementById("nk").onclick = navysKI;
    imgT = document.querySelector('.StylObrazkaUvodny');
}
window.onload = nacitaj;
function navysKI() {
    krokIndex++;
    if (krokIndex >= pole.length) {
        krokIndex = 1;
    }
    imgT.setAttribute('src',pole[krokIndex]);
    document.getElementById('text1').innerHTML = poleText[krokIndex];
}

function znizKI() {
    krokIndex--;
    if (krokIndex < 1) {
        krokIndex = pole.length-1;
    }
    imgT.setAttribute('src',pole[krokIndex]);
    document.getElementById('text1').innerHTML = poleText[krokIndex];

}