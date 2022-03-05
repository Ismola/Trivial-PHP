<?php
//Pongo esto al principio del archivo porque si nó, luego me da error
session_start();
//Esto son algunas funciones que he creado para facilitarme la vida
function imp($array){
    echo '<pre>';
    print_r($array);
    echo '<pre>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Inicio</title>
    <script src="Archivos/index.js"></script>
    <link rel="stylesheet" href="Archivos/index.css">
</head>
<body>
<?php
//Esto sirve para rescatar los posibles cambios de las preguntas ya existentes del archivo de configuracion
if (isset($_POST["pregunta0"])){
//    Abro el fichero en modo w, para escribir y que se ponga al inicio del fichero
    $fichero = fopen('Ficheros/datos' ,'w');
//    Pongo un contador que irá desde 0 hasta el número de preguntas. Nos servirá para ir cambiando el name de os post,
    $cont = 0;
//    te cuento mi movida: en el archivo de coniguración, a parte de añadir pregunta, puedo modificar le resto.
//Para guardar los posibles cambios, cuando se crean las tarjetas, cada valor se guarda con un numero. pregunta 1, pregunta2, pregunta3, así todo el rato, y con cada tipo de datos.
//    Por eso, ahora digo: miebtras exista el POST de... pregunta1, ponme sus datos. SI existe el POST de pregunta2, guarda sus datos.
//    Por datos me refiero a las respuestas, la correcta y toda la pesca.
    while (isset($_POST["pregunta$cont"])){
        fputs($fichero, $_POST["pregunta$cont"]);
        fputs($fichero,"\n");
        fputs($fichero, $_POST["r1$cont"]);
        fputs($fichero,"\n");
        fputs($fichero, $_POST["r2$cont"]);
        fputs($fichero,"\n");
        fputs($fichero, $_POST["r3$cont"]);
        fputs($fichero,"\n");
        fputs($fichero, $_POST["r4$cont"]);
        fputs($fichero,"\n");
        fputs($fichero, $_POST["option$cont"]);
        fputs($fichero,"\n");
        fputs($fichero, $_POST["categoria$cont"]);
        fputs($fichero,"\n");
//        Esto es para que si el POST de URL no es cadena vacia(""), pues que me ponga la url que ha escrito, y si es cadena vacía, que me ponga esta URL por defecto
        if ($_POST["url$cont"] != ""){
            fputs($fichero, $_POST["url$cont"]);
        }else{
            fputs($fichero, 'https://i.blogs.es/f2ba32/wallpapers-abduzeedo/1366_2000.jpg');
        }
//        Añado los saltos de lines para que si ves el fichero, tengan una separación y sea mas facil separar las preguntas visualemente, pero a la hora de leer, eso da =
        fputs($fichero,"\n");
        fputs($fichero,"\n");
//        Se suma 1 a cont, para ir a la siguiente pregunta
        $cont++;
    }
}
//Esto sirve para rescatar la posible pregunta añadida del fichero de configuración
//Solo si existen todos estos datos, pregunta, respuesta y todo eso, me lo guardará en el archivo, si falta alguno, no lo hará
//pregunta es la pregunta, r1 r2,r3,r4 las reespuestas, option, la posicion de la respuesta cirrecta, categoría la categoría y la URL pos =
if (isset($_POST['pregunta']) && isset($_POST['r1']) && isset($_POST['r2']) && isset($_POST['r3']) && isset($_POST['r4']) && isset($_POST['option']) && isset($_POST['categoria'])  ){
    $fichero = fopen('Ficheros/datos' ,'a+');
    fputs($fichero, $_POST['pregunta']);
    fputs($fichero,"\n");
    fputs($fichero, $_POST['r1']);
    fputs($fichero,"\n");
    fputs($fichero, $_POST['r2']);
    fputs($fichero,"\n");
    fputs($fichero, $_POST['r3']);
    fputs($fichero,"\n");
    fputs($fichero, $_POST['r4']);
    fputs($fichero,"\n");
    fputs($fichero, $_POST['option']);
    fputs($fichero,"\n");
    fputs($fichero, $_POST['categoria']);
    fputs($fichero,"\n");
    if ($_POST['url'] != ""){
        fputs($fichero, $_POST['url']);
    }else{
        fputs($fichero, 'https://i.blogs.es/f2ba32/wallpapers-abduzeedo/1366_2000.jpg');
    }

    fputs($fichero,"\n");
    fputs($fichero,"\n");
//    Cierro el fichero
    fclose($fichero);

}
//Esto sirve para pasar el archivo de datos a un array que se guardará en una sesión. Hace grupos de 7 datos, que generan un array, que se guardan en otro array. Es decir, se va a generar un array de arrays.
//Ahora abro el fichero en modo lectura, al principio del fichero
$fichero = fopen('Ficheros/datos' ,'r');
//$preguntaguardada es un array que contendrá todos los datos de una sola pregunta
$preguntaguardada = array();
//$preguntas recibirá push con $preguntaguardada, siendo así el array de array que buscábamos antes
$preguntas = array();
//utilizo este contador para ir de uno a ocho todo el rato. Como el fichero de datos, no uso ningun caracter que delimite nada, se hará contando columnas, Siempre se van a guardar, como se ha visot antes, por el mismo orden.
//Entonces, cuando haya contado 7 datos, es que ya ha terminado la pregunta y el siguiente dato es de la siguiente pregunta. Por tanto, preguntas, nos servirá para para ir contando de 1 a 8
$cont = 1;
//Mientras que no haya llegado a final de fichero.....
while (!feof($fichero)){
//    $linea es la linea del fichero
    $linea = fgets($fichero);
//    Ahora digo: si linea no es un salto de linea o una cadena vacia (para qye no me guarde posiciones del array sin datos)
    if ($linea != "\n" && $linea!= ""){
//        Entonces súbeme esa linea a pregunta guardada, que recuerdo que este array solo guardaba los datos de un array
        array_push($preguntaguardada,$linea);
//       Si contador es = a 8, significa que ya ha guardado 7 datos, y el siguiente es de la siguiente pregunta, por tanto....
        if ($cont == 8){
//            Por tanto me guarda la $preguntaguardada a $preguntas
            array_push($preguntas,$preguntaguardada);
//            Restablezco $preguntaguardada a un array vacio
            $preguntaguardada = array();
//            Y el contador a 1 para que vuelva a empezar ese proceso
            $cont = 1;
//            Si el contador no es 8, significa que todavía no se ha guardado todos los datos de la pregunta, por tanto suma 1 a contador
        }else{
            $cont++;
        }
    }
}
//Cierro e fichero
fclose($fichero);
//Por ultimo, guardo todas las preguntas de antes, en una sesión para que podamos usar este array en otros archivos php
$_SESSION["preguntas"] = $preguntas;
//Ahora haremos lo mismo pero para los jugadores. Lo primero será escribir en el fichero la nueva puntuacion
//Si existe la sesino de nombre y puntuacion (que se crea en jugar.php)..
if ((isset($_SESSION["nombre"]) && isset($_SESSION["puntuacion"])) ){
//Entonces pregunta si la puntuacion es mayor a 0 y nombre no es nada. Nos servirá para que solo se guarde la puntuacion la primera vez que se cargue index.php , y no todas
    if (($_SESSION["puntuacion"] >= 0 && $_SESSION["nombre"] != "")){
//        Abrimos el fichero por  el final y escribimos, separando por saltos de linea, como antes
        $fichero = fopen('Ficheros/jugadores' ,'a+');
//        Guardaremos el nombre
        fputs($fichero, $_SESSION["nombre"]);
        fputs($fichero,"\n");
//        Y la puntuacion
        fputs($fichero, $_SESSION["puntuacion"]);
        fputs($fichero,"\n");
        fputs($fichero,"\n");
        fclose($fichero);
    }
//    Estas lineas , nos servirán para cambiar puntuacion y nombre. Para que cuando se vuelva a cargar index (por ejemplo al editar una pregunta y volver) el programa no vuelva a meter los mismos datos en el archivo
    $_SESSION["puntuacion"] = -1;
    $_SESSION["nombre"] = "";
}
//Ahora pasaremos del fichero a un array de arrays. El procedimiento es el mismo, pero en vez de hacer grupos de 7 campos, lo hago de dos, nombre y puntuacion
$fichero = fopen('Ficheros/jugadores' ,'r');
//jugador nos servirá para guardar el nombre y su puntuacion
$jugador = array();
//Jugadores nos servirá para ir guardando a jugador cada vez que se completen sus campos
$jugadores = array();
$cont = 1;
while (!feof($fichero)){
    $linea = fgets($fichero);
    if ($linea != "\n" && $linea!= ""){
        array_push($jugador,$linea);
        if ($cont == 2){
            array_push($jugadores,$jugador);
            $jugador = array();
            $cont = 1;
        }else{
            $cont++;
        }
    }
}
fclose($fichero);
//Ahora viene lo divertido, el usort
//Usort sirve para ordenar un array, y para ellos va pasando de dos en dos valores, y en funcion de lo que devuelve la funcion a la que llama (1,-1,0) pondrá un campo delante de otro
//Esta funcion nos servirá para usar usort. Devuelve -1 si el primer campo es mayor al segundo, 1 si el primero campo es menor al otro y 0 si son iguales
//El trim, es porque al escribir en el fichero o leerlo, nosé, se generan como caracteres invisibles al rededor de los campos. Entonces así los elimino. (si no no funciona nada)
//Por cierto, la funcion los ordena de mayor a menor, para luego imprimirlos bien
function ordenar($a, $b)
{
    if (trim($a[1])  > trim($b[1])){
        return -1;
    }elseif (trim($a[1]) < trim($b[1])){
        return 1;
    }else{
        return 0;
    }
}
//usamos el usort con jugadores, el array donde está el array con todos ellos
usort($jugadores, "ordenar");
?>
<!--Ahora me imprime 3 contenedores, el de inicio con el ranking y los botones de jugar, luego el segundo, el de partida, con el boton de partida, y por ultimo el contenedor de configuracion con el boton de edicion-->
<div id='contenedor' class='contenedor'>
    <div id='title' class='title'>Trivial</div>
    <div id='posicion' class='posicion'>
        <div>
            <div>1</div>
<!--            Para imprimir las puntuaciones primero pregunto si existen, porque pudiera darse el caso de que no existan. Si existen las imprimo y si no, pues pongo un mensaje-->
            <div><?php if (isset($jugadores[0][0])){ echo $jugadores[0][0];}else{echo "Todavía no hay un ganador. <br> Pero podrías ser tu";} ?></div>
            <div><?php if (isset($jugadores[0][1])){ echo $jugadores[0][1];echo "pts";} ?></div>
        </div>
        <div>
            <div>2</div>
            <div><?php if (isset($jugadores[1][0])){ echo $jugadores[1][0];}else{echo "Todavía no hay un ganador. <br> Pero podrías ser tu";} ?></div>
            <div><?php if (isset($jugadores[1][1])){ echo $jugadores[1][1];echo "pts";} ?></div>
        </div>
        <div>
            <div>3</div>
            <div><?php if (isset($jugadores[2][0])){ echo $jugadores[2][0];}else{echo "Todavía no hay un ganador. <br> Pero podrías ser tu";} ?></div>
            <div><?php if (isset($jugadores[2][1])){ echo $jugadores[2][1];echo "pts";} ?></div>
        </div>
        <div>
            <div>4</div>
            <div><?php if (isset($jugadores[3][0])){ echo $jugadores[3][0];}else{echo "Todavía no hay un ganador. <br> Pero podrías ser tu";} ?></div>
            <div><?php if (isset($jugadores[3][1])){ echo $jugadores[3][1];echo "pts";}?></div>
        </div>
        <div>
            <div>5</div>
            <div><?php if (isset($jugadores[4][0])){ echo $jugadores[4][0];}else{echo "Todavía no hay un ganador. <br> Pero podrías ser tu";} ?></div>
            <div><?php if (isset($jugadores[4][1])){ echo $jugadores[4][1];echo "pts";} ?></div>
        </div>
    </div>
    <div id='boto1' onclick='funcion1()' class='boto1'><button>Jugar</button></div>
    <div id='boto2' onclick='funcion2()' class='boto2'><button>Config</button></div>
    <div class='border1'></div>
    <div class='border2'></div>
    <div class='border3'></div>
    <div class='border4'></div>
</div>
<div id='contenedor2' class='contenedor2'>
    <div id='title2' class='title'>Partida</div>
    <div id='atras' onclick='funcion3()' class='atras'></div>
    <!--        <form action='jugar.php' method='post'>-->
    <div onclick="funcion5()" id='jugar' class='editar'><button id="macarron">Jugar</button> </div>
    <!--    </form>-->

    <div class='border1'></div>
    <div class='border2'></div>
    <div class='border3'></div>
    <div class='border4'></div>
    <div id="amarillo" class="color amarillo">
        <div id="porcentajeamarillo"></div>
        <div class="raya" id="raya1"></div>
        <div class="raya" id="raya2"></div>
        <div class="raya" id="raya3"></div>
        <div class="raya" id="raya4"></div>
        <div class="raya" id="raya5"></div>
    </div>
    <div id="azul" class="color azul">
        <div id="porcentajeazul"></div>
        <div class="raya" id="raya1"></div>
        <div class="raya" id="raya2"></div>
        <div class="raya" id="raya3"></div>
        <div class="raya" id="raya4"></div>
        <div class="raya" id="raya5"></div>
    </div>
    <div id="rojo" class="color rojo">
        <div id="porcentajerojo"></div>
        <div class="raya" id="raya1"></div>
        <div class="raya" id="raya2"></div>
        <div class="raya" id="raya3"></div>
        <div class="raya" id="raya4"></div>
        <div class="raya" id="raya5"></div>
    </div>
    <div id="verde" class="color verde">
        <div id="porcentajeverde"></div>
        <div class="raya" id="raya1"></div>
        <div class="raya" id="raya2"></div>
        <div class="raya" id="raya3"></div>
        <div class="raya" id="raya4"></div>
        <div class="raya" id="raya5"></div>
    </div>
</div>
<div id='contenedor3' class='contenedor3'>
    <div id='title3' class='title'>Configuración</div>
    <div id='atras' onclick='funcion4()' class='atras'></div>
    <form action="config.php" method="post">
        <div id='editar' class='editar'><button>Editar</button> </div>
    </form>
    <div class='border1'></div>
    <div class='border2'></div>
    <div class='border3'></div>
    <div class='border4'></div>
</div>
</body>
</html>
