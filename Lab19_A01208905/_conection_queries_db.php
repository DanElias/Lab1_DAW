<?php

    //se conecta con la base de datos indicada
    function conectDb(){//¿Estos parámetros deben de cambiar cuando la págn se suba a otro servidor que no sea tu propia pc?
        $servername = "localhost";
        $username = "danelias";
        $password = "";
        $dbname = "laboratorios_dawbd"; // estos datos obviamente varían con el ambiente de desarrollo utilizado
        
        $con = mysqli_connect($servername, $username, $password, $dbname);
        
        //Check connection
        if(!$con){
            //die("Connection failed: ".mysqli_connect_error());
            die("Error 505: Internal Sever Error");
        }
        
        return $con;
    }

    //cierra la conexión con la base de datos
    function closeDb($mysql){
        mysqli_close($mysql);
    }

    //obtiene todas las tuplas con todos sus datos
    function obtenerEventos(){
        
        $conn = conectDb();
        
        $sql = "SELECT id_evento, nombre, fecha, lugar, descripcion FROM evento";
        
        $result = mysqli_query($conn, $sql);
        
        closeDb($conn);
        
        return $result;
        
        echo $result;
    }

    // regresa todos los datos de una tupla cuyo nombre sea igual al especificado
    function obtenerEventosPorNombre($nombre_evento){
        $conn = conectDb();
        
        $sql = "SELECT id_evento, nombre, fecha, lugar, descripcion FROM evento WHERE nombre LIKE '%".$nombre_evento."%'";
        
        $result = mysqli_query($conn, $sql);
        
        closeDb($conn);
        
        return $result;
    }

    // regresa todos los datos de una tupla cuyo fecha ocurra antes o igual a una fecha especificada.
    function obtenerEventosPorFecha($fecha_evento){//Las fechas se guardan como 1998-03-28
        $conn = conectDb();
        
        $sql = "SELECT id_evento, nombre, fecha, lugar, descripcion FROM evento WHERE fecha LIKE '%".$fecha_evento."%'";
        
        echo $sql;
        
        $result = mysqli_query($conn, $sql);
        
        closeDb($conn);
        
        return $result;
    }
    
    function obtenerEventosPorID($id_evento){
        $conn = conectDb();
        
        $sql = "SELECT id_evento, nombre, fecha, lugar, descripcion FROM evento WHERE id_evento = '".$id_evento."'";
        
        $result = mysqli_query($conn, $sql);
        
        closeDb($conn);
        
        return $result;
    }
    
    //Inserta un nuevo evento en la base de datos
    function insertarEvento($nombre_evento,$fecha_evento,$lugar_evento, $descripcion_evento){
        $conn=conectDb();
        
        $sql="INSERT INTO evento (id_evento,nombre,fecha,lugar,descripcion) VALUES 
        (0,\"".$nombre_evento."\",\"".$fecha_evento."\",\"".$lugar_evento."\",\"". $descripcion_evento."\") ";
        
        if(mysqli_query($conn,$sql)){
            closeDb($conn);
            return true;
        }
        else{
            closeDb($conn);
            return false;
        }
        
    }
    
    //Inserta un nuevo evento en la base de datos
    function editarEvento($id_evento, $nombre_evento,$fecha_evento,$lugar_evento, $descripcion_evento){
        $conn=conectDb();
        
        $sql="UPDATE evento SET id_evento=$id_evento, nombre='".$nombre_evento."', fecha='".$fecha_evento."', lugar='".$lugar_evento."', descripcion='".$descripcion_evento."'
        WHERE id_evento=".$id_evento."";
        
        if(mysqli_query($conn,$sql)){
            closeDb($conn);
            return true;
        }
        else{
            closeDb($conn);
            return false;
        }
        
    }
    
    //borra el evento que tenga el id 
     function eliminarEventoPorID($id_evento){
        $conn = conectDb();
        
        $sql = "DELETE FROM evento WHERE id_evento ='".$id_evento."'";
        
        if(mysqli_query($conn,$sql)){
            closeDb($conn);
            return true;
        }
        else{
            closeDb($conn);
            return false;
        }
    }


?>