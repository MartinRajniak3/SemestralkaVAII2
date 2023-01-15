
class Navod {
    constructor() {

        document.getElementById("krokUp").onclick = () => this.step();
        document.getElementById("krokDown").onclick = () => this.posunDown();

        this.reloadData();
        setInterval(() => {
            this.reloadData()
        }, 2000);
    }
    async posunUp() {
        krokIndex++;
        this.step();
    }

    async posunDown() {
        krokIndex--;
        this.step();
    }

    async step() {

            let response = await fetch("?c=tutorial&a=steps");
            let data = await response.json();
            krokIndex = 0;
            var popis = document.getElementById("popis");
            var imag = document.getElementById("imag");
            var htmlPopis = "";
            var htmlImage = "";
            var pocitadlo = 0;
            var polePopis = [];
            var poleImg= [];

            data.forEach((ste) => {
                polePopis[pocitadlo] = ste.popis;
                poleImg[pocitadlo] = ste.image;
                pocitadlo++;

            });

            if (pocitadlo !== 0) {
                krokIndex = krokIndex % pocitadlo;
                htmlPopis = `<p> ${polePopis[krokIndex]} <\p>`;
                htmlImage = `<img class="StylObrazkaUvodny" src="${poleImg[krokIndex]}" alt="...">`;

            }

            popis.innerHTML = htmlPopis;
            imag.innerHTML = htmlImage;

    }

    async reloadData() {
        await this.step();
    }
}

var krokIndex;
var navd;
document.addEventListener(
    'DOMContentLoaded', () => {
        navd = new Navod();
    }, false)
;
