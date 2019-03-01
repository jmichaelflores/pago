<?php
/**
 * Ejemplo de como guardar el contenido de un formulario en una base de datos MySQL
 * http://www.lawebdelprogramador.com
 */

$databaseHost="localhost";
$databaseName="test";
$databaseUser="all";
$databasePassword="all";
$valoresSelect=array(1=>"rojo", "azul", "verde");

try {
    # Conectamos con la base de datos...
    $dbh = new PDO("mysql:host=".$databaseHost.";dbname=".$databaseName, $databaseUser, $databasePassword);
} catch(PDOException $err) {
    echo "<pre>".print_r($err,true)."</pre>";
    exit();
}

# Si hemos pulsado el boton...
if($_POST["botonEnviar"])
{
    try {
        # Creamos la cadena sql
        $sql="INSERT INTO `pruebaFormulario`
            (
                `text`,`textArea`,`select`,`checkbox`
            )VALUES(
                :text, :textArea, :select, :checkbox
            )";
        # Preparamos la cadena para guardar los datos
        $sth=$dbh->prepare($sql);
        # Creamos el array con los valores a ser reemplazados en la cadena sql
        # En el textArea, reemplazamos los saltos de linea por <br> con la funcion
        # nl2br, para poder mostrarlos en la web.
        $arrayValores=array(
                ':text'=>$_POST["text"],
                ':textArea'=>nl2br($_POST["textArea"]),
                ':select'=>$_POST["select"],
                ':checkbox'=>($_POST["checkbox"]=="on"?1:0)
            );
        # Ejecutamos la consulta sql insertando los valores en la tabla
        $sth->execute($arrayValores);
        
        echo "A&ntilde;adido con el ID: ".$dbh->lastInsertId();
    } catch(PDOException $err) {
        echo "<pre>".print_r($err,true)."</pre>";
        exit();
    }
}
?>
<!DOCTYPE html>
<!--http://www.lawebdelprogramador.com-->
<html>
<head>
    <title>La Web del Programador - Ejemplo de guardar un formulario en base de datos con PDO</title>
    <style>
    /* estilos para el formulario */
    .title      {clear:both;float:left;width:100px;}
    .input      {float:left;}
    .button     {clear:both;padding-top:10px;}
    input       {border:1px solid;}
    /* estilos para mostrar el contenido de la base de datos */
    #contenidoDatos {margin-top:20px;padding-top:5px;border-top:1px solid;}
        #contenidoDatos .id         {clear:both;float:left;width:20px;}
        #contenidoDatos .text       {float:left;width:100px;}
        #contenidoDatos .textArea   {float:left;width:200px;}
        #contenidoDatos .select     {float:left;width:50px;}
        #contenidoDatos .checkbox   {float:left;width:10px;}
    </style>
</head>

<body>
<h2>La Web del Programador<br />Ejemplo de guardar un formulario en base de datos con PDO</h2>
<form action='<?php echo $_SERVER["PHP_SELF"]?>' method='POST'>
    <div class='title'>texto</div>
    <div class='input'><input type="text" name="text" maxsixe="100"></div>
    
    <div class='title'>textArea</div>
    <div class='input'><textarea name="textArea" cols="40" rows="5">Pon un texto</textarea></div>
    
    <div class='title'>select</div>
    <div class='input'>
        <select name="select">
            <option value='0'>Selecciona un color</option>
            <?php
            # mostramos las opciones del array de valores
            foreach($valoresSelect as $key=>$value)
            {
                echo "<option value='".$key."'>".$value."</option>";
            }
            ?>
        </select>
    </div>
    
    <div class='title'>checkbox</div>
    <div class='input'><input type="checkbox" name="checkbox"></div>
    
    <div class='button'>
        <input type='submit' name='botonEnviar' value='Guardar valores'>
    </div>
</form>

<div id="contenidoDatos">
    <?php
    # Aqui vamos a mostrar el contenido de la base de datos...

    # Creamos la cadena sql
    $sql="SELECT * FROM `pruebaFormulario` ORDER BY id DESC";
    # Hacemos la consulta a la base de datos y recorremos todos los valores
    foreach($dbh->query($sql) as $row)
    {
        # Mostramos el contenido de la base de datos
        echo "<div class='id'>".$row["id"]."</div>";
        echo "<div class='text'>".($row["text"]?$row["text"]:"-")."</div>";
        echo "<div class='textArea'>".($row["textArea"]?$row["textArea"]:"-")."</div>";
        echo "<div class='select'>";
            if($row["select"]==0)
            {
                # Si no ha seleccionado ningun valor...
                echo "-";
            }else{
                # Mostramos el color del array de valores
                echo $valoresSelect[$row["select"]];
            }
        echo "</div>";
        echo "<div class='checkbox'>".$row["checkbox"]."</div>";
    }
    ?>
</div>
</body>
</html>
