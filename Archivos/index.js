
    function funcion1() {

        document.getElementById('contenedor').style.width = '100px';
        document.getElementById('contenedor').style.height = '200px';
        document.getElementById('posicion').style.display = 'none';
        document.getElementById('boto1').style.display = 'none';
        document.getElementById('boto2').style.display = 'none';

        document.getElementById('title').style.top = '50%';
        // document.getElementById('contenedor').style.background = 'red';
        setTimeout(funcion1b, 1000);
    }
    function funcion1b() {
        document.getElementById('contenedor').style.top = '-100px';
        document.getElementById('contenedor2').style.top = '50%';

        // document.getElementById('contenedor').style.background = 'red';
        setTimeout(funcion1c, 500);
    }
    function funcion1c() {

        document.getElementById('contenedor2').style.width = '100vw';
        document.getElementById('contenedor2').style.height = '100vh';
        document.getElementById('jugar').style.display = 'flex';
        document.getElementById('title2').style.top = '50px';
    }
    function funcion2() {

        document.getElementById('contenedor').style.width = '100px';
        document.getElementById('contenedor').style.height = '200px';
        document.getElementById('posicion').style.display = 'none';
        document.getElementById('boto1').style.display = 'none';
        document.getElementById('boto2').style.display = 'none';

        document.getElementById('title').style.top = '50%';

        setTimeout(funcion2b, 1000);
    }
    function funcion2b() {
        document.getElementById('contenedor').style.top = '-100px';
        document.getElementById('contenedor3').style.top = '50%';

        setTimeout(funcion2c, 500);
    }
    function funcion2c() {
        document.getElementById('contenedor3').style.width = '100vw';
        document.getElementById('contenedor3').style.height = '100vh';
        document.getElementById('title3').style.top = '50px';
        document.getElementById('editar').style.display = 'flex';


    }
    function funcion3() {
        // document.getElementById('contenedor').style.top = '-100px';
        document.getElementById('contenedor2').style.width = '100px';
        document.getElementById('contenedor2').style.height = '200px';
        document.getElementById('jugar').style.display = 'none';
        document.getElementById('title2').style.top = '50%';
        setTimeout(funcion3b, 1000);
    }
    function funcion3b() {

        document.getElementById('contenedor2').style.top = '-100px';
        document.getElementById('contenedor').style.top = '50%'



        setTimeout(funcion3c, 500);
    }
    function funcion3c() {


        document.getElementById('contenedor').style.width = '100vw';
        document.getElementById('contenedor').style.height = '100vh';
        document.getElementById('posicion').style.display = 'flex';
        document.getElementById('boto1').style.display = 'flex';
        document.getElementById('boto2').style.display = 'flex';

        document.getElementById('title').style.top = '27%';

        // setTimeout(funcion3d, 500);

    }
    function funcion4() {

        // document.getElementById('contenedor').style.top = '-100px';
        document.getElementById('contenedor3').style.width = '100px';
        document.getElementById('contenedor3').style.height = '200px';
        document.getElementById('title3').style.top = '50%';
        document.getElementById('editar').style.display = 'none';

        setTimeout(funcion4b, 1000);
    }
    function funcion4b() {

        document.getElementById('contenedor3').style.top = '-100px';
        document.getElementById('contenedor').style.top = '50%'



        setTimeout(funcion4c, 500);
    }
    function funcion4c() {


        document.getElementById('contenedor').style.width = '100vw';
        document.getElementById('contenedor').style.height = '100vh';
        document.getElementById('posicion').style.display = 'flex';
        document.getElementById('boto1').style.display = 'flex';
        document.getElementById('boto2').style.display = 'flex';

        document.getElementById('title').style.top = '27%';

        // window.open('https://www.google.com/', '_self');

        // setTimeout(funcion3d, 500);

    }
    function funcion5() {
        document.getElementById("macarron").style.color = "black";
        document.getElementById("jugar").style.background = "black";


        document.getElementById("jugar").style.transition = "1s";
        document.getElementById("jugar").style.transform = "scale(40)";
        setTimeout(funcion5a, 1000);
    }
    function funcion5a() {
        document.getElementById("amarillo").style.height = "100%";
        document.getElementById("azul").style.height = "100%";
        document.getElementById("rojo").style.height = "100%";
        document.getElementById("verde").style.height = "100%";


        setTimeout(funcion5b, 1200);
    }
    function funcion5b() {

        document.getElementById("amarillo").style.border = "3px solid #eee";
        document.getElementById("azul").style.border = "3px solid #eee";
        document.getElementById("rojo").style.border = "3px solid #eee";
        document.getElementById("verde").style.border = "3px solid #eee";

        document.getElementById("amarillo").style.height = "20%";
        document.getElementById("azul").style.height = "20%";
        document.getElementById("rojo").style.height = "20%";
        document.getElementById("verde").style.height = "20%";


        document.getElementById("amarillo").style.bottom = "2%";
        document.getElementById("azul").style.bottom = "52%";
        document.getElementById("rojo").style.bottom = "77%";
        document.getElementById("verde").style.bottom = "27%";
        setTimeout(funcion5c, 1000);
    }
    function funcion5c() {

        document.getElementById("amarillo").style.left = "40px";
        document.getElementById("azul").style.left = "40px";
        document.getElementById("rojo").style.left = "40px";
        document.getElementById("verde").style.left = "40px";

        document.getElementById("amarillo").style.boxShadow = "2px 5px 41px 4px gold";
        document.getElementById("azul").style.boxShadow = "2px 5px 41px 4px lightblue";
        document.getElementById("rojo").style.boxShadow = "2px 5px 41px 4px lightcoral";
        document.getElementById("verde").style.boxShadow = "2px 5px 41px 4px lightgreen";


        document.getElementById("amarillo").style.width = "30px";
        document.getElementById("azul").style.width = "30px";
        document.getElementById("rojo").style.width = "30px";
        document.getElementById("verde").style.width = "30px";
        setTimeout(funcion5d, 1000);

    }
    function funcion5d() {


        document.getElementById("amarillo").style.borderRadius = "0px 0px 100px 100px";
        document.getElementById("azul").style.borderRadius = "0px 0px 100px 100px";
        document.getElementById("rojo").style.borderRadius = "0px 0px 100px 100px";
        document.getElementById("verde").style.borderRadius = "0px 0px 100px 100px";



        document.getElementById("porcentajeamarillo").style.height = "5%";
        document.getElementById("porcentajerojo").style.height = "5%";
        document.getElementById("porcentajeazul").style.height = "5%";
        document.getElementById("porcentajeverde").style.height = "5%";
        setTimeout(funcion5e, 1000);
    }
    function funcion5e() {
        window.open("jugar.php", '_self');

    }