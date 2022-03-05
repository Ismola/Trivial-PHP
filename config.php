<?php
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
    <title>Configuración</title>
    <script src="Archivos/config.js"></script>
    <link rel="stylesheet" href="Archivos/config.css">
</head>
<body>
<!--Inicio el formulario-->

<div id='contenedor3' class='contenedor3'>
    <div id='title3' class='title'>Configuración</div>

    <form action='index.php' method='post'>
    <button class='botonenviar' id="guardar" type='submit'>Guardar</button>
    <button class='botonlimpiar' id="limpiar" type='reset'>Limpiar</button>
    <button onclick='funcion2()' id="cancelar" class='mepiro' type='button'>Cancelar</button>
    <button onclick='funcion1(1)' id='botonizq' type='button' class='botonizq'>&lt;</button>
    <button onclick='funcion1(2)' id='botonder' type='button' class='botonder'>&gt;</button>
    <div class='border1'></div>
    <div class='border2'></div>
    <div class='border3'></div>
    <div class='border4'></div>
<!--    Esta es la targeta que siempre sale, sirve para añadir preguntas-->
    <div class='targeta' id='targetita-1'>
        <div class='imagendelatargeta'>
            <img src='https://i.blogs.es/f2ba32/wallpapers-abduzeedo/1366_2000.jpg' alt=''>
        </div>
            <div class='pregunta' >
                <label for='pregunta'>Escribe la pregunta:</label>
                <input id="preguntaqlo" name='pregunta' type='text' required="required">
            </div>
            <div class='respuestas' >
                <input class='rata' type='radio' name='option' id='o1' value='1' required="required">
                <label for='o1'>
                    <input name='r1' id="r1" class='pepe' type='text' required="required">
                </label>

                <input class='rata' type='radio' name='option' id='o2' value='2' required="required">
                <label for='o2'>
                    <input name='r2' id="r2" class='pepe' type='text' required="required">
                </label>

                <input class='rata' type='radio' name='option' id='o3' value='3' required="required">
                <label for='o3'>
                    <input name='r3' id="r3" class='pepe' type='text' required="required">
                </label>

                <input class='rata' type='radio' name='option' id='o4' value='4' required="required">
                <label for='o4'>
                    <input name='r4' id="r4" class='pepe' type='text' required="required">
                </label>
            </div>
            <div class='categoria' >
                <label for='categoria'>Selecciona la categoría:</label>
                <select name='categoria' id='categoria' required>
                    <option value='Matemáticas' style='background: lightblue'>Matemáticas</option>
                    <option value='Literatura' style='background: lightcoral'>Literatura</option>
                    <option value='Geología' style='background: lightgreen'>Geología</option>
                    <option value='Inglés' style='background: gold '>Inglés</option>
                </select>
            </div>
            <div class='foto'>
                <label for='categoria'>Escribe la URL de una imagen:</label>
                <input name='url' type='text'>
            </div>
    </div>
        <?php
//Con este for, imprimo tantas targeta como preguntas haya, además, segun se crean, va cambio el name distinto para cada input, para que luego pueda recogerlos.
//Esto sirve para que se puedan cambiar las preguntas y luego recoger los valores cambiados
//Para cambiar el name, simplemente añado la variable i, (que va a ser la contadora de targetas) al final del name, para que luego se genere, pregunta1 pregunta2 pregunta3 y asi con cada dato
//Este for, va de 0 al numero de pregunta que haya en el arary que generamos en la pagina de index
        if (isset($_SESSION["preguntas"])){
            for ($i = 0; $i < count($_SESSION["preguntas"]); $i++){
                echo ("<div class='targeta' id='targetita$i' style='top: 200%; ");
//    Con esto cambio el borde de la tarjeta según  su categoría
//    Con trim, quito los posibles huecos en blanco, o caracteres raros que se hayan podido generar en el proceso de guardado (sin ellos, la cosa falla)
//$_SESSION["preguntas"][$i][6]) la i, es el numero de pregunta y el 6 es la categoria. Es decir, que la categoría va air cambiando segun cada vuelta del for
                if (trim($_SESSION["preguntas"][$i][6]) == "Matemáticas"){
                    echo "border: 10px solid lightblue;";
                }
                if (trim($_SESSION["preguntas"][$i][6]) == "Literatura"){
                    echo "border: 10px solid lightcoral;";
                }
                if (trim($_SESSION["preguntas"][$i][6]) == "Geología"){
                    echo "border: 10px solid lightgreen;";
                }
                if (trim($_SESSION["preguntas"][$i][6]) == 'Inglés'){
                    echo "border: 10px solid gold;";
                }
                echo ("'>
        <div class='imagendelatargeta'>
            <img src='");
//    $_SESSION["preguntas"][$i][7]) la posicion 7 indica la url de la pregunta. La pongo aquí para que me la ponga en la parte de arriba de la pregunta
                echo $_SESSION["preguntas"][$i][7];

                echo("' alt=''>
        </div>
            <div class='pregunta'>
                <label for='pregunta'>Escribe la pregunta:</label>");
//    Gracias la for, cada input que genero tiene el name cambiado. Ademñas en el campo value, pongo el valor del array $_SESSION["preguntas"][$i][0]), 0 es la posicion donde va la pregunta
                echo("<input name='pregunta$i' type='text' value='");echo $_SESSION["preguntas"][$i][0];echo ("'required>
            </div>
            <div class='respuestas'>
            ");
//                Con este for, genero 4 inputs disintos, de tipo radio y 4 inputs de tipo text. Cada uno, tiene su name y su id distinto, dado con la varible $i del for del principio
                for ($a = 1 ; $a < 5 ;$a++){
//          $_SESSION["preguntas"][$i][5]) es la posicion correcta. Por tanto, cada vez que imprimo uno, con e if, pregunto que si esa posicion es igual a la que hay en la posicion correcta.
// Si lo hay, me escribo el input con el cheked  porque significa que es correcto
                    if ($_SESSION["preguntas"][$i][5] == $a){
                        echo "<input class='rata' type='radio' name='option$i' id='o$a' value='$a' required checked>";
                    }else{
                        echo "<input class='rata' type='radio' name='option$i' id='o$a' value='$a' required>";
                    }
                    echo "<label for='o$a'>";
                    echo "<input name='r$a$i' class='pepe' type='text' value='";
//        Aquí, se imprime pregunta $i $a. i iba de 1 al numero de preguntas, y a va de 1 a 4
//          Se hace esto, para luego recogerlo de manera facil en el inde.php
                    echo $_SESSION["preguntas"][$i][$a];
                    echo "' required>";
                    echo " </label>";
                }
                echo("
             </div>
            <div class='categoria'>
                <label for='categoria'>Selecciona la categoría:</label>
");
//    De igual forma que antes, la categoria se imprime con un numero al final para distingirlo de las otras categoría del resto de preguntas
                echo ("
                <select name='categoria$i' id='categoria$i' required>
                ");
//    Todos estos ifs, sirven para detectar de que categoría es la pregunta, y poner su categoría en primer lugar.
//Pregunto que si la categoria que hay escrita en el array es igual a la que se va a escribir, que me ponga el selected, que la muestra en primer lugar
//$_SESSION["preguntas"][$i][6]) indica la categoria
                if (trim($_SESSION["preguntas"][$i][6]) == "Matemáticas"){
                    echo "<option selected value='Matemáticas' style='background: lightblue'>Matemáticas</option>";
                }else{
                    echo "<option value='Matemáticas' style='background: lightblue'>Matemáticas</option>";
                }
                if (trim($_SESSION["preguntas"][$i][6]) == "Literatura"){
                    echo "<option selected value='Literatura' style='background: lightcoral'>Literatura</option>";
                }else{
                    echo "<option value='Literatura' style='background: lightcoral'>Literatura</option>";
                }
                if (trim($_SESSION["preguntas"][$i][6]) == "Geología"){
                    echo "<option selected value='Geología' style='background: lightgreen'>Geología</option>";
                }else{
                    echo "<option value='Geología' style='background: lightgreen'>Geología</option>";
                }
                if (trim($_SESSION["preguntas"][$i][6]) == 'Inglés'){
                    echo "<option selected value='Inglés' style='background: gold '>Inglés</option>";
                }else{
                    echo "<option value='Inglés' style='background: gold '>Inglés</option>";
                }
                echo ("
                </select>
            </div>
            <div class='foto'>
                <label for='categoria'>Escribe la URL de una imagen:</label>
");
//    Como antes, con la url me genera un name distinto para luego poder recogerlo
                echo ("
                <input name='url$i' type='text' value='");
//    $_SESSION["preguntas"][$i][7]) es la URL, la pongo ahí para que me la escruiba en la targeta
                echo $_SESSION["preguntas"][$i][7];
                echo ("'>
            </div>
    </div>
    ");
            }
        }
echo "</form>";
echo "</div>";

?>
</body>
</html>
