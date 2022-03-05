<?php
//Pongo esto al principio del archivo porque si nó, luego me da error
session_start();
//Esto son algunas funciones que he creado para facilitarme la vida
function imp($array){
    echo '<pre>';
    print_r($array);
    echo '<pre>';
}
function vervariable($variable){
    echo"<script>";
    echo "alert('$variable')";
    echo"</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Jugar</title>
    <script src="Archivos/jugar.js"></script>
    <link rel="stylesheet" href="Archivos/jugar.css">
</head>
<body>
<?php
echo ("<div id='contenedor2' class='contenedor2'>");
//Al lio. Esta es la ultima pagina que escribo, que ya estoy cansado, aun no he cenado y en 7 min se entrega la practica.
//Correctisimo se envia cada vez que acierto una pregunta
if (isset($_POST["correctisimo"])){
//    Si acierto, la racha de multiplica x 2. Empieza siendo 5 (y cada vez que fallo se convierte en 5). Por tanto sera: 10, 20, 40, 80,160, etc
    $_SESSION["racha"]*=2;
//    Se le suma a la puntuación
    $_SESSION["puntuacion"] = $_SESSION["puntuacion"] + $_SESSION["racha"];

//Con esto miro de que categoria es la pregunta acertada y sumo 1 a la variable de su categoria (nos servirá para pintar cuantas hay acertadas de su grupo y para impedir que cuando se hayan acertado 5 de una, salgan mas preguntas)
    if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Matemáticas"){
        $_SESSION["mate"]++;
    }if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Literatura"){
        $_SESSION["lite"]++;
    }if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Geología"){
        $_SESSION["geo"]++;
    }if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == 'Inglés'){
        $_SESSION["ingles"]++;
    }
}else{
//    Si no fallo, la racha se restablece a 5
    $_SESSION["racha"] = 5;
}
//Si no existe el post de empezar, significa que no he empezado aún, jeje
    if (!isset($_POST["empezar"])){
//        Por lo tanto, inicio todas las variables a su valor inicial.
//        Estas primeras nos servirán para indicar cuantas preguntas de cada categoria se han acertado
        $_SESSION["mate"] = 0;
        $_SESSION["lite"] = 0;
        $_SESSION["ingles"] = 0;
        $_SESSION["geo"] = 0;
//    La racha nos indica la racha en la que estamos
        $_SESSION["racha"] = 5;
//La puntuacion indica cuantos puntos tenemos
        $_SESSION["puntuacion"] = 0;
//        Preguntas resueltas indica cuantas preguntas hemos respondido, tanto buenas como malas
        $_SESSION["preguntasresultas"] = 0;
//        Contados irá desde 0 hasta el numero de preguntas que haya. Empieza dede -1 porque luego le sumo 1 cada vez que sale una pregunta
        $_SESSION["contador"] = -1;
//        Nombre indica el nombre de la persona que juega
        $_SESSION["nombre"] = "";
//        barajeadas será una copia de las preguntas. Las separo para que no me mezcle las preguntas que hay en el array original
        $_SESSION["barajeadas"] = $_SESSION["preguntas"];
//        barajeamos el el array barajeadas
        shuffle($_SESSION["barajeadas"]);
//        Como aún no he empezado, me imprimo un formulario para meter el nombre. Tendra un input que hara un post con nombre
        echo ("    <form method='post'>
<div class='atope' id='atope'>
    <input type='text' class='nombre' name='nombre' id='nombre' required placeholder='Introduce tu nombre'>
    <button class='empezar' name='empezar' id='empezar'>Empezar</button>
</div>
    </form>");
    }else{
//        En caso de ya haya empezado...
//        Si existe el post de nombre (solo la primera vez que entre en está parte del codigo, recibirá el post)
        if (isset($_POST["nombre"])){
//            Digo que la sesion nombre contenga el post que le acabo de hacer
            $_SESSION["nombre"] = $_POST["nombre"];
        }
//        A contador le sumo 1 y ha preguntas resueltas. No puedo usar contador como preguntas resueltas, porque cuando se cumplan las categorias, tendre que saltar preguntas para pasar a preguntas
//que no sean de la categoria resuelta, por lo tanto contador seguirá aumentado pero preguntasresueltas no
            $_SESSION["contador"]++;
            $_SESSION["preguntasresultas"]++;
//            Bueno, si existe esta posicion de barajeadas significa que hay una pregunta
            if (isset($_SESSION["barajeadas"][$_SESSION["contador"]][1])) {
//                Este for va desde la posicion de preguntas por la que vaya hasta la ultima pregunta
                for ($abracadabra = $_SESSION["contador"]; $abracadabra<count($_SESSION["barajeadas"]);$abracadabra++){
//                    En caso de que alguna de las cateogorias sea igual a 5, se sumará 1 a contador. Esto hará que cuando se hayan cumplido 5 preguntas de cierta categoría no vuelvan a salir ninguna pregunta mas de esa categoría
                    if  ($_SESSION["mate"] >= 5 && trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Matemáticas"){
                        $_SESSION["contador"]++;
                    }elseif ($_SESSION["lite"] >= 5 && trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Literatura"){
                        $_SESSION["contador"]++;
                    }elseif ($_SESSION["geo"] >= 5 && trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Geología"){
                        $_SESSION["contador"]++;
                    }elseif  ($_SESSION["ingles"] >= 5 && trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Inglés"){
                        $_SESSION["contador"]++;
                    }else{
//                       En caso de que esa pregunta contenga una pregunta válida, con una categoria que se pueda jugar aun, entonces sale del bucle y empieza la magia
                        break;
                    }
                }
            }
//                Vuelvo a preguntar si existe esa posicion de la pregunta, porque como antes he estado saltando preguntas, puede que ahora no exista. Si no existe es que me he quedado sin pregutas
            if (isset($_SESSION["barajeadas"][$_SESSION["contador"]][1])){
//                Empiezo a imprimir la targeta
                echo ("
<form method='post'>
    <input type='hidden' name='empezar' id=''>
    <div class='preguntas'>");
//        Dependiendo de la clase que sea esa pregunta, me pintará el borde y la sombra de un color distinto
            echo("<div class='tarjeta' style='");if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Matemáticas"){echo "border: 10px solid lightblue;";echo "box-shadow: 2px 5px 41px 4px lightblue;";}if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Literatura"){echo "border: 10px solid lightcoral;";echo "box-shadow: 2px 5px 41px 4px lightcoral;";}if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == "Geología"){echo "border: 10px solid lightgreen;";echo "box-shadow: 2px 5px 41px 4px lightgreen;";}if (trim($_SESSION["barajeadas"][$_SESSION["contador"]][6]) == 'Inglés'){echo "border: 10px solid gold;";echo "box-shadow: 2px 5px 41px 4px gold;";}echo("'>");
//            En este div, se pondrá preguntas resueltas y debajo la puntuacion. Es el circulo blanco que se ve
            echo("<div class='contador'>");echo $_SESSION["preguntasresultas"];echo (" <br> <span>");echo $_SESSION["puntuacion"];echo ("pts</span></div>
            <div class='fotito'>
                <img src='");
//            Imprimo la foto
            echo $_SESSION["barajeadas"][$_SESSION["contador"]][7];echo ("' alt=''>
            </div>
            <div class='pregunta'>Pregunta de ");
//            Pongo de que categoria es la pregunta, y la pregunta
            echo $_SESSION["barajeadas"][$_SESSION["contador"]][6]; echo(": <br> ");echo $_SESSION["barajeadas"][$_SESSION["contador"]][0];echo("</div>
            <div class='respuesta'>");
//            Con este for, imprimo las respuestas.
                for ( $i = 1; $i <= 4;$i++){
//                    En caso de que esa vuelta del for coincida con la pregunta correcta, que se indica con un numero, me pondra un name llamado correctisimo. Por tanto se imprimiran las 4 preguntas pero la correcta tendrña ese name
//Por lo taaaaanto si le doy a la correcta, se posteara el valor correctisimo, si no, no
                    if ($i == $_SESSION["barajeadas"][$_SESSION["contador"]][5]){
                        echo "<button name='correctisimo' type='submit'>";
                        echo $_SESSION["barajeadas"][$_SESSION["contador"]][$i];
                        echo "</button>";
                    }else{
                        echo "<button type='submit'>";
                        echo $_SESSION["barajeadas"][$_SESSION["contador"]][$i];
                        echo "</button>";
                    }
                }echo("
            </div>
        </div>
    </div>
</form>
    ");
            }
//            Si el progrma detecta que ya no hay ninguna pregunta más, se pasará a esta parte del código
            else{
                echo ("
<div class='tuposicion'>
    <div>");
//                Primero se imprime el nombre del jugador en una bola
                echo $_SESSION["nombre"];echo("</div>
    <div>");
//                Luego, si todas las categorias están al 5, se sumará 1000 a la puntuacion
                if ( $_SESSION["ingles"] >= 5 &&  $_SESSION["mate"] >= 5 &&  $_SESSION["lite"] >= 5 &&  $_SESSION["geo"] >= 5){$_SESSION["puntuacion"] += 1000;}
//                Despues se imprime la puntuaicon en una bola
        echo $_SESSION["puntuacion"];echo("pts
    </div>");
//    Por ultimo en la 3 vola, se pone un enlace al index.php. Sin post y sin royos
        echo("<div onclick='funcion2()'><a href='index.php'>Volver</a></div>
</div>
");
            }
    }
//    Esto ultimo imprime las probetas de los lados
echo ("

    <div id='amarillo' class='color amarillo'>
        <div id='porcentajeamarillo' style='height: ");
//    En cada una, si existe la sesión con su nombre, pasará a un switch, que dependiendo del valor de la varible, cambiará la alatura del color. No tiene mucho misterio, pero.... ¿A que queda guay?
    if (isset($_SESSION["ingles"])){switch ($_SESSION["ingles"]){case 0:echo "5";break;case 1:echo "20";break;case 2:echo "40";break;case 3:echo "60";break;case 4:echo "80";break;default:echo "100";break;}}echo("%'></div>
        <div class='raya' id='raya1'></div>
        <div class='raya' id='raya2'></div>
        <div class='raya' id='raya3'></div>
        <div class='raya' id='raya4'></div>
        <div class='raya' id='raya5'></div>
    </div>
    <div id='azul' class='color azul'>
        <div id='porcentajeazul' style='height: ");if (isset($_SESSION["mate"])){switch ($_SESSION["mate"]){case 0:echo "5";break;case 1:echo "20";break;case 2:echo "40";break;case 3:echo "60";break;case 4:echo "80";break;default:echo "100";break;}}echo("%'></div>
        <div class='raya' id='raya1'></div>
        <div class='raya' id='raya2'></div>
        <div class='raya' id='raya3'></div>
        <div class='raya' id='raya4'></div>
        <div class='raya' id='raya5'></div>
    </div>
    <div id='rojo' class='color rojo'>
        <div id='porcentajerojo' style='height: ");if (isset($_SESSION["lite"])){switch ($_SESSION["lite"]){case 0:echo "5";break;case 1:echo "20";break;case 2:echo "40";break;case 3:echo "60";break;case 4:echo "80";break;default:echo "100";break;}}echo("%'></div>
        <div class='raya' id='raya1'></div>
        <div class='raya' id='raya2'></div>
        <div class='raya' id='raya3'></div>
        <div class='raya' id='raya4'></div>
        <div class='raya' id='raya5'></div>
    </div>
    <div id='verde' class='color verde'>
        <div id='porcentajeverde' style='height: ");if (isset($_SESSION["geo"])){switch ($_SESSION["geo"]){case 0:echo "5";break;case 1:echo "20";break;case 2:echo "40";break;case 3:echo "60";break;case 4:echo "80";break;default:echo "100";break;}}echo("%'></div>
        <div class='raya' id='raya1'></div>
        <div class='raya' id='raya2'></div>
        <div class='raya' id='raya3'></div>
        <div class='raya' id='raya4'></div>
        <div class='raya' id='raya5'></div>
    </div>
");
    ?>
</div>
</body>
<!--Por fin termino este trabajo, a estado chulo, se me ha hecho largo, puede por haberle metido mas movidas por mi parte, pero bueno. Espero buena nota jiji-->
</html>
