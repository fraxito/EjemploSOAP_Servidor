<?php

function conectaBBDD(){
    // https://bit.ly/3oFLDmR  para la BBDD
    //Tres parámetros para la conexion
    // nombre de la base de datos
    $BBDD = 'test';
    //usuario BBDD
    $usuario_bbdd = 'root';
    //contraseña mysql
    $pass = '';

    $conexion = new mysqli('localhost', $usuario_bbdd, $pass, $BBDD);
    $consulta = $conexion -> query("SET NAMES UTF8");
    return $conexion;
}



// $consultaPrueba = $conexion -> query("SELECT * FROM usuariosAlmacen");
// for ($i=0; $i< $consultaPrueba->num_rows; $i++){
//     $r = $consultaPrueba->fetch_array();
//     echo 'usuario: '.$r['DNI'].' nombre: '.$r['nombre'].'<br>';
// }

class ServicioDeUsuarios{
    private $_DNI;
    private $_PASSWORD;

    public function login($dni, $password){
        $conexion = conectaBBDD();
        $this->_DNI = $dni;
        $this->_PASSWORD = $password;
        $consulta_usuarios = $conexion -> prepare("SELECT * FROM usuariosAlmacen
                                                    WHERE DNI = ? ");
        $consulta_usuarios -> bind_param("s", $dni);
        $consulta_usuarios ->execute();
        $consulta_usuarios ->store_result();
        $consulta_usuarios ->bind_result($DNI_, $clave, $email, $nombre, $apellidos, $sexo);
        $consulta_usuarios ->fetch();

        return $nombre.' '.$apellidos;
    }
}

$servidor = new SoapServer(null, array('uri' => 'urn:webservices'));
$servidor->setClass('ServicioDeUsuarios');
$servidor->handle();

//NOTA: PARA QUE EL SOAP FUNCIONE EN XAMPP:
// hay que descomentar la linea ;extension=soap
// en el php.ini  (se puede editar desde XAMPP)
