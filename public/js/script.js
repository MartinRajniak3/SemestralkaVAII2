class Navod {
    constructor() {
        this.reloadData();
        setInterval(() => {
            this.reloadData()
        }, 2000);
    }

    async step() {
        let idTut = document.getElementById("idNavod").value;
        let input = "?c=tutorial&a=steps&tut=" + idTut;
        let response = await fetch(input);
        let data = await response.json();
        var kroky = document.getElementById("kroky");
        var htmlKroky = "";
        var pocitadlo = 0;
        var htmlLogged = "";
        var log = document.getElementById("logged").value;
        var idTutorial = document.getElementById("idTut").value;
        data.forEach((ste) => {
            pocitadlo++;
            if (log == 1) {
                htmlLogged = ` <a class="btn btn-warning" href="?c=tutorial&a=editStep&id=${ste.id}&idTut=${idTutorial}">Upravit krok</a> 
                                <a class="btn btn-danger" href="?c=tutorial&a=deleteStep&id=${ste.id}">Zmazat krok</a>`;

            }
            htmlKroky += `
                    <p class="bordHoreADole"> 
                        <div class="stylLink"><div class="stylLink1 text-center">${pocitadlo}. ${ste.popis}</div></div> 
                        <img class="StylObrazkaUvodny" src="${ste.image}" alt="...">
                        <div class="text-center">${htmlLogged}</div>
                    <\p>`;
        });
        kroky.innerHTML = htmlKroky;
    }
    async reloadData() {
        this.step();
    }
}
var navd;
document.addEventListener(
    'DOMContentLoaded', () => {
        navd = new Navod();
    }, false)
;
