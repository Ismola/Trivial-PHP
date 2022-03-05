setTimeout(funcion0,500)
function funcion0(){
    document.getElementById("targetita-1").style.filter = "opacity(100%)";
    document.getElementById("guardar").style.filter = "opacity(100%)";
    document.getElementById("limpiar").style.filter = "opacity(100%)";
    document.getElementById("cancelar").style.filter = "opacity(100%)";
    document.getElementById("botonizq").style.filter = "opacity(100%)";
    document.getElementById("botonder").style.filter = "opacity(100%)";
}

    var ntargeta = -1;
    function funcion1(movimiento){
        if (movimiento == 1){
            if (document.getElementById("targetita"+(ntargeta-1))){
                document.getElementById("targetita"+(ntargeta)).style.top = "200%";
                ntargeta--;
                document.getElementById("targetita"+(ntargeta)).style.left = "32%";
                document.getElementById("targetita"+(ntargeta)).style.top = "55%";

            }
        }
        if (movimiento == 2){
            if (document.getElementById("targetita"+(ntargeta+1))){
                document.getElementById("targetita"+(ntargeta)).style.left = "-200%";
                ntargeta++;
                document.getElementById("targetita"+(ntargeta)).style.left = "32%";
                document.getElementById("targetita"+(ntargeta)).style.top = "55%";

            }
        }
        if (document.getElementById("targetita"+(ntargeta+1))){
            document.getElementById("botonder").style.background = "#eee";
        }else {

            document.getElementById("botonder").style.background = "lightcoral";

        }
        if (document.getElementById("targetita"+(ntargeta-1))){
            document.getElementById("botonizq").style.background = "#eee";
            document.getElementById("o1").removeAttribute("required");
            document.getElementById("o2").removeAttribute("required");
            document.getElementById("o3").removeAttribute("required");
            document.getElementById("o4").removeAttribute("required");
            document.getElementById("r1").removeAttribute("required");
            document.getElementById("r2").removeAttribute("required");
            document.getElementById("r3").removeAttribute("required");
            document.getElementById("r4").removeAttribute("required");
            document.getElementById("preguntaqlo").removeAttribute("required");
            document.getElementById("categoria").removeAttribute("required");
        }else {
            document.getElementById("botonizq").style.background = "lightcoral";
            document.getElementById("o1").setAttribute("required","required")
            document.getElementById("o2").setAttribute("required","required")
            document.getElementById("o3").setAttribute("required","required")
            document.getElementById("o4").setAttribute("required","required")
            document.getElementById("r1").setAttribute("required","required")
            document.getElementById("r2").setAttribute("required","required")
            document.getElementById("r3").setAttribute("required","required")
            document.getElementById("r4").setAttribute("required","required")
            document.getElementById("preguntaqlo").setAttribute("required","required")
            document.getElementById("categoria").setAttribute("required","required")
        }
    }
    function funcion2(){
        var ntargeta = -1;
        while (document.getElementById("targetita"+(ntargeta))){
            document.getElementById("targetita"+(ntargeta)).style.filter = "opacity(0%)";
            ntargeta++;
        }
        document.getElementById("guardar").style.filter = "opacity(0%)";
        document.getElementById("limpiar").style.filter = "opacity(0%)";
        document.getElementById("cancelar").style.filter = "opacity(0%)";
        document.getElementById("botonizq").style.filter = "opacity(0%)";
        document.getElementById("botonder").style.filter = "opacity(0%)";
        setTimeout(funcion2a,500);
    }
function funcion2a(){


    document.getElementById('contenedor3').style.width = '100px';
    document.getElementById('contenedor3').style.height = '200px';
    document.getElementById('title3').style.top = '50%';
    setTimeout(funcion2b,1000);

}
function funcion2b() {

    document.getElementById('contenedor3').style.top = '-100px';

    setTimeout(funcion2c, 500);
}
function funcion2c() {

    window.open('index.php', "_self");


    setTimeout(funcion2c, 500);
}