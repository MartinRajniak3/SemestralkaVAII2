class Podnet {
    constructor() {
        document.getElementById("pridajBTN").onclick = () => this.create();

        this.reloadData();
        setInterval(() => {
            this.reloadData()
        }, 2000);
    }
    async create() {
        let response = await fetch("?c=window&a=storePodnet", {
            method: 'POST',
            headers: {
                'Content-Type': "application/json",
            },
            body: JSON.stringify({
                title: document.getElementById("titleIN").value,
                text: document.getElementById("textIN").value,
                tvorca: document.getElementById("tvorcaIN").value
            })
        });
        document.getElementById("titleIN").value = "";
        document.getElementById("textIN").value = "";

    }
    async allSelect() {
        let response = await fetch("?c=window&a=windows");
        let data = await response.json();
        var red = document.getElementById("red");
        var cyan = document.getElementById("cyan");
        var lime = document.getElementById("lime");
        var htmlRed = "";
        var htmlCyan = "";
        var htmlLime = "";
        var htmlAdmin = "";
        var htmlLogged = "";
        var logged = document.getElementById("logged").value;
        data.forEach((windo) => {
            var tvor = windo.tvorca;
            if (logged == 1) {
                htmlAdmin = `<p class="text-center">
                                <a class="btn btn-info" href="?c=window&a=zmenStav&id=${windo.id}&stav=0">V Ponuke</a>
                                <a class="btn btn-success" href="?c=window&a=zmenStav&id=${windo.id}&stav=1">Hotovo</a>
                                <a class="btn btn-danger" href="?c=window&a=zmenStav&id=${windo.id}&stav=2">Nebude</a>
                            </p>`;
            } else {
                htmlAdmin = "";
            }

            if (logged == 1 || logged == tvor) {

                htmlLogged = `<p><a href="?c=window&a=edit&id=${windo.id}" class="btn btn-warning">Upraviť</a>
                                        <a href="?c=window&a=delete&id=${windo.id}" class="btn btn-danger">Zmazať</a></p>
                                <p><a href="?c=window&a=like&id=${windo.id}" class="btn btn-primary">${windo.likes}  Hlasovat</a></p>`;
            } else {
                htmlLogged = `<p><a href="?c=window&a=like&id=${windo.id}" class="btn btn-primary">${windo.likes}  Hlasovat</a></p>`;

            }

            if (windo.stav === 2) {
                htmlRed += `<div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="card my-3 redcarpet">
                            <h5 class="card-header signText">
                                ${windo.title}
                            </h5>
                            <div class="card-body">
                                ${htmlAdmin}
                                <p class="card-text signText">
                                    ${windo.text}
                                </p>
                                ${htmlLogged}
                            </div>
                        </div>
                    </div>
                    `;
            } else if (windo.stav === 1) {
                htmlLime += `<div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="card my-3 limecarpet">
                            <h5 class="card-header signText">
                                ${windo.title}
                            </h5>
                            <div class="card-body">
                                ${htmlAdmin}
                                <p class="card-text signText">
                                    ${windo.text}
                                </p>
                                ${htmlLogged}
                            </div>
                        </div>
                    </div>
                    `;
            } else {
                htmlCyan += `<div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="card my-3 carpet">
                            <h5 class="card-header signText">
                                ${windo.title}
                            </h5>
                            <div class="card-body">
                                ${htmlAdmin}
                                <p class="card-text signText">
                                    ${windo.text}
                                </p>
                                ${htmlLogged}
                            </div>
                        </div>
                    </div>
                    `;
            }

        });
        red.innerHTML = htmlRed;
        cyan.innerHTML = htmlCyan;
        lime.innerHTML = htmlLime;
    }
    async reloadData() {
        this.allSelect();
    }
}
var podn;
document.addEventListener(
    'DOMContentLoaded', () => {
        podn = new Podnet();
    }, false)
;
