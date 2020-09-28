<?php

    ini_set("display_errors", 1);   
    header("Content-Type: text/html; charset=ISO_8859-1");
    //header("Content-Type: text/html;charset=utf-8");
    header("Content-type: text/javascript; charset=iso-8859-1");
    date_default_timezone_set('America/Monterrey'); 
    /*

    CREATE USER 'advenqgk_iasd'@'localhost' IDENTIFIED BY 'thanks_God7';
GRANT ALL PRIVILEGES ON advenqgk_iasd.* TO 'advenqgk_iasd'@'localhost';
ALTER USER 'advenqgk_iasd'@'localhost' IDENTIFIED WITH mysql_native_password BY 'thanks_God7';

    $variables = array_keys($HTTP_POST_VARS); 
    $valores = array_values($HTTP_POST_VARS); 
     
    for($a=0;$a<count($valores);$a++){ 
        $valores[$a] = ($valores[$a]); 
    } 
    for($a=0;$a<count($valores);$a++){ 
        $cadena = $variables[$a]; 
        $$cadena = $valores[$a]; 
    }*/  
if(!isset($_SESSION))
    {
        ini_set("session.cookie_lifetime","36000");
        ini_set('session.gc_maxlifetime', "36000");
        // each client should remember their session id for EXACTLY 10 hour
        session_set_cookie_params(36000);
       
       session_start();  
    }
class connectionMinisterial {
    public $conn;       
    public $flagConn;   
    private $username;
    private $password;
    private $hostname;
    private $database;
    public function __construct(){
        $this->username = "advenqgk_iasd";
        $this->password = "thanks_God7";
        $this->hostname = "localhost";
        $this->database = "advenqgk_iasd";
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if ($this->conn){
            $this->flagconn = true;
        }else{
            $this->flagconn = false;
        }
    }
    public function __destruct(){
        mysqli_close($this->conn);
    }
}
    $recordset = new connectionMinisterial();
    $servicio = "";
    $accion = "";
    if(isset($_POST["servicio"]))
    {
        $servicio = $_POST['servicio'];
    }
    if(isset($_POST["accion"]))
    {
        $accion = $_POST['accion'];
    }
    
    
   
        if($servicio!="login" || $accion !="access")
        {
           if (!isset($_SESSION['nombre']) && $accion !="mandarCorreoRecuperarContrasena")
            {
                if(isset($_POST["hash"]))
                {
                    $hash = $_POST["hash"];
                    $fechaFinal = date('Ymd', time());
                    $fechaFinal = "".$fechaFinal;
                    $ano = substr($fechaFinal,0,4);
                    $mes = substr($fechaFinal,4,2);
                    $dia = substr($fechaFinal,6,2);
                    $date2=$ano."-".$mes."-".$dia;
                    $hashPHP = base64_encode(hash("sha512",$date2));
                    if($hash!=$hashPHP)
                    {
                        header('Location: index.php?error=-1');
                        exit();    
                    }
                }
                else
                {
                    header('Location: index.php?error=1');
                    exit();
                }
            }
        }
    
    if(isset($_GET['servicio']))
    {
        $servicio = $_GET['servicio'];
    }
    if(isset($_GET['accion']))
    {
        $accion = $_GET['accion'];
    }
function damePastorDeIglesia()
{
    $regresaID = 0;
    $recordsetAux = new connectionMinisterial();
    
    $sql3X=("SELECT idGrupo, idUsuarioCampo FROM verAccionesDeGrupos WHERE idGrupo = ".$_SESSION["idGrupo"].")");
    //$sql3X=("SELECT du.idUsuarioCampo FROM Grupos g INNER JOIN Distritos d on g.idDistrito = d.idDistrito INNER JOIN DistritosUsuarios du on d.idDistrito = du.idDistrito WHERE g.idGrupo = ".$_SESSION["idGrupo"]);
    if($query3X = mysqli_query($recordsetAux->conn,$sql3X))
    {
        if($row3X=mysqli_fetch_array($query3X,MYSQLI_ASSOC))
        {
            $regresaID = $row3X["idUsuarioCampo"];
        }
    }
    return $regresaID;
}
function checarSesionDistrito()
{
    if(!isset($_SESSION['idDistrito']))
    {
        if(isset($_POST["hash"]))
        {
            $hash = $_POST["hash"];
            $fechaFinal = date('Ymd', time());
            $fechaFinal = "".$fechaFinal;
            $ano = substr($fechaFinal,0,4);
            $mes = substr($fechaFinal,4,2);
            $dia = substr($fechaFinal,6,2);
            $date2=$ano."-".$mes."-".$dia;
            $hashPHP = base64_encode(hash("sha512",$date2));
            if($hash!=$hashPHP)
            {
                echo '{ "success" : -1 }';
                exit();    
            }
            else
            {

            }
        }
        else
        {
            echo '{ "success" : 0 }';
            exit();    
        }
    }
}    
function checarSesionUsuarios()
{

    if(!isset($_SESSION['nombre']))
    {
        if(isset($_POST["hash"]))
        {
            $hash = $_POST["hash"];
            $fechaFinal = date('Ymd', time());
            $fechaFinal = "".$fechaFinal;
            $ano = substr($fechaFinal,0,4);
            $mes = substr($fechaFinal,4,2);
            $dia = substr($fechaFinal,6,2);
            $date2=$ano."-".$mes."-".$dia;
            $hashPHP = base64_encode(hash("sha512",$date2));
            if($hash!=$hashPHP)
            {
                echo '{ "success" : -1 }';
                exit();    
            }
            else
            {

            }
        }
        else
        {
            echo '{ "success" : 0 }';
            exit();    
        }
    }
} 
function checarPermisoAdministrador()
{
    if(!isset($_SESSION['idCampo']))
    {
        if(isset($_POST["hash"]))
        {
            $hash = $_POST["hash"];
            $fechaFinal = date('Ymd', time());
            $fechaFinal = "".$fechaFinal;
            $ano = substr($fechaFinal,0,4);
            $mes = substr($fechaFinal,4,2);
            $dia = substr($fechaFinal,6,2);
            $date2=$ano."-".$mes."-".$dia;
            $hashPHP = base64_encode(hash("sha512",$date2));
            if($hash!=$hashPHP)
            {
                echo '{ "success" : -2 }';
                exit();    
            }
        }
        else
        {
            echo '{ "success" : 0 }';
            exit();    
        }
    }
} 
function respuestaNegativa()
{
     if(isset($_POST["hash"]))
        {
            $hash = $_POST["hash"];
            $fechaFinal = date('Ymd', time());
            $fechaFinal = "".$fechaFinal;
            $ano = substr($fechaFinal,0,4);
            $mes = substr($fechaFinal,4,2);
            $dia = substr($fechaFinal,6,2);
            $date2=$ano."-".$mes."-".$dia;
            $hashPHP = base64_encode(hash("sha512",$date2));
            if($hash!=$hashPHP)
            {
                echo '{ "success" : -3 }';
                exit();    
            }
        }
        else
        {
            echo '{ "success" : 0 }';
            exit();    
        }
} 
function randomClave() 
{
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
   
function randomPassword() 
{
    //$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $alphabet = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
switch($servicio)
    {
        case 'notifications':
                switch($accion)
                {
                    case 'sube2020':
                    $sql2=("SELECT anio, accion, accionPasado, idDepartamentosAccionesIglesias, indicador, motor, objetivo, tipo, nombre FROM verAccionesDeDepartamentosAccionesIglesias WHERE anio = 2020  order by idDepartamentosAccionesIglesias asc");
                     //$sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo, dd.nombre FROM DepartamentosAccionesIglesias d INNER JOIN Motores m on m.idMotor = d.motor INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos INNER JOIN Departamentos dd on d.idDepartamento = dd.idDepartamento WHERE d.anio = 2020  order by d.idDepartamentosAccionesIglesias asc");
                    if($query2 = mysqli_query($recordset->conn,$sql2))
                    {
                        while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                        {
                            $sql22=("DELETE FROM ActividadesSugerentesIglesia WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]);
                                if($query22 = mysqli_query($recordset->conn,$sql22))
                                {
                                }
                            
                        }
                    }
                    $sql2=("SELECT anio, accion, accionPasado, idDepartamentosAccionesIglesias, indicador, motor, objetivo, tipo, nombre FROM verAccionesDeDepartamentosAccionesIglesias WHERE anio = 2020  order by idDepartamentosAccionesIglesias asc");
                   //$sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo, dd.nombre FROM DepartamentosAccionesIglesias d INNER JOIN Motores m on m.idMotor = d.motor INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos INNER JOIN Departamentos dd on d.idDepartamento = dd.idDepartamento WHERE d.anio = 2020  order by d.idDepartamentosAccionesIglesias asc");
                    echo $sql2."<br><br>\n\n";
                    if($query2 = mysqli_query($recordset->conn,$sql2))
                    {
                        while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                        {
                            $idDepartamentosAccionesIglesiasINSERT = $row2["idDepartamentosAccionesIglesias"];
                            $accionPasado = ($row2["accionPasado"]);
                            $sql3=("SELECT idDepartamentosAccionesIglesias
                             FROM DepartamentosAccionesIglesias 
                             WHERE accionPasado = '".$accionPasado."'
                             ORDER BY idDepartamentosAccionesIglesias ASC");
                            echo $sql3."<br><br>\n\n";
                            if($query3 = mysqli_query($recordset->conn,$sql3))
                            {
                                if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                {
                                    $idDepartamentosAccionesIglesiasQUERY = $row3["idDepartamentosAccionesIglesias"];
                                    $sql4=("SELECT idDepartamento, descripcion, titulo
                                     FROM ActividadesSugerentesIglesia 
                                     WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesiasQUERY);
                                    echo $sql4."<br><br>\n\n";
                                    if($query4 = mysqli_query($recordset->conn,$sql4))
                                    {
                                        while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                        {
                                         //   $row4["descripcion"] = ($row4["descripcion"]);
                                           // $row4["titulo"] = ($row4["titulo"]);
                                            $sql5=("INSERT INTO ActividadesSugerentesIglesia (idDepartamento, descripcion, idDepartamentosAccionesIglesias, titulo, origen) VALUES (".$row4["idDepartamento"].", '".$row4["descripcion"]."',".$idDepartamentosAccionesIglesiasINSERT.",  '".$row4["titulo"]."', -1 )");
                                            echo $sql5."<br><br>\n\n";
                                            if($query5 = mysqli_query($recordset->conn,$sql5))
                                            {
                                            }
                                        }
                                    }
                            
                                }
                            }
                        }
                    }
                    echo '{ "success" : -1 }';
                        exit(0);
                    break;
                    case 'newToken': 
                        $tipo = $_POST['tipo'];
                        $token = $_POST['token'];
                        $idCampo = $_POST['idCampo'];
                        $correo = $_POST['correo'];
                        $sql2=("SELECT token FROM tokens WHERE token = '".$token."' AND tipo = ".$tipo);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                echo '{ "success" : 1, "sql" : "'.$sql2.'" }';
                                exit(0);
                            }
                            else
                            {
                                $sql3=("INSERT INTO tokens (tipo, token, timestamp, idCampo, correo) values('".$tipo."', '".$token."', ".time().", ".$idCampo.", '".$correo."' )");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    echo '{ "success" : 1  , "sql" : "'.$sql3.'"}';
                                    exit(0);
                                }
                            }
                        }
                        echo '{ "success" : 0 }';
                        exit(0);   
                    break;
                }
        break; 
        case 'actividadesSugerentes':
                switch($accion)
                {
                    case 'agregarActividadesSugerentesDeParteDeLaIglesia':    
                        checarSesionUsuarios();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $descripcion = ($_POST['descripcion']);
                        $titulo = ($_POST['titulo']);
                        $sql2=("INSERT INTO ActividadesSugerentesIglesia  (origen, titulo, idDepartamentosAccionesIglesias, descripcion) VALUES (".$_SESSION["idGrupo"].", '".$titulo."', ".$idDepartamentosAccionesIglesias.", '".$descripcion."')");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            $idActividadesSugerentesIglesia = mysqli_insert_id($recordset->conn);
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarActividadesSugerentes':    
                        checarSesionUsuarios();
                        $idDepartamento = $_POST['idDepartamento'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $ene = $_POST['ene'];
                        $feb = $_POST['feb'];
                        $mar = $_POST['mar'];
                        $abr = $_POST['abr'];
                        $may = $_POST['may'];
                        $jun = $_POST['jun'];
                        $jul = $_POST['jul'];
                        $ago = $_POST['ago'];
                        $sep = $_POST['sep'];
                        $oct = $_POST['oct'];
                        $nov = $_POST['nov'];
                        $dic = $_POST['dic'];
                        
                        $descripcion = ($_POST['descripcion']);
                        $titulo = ($_POST['titulo']);
                        $sql2=("INSERT INTO ActividadesSugerentesIglesia  (origen, titulo, idDepartamentosAccionesIglesias, idDepartamento, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic) VALUES (-1, '".$titulo."', ".$idDepartamentosAccionesIglesias.", ".$idDepartamento.", '".$descripcion."', ".$ene.", ".$feb.", ".$mar.", ".$abr.", ".$may.", ".$jun.", ".$jul.", ".$ago.", ".$sep.", ".$oct.", ".$nov.", ".$dic." )");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            $idActividadesSugerentesIglesia = mysqli_insert_id($recordset->conn);
                            //$nombreArchivo = $idActividadesSugerentesIglesia."-".$_POST["nombre"];
                            //move_uploaded_file($_FILES['archivo']['tmp_name'], 'images/archivos/' . $nombreArchivo);
                            //$sql=("UPDATE ActividadesSugerentesIglesia SET archivo =  '".$nombreArchivo."' WHERE idActividadesSugerentesIglesia = ".$idActividadesSugerentesIglesia);
                            //if($query = mysqli_query($recordset->conn,$sql))
                            //{
                                echo '{ "success" : 1 }';
                                exit(0);
                            //}
                        }
                    break;
                    case 'eliminaActividadesSugerentes':    
                        checarSesionUsuarios();
                        $idActividadesSugerentesIglesia = $_POST['idActividadesSugerentesIglesia'];
                        $sql3=("SELECT archivo FROM ActividadesSugerentesIglesia WHERE idActividadesSugerentesIglesia = ".$idActividadesSugerentesIglesia);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                unlink("images/archivos/".$row3["archivo"]);
                                $sql2=("DELETE FROM ActividadesSugerentesIglesia  WHERE  idActividadesSugerentesIglesia = ".$idActividadesSugerentesIglesia);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                        }        
                    break;
                    case 'listaPorDepartamento':   
                        checarSesionUsuarios();
                        $idDepartamento = $_POST['idDepartamento'];
                        

                        $inventario = array();
                        $sql2=('SELECT accion, indicador, idDepartamentosAccionesIglesias, motor FROM verAccionesDeDepartamentosAccionesIglesiasIdDepartamento WHERE idDepartamento = '.$idDepartamento.' order by o.motor asc, o.idDepartamentosAccionesIglesias asc');
                         //$sql2=('SELECT o.accion, o.indicador, o.idDepartamentosAccionesIglesias, m.motor FROM DepartamentosAccionesIglesias o INNER JOIN Motores m on m.idMotor = o.motor WHERE o.idDepartamento = '.$idDepartamento.' order by o.motor asc, o.idDepartamentosAccionesIglesias asc');                        
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                array_push($inventario, $row2);
                            }
                        }
                        $actividades = array();


                        $sql2=("SELECT idActividadesSugerentesIglesia, archivo, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic FROM ActividadesSugerentesIglesia WHERE idDepartamento = ".$idDepartamento." order by idActividadesSugerentesIglesia asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["descripcion"] = ($row2["descripcion"]);
                                array_push($actividades, $row2);
                            }
                            echo '{ "success" : 1, "actividades" : '.json_encode($actividades).', "inventario" : '.json_encode($inventario).'}';
                            exit(0);
                        }
                    break;
                }
        break;
        case 'config':
                switch($accion)
                {
                    case 'presidenteCampo': 
                        checarSesionUsuarios();
                        checarPermisoAdministrador();  
                        $idCampo = $_POST['idCampo'];
                        $idUsuarioCampo = $_POST['idUsuarioCampo'];
                        $sql=("UPDATE UsuariosCampos SET departamento = -1 WHERE idCampo = ".$idCampo." AND departamento = 0");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            $sql=("UPDATE UsuariosCampos SET departamento = 0, idCampo = ".$idCampo."  WHERE idUsuarioCampo = ".$idUsuarioCampo."");
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                echo '{ "success" : 1 }';
                                exit(0);
                            }
                        }
                    break;
                    case 'fechaCampos': 
                        checarSesionUsuarios();
                        checarPermisoAdministrador();  
                        $idCampo = $_POST['idCampo'];
                        $fecha = $_POST['fecha'];
                        $sql=("UPDATE Campos SET periodoTimestamp =  ".$fecha." WHERE idCampo = ".$idCampo);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'listaCampos':   
                        checarSesionUsuarios();
                        $lista = array();
                        $disponibles = array();
                        $sql=("SELECT idUsuarioCampo, nombre FROM verAccionesDeUsuariosCampos WHERE idUsuarioCampo IS NULL OR departamento = 0");
                        //$sql=("SELECT u.idUsuarioCampo, u.nombre FROM UsuariosCampos u LEFT JOIN DepartamentosUsuarios d on u.idUsuarioCampo = d.idUsuarioCampo WHERE d.idUsuarioCampo IS NULL OR u.departamento = 0");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                $row["nombre"] = ($row["nombre"]);
                                array_push($disponibles, $row);
                            }
                        }
                        $sql=("SELECT c.idCampo, c.nombre, c.periodoTimestamp
                            FROM Campos c
                             WHERE  c.idCampo != 11 ");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                $rowX = array();
                                $rowX["idCampo"] = $row["idCampo"];
                                $rowX["nombre"] = ($row["nombre"]);
                                $rowX["periodoTimestamp"] = $row["periodoTimestamp"];
                                $rowX["persona"] = '';
                                $rowX["idUsuarioCampo"] = 0;
                                $sql2=("SELECT u.idUsuarioCampo, u.nombre as persona
                                    FROM UsuariosCampos u
                                     WHERE u.departamento = 0 AND u.idCampo = ".$row["idCampo"]);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                    {
                                        $rowX["persona"] = ($row2["persona"]);
                                        $rowX["idUsuarioCampo"] = $row2["idUsuarioCampo"];    
                                    }
                                }
                                array_push($lista, $rowX);
                            }
                            echo '{ "success" : 1, "lista" : '.json_encode($lista).', "disponibles" : '.json_encode($disponibles).'}';
                            exit(0);
                        }                       
                    break;
                    case 'cambiaContraDesdeRecuperacion':   
                        $nuevoPass = sha1($_POST['pass']);
                        $antiguoPass = $_SESSION["h"];
                        $correo = $_SESSION["c"];
                        $sql=("SELECT idUsuario FROM Usuarios WHERE pass = '".$antiguoPass."' AND correo = '".$correo."' AND activo = 1");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                $sql1=("UPDATE Usuarios SET pass =  '".$nuevoPass."' WHERE idUsuario = ".$row["idUsuario"]);
                                if($query1 = mysqli_query($recordset->conn,$sql1))
                                {
                                    echo '{ "success" : 1 }';
                                    exit();
                                }
                            }
                        }                       
                    break;
                    case 'mandarCorreoRecuperarContrasena':   
                        $correo = $_POST['correo'];
                        $sql=("SELECT pass FROM Usuarios WHERE correo = '".$correo."' AND activo = 1");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                $url = 'http://200.188.142.250:1991/mandaCorreo?c='.$correo.'&a=Generacion%20de%20nueva%20contrasena&m=<div>Tu usuario para el sistema es: '.$correo.', Para cambiar de contrase&ntilde;a, por favor  <a href="http://juntas.adventistasumn.org/recuperarContrasena.php?c='.$correo.'&h='.$row["pass"].'" target="_blank"/>da click aqui</a></div>&uno=&dos=&tres=';
 
                                $contents = file_get_contents($url);
                                echo '{ "success" : 1 }';
                                exit(0);
                                 

                                require_once 'PHPMailerAutoload.php';
                                $mail = new PHPMailer();
                                $mail->isSMTP();
                                $mail->SMTPDebug = 0;
                                $mail->Debugoutput = 'html';
                                $mail->Host = 'smtp.gmail.com';  
                                $mail->Port = 587;
                                $mail->SMTPSecure = 'tls';
                                $mail->SMTPAuth = true;
                                $mail->Username = "f.pecina@unav.edu.mx";
                                $mail->Password = "thanks_God1863";
                                $mail->setFrom('sistemas@adventistasumn.org', 'Juntas Adventistas');
                                $mail->addReplyTo('soporte@transformameumn.org', 'Soporte');
                                $mail->addAddress($correo, 'Usuario');
                                $mail->addBCC('f.pecina@unav.edu.mx', 'CC');
                                $mail->Subject = 'Generacion de nueva contrasena';
                                $mail->msgHTML('<div>Tu usuario para el sistema es: '.$correo.', Para cambiar de contrase&ntilde;a, por favor  <a href="http://juntas.adventistasumn.org/recuperarContrasena.php?c='.$correo.'&h='.$row["pass"].'" target="_blank"/>da click aqui</a></div>');
                                if (!$mail->send()) {
                                   echo '{ "success" : -1 , "error" : '.$mail->ErrorInfo.'}';
                                } else {
                                    echo '{ "success" : 1 }';
                                }
                                exit(0);
                            }
                        }                    
                    break;
                    case 'cambiaContra':   
                        checarSesionUsuarios();
                        $pass = sha1($_POST['pass']);
                        $sql=("UPDATE UsuariosCampos SET pass =  '".$pass."' WHERE idUsuarioCampo = ".$_SESSION["idUsuarioCampo"]);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }                        
                    break;
                    case 'mandaCorreo':   
                        checarSesionUsuarios();
                        $idUsuarioCampo = $_POST['idUsuarioCampo'];
                        $sql=("SELECT correo FROM UsuariosCampos WHERE idUsuarioCampo = ".$idUsuarioCampo."");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                $pass = randomPassword();
                                $passSHA1 = sha1(sha1($pass));
                                $sql2=("UPDATE UsuariosCampos SET pass =  '".$passSHA1."' WHERE idUsuarioCampo = ".$idUsuarioCampo);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                  /*  $a = urlencode('Sistema Senor Transformame UMN');
                                    $m = urlencode('<div>Tu usuario para el sistema es: '.$row["correo"].', <br>Tu contrase&ntilde;a es  '.$pass.'  <br>La pagina es: <a href="http://transformameumn.org/">http://transformameumn.org/</a> </div>');
                                    $url = 'http://200.188.142.250:1991/mandaCorreo?c='.$row["correo"].'&a='.$a.'&m='.$m.'&uno=&dos=&tres=';
                                    //echo $url;
                                     $contents = file_get_contents($url);
                                    exit(0);
                                    
                                    $ch = curl_init();


                                    // Set the URL that you want to GET by using the CURLOPT_URL option.
                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
                                    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                                    // Execute the request.
                                    $data = curl_exec($ch);
                                    // Close the cURL handle.
                                    curl_close($ch);
                                    // Print the data out onto the page.
                                    // echo $data;
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                    */
                                    require_once 'PHPMailerAutoload.php';
                                    $mail = new PHPMailer();
                                    $mail->isSMTP();
                                    $mail->SMTPDebug = 0;
                                    $mail->Debugoutput = 'html';
                                    $mail->Host = 'smtp.gmail.com';  
                                    $mail->Port = 587;
                                    $mail->SMTPSecure = 'tls';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = "f.pecina@unav.edu.mx";
                                    $mail->Password = "thanks_God1863";
                                    $mail->setFrom('sistemas@adventistasumn.org', 'Senor Transformame');
                                    $mail->addReplyTo('f.pecina@unav.edu.mx', 'Soporte');
                                    $mail->addAddress($row["correo"], 'Usuario');
                                    $mail->addBCC('f.pecina@unav.edu.mx', 'CC');
                                    $mail->addBCC($_SESSION["correo"], 'CCC');
                                    $mail->Subject = 'Sistema Senor Transformame UMN';
                                    $mail->msgHTML('<div>Tu usuario para el sistema es: '.$row["correo"].', <br>Tu contrase&ntilde;a es  '.$pass.'  <br>La pagina es: <a href="http://transformameumn.org/">http://transformameumn.org/</a> </div>');
                                    if (!$mail->send()) {
                                       echo '{ "success" : -1 , "error" : '.$mail->ErrorInfo.'}';
                                    } else {
                                        echo '{ "success" : 1 }';
                                    }
                                    exit(0);
                                }      
                            }
                        }
                    break;
                }
        break;
        case 'motor':
                switch($accion)
                {
                    case 'agregarMeta':    
                        checarSesionUsuarios();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $indicador = $_POST['indicador'];
                        $descripcionMeta = ($_POST['descripcionMeta']);
                        $metaNumero = $_POST['metaNumero'];
                        $anio = $_POST['anio'];
                        $sql2=("INSERT INTO MetasEstrategicas  (idDepartamentosAcciones, meta, indicador, metaNumero, idUsuarioCampo, idCampo, anio) 
                            VALUES (".$idDepartamentosAcciones.", '".$descripcionMeta."', ".$indicador.", ".$metaNumero." , ".$_SESSION["idUsuarioCampo"]." , ".$_SESSION["idCampo"].", ".$anio." )");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarPresupuestoMeta':    
                        checarSesionUsuarios();
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $concepto = ($_POST['concepto']);
                        $presupuesto = $_POST['cantidad'];
                        $sql2=("INSERT INTO PresupuestoMetas  (idMetasEstrategicas, concepto, presupuesto) VALUES (".$idMetasEstrategicas.", '".$concepto."', ".$presupuesto.")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminaPresupuestoMeta':    
                        checarSesionUsuarios();
                        $idPresupuestoMetas = $_POST['idPresupuestoMetas'];
                        $sql2=("DELETE FROM PresupuestoMetas  WHERE  idPresupuestoMetas = ".$idPresupuestoMetas);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarFechaAccionCampo2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $idMetas2018 = $_POST['idMetas2018'];
                        $fechaAnadirAccionCampo = ($_POST['fechaAnadirAccionCampo']);
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $idUsuarioCampo = $_SESSION["idUsuarioCampo"];
                        $idCampo = $_SESSION["idCampo"];
                        $idFechasMetas = 0;
                        $sql2=("SELECT insertFechasMetasIdMetasEstrategicas (".$idMetasEstrategicas.", '".$fechaAnadirAccionCampo."', '', ".$anio.")");
                        //$sql2=("INSERT INTO FechasMetas (idMetasEstrategicas, fechaInicial, fechaFinal, anio) VALUES (".$idMetasEstrategicas.", '".$fechaAnadirAccionCampo."', '', ".$anio.")");
                        $sql3=("SELECT idFechasMetas FROM FechasMetas WHERE idMetasEstrategicas = ".$idMetasEstrategicas." AND anio = ".$anio);
                        $insert = true;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql2=("SELECT updateFechasMetasFechaInicial('".$fechaAnadirAccionCampo."', ".$row3["idFechasMetas"].");");
                                //$sql2=("UPDATE FechasMetas  SET concepto = '".$fechaAnadirAccionCampo."' WHERE idFechasMetas = ".$row3["idFechasMetas"]);
                                $idFechasMetas = $row3["idFechasMetas"];
                                $insert = false;
                            }
                            $sql2=("SELECT insertFechasMetasIdMetasEstrategicas (".$idMetasEstrategicas.", '".$fechaAnadirAccionCampo."', '', ".$anio.")");
                            //$sql2=("INSERT INTO FechasMetas (idMetasEstrategicas, fechaInicial, fechaFinal, anio) VALUES (".$idMetasEstrategicas.", '".$fechaAnadirAccionCampo."', '', ".$anio.")");
                            $insert = true;
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($insert)
                                {
                                    $idFechasMetas = mysqli_insert_id($recordset->conn);
                                }
                                echo '{ "success" : 1, "idFechasMetas" : '.$idFechasMetas.' }';
                                exit(0);
                            }
                        }
                    break;
                    case 'agregarGastoAccionCampo2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $idMetas2018 = $_POST['idMetas2018'];
                        $gastoAnadirAccionCampo = ($_POST['gastoAnadirAccionCampo']);
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $idUsuarioCampo = $_SESSION["idUsuarioCampo"];
                        $idCampo = $_SESSION["idCampo"];
                        $idPresupuestoMetas = 0;
                         $sql2=("SELECT insertPresupuestoMetasAnio (".$idMetasEstrategicas.",0, '".$gastoAnadirAccionCampo."', ".$anio.")");
                        //$sql2=("INSERT INTO PresupuestoMetas (idMetasEstrategicas, presupuesto, concepto, anio) VALUES (".$idMetasEstrategicas.",0, '".$gastoAnadirAccionCampo."', ".$anio.")");
                        $sql3=("SELECT idPresupuestoMetas FROM PresupuestoMetas WHERE idMetasEstrategicas = ".$idMetasEstrategicas." AND anio = ".$anio);
                        $insert = true;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql2=("SELECT updatePresupuestoMetasConcepto('".$gastoAnadirAccionCampo."', ".$row3["idPresupuestoMetas"].");");
                                //$sql2=("UPDATE PresupuestoMetas  SET concepto = '".$gastoAnadirAccionCampo."' WHERE idPresupuestoMetas = ".$row3["idPresupuestoMetas"]);
                                $idPresupuestoMetas = $row3["idPresupuestoMetas"];
                                $insert = false;
                            }
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($insert)
                                {
                                    $idPresupuestoMetas = mysqli_insert_id($recordset->conn);
                                }
                                echo '{ "success" : 1, "idPresupuestoMetas" : '.$idPresupuestoMetas.' }';
                                exit(0);
                            }
                        }
                    break;
                    case 'agregarActividadAccionCampo2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $idMetas2018 = $_POST['idMetas2018'];
                        $actividadAnadirAccionCampo = ($_POST['actividadAnadirAccionCampo']);
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $idUsuarioCampo = $_SESSION["idUsuarioCampo"];
                        $idCampo = $_SESSION["idCampo"];
                        $idActividadesMetas = 0;
                        $sql2=("SELECT insertActividadesMetasIdMetasEstrategicas (".$idMetasEstrategicas.", '".$actividadAnadirAccionCampo."', ".$anio.")");
                        //$sql2=("INSERT INTO ActividadesMetas (idMetasEstrategicas, actividad,  anio) VALUES (".$idMetasEstrategicas.", '".$actividadAnadirAccionCampo."', ".$anio.")");
                        $sql3=("SELECT idActividadesMetas FROM ActividadesMetas WHERE idMetasEstrategicas = ".$idMetasEstrategicas." AND anio = ".$anio);
                        $insert = true;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql2=("SELECT updateActividadesMetasActividad  ('".$actividadAnadirAccionCampo."', ".$row3["idActividadesMetas"].");");
                                //$sql2=("UPDATE ActividadesMetas  SET actividad = '".$actividadAnadirAccionCampo."' WHERE idActividadesMetas = ".$row3["idActividadesMetas"]);
                                $idActividadesMetas = $row3["idActividadesMetas"];
                                $insert = false;
                            }
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($insert)
                                {
                                    $idActividadesMetas = mysqli_insert_id($recordset->conn);
                                }
                                echo '{ "success" : 1, "idActividadesMetas" : '.$idActividadesMetas.' }';
                                exit(0);
                            }
                        }             
                    break;
                    case 'agregarLugarAccionIglesia2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $lugarAnadirAccionIglesia = ($_POST['lugarAnadirAccionIglesia']);
                        $idActividadesIglesias = $_POST['idActividadesIglesias'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("SELECT insertLugaresMetasIglesiasIdActividadesIglesias (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$lugarAnadirAccionIglesia."', ".$anio.", ".$_SESSION["idGrupo"].")");
                        //$sql2=("INSERT INTO LugaresMetasIglesias  (idActividadesIglesias, idUsuarioCampo, idDepartamentosAccionesIglesias, lugar, anio, idGrupo) VALUES (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$lugarAnadirAccionIglesia."', ".$anio.", ".$_SESSION["idGrupo"].")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarLugarAccionIglesia':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $lugarAnadirAccionIglesia = $_POST['lugarAnadirAccionIglesia'];
                        $idActividadesIglesias = $_POST['idActividadesIglesias'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("INSERT INTO LugaresMetasIglesias  (idActividadesIglesias, idUsuarioCampo, idDepartamentosAccionesIglesias, lugar, anio, idGrupo) VALUES 
                            (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$lugarAnadirAccionIglesia."', ".$anio.", ".$_SESSION["idGrupo"].")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarMetaAccionCampo2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $indicador = $_POST['indicador'];
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $valorNumero = $_POST['valorNumero'];
                        $idMetas2018 = $_POST['idMetas2018'];
                        //$idUsuarioCampo = damePastorDeIglesia();
                        $idUsuarioCampo = $_SESSION["idUsuarioCampo"];
                        $idCampo = $_SESSION["idCampo"];
                        $idMetasEstrategicas = 0;
                        $sql3=("SELECT idMetasEstrategicas FROM MetasEstrategicas2018 WHERE idDepartamentosAcciones = ".$idDepartamentosAcciones." AND idCampo = ".$_SESSION["idCampo"]." AND anio = ".$anio." AND idMetas2018 = ".$idMetas2018);
                        $sql2=("SELECT insertMetasEstrategicas2018IdDepartamentosAcciones (".$idDepartamentosAcciones.", ".$idUsuarioCampo.", ".$valorNumero.", ".$indicador.", ".$idCampo.", ".$anio.", ".$idMetas2018.")");
                        //$sql2=("INSERT INTO MetasEstrategicas2018  (idDepartamentosAcciones, idUsuarioCampo, metaNumero, indicador, idCampo, anio, idMetas2018) VALUES (".$idDepartamentosAcciones.", ".$idUsuarioCampo.", ".$valorNumero.", ".$indicador.", ".$idCampo.", ".$anio.", ".$idMetas2018.")");
                        $insert = true;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql2=("SELECT updateMetasEstrategicas2018MetaNumero(".$valorNumero.", ".$row3["idMetasEstrategicas"].");");
                                //$sql2=("UPDATE MetasEstrategicas2018  SET metaNumero = ".$valorNumero." WHERE idMetasEstrategicas = ".$row3["idMetasEstrategicas"]);
                                $idMetasEstrategicas = $row3["idMetasEstrategicas"];
                                $insert = false;
                            }
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($insert)
                                {
                                    $idMetasEstrategicas = mysqli_insert_id($recordset->conn);
                                }
                                echo '{ "success" : 1, "idMetasEstrategicas" : '.$idMetasEstrategicas.' }';
                                exit(0);
                            }
                        }
                    break;
                    case 'agregarMetaAccionIglesia2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $valorNumero = $_POST['valorNumero'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $idMetasEstrategicasIglesias = 0;
                        $sql3=("SELECT idMetasEstrategicasIglesias FROM MetasEstrategicasIglesias WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias." AND idGrupo = ".$_SESSION["idGrupo"]." AND anio = ".$anio);
                         $sql2=("SELECT insertMetasEstrategicasIglesiasIdUsuarioCampo (".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", ".$valorNumero.", ".$_SESSION["idGrupo"].", ".$anio.")");
                       // $sql2=("INSERT INTO MetasEstrategicasIglesias  (idUsuarioCampo, idDepartamentosAccionesIglesias, metaNumero, idGrupo, anio) VALUES (".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", ".$valorNumero.", ".$_SESSION["idGrupo"].", ".$anio.")");
                        $entre = 0;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $entre = 1;
                                $idMetasEstrategicasIglesias = $row3["idMetasEstrategicasIglesias"];
                                $sql2=("SELECT updateMetasEstrategicasIglesiasMetaNumero(".$valorNumero.", ".$row3["idMetasEstrategicasIglesias"].");");
                                //$sql2=("UPDATE MetasEstrategicasIglesias  SET metaNumero = ".$valorNumero." WHERE idMetasEstrategicasIglesias = ".$row3["idMetasEstrategicasIglesias"]);
                            }
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($entre==0)
                                {
                                    $idMetasEstrategicasIglesias = mysqli_insert_id($recordset->conn);
                                }
                                echo '{ "success" : 1, "idMetasEstrategicasIglesias" : '.$idMetasEstrategicasIglesias.' }';
                                exit(0);
                            }
                        }
                    break;
                    case 'agregarMetaAccionIglesia':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $valorNumero = $_POST['valorNumero'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("INSERT INTO MetasEstrategicasIglesias  (idUsuarioCampo, idDepartamentosAccionesIglesias, metaNumero, idGrupo, anio) VALUES 
                            (".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", ".$valorNumero.", ".$_SESSION["idGrupo"].", ".$anio.")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarPresupuestoAccionIglesia2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $presupuestoAnadirAccionIglesia = ($_POST['presupuestoAnadirAccionIglesia']);
                        $idActividadesIglesias = $_POST['idActividadesIglesias'];
                        $presupuestoConceptoAccionIglesiaAnadir = ($_POST['presupuestoConceptoAccionIglesiaAnadir']);
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql3=("SELECT idPresupuestoMetasIglesias FROM PresupuestoMetasIglesias WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias." AND idGrupo = ".$_SESSION["idGrupo"]." AND anio = ".$anio." AND idActividadesIglesias = ".$idActividadesIglesias);
                       $sql2=("SELECT insertPresupuestoMetasIglesiasIdActividadesIglesias (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$presupuestoAnadirAccionIglesia."', '".$presupuestoConceptoAccionIglesiaAnadir."', ".$anio.", ".$_SESSION["idGrupo"].")");
                       //$sql2=("INSERT INTO PresupuestoMetasIglesias  (idActividadesIglesias, idUsuarioCampo, idDepartamentosAccionesIglesias, presupuesto, concepto, anio, idGrupo) VALUES (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$presupuestoAnadirAccionIglesia."', '".$presupuestoConceptoAccionIglesiaAnadir."', ".$anio.", ".$_SESSION["idGrupo"].")");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql2=("SELECT updatePresupuestoMetasIglesiasPresupuesto('".$presupuestoAnadirAccionIglesia."', '".$presupuestoConceptoAccionIglesiaAnadir."', ".$row3["idPresupuestoMetasIglesias"].");");
                                //$sql2=("UPDATE PresupuestoMetasIglesias  SET presupuesto = '".$presupuestoAnadirAccionIglesia."', concepto = '".$presupuestoConceptoAccionIglesiaAnadir."' WHERE idPresupuestoMetasIglesias = ".$row3["idPresupuestoMetasIglesias"]);
                            }
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                echo '{ "success" : 1 }';
                                exit(0);
                            }
                        }
                        echo '{ "success" : 0, "sql3" : "'.$sql3.'" , "sql2" : "'.$sql2.'" }';
                        exit(0);
                    break;
                    case 'agregarPresupuestoAccionIglesia':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $presupuestoAnadirAccionIglesia = $_POST['presupuestoAnadirAccionIglesia'];
                        $idActividadesIglesias = $_POST['idActividadesIglesias'];
                        $presupuestoConceptoAccionIglesiaAnadir = $_POST['presupuestoConceptoAccionIglesiaAnadir'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("INSERT INTO PresupuestoMetasIglesias  (idActividadesIglesias, idUsuarioCampo, idDepartamentosAccionesIglesias, presupuesto, concepto, anio, idGrupo) VALUES 
                            (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$presupuestoAnadirAccionIglesia."', '".$presupuestoConceptoAccionIglesiaAnadir."', ".$anio.", ".$_SESSION["idGrupo"].")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'borrarActividadAccionIglesiaNuevo':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $idActividadesSugerentesIglesia = $_POST['idActividadesSugerentesIglesia'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("DELETE FROM ActividadesIglesias  WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias." AND idActividadesSugerentesIglesia = ".$idActividadesSugerentesIglesia." AND anio = ".$anio." AND idGrupo = ".$_SESSION["idGrupo"]);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarActividadAccionIglesiaNuevo2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $valor = intval($_POST['valor']);
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $idActividadesSugerentesIglesia = intval($_POST['idActividadesSugerentesIglesia']);
                        $actividadOtra = ($_POST['actividadOtra']);
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql3=("SELECT idActividadesIglesias FROM ActividadesIglesias WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias." AND idGrupo = ".$_SESSION["idGrupo"]." AND anio = ".$anio." AND idActividadesSugerentesIglesia = ".$idActividadesSugerentesIglesia);
                        $insert = true;
                        $sql2=("SELECT insertActividadesIglesiasIdUsuarioCampoActividadOtra (".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", ".$idActividadesSugerentesIglesia.", ".$anio.", ".$_SESSION["idGrupo"].", '".$actividadOtra."')");
                        //$sql2=("INSERT INTO ActividadesIglesias  (idUsuarioCampo, idDepartamentosAccionesIglesias, idActividadesSugerentesIglesia, anio, idGrupo, actividadOtra) VALUES (".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", ".$idActividadesSugerentesIglesia.", ".$anio.", ".$_SESSION["idGrupo"].", '".$actividadOtra."')");
                        $idActividadesIglesias = -1;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $idActividadesIglesias = $row3["idActividadesIglesias"];
                                $sql2=("SELECT updateActividadesIglesiasActividadOtra('".$actividadOtra."', ".$idUsuarioCampo.", ".$idActividadesIglesias.");");
                                //$sql2=("UPDATE ActividadesIglesias SET actividadOtra = '".$actividadOtra."', idUsuarioCampo = ".$idUsuarioCampo." WHERE idActividadesIglesias = ".$idActividadesIglesias."");
                                $insert = false;
                            }
                            if($valor==0)
                            {
                                $sql2=("SELECT deleteActividadesIglesiasIdActIgl (".$idActividadesIglesias.");");
                                //$sql2=("DELETE FROM ActividadesIglesias WHERE idActividadesIglesias = ".$idActividadesIglesias);
                                $insert = false;
                            }
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($insert)
                                {
                                    $idActividadesIglesias = mysqli_insert_id($recordset->conn);
                            
                                }
                                echo '{ "success" : 1, "idActividadesIglesias" : '.$idActividadesIglesias.' }';
                                exit(0);
                            }
                        }
                    break;
                    case 'agregarActividadAccionIglesiaNuevo':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $idActividadesSugerentesIglesia = $_POST['idActividadesSugerentesIglesia'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("INSERT INTO ActividadesIglesias  (idUsuarioCampo, idDepartamentosAccionesIglesias, idActividadesSugerentesIglesia, anio, idGrupo) VALUES 
                            (".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", ".$idActividadesSugerentesIglesia.", ".$anio.", ".$_SESSION["idGrupo"].")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarActividadAccionIglesia':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $actividadOtra = ($_POST['actividadOtra']);
                        $idActividadesSugerentesIglesia = $_POST['idActividadesSugerentesIglesia'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("INSERT INTO ActividadesIglesias  (idUsuarioCampo, idDepartamentosAccionesIglesias, actividadOtra, idActividadesSugerentesIglesia, anio, idGrupo) VALUES 
                            (".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$actividadOtra."', ".$idActividadesSugerentesIglesia.", ".$anio.", ".$_SESSION["idGrupo"].")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarCalendarioAccionIglesia2018':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $idActividadesIglesias = $_POST['idActividadesIglesias'];
                        $calendarioAccionIglesiaFechaInicial = $_POST['calendarioAccionIglesiaFechaInicial'];
                        $calendarioAccionIglesiaFechaFinal = $_POST['calendarioAccionIglesiaFechaFinal'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $idFechasMetasIglesias = intval($_POST["idFechasMetasIglesias"]);
                        $sql2="";
                        if($idFechasMetasIglesias==0)//insert
                        {
                            $sql2=("SELECT insertFechasMetasIglesiasIdActividadesIglesias (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$calendarioAccionIglesiaFechaInicial."', ".$anio.", ".$_SESSION["idGrupo"].", '".$calendarioAccionIglesiaFechaFinal."')");
                            //$sql2=("INSERT INTO FechasMetasIglesias  (idActividadesIglesias, idUsuarioCampo, idDepartamentosAccionesIglesias, fecha, anio, idGrupo, fechaFinal) VALUES (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$calendarioAccionIglesiaFechaInicial."', ".$anio.", ".$_SESSION["idGrupo"].", '".$calendarioAccionIglesiaFechaFinal."')");
                        }
                        else
                        {
                            $sql2=("SELECT updateFechasMetasIglesiasFecha ('".$calendarioAccionIglesiaFechaInicial."', '".$calendarioAccionIglesiaFechaFinal."', ".$idFechasMetasIglesias.")");
                            //$sql2=("UPDATE FechasMetasIglesias SET fecha = '".$calendarioAccionIglesiaFechaInicial."', fechaFinal= '".$calendarioAccionIglesiaFechaFinal."' WHERE idFechasMetasIglesias = ".$idFechasMetasIglesias);
                            if($calendarioAccionIglesiaFechaFinal=="")
                            {
                                $sql2=("SELECT deleteFechasMetasIglesiasIdFchasMetIgl(".$idFechasMetasIglesias.");");
                                //$sql2=("DELETE FROM FechasMetasIglesias WHERE idFechasMetasIglesias = ".$idFechasMetasIglesias);
                            }
                        }
                       // $sql3=("SELECT idFechasMetasIglesias FROM FechasMetasIglesias WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias." AND idGrupo = ".$_SESSION["idGrupo"]." AND anio = ".$anio." AND idActividadesIglesias = ".$idActividadesIglesias);

                        // if($query3 = mysqli_query($recordset->conn,$sql3))
                        //{
                          //  if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            //{
                              //  $idFechasMetasIglesias = $row3["idFechasMetasIglesias"];
                                
                            //}
                           // else
                            //{
                                //$idFechasMetasIglesias = mysqli_insert_id($recordset->conn);
                           // }
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($idFechasMetasIglesias==0)//insert
                                {
                                    $idFechasMetasIglesias = mysqli_insert_id($recordset->conn);
                                }
                                echo '{ "success" : 1, "idFechasMetasIglesias" : '.$idFechasMetasIglesias.' }';
                                exit(0);
                            }
                      //  }
                    break;
                    case 'agregarCalendarioAccionIglesia':    
                        checarSesionUsuarios();
                        $anio = $_POST['anio'];
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $idActividadesIglesias = $_POST['idActividadesIglesias'];
                        $calendarioAccionIglesiaFechaInicial = $_POST['calendarioAccionIglesiaFechaInicial'];
                        $calendarioAccionIglesiaFechaFinal = $_POST['calendarioAccionIglesiaFechaFinal'];
                        $idUsuarioCampo = damePastorDeIglesia();
                        $sql2=("INSERT INTO FechasMetasIglesias  (idActividadesIglesias, idUsuarioCampo, idDepartamentosAccionesIglesias, fecha, anio, idGrupo, fechaFinal) VALUES 
                            (".$idActividadesIglesias.", ".$idUsuarioCampo.", ".$idDepartamentosAccionesIglesias.", '".$calendarioAccionIglesiaFechaInicial."', ".$anio.", ".$_SESSION["idGrupo"].", '".$calendarioAccionIglesiaFechaFinal."')");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarCalendarioMeta':    
                        checarSesionUsuarios();
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $calendarioMetaFechaInicial = $_POST['calendarioMetaFechaInicial'];
                        $calendarioMetaFechaFinal = $_POST['calendarioMetaFechaFinal'];
                        $sql2=("INSERT INTO FechasMetas  (idMetasEstrategicas, fechaInicial, fechaFinal) VALUES (".$idMetasEstrategicas.", '".$calendarioMetaFechaInicial."', '".$calendarioMetaFechaFinal."')");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminarPresupuestoAccionIglesia':    
                        checarSesionUsuarios();
                        $idPresupuestoMetasIglesias = $_POST['idPresupuestoMetasIglesias'];
                        $sql2=("DELETE FROM PresupuestoMetasIglesias  WHERE  idPresupuestoMetasIglesias = ".$idPresupuestoMetasIglesias);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminarActividadAccionIglesia':    
                        checarSesionUsuarios();
                        $idActividadesIglesias = $_POST['idActividadesIglesias'];
                        $sql2=("DELETE FROM ActividadesIglesias  WHERE  idActividadesIglesias = ".$idActividadesIglesias);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminarLugarAccionIglesia':    
                        checarSesionUsuarios();
                        $idLugaresMetasIglesias = $_POST['idLugaresMetasIglesias'];
                        $sql2=("DELETE FROM LugaresMetasIglesias  WHERE  idLugaresMetasIglesias = ".$idLugaresMetasIglesias);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminarCalendarioAccionCampo':    
                        checarSesionUsuarios();
                        $idFechasMetas = $_POST['idFechasMetas'];
                        $sql2=("SELECT deleteFechasMetasIdFchaMet (".$idFechasMetas.");");
                        //$sql2=("DELETE FROM FechasMetas  WHERE  idFechasMetas = ".$idFechasMetas);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminarCalendarioAccionIglesia':    
                        checarSesionUsuarios();
                        $idFechasMetasIglesias = $_POST['idFechasMetasIglesias'];
                        $sql2=("SELECT deleteFechasMetasIglesiasIdFchasMetIgl (".$idFechasMetasIglesias.");");
                        //$sql2=("DELETE FROM FechasMetasIglesias  WHERE  idFechasMetasIglesias = ".$idFechasMetasIglesias);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminaCalendarioMeta':    
                        checarSesionUsuarios();
                        $idFechasMetas = $_POST['idFechasMetas'];
                        $sql2=("DELETE FROM FechasMetas  WHERE  idFechasMetas = ".$idFechasMetas);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'agregarActividadesMeta':    
                        checarSesionUsuarios();
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $actividad = ($_POST['actividad']);
                        $sql2=("INSERT INTO ActividadesMetas  (idMetasEstrategicas, actividad) VALUES (".$idMetasEstrategicas.", '".$actividad."')");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'eliminaActividadesMeta':    
                        checarSesionUsuarios();
                        $idActividadesMetas = $_POST['idActividadesMetas'];
                        $sql2=("DELETE FROM ActividadesMetas  WHERE  idActividadesMetas = ".$idActividadesMetas);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                     case 'agregarDirectrizEstrategica':    
                        checarSesionUsuarios();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $fechaInicialDirectriz = $_POST['fechaInicialDirectriz'];
                        $fechaFinalDirectriz = $_POST['fechaFinalDirectriz'];
                        $descrDirectriz = ($_POST['descrDirectriz']);
                        $sql2=("INSERT INTO DirectricesAcciones  (idDepartamentosAcciones, fechaInicial, fechaFinal, descripcion) VALUES (".$idDepartamentosAcciones.", '".$fechaInicialDirectriz."', '".$fechaFinalDirectriz."', '".$descrDirectriz."')");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            $idDirectricesAcciones = mysqli_insert_id($recordset->conn);
                            $nombreArchivo = $idDirectricesAcciones."-".$_POST["nombre"];
                            move_uploaded_file($_FILES['archivo']['tmp_name'], 'images/direc/' . $nombreArchivo);
                            $sql=("UPDATE DirectricesAcciones SET archivo =  '".$nombreArchivo."' WHERE idDirectricesAcciones = ".$idDirectricesAcciones);
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                echo '{ "success" : 1 }';
                                exit(0);
                            }
                        }
                    break;
                    case 'eliminaDirectrizMeta':    
                        checarSesionUsuarios();
                        $idDirectricesAcciones = $_POST['idDirectricesAcciones'];
                        $sql3=("SELECT archivo FROM DirectricesAcciones WHERE idDirectricesAcciones = ".$idDirectricesAcciones);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                //unlink("images/direc/".$row3["archivo"]);
                                $sql2=("DELETE FROM DirectricesAcciones  WHERE  idDirectricesAcciones = ".$idDirectricesAcciones);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                        }        
                    break;
                    case 'agregarVerificacionMeta':    
                        checarSesionUsuarios();
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $verificacionMetaFechaInicial = $_POST['verificacionMetaFechaInicial'];
                        $verificacionMetaFechaFinal = $_POST['verificacionMetaFechaFinal'];
                        $verificacionDescripcion = ($_POST['verificacionDescripcion']);
                        $sql2=("INSERT INTO VerificacionMetas  (idMetasEstrategicas, fechaInicial, fechaFinal, descripcion) VALUES (".$idMetasEstrategicas.", '".$verificacionMetaFechaInicial."', '".$verificacionMetaFechaFinal."', '".$verificacionDescripcion."')");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            $idVerificacionMetas = mysqli_insert_id($recordset->conn);
                            $nombreArchivo = $idVerificacionMetas."-".$_POST["nombre"];
                            move_uploaded_file($_FILES['archivo']['tmp_name'], 'images/evidencia/' . $nombreArchivo);
                            $sql=("UPDATE VerificacionMetas SET archivo =  '".$nombreArchivo."' WHERE idVerificacionMetas = ".$idVerificacionMetas);
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                echo '{ "success" : 1 }';
                                exit(0);
                            }
                        }
                    break;
                    case 'eliminaVerificacionMeta':    
                        checarSesionUsuarios();
                        $idVerificacionMetas = $_POST['idVerificacionMetas'];
                        $sql3=("SELECT archivo FROM VerificacionMetas WHERE idVerificacionMetas = ".$idVerificacionMetas);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                unlink("images/evidencia/".$row3["archivo"]);
                                $sql2=("DELETE FROM VerificacionMetas  WHERE  idVerificacionMetas = ".$idVerificacionMetas);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                        }        
                    break;
                    case 'verActividadesSugerentesIglesia':    
                        checarSesionUsuarios();
                        $actividadesSugerentes = array();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $anio = $_POST['anio'];
                        $sql3=("SELECT idActividadesSugerentesIglesia, titulo, descripcion, origen
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias." order by idActividadesSugerentesIglesia asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["esta"] = 0;
                                $rowY["descripcion"] = ($row3["descripcion"]);
                                $rowY["titulo"] = ($row3["titulo"]);
                                $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                $sql2=("SELECT idActividadesIglesias FROM ActividadesIglesias 
                                   WHERE idGrupo = ".$_SESSION["idGrupo"]." AND anio = ".$anio." AND idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias." AND idActividadesSugerentesIglesia = ".$row3["idActividadesSugerentesIglesia"]);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                    {
                                        $rowY["esta"] = 1;
                                    }
                                }
                                $rowY["origen"] = $row3["origen"];
                                if($row3["origen"]==-1)
                                {
                                    $rowY["origen"] = "UMN";
                                }
                                else
                                {
                                    $sql2=("SELECT nombre, idDistrito FROM Grupos 
                                    WHERE idGrupo = ".$row3["origen"]);
                                    if($query2 = mysqli_query($recordset->conn,$sql2))
                                    {
                                        if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                        {
                                            $row2["nombre"] = ($row2["nombre"]);
                                            $sql1=("SELECT nombre, idCampo FROM Distritos 
                                            WHERE idDistrito = ".$row2["idDistrito"]);
                                            if($query1 = mysqli_query($recordset->conn,$sql1))
                                            {
                                                if($row1=mysqli_fetch_array($query1,MYSQLI_ASSOC))
                                                {
                                                    $row1["nombre"] = ($row1["nombre"]);
                                                    $sql0=("SELECT nombre FROM Campos 
                                                    WHERE idCampo = ".$row1["idCampo"]);
                                                    if($query0= mysqli_query($recordset->conn,$sql0))
                                                    {
                                                        if($row0=mysqli_fetch_array($query0,MYSQLI_ASSOC))
                                                        {
                                                            $row0["nombre"] = ($row0["nombre"]);
                                                            $rowY["origen"] = $row0["nombre"]." - ".$row1["nombre"]." - ".$row2["nombre"];
                                                        }
                                                    }
                                                }
                                            }
                                            
                               
                                        }
                                    }

                                }
                                array_push($actividadesSugerentes, $rowY);
                            }
                        }
                        echo '{ "success" : 1, "actividadesSugerentes" : '.json_encode($actividadesSugerentes).'}';
                        exit(0);
                    break;
                    case 'verAccionesDeCamposMonitoreoDetallePorCampos':  
                        checarSesionUsuarios();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $anio = $_POST['anio'];
                        $metas = array();
                       /* $indicador = -1;
                        $sql3=("SELECT indicador
                             FROM DepartamentosAccionesIglesias 
                            WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $indicador = $row3["indicador"];
                            }
                        }
                        */

                        $idCamposUMN = '';
                        $first = true;
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE dependeDe = 11 order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $nombreDeCampo = ($row33["nombre"]);
                                $sql3=("SELECT meta, metaNumero, indicador, idMetasEstrategicas, nombre FROM verAccionesDeMetasEstrategicas WHERE idDepartamentosAcciones = ".$idDepartamentosAcciones." AND idCampo = ".$idCampo." AND anio = ".$anio.")");
                               //$sql3=("SELECT m.meta, m.metaNumero, m.indicador, m.idMetasEstrategicas, u.nombre FROM MetasEstrategicas m INNER JOIN UsuariosCampos u on u.idUsuarioCampo = m.idUsuarioCampo WHERE m.idDepartamentosAcciones = ".$idDepartamentosAcciones." AND m.idCampo = ".$idCampo." AND m.anio = ".$anio."");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["idMetasEstrategicas"] = $row3["idMetasEstrategicas"];
                                        $rowY["indicador"] = $row3["indicador"];
                                        $rowY["nombre"] = $nombreDeCampo;
                                        $rowY["usuario"] = ($row3["nombre"]);
                                        $rowY["idCampo"] = $idCampo;
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $rowY["sumaDeMetas"] = $row3["metaNumero"];
                                        $rowY["meta"] = $row3["meta"];
                                        array_push($metas, $rowY);
                                    }
                                }
                               
                            }
                        }
                        echo '{ "success" : 1, "metas" : '.json_encode($metas).' }';
                        exit(0);
                    break; 
                    case 'verAccionesDeIglesiaMonitoreoDetallePorCampos':  
                        checarSesionUsuarios();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $anio = $_POST['anio'];
                        $metas = array();
                        $indicador = -1;
                         $sql3=("SELECT indicador
                             FROM DepartamentosAccionesIglesias 
                            WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $indicador = $row3["indicador"];
                            }
                        }
                        

                        $idCamposUMN = '';
                        $first = true;
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE dependeDe = 11 order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $nombreDeCampo = ($row33["nombre"]);
                                     
                                $idGrupoDeCampos = '';
                                $first = true;
                                $sql3=("SELECT idDistrito
                                    FROM Distritos 
                                    WHERE idCampo = ".$idCampo." order by nombre asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $sql4=("SELECT idGrupo
                                            FROM Grupos 
                                            WHERE idDistrito = ".$row3["idDistrito"]." order by idGrupo asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                if($first)
                                                {
                                                    $first = false;
                                                    $idGrupoDeCampos = $row4["idGrupo"];
                                                }
                                                else
                                                {
                                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                                }
                                            }
                                        }
                                    }
                                }
                                $rowY = array();
                                $rowY["Primero"] = 0;
                                $rowY["Segundo"] = 0;
                                $rowY["Tercero"] = 0;
                                $rowY["Cuarto"] = 0;
                                      
                                $sql3=("SELECT m.anio, m.metaNumero, m.idMetasEstrategicasIglesias, m.idGrupo
                                    FROM MetasEstrategicasIglesias m
                                    WHERE m.idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias."
                                    AND m.idGrupo in (".$idGrupoDeCampos.")
                                    AND m.anio = ".$anio."");


                                $sumaDeMetas = 0;
                                $primero = 0;
                                $segundo = 0;
                                $tercero = 0;
                                $cuarto = 0;
                                $promedioDeMetas = 0;
                                $cuantos = 0;
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $sumaDeMetas = $sumaDeMetas + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;
                                                $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                            FROM EvaluacionIglesias 
                                                            WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                                if($query333 = mysqli_query($recordset->conn,$sql333))
                                                {
                                                    if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                                    {
                                                      
                                                        $rowY["Primero"] = $rowY["Primero"]+intval($row333["Primero"]);
                                                        $rowY["Segundo"] = $rowY["Segundo"]+intval($row333["Segundo"]);
                                                        $rowY["Tercero"] = $rowY["Tercero"]+intval($row333["Tercero"]);
                                                        $rowY["Cuarto"] = $rowY["Cuarto"]+intval($row333["Cuarto"]);
                                                        $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                                    }
                                                }
                                    }
                                }
                                $rowY["indicador"] = $indicador;
                                $rowY["nombre"] = $nombreDeCampo;
                                $rowY["idCampo"] = $idCampo;
                                $rowY["sumaDeMetas"] = $sumaDeMetas;
                                $rowY["primero"] = $primero;
                                $rowY["segundo"] = $segundo;
                                $rowY["tercero"] = $tercero;
                                $rowY["cuarto"] = $cuarto;
                                $rowY["metaNumero"] = $sumaDeMetas;
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                $promedioDeMetas = round($sumaDeMetas/$cuantos,2);
                                $rowY["promedioDeMetas"] = $promedioDeMetas;
                                array_push($metas, $rowY);
                            }
                        }
                        echo '{ "success" : 1, "metas" : '.json_encode($metas).' }';
                        exit(0);
                    break; 
                    case 'verAccionesDeDistritoMonitoreoDetalle':  
                        checarSesionUsuarios();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $anio = $_POST['anio'];
                        $metas = array();
                        $idGrupoDeCampos = '';
                        $first = true;
                       
                       
                         $idDistrito  = -1;
                        if(isset($_SESSION["idDistrito"]))
                        {
                            $idDistrito = $_SESSION["idDistrito"];
                        }
                        else
                        {
                            $idDistrito = $_POST["idDistrito"];    
                        }
                        
                        $sql4=("SELECT idGrupo
                            FROM Grupos 
                            WHERE idDistrito = ".$idDistrito." order by idGrupo asc");
                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        if($first)
                                        {
                                            $first = false;
                                            $idGrupoDeCampos = $row4["idGrupo"];
                                        }
                                        else
                                        {
                                            $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                        }
                                    }
                                }
                          
                         $indicador = -1;
                         $sql3=("SELECT indicador
                             FROM DepartamentosAccionesIglesias 
                            WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $indicador = $row3["indicador"];
                            }
                        }
                        $sql3=("SELECT m.anio, m.metaNumero, m.idMetasEstrategicasIglesias, m.idGrupo
                            FROM MetasEstrategicasIglesias m
                            WHERE m.idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias."
                            AND m.idGrupo in (".$idGrupoDeCampos.")
                            AND m.anio = ".$anio."");
                        $sumaDeMetas = 0;
                         $primero = 0;
                                $segundo = 0;
                                $tercero = 0;
                                $cuarto = 0;
                                
                        $promedioDeMetas = 0;
                        $cuantos = 0;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql4=("SELECT nombre, nombre as distrito FROM verAccionesDeGruposNombre INNER JOIN Distritos on idDistrito = idDistrito WHERE idGrupo = ".$row3["idGrupo"]." order by nombre asc");

                                //$sql4=("SELECT g.nombre, d.nombre as distrito FROM Grupos g INNER JOIN Distritos d on d.idDistrito = g.idDistrito WHERE g.idGrupo = ".$row3["idGrupo"]." order by d.nombre asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    if($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["nombre"] = ($row4["nombre"]);
                                        $rowY["idGrupo"] = $row3["idGrupo"];
                                        $rowY["distrito"] = ($row4["distrito"]);
                                        $rowY["indicador"] = $indicador;
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $sumaDeMetas = $sumaDeMetas + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                            FROM EvaluacionIglesias 
                                                            WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                                if($query333 = mysqli_query($recordset->conn,$sql333))
                                                {
                                                    if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                                    {
                                                      
                                                        $rowY["Primero"] = $row333["Primero"];
                                                        $rowY["Segundo"] = $row333["Segundo"];
                                                        $rowY["Tercero"] = $row333["Tercero"];
                                                        $rowY["Cuarto"] = $row333["Cuarto"];
                                                        $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                                    }
                                                }
                                        array_push($metas, $rowY);
                                    }
                                }
                            }
                        }
                        if($cuantos==0)
                        {
                            $cuantos = 1;
                        }
                        $promedioDeMetas = round($sumaDeMetas/$cuantos,2);
                        echo '{ "success" : 1, "metas" : '.json_encode($metas).', "promedioDeMetas" : '.$promedioDeMetas.', "sumaDeMetas" : '.$sumaDeMetas.'}';
                        exit(0);
                    break;
                    case 'verAccionesDeIglesiaMonitoreoDetalle':  
                        checarPermisoAdministrador();  
                        checarSesionUsuarios();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $anio = $_POST['anio'];
                        $metas = array();
                        $idGrupoDeCampos = '';
                        $first = true;
                        $idCampo = -1;
                        if(isset($_SESSION["idCampo"]))
                        {
                            $idCampo = $_SESSION["idCampo"];
                        }
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];
                        }
                        $sql3=("SELECT idDistrito
                                    FROM Distritos 
                                    WHERE idCampo = ".$idCampo." order by nombre asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql4=("SELECT idGrupo
                                    FROM Grupos 
                                    WHERE idDistrito = ".$row3["idDistrito"]." order by idGrupo asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        if($first)
                                        {
                                            $first = false;
                                            $idGrupoDeCampos = $row4["idGrupo"];
                                        }
                                        else
                                        {
                                            $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                        }
                                    }
                                }
                            }
                        }
                         $indicador = -1;
                         $sql3=("SELECT indicador
                             FROM DepartamentosAccionesIglesias 
                            WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $indicador = $row3["indicador"];
                            }
                        }
                        $sql3=("SELECT m.anio, m.metaNumero, m.idMetasEstrategicasIglesias, m.idGrupo
                            FROM MetasEstrategicasIglesias m
                            WHERE m.idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias."
                            AND m.idGrupo in (".$idGrupoDeCampos.")
                            AND m.anio = ".$anio."");
                        $sumaDeMetas = 0;
                         $primero = 0;
                                $segundo = 0;
                                $tercero = 0;
                                $cuarto = 0;
                                
                        $promedioDeMetas = 0;
                        $cuantos = 0;
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql4=("SELECT nombre, nombre as distrito FROM verAccionesDeGruposNombre INNER JOIN Distritos on idDistrito = idDistrito WHERE idGrupo = ".$row3["idGrupo"]." order by nombre asc");
                                //$sql4=("SELECT g.nombre, d.nombre as distrito FROM Grupos g INNER JOIN Distritos d on d.idDistrito = g.idDistrito WHERE g.idGrupo = ".$row3["idGrupo"]." order by d.nombre asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    if($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["nombre"] = ($row4["nombre"]);
                                        $rowY["idGrupo"] = $row3["idGrupo"];
                                        $rowY["distrito"] = ($row4["distrito"]);
                                        $rowY["indicador"] = $indicador;
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $sumaDeMetas = $sumaDeMetas + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                            FROM EvaluacionIglesias 
                                                            WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                                if($query333 = mysqli_query($recordset->conn,$sql333))
                                                {
                                                    if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                                    {
                                                      
                                                        $rowY["Primero"] = $row333["Primero"];
                                                        $rowY["Segundo"] = $row333["Segundo"];
                                                        $rowY["Tercero"] = $row333["Tercero"];
                                                        $rowY["Cuarto"] = $row333["Cuarto"];
                                                        $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                                    }
                                                }
                                        array_push($metas, $rowY);
                                    }
                                }
                            }
                        }
                        if($cuantos==0)
                        {
                            $cuantos = 1;
                        }
                        $promedioDeMetas = round($sumaDeMetas/$cuantos,2);
                        echo '{ "success" : 1, "metas" : '.json_encode($metas).', "promedioDeMetas" : '.$promedioDeMetas.', "sumaDeMetas" : '.$sumaDeMetas.'}';
                        exit(0);
                    break;
                    case 'verCamposQueYaPresentaronPlanDelCampoUMN2018':  
                        checarSesionUsuarios();
                        $campos = array();
                        $anio = $_POST['anio'];
                        $denominadorCampo=1;
                        $sql33=("SELECT COUNT(d.idDepartamentosAcciones) as denominador FROM verAccionesDeDepartamentosAcciones2018 WHERE  anio = ".$anio." AND tipo = 2");
                        //$sql33=("SELECT COUNT(d.idDepartamentosAcciones) as denominador FROM DepartamentosAcciones2018 d INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica WHERE  d.anio = ".$anio." AND a.tipo = 2");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            if($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {  
                                $denominadorCampo = $row33["denominador"];
                            }
                        }
                        $denominadorUnion=1;
                        $sql33=("SELECT COUNT(d.idDepartamentosAcciones) as denominador
                            FROM DepartamentosAcciones2018 d
                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                            WHERE  d.anio = ".$anio." AND a.tipo = 3");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            if($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {  
                                $denominadorUnion = $row33["denominador"];
                            }
                        }
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                     order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = $row33["idCampo"];
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["iglesias"] = array();
                                $rowX["no"] = array();
                                $tipo=2;//2 es campo, 3 es union
                                if($row33["idCampo"]==11)//si es union
                                {
                                    $tipo=3;
                                }
                                //el proposito del query de abajo es obtener las diferentes iglesias que tienen algo que informar, en el caso del campo, pue serian los departamentos que estan funcionando para el campo
                                $sql3=("SELECT DISTINCT dd.idDepartamento, dd.nombre
                                FROM DepartamentosAcciones2018 d
                                INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                                INNER JOIN Departamentos dd on dd.idDepartamento = d.idDepartamento
                                WHERE  d.anio = ".$anio." AND a.tipo = ".$tipo."
                                order by dd.idDepartamento asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $denominadorCampoMomentaneo=1;
                                        $sql34=("SELECT COUNT(m.idMetas2018) as denominador
                                            FROM DepartamentosAcciones2018 d
                                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                                            INNER JOIN Metas2018 m on m.idDepartamentosAcciones = d.idDepartamentosAcciones
                                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = a.idObjetivosEspecificos
                                            WHERE  d.anio = ".$anio." AND a.tipo = ".$tipo." AND d.idDepartamento = ".$row3["idDepartamento"]);
                                        if($query34 = mysqli_query($recordset->conn,$sql34))
                                        {
                                            if($row34=mysqli_fetch_array($query34,MYSQLI_ASSOC))
                                            {  
                                                $denominadorCampoMomentaneo = $row34["denominador"];
                                            }
                                        }
                                        $row3["nombre"] = ($row3["nombre"]);
                                        if($row3["idDepartamento"]==12)
                                        {
                                            $row3["nombre"] = "Secretaría Ministerial";
                                        }
                                        if($row3["idDepartamento"]==6)
                                        {
                                            //$row3["nombre"] = "Escuela Sábatica y Ministerios Personales";
                                        }
                                        $row3["distrito"] = "";//($row3["distrito"]);
                                        $row3["pcent"] = 0.0;
                                        //el proposito de este query es saber, del departamento, cuantas tiene meta para su campo!
                                        $sql5=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                        FROM MetasEstrategicas2018 m 
                                        INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones
                                        WHERE m.idCampo = ".$idCampo." AND d.idDepartamento = ".$row3["idDepartamento"]."
                                        AND m.anio = ".$anio." GROUP BY m.idCampo ");
                                        if($query5 = mysqli_query($recordset->conn,$sql5))
                                        {
                                            if($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                            {
                                                if($denominadorCampoMomentaneo==0)
                                                {
                                                    echo $row3["nombre"];
                                                    exit(0);
                                                }
                                                $pcent = ($row5["numerador"]/$denominadorCampoMomentaneo)*100;
                                                $row3["pcent"] = $pcent;
                                            }
                                        }
                                        array_push($rowX["iglesias"], $row3);
                                    }
                                }
                               
                                array_push($campos, $rowX);
                            }
                        }
                        echo '{ "success" : 1, "campos" : '.json_encode($campos).', "denominadorCampo" : '.$denominadorCampo.', "denominadorUnion" : '.$denominadorUnion.' }';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampoUMN2018':  
                        checarSesionUsuarios();
                        $campos = array();
                        $anio = $_POST['anio'];
                        $denominador=1;
                         $sql33=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {  
                                $denominador = $row33["denominador"];
                            }
                        }
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE dependeDe = 11 order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = $row33["idCampo"];
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["iglesias"] = array();
                                $rowX["no"] = array();
                                $sql3=("SELECT DISTINCT m.idGrupo, g.nombre, d.nombre as distrito
                                FROM Distritos d
                                INNER JOIN Grupos g on g.idDistrito = d.idDistrito
                                INNER JOIN MetasEstrategicasIglesias m on m.idGrupo = g.idGrupo
                                WHERE d.idCampo in (".$idCampo.")
                                AND m.anio = ".$anio);
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        $row3["pcent"] = 0.0;
                                        $sql5=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador
                                        FROM MetasEstrategicasIglesias m 
                                        WHERE m.idGrupo = ".$row3["idGrupo"]."
                                        AND m.anio = ".$anio." GROUP BY m.idGrupo ");
                                        if($query5 = mysqli_query($recordset->conn,$sql5))
                                        {
                                            if($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                            {
                                                $pcent = ($row5["numerador"]/$denominador)*100;
                                                $row3["pcent"] = $pcent;
                                            }
                                        }
                                        array_push($rowX["iglesias"], $row3);
                                    }
                                }
                               

                                $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                                    FROM Grupos g
                                    INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                    WHERE  d.idCampo in (".$idCampo.")
                                    ORDER BY d.idDistrito ASC  ");
                                 if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        array_push($rowX["no"], $row3);
                                    }
                                }
                                array_push($campos, $rowX);
                            }
                        }
                        echo '{ "success" : 1, "campos" : '.json_encode($campos).', "denominador" : '.$denominador.' }';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampoUMN':  
                        checarSesionUsuarios();
                        $campos = array();
                        $anio = $_POST['anio'];
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE dependeDe = 11 order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = $row33["idCampo"];
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["iglesias"] = array();
                                $rowX["no"] = array();
                                $sql3=("SELECT DISTINCT m.idGrupo, g.nombre, d.nombre as distrito
                                FROM Distritos d
                                INNER JOIN Grupos g on g.idDistrito = d.idDistrito
                                INNER JOIN MetasEstrategicasIglesias m on m.idGrupo = g.idGrupo
                                WHERE d.idCampo in (".$idCampo.")
                                AND m.anio = ".$anio);
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        array_push($rowX["iglesias"], $row3);
                                    }
                                }
                               

                                $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                                FROM Grupos g
                                LEFT JOIN MetasEstrategicasIglesias m on m.idGrupo = g.idGrupo
                                INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                WHERE m.idGrupo IS NULL AND d.idCampo in (".$idCampo.")
                                ORDER BY d.idDistrito ASC");
                                 if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        array_push($rowX["no"], $row3);
                                    }
                                }
                                array_push($campos, $rowX);
                            }
                        }
                        echo '{ "success" : 1, "campos" : '.json_encode($campos).' }';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanIglesia2018':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idGrupo = -1;
                        if(isset($_POST["idGrupo"]))
                        {
                            $idGrupo = $_POST["idGrupo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idGrupo"]))
                            {
                                $idGrupo = $_SESSION["idGrupo"];
                            }    
                        }
                        $denominador = 1;
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }

                        $sql3=("SELECT IFNULL(COUNT(m.idMetasEstrategicasIglesias),0) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE g.idGrupo in (".$idGrupo.")
                            AND m.anio = ".$anio." GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($iglesias, $row3);
                            }
                        }
                        if(count($iglesias)==0) {
                            $row3 = array();
                            $row3["numerador"] = 0;
                            array_push($iglesias, $row3);
                        }
                       

                      
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).' , "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelUMN2018InformeTrimestral_PorTrimestre':  
                        checarSesionUsuarios();
                        $campos = array();
                        $anio = $_POST['anio'];
                        $trimestre = intval($_POST["trimestre"]);
                        $palabrin = "Primero";
                        if($trimestre==2){
                            $palabrin = "Segundo";
                        } else {
                            if($trimestre==3){
                                $palabrin = "Tercero";
                            } else {
                                if($trimestre==4){
                                    $palabrin = "Cuarto";
                                } 
                            }
                        }
                        
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $denominador = 1;//super hardcode, perdon al que lo lea, pero bueno, el Dr Cea viene a regañarme a las 4pm, y quiero entregar el asunto terminado; ya le explique la situación por telefono y no me entendió; eso hizo perder en mi la esperanza de que alguien en la unión me entendiera, porque hasta ahora el que trabaja más ordenado es el Dr. Cea, pero bueno, fue la solución que se me ocurrio para antes de las 4pm.   30/Agosto/2018 12:52 pm
                        /*$sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        */
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE dependeDe = 11 order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = $row33["idCampo"];
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["iglesias"] = array();
                                $rowX["no"] = array();
                                $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                                    FROM MetasEstrategicasIglesias m 
                                    INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                                    INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                    INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                                    WHERE d.idCampo in (".$idCampo.")
                                    AND m.anio = ".$anio." AND e.".$palabrin." != 0 GROUP BY m.idGrupo 
                                    order by d.nombre asc, m.idGrupo asc ");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        //super hardcode
                                        if(intval($row3["numerador"])>$denominador){
                                            $row3["numerador"] = $denominador;
                                        }
                                        $pcent = ($row3["numerador"]/$denominador)*100;
                                        $row3["pcent"] = $pcent;
                                        array_push($rowX["iglesias"], $row3);
                                    }
                                }
                               

                                $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                                FROM Grupos g
                                INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                WHERE  d.idCampo in (".$idCampo.")
                                ORDER BY d.idDistrito ASC");
                                 if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        array_push($rowX["no"], $row3);
                                    }
                                }
                                array_push($campos, $rowX);
                            }
                            echo '{ "success" : 1, "campos" : '.json_encode($campos).', "denominador" : '.$denominador.' }';
                            exit(0);
                        }
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelUMN2018InformeTrimestral':  
                    //verIglesiasQueYaPresentaronPlanDelCampoUMN2018'
                        checarSesionUsuarios();
                        $campos = array();

                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $denominador = 1;
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        $denominador = 1;
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE dependeDe = 11 order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = $row33["idCampo"];
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["iglesias"] = array();
                                $rowX["no"] = array();
                                $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                                    FROM MetasEstrategicasIglesias m 
                                    INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                                    INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                    INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                                    WHERE d.idCampo in (".$idCampo.")
                                    AND m.anio = ".$anio." GROUP BY m.idGrupo 
                                    order by d.nombre asc, m.idGrupo asc ");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        if(intval($row3["numerador"])>=1)
                                        {
                                            $row3["numerador"] = 1;
                                        }
                                        $pcent = ($row3["numerador"]/$denominador)*100;
                                        $row3["pcent"] = $pcent;
                                        /*$sql5=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador
                                        FROM MetasEstrategicasIglesias m 
                                        WHERE m.idGrupo = ".$row3["idGrupo"]."
                                        AND m.anio = ".$anio." GROUP BY m.idGrupo ");
                                        if($query5 = mysqli_query($recordset->conn,$sql5))
                                        {
                                            if($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                            {
                                                $pcent = ($row5["numerador"]/$denominador)*100;
                                                $row3["pcent"] = $pcent;
                                            }
                                        }*/
                                        array_push($rowX["iglesias"], $row3);
                                    }
                                }
                               

                                $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                                FROM Grupos g
                                INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                WHERE  d.idCampo in (".$idCampo.")
                                ORDER BY d.idDistrito ASC");
                                 if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $row3["distrito"] = ($row3["distrito"]);
                                        array_push($rowX["no"], $row3);
                                    }
                                }
                                array_push($campos, $rowX);
                            }
                            echo '{ "success" : 1, "campos" : '.json_encode($campos).', "denominador" : '.$denominador.' }';
                            exit(0);
                        }
                    break;
                    case 'verDepartamentosQueYaPresentaronPlanDelCampo2018InformeTrimestralUMN_PorTrimestre':  
                        checarSesionUsuarios();
                        $campos = array();
                        $anio = $_POST['anio'];
                        $trimestre = intval($_POST['trimestre']);
                        $palabrin = "Primero";
                        if($trimestre==2){
                            $palabrin = "Segundo";
                        } else {
                            if($trimestre==3){
                                $palabrin = "Tercero";
                            } else {
                                if($trimestre==4){
                                    $palabrin = "Cuarto";
                                } 
                            }
                        }
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $denominadorCampo=16;//menos mision adventista y ministerios personales y tecnologia
                        $denominadorUnion=17;//menos mision adventista y ministerios personales

                        $denominadorCampo=16;//menos mision adventista y ministerios personales y tecnologia
                        $denominadorUnion=1;//menos mision adventista y ministerios personales
                        
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                     order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = $row33["idCampo"];
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["iglesias"] = array();
                                $rowX["no"] = array();
                                $tipo=2;//2 es campo, 3 es union
                                if($row33["idCampo"]==11)//si es union
                                {
                                    $tipo=3;
                                }
                                $sql2=('SELECT idDepartamento, nombre
                                    FROM Departamentos 
                                    WHERE tipo >= 1 order by nombre asc');
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                    {
                                        $row2["nombre"] = ($row2["nombre"]);
                                        if($row2["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                        {
                                           // $row2["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                        }
                                
                                        $denominador = 1;
                                        $sql3=("SELECT COUNT(d.idDepartamentosAcciones) as denominador
                                            FROM DepartamentosAcciones2018 d
                                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                                            WHERE  d.anio = ".$anio." AND d.idDepartamento = ".$row2["idDepartamento"]." AND a.tipo = 2");
                                        if($query3 = mysqli_query($recordset->conn,$sql3))
                                        {
                                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                            {
                                                $denominador = 1;
                                                //$denominador = $row3["denominador"];
                                            }
                                        }
                            /*   $sql5=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                                FROM MetasEstrategicas2018 m 
                                                INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones
                                                WHERE m.idCampo = ".$idCampo." AND d.idDepartamento = ".$row3["idDepartamento"]."
                                                AND m.anio = ".$anio." GROUP BY m.idCampo ");
                                            */
                                        $entre = 0;
                                        $sql3=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                            FROM MetasEstrategicas2018 m 
                                            INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones

                                            INNER JOIN EvaluacionCampo2018 e on e.idMetasEstrategicas = m.idMetasEstrategicas
                                            WHERE m.idCampo in (".$rowX["idCampo"].") AND d.idDepartamento = ".$row2["idDepartamento"]."
                                            AND m.anio = ".$anio." AND e.".$palabrin." != 0 GROUP BY m.idCampo 
                                            ");
                                        if($query3 = mysqli_query($recordset->conn,$sql3))
                                        {
                                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                            {
                                                $entre = 1;
                                                if(intval($row3["numerador"])==0)
                                                {
                                                    $entre = 0;
                                                }
                                                else
                                                {
                                                    $row3["numerador"] = 1;//hardcode maximus
                                                    //perdon por hardcodear asi, pero con que ponga algo en el departamento, se lo contamos como valido, porque solo piden y piden y no se detienen a planear, luego le echan la culpa a uno, en la iglesia no hay cultura tecnologica en este momento, 30/08/2018
                                                    //$row3["nombre"] = ($row3["nombre"]);
                                                    $row3["denominador"] = $denominador;
                                                    $row3["nombre"] = $row2["nombre"];
                                                    $row3["distrito"] = "";//($row3["distrito"]);
                                                    array_push($rowX["iglesias"], $row3);
                                                }
                                            }
                                        }
                                        if($entre==0)
                                        {
                                            $row3=array();
                                            $row3["denominador"] = $denominador;
                                            $row3["numerador"] = 0;
                                            $row3["nombre"] = $row2["nombre"];
                                            $row3["distrito"] ="";// ($row3["distrito"]);
                                            array_push($rowX["no"], $row3);
                                        }
                                      
                                    
                                    }
                                    array_push($campos, $rowX);
                                }
                            }
                            echo '{ "success" : 1, "campos" : '.json_encode($campos).', "denominadorCampo" : '.$denominadorCampo.', "denominadorUnion" : '.$denominadorUnion.'}';
                            exit(0);
                        }
                    break;
                    case 'verDepartamentosQueYaPresentaronPlanDelCampo2018InformeTrimestralUMN':  
                    //verCamposQueYaPresentaronPlanDelCampoUMN2018
                        checarSesionUsuarios();
                        $campos = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                         $denominadorCampo=1;
                        $sql33=("SELECT COUNT(d.idDepartamentosAcciones) as denominador
                            FROM DepartamentosAcciones2018 d
                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                            WHERE  d.anio = ".$anio." AND a.tipo = 2");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            if($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {  
                                $denominadorCampo = $row33["denominador"];
                            }
                        }
                         $denominadorUnion=1;
                        $sql33=("SELECT COUNT(d.idDepartamentosAcciones) as denominador
                            FROM DepartamentosAcciones2018 d
                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                            WHERE  d.anio = ".$anio." AND a.tipo = 3");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            if($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {  
                                $denominadorUnion = $row33["denominador"];
                            }
                        }
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                     order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = $row33["idCampo"];
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["iglesias"] = array();
                                $rowX["no"] = array();
                                $tipo=2;//2 es campo, 3 es union
                                if($row33["idCampo"]==11)//si es union
                                {
                                    $tipo=3;
                                }
                                $sql2=('SELECT idDepartamento, nombre
                                    FROM Departamentos 
                                    WHERE tipo >= 1 order by nombre asc');
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                    {
                                        $row2["nombre"] = ($row2["nombre"]);
                                        if($row2["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                        {
                                            //$row2["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                        }
                                        $denominador = 1;
                                        $sql3=("SELECT COUNT(d.idDepartamentosAcciones) as denominador
                                            FROM DepartamentosAcciones2018 d
                                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                                            WHERE  d.anio = ".$anio." AND d.idDepartamento = ".$row2["idDepartamento"]." AND a.tipo = 2");
                                        if($query3 = mysqli_query($recordset->conn,$sql3))
                                        {
                                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                            {
                                                $denominador = $row3["denominador"];
                                            }
                                        }
                            /*   $sql5=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                                FROM MetasEstrategicas2018 m 
                                                INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones
                                                WHERE m.idCampo = ".$idCampo." AND d.idDepartamento = ".$row3["idDepartamento"]."
                                                AND m.anio = ".$anio." GROUP BY m.idCampo ");
                                            */
                                        $entre = 0;
                                        $sql3=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                            FROM MetasEstrategicas2018 m 
                                            INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones

                                            INNER JOIN EvaluacionCampo2018 e on e.idMetasEstrategicas = m.idMetasEstrategicas
                                            WHERE m.idCampo in (".$rowX["idCampo"].") AND d.idDepartamento = ".$row2["idDepartamento"]."
                                            AND m.anio = ".$anio." GROUP BY m.idCampo 
                                            ");
                                        if($query3 = mysqli_query($recordset->conn,$sql3))
                                        {
                                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                            {
                                                $entre = 1;
                                                if(intval($row3["numerador"])==0)
                                                {
                                                    $entre = 0;
                                                }
                                                else
                                                {
                                                    //$row3["nombre"] = ($row3["nombre"]);
                                                    $row3["denominador"] = $denominador;
                                                    $row3["nombre"] = $row2["nombre"];
                                                    $row3["distrito"] = "";//($row3["distrito"]);
                                                    array_push($rowX["iglesias"], $row3);
                                                }
                                            }
                                        }
                                        if($entre==0)
                                        {
                                            $row3=array();
                                            $row3["denominador"] = $denominador;
                                            $row3["numerador"] = 0;
                                            $row3["nombre"] = $row2["nombre"];
                                            $row3["distrito"] ="";// ($row3["distrito"]);
                                            array_push($rowX["no"], $row3);
                                        }
                                      
                                    
                                    }
                                    array_push($campos, $rowX);
                                }
                            }
                            echo '{ "success" : 1, "campos" : '.json_encode($campos).', "denominadorCampo" : '.$denominadorCampo.', "denominadorUnion" : '.$denominadorUnion.'}';
                            exit(0);
                        }
                    break;
                    case 'verDepartamentosQueYaPresentaronPlanDelCampo2018InformeTrimestral_PorTrimestre':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $trimestre = intval($_POST['trimestre']);
                        $palabrin = "Primero";
                        if($trimestre==2){
                            $palabrin = "Segundo";
                        } else {
                            if($trimestre==3){
                                $palabrin = "Tercero";
                            } else {
                                if($trimestre==4){
                                    $palabrin = "Cuarto";
                                } 
                            }
                        }
                        
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $tipin = 1;
                        $tipon = 2;
                        $extra = " AND idDepartamento != 2 AND idDepartamento != 18 ";
                        if(intval($idCampo)==11){
                            $tipin = 0;
                            $tipon = 3;
                            $extra = " AND idDepartamento != 2 AND idDepartamento != 18 ";
                        }
                       
                       

                         $sql2=('SELECT idDepartamento, nombre
                            FROM Departamentos 
                            WHERE tipo >= '.$tipin.' '.$extra.' order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                if($row2["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                {
                                   // $row2["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                }

                                 if($row2["idDepartamento"]==20 && $anio==2019)//hardcode maximus, perdon el que lo lea, pero..
                                {
                                    continue;
                                }
                                if($row2["idDepartamento"]==20 && $anio==2020)//hardcode maximus, perdon el que lo lea, pero..
                                {
                                    continue;
                                }
                        
                        
                                $denominador = 1;
                                /*
                                $sql3=("SELECT COUNT(d.idDepartamentosAcciones) as denominador
                                    FROM DepartamentosAcciones2018 d
                                    INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                                    WHERE  d.anio = ".$anio." AND d.idDepartamento = ".$row2["idDepartamento"]." AND a.tipo = ".$tipon);
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $denominador = $row3["denominador"];
                                    }
                                }
                                */
                                $entre = 0;
                                $sql3=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                    FROM MetasEstrategicas2018 m 
                                    INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones

                                    INNER JOIN EvaluacionCampo2018 e on e.idMetasEstrategicas = m.idMetasEstrategicas
                                    WHERE m.idCampo in (".$idCampo.") AND d.idDepartamento = ".$row2["idDepartamento"]."
                                    AND m.anio = ".$anio." AND e.".$palabrin." != 0 GROUP BY m.idCampo 
                                    ");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $entre = 1;
                                        if(intval($row3["numerador"])==0)
                                        {
                                            $entre = 0;
                                        }
                                        else
                                        {
                                            //$row3["nombre"] = ($row3["nombre"]);
                                            $row3["denominador"] = $denominador;
                                            $row3["numerador"] = 1;//hardcode maximus
                                            //perdon por hardcodear asi, pero con que ponga algo en el departamento, se lo contamos como valido, porque solo piden y piden y no se detienen a planear, luego le echan la culpa a uno, en la iglesia no hay cultura tecnologica en este momento, 30/08/2018
                                            $row3["nombre"] = $row2["nombre"];
                                            $row3["idDepartamento"] = $row2["idDepartamento"];
                                            $row3["distrito"] = "";//($row3["distrito"]);
                                            array_push($iglesias, $row3);   
                                        }
                                    }
                                }
                                if($entre==0)
                                {
                                    $row3=array();
                                    $row3["denominador"] = $denominador;
                                    $row3["numerador"] = 0;
                                    $row3["idDepartamento"] = $row2["idDepartamento"];
                                    $row3["nombre"] = $row2["nombre"];
                                    $row3["distrito"] ="";// ($row3["distrito"]);
                                    array_push($no, $row3);
                                }
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verDepartamentosQueYaPresentaronPlanDelCampo2018InformeTrimestral':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $tipin = 1;
                        $tipon = 2;
                        if(intval($idCampo)==11){
                            $tipin = 0;
                            $tipon = 3;
                        }
                       
                       

                         $sql2=('SELECT idDepartamento, nombre
                            FROM Departamentos 
                            WHERE tipo >= '.$tipin.' order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                if($row2["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                {
                                    //$row2["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                }
                        
                                $denominador = 1;
                                $sql3=("SELECT COUNT(d.idDepartamentosAcciones) as denominador
                                    FROM DepartamentosAcciones2018 d
                                    INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                                    INNER JOIN MetasEstrategicas2018 m on m.idDepartamentosAcciones = d.idDepartamentosAcciones
                                    WHERE  d.anio = ".$anio." AND d.idDepartamento = ".$row2["idDepartamento"]." AND a.tipo = ".$tipon." AND m.idCampo in (".$idCampo.") AND m.anio = ".$anio."");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $denominador = $row3["denominador"];
                                    }
                                }
                    /*   $sql5=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                        FROM MetasEstrategicas2018 m 
                                        INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones
                                        WHERE m.idCampo = ".$idCampo." AND d.idDepartamento = ".$row3["idDepartamento"]."
                                        AND m.anio = ".$anio." GROUP BY m.idCampo ");
                                    */
                                $entre = 0;
                                $sql3=("SELECT COUNT(m.idMetasEstrategicas) as numerador
                                    FROM MetasEstrategicas2018 m 
                                    INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones

                                    INNER JOIN EvaluacionCampo2018 e on e.idMetasEstrategicas = m.idMetasEstrategicas
                                    WHERE m.idCampo in (".$idCampo.") AND d.idDepartamento = ".$row2["idDepartamento"]."
                                    AND m.anio = ".$anio." GROUP BY m.idCampo 
                                    ");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $entre = 1;
                                        if(intval($row3["numerador"])==0)
                                        {
                                            $entre = 0;
                                        }
                                        else
                                        {
                                            //$row3["nombre"] = ($row3["nombre"]);
                                            $row3["denominador"] = $denominador;
                                            $row3["nombre"] = $row2["nombre"];
                                            $row3["idDepartamento"] = $row2["idDepartamento"];
                                            $row3["distrito"] = "";//($row3["distrito"]);
                                            $row3["idCampo"] = $idCampo;
                                            array_push($iglesias, $row3);   
                                        }
                                    }
                                }
                                if($entre==0)
                                {
                                    $row3=array();
                                    $row3["denominador"] = $denominador;
                                    $row3["numerador"] = 0;
                                    $row3["idDepartamento"] = $row2["idDepartamento"];
                                    $row3["nombre"] = $row2["nombre"];
                                    $row3["distrito"] ="";// ($row3["distrito"]);
                                    array_push($no, $row3);
                                }
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018InformeTrimestral_Iglesia_PorTrimestre':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $trimestre = intval($_POST['trimestre']);
                        $palabrin = "Primero";
                        if($trimestre==2){
                            $palabrin = "Segundo";
                        } else {
                            if($trimestre==3){
                                $palabrin = "Tercero";
                            } else {
                                if($trimestre==4){
                                    $palabrin = "Cuarto";
                                } 
                            }
                        }
                        
                        $idCampo = -1;
                        if(isset($_POST["idGrupo"]))
                        {
                            $idCampo = $_POST["idGrupo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idGrupo"]))
                            {
                                $idCampo = $_SESSION["idGrupo"];
                            }    
                        }
                        $denominador = 11;
                        //super hardcode, perdon al que lo lea, pero bueno, el Dr Cea viene a regañarme a las 4pm, y quiero entregar el asunto terminado; ya le explique la situación por telefono y no me entendió; eso hizo perder en mi la esperanza de que alguien en la unión me entendiera, porque hasta ahora el que trabaja más ordenado es el Dr. Cea, pero bueno, fue la solución que se me ocurrio para antes de las 4pm.   30/Agosto/2018 14:48 pm
                        /*
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        */
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                            WHERE d.idDistrito in (".$idCampo.")
                            AND m.anio = ".$anio." AND e.".$palabrin." != 0 GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                //super hardcode
                                if(intval($row3["numerador"])>$denominador){
                                    $row3["numerador"] = $denominador;
                                }
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  g.idGrupo in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018InformeTrimestralDistrito_PorTrimestre':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $trimestre = intval($_POST['trimestre']);
                        $palabrin = "Primero";
                        if($trimestre==2){
                            $palabrin = "Segundo";
                        } else {
                            if($trimestre==3){
                                $palabrin = "Tercero";
                            } else {
                                if($trimestre==4){
                                    $palabrin = "Cuarto";
                                } 
                            }
                        }
                        
                        $idCampo = -1;
                        if(isset($_POST["idDistrito"]))
                        {
                            $idCampo = $_POST["idDistrito"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idDistrito"]))
                            {
                                $idCampo = $_SESSION["idDistrito"];
                            }    
                        }
                        $denominador = 11;

                        if($trimestre>=3 && $anio==2019){ //perdon al que lo lea, no he dormido por mis hijos y los pastores dan mucha lata
                            $denominador = 30;    
                            if($idCampo==12){ //perdon al que lo lea, no he dormido por mis hijos 
                                $denominador = 30;
                            }
                            if($idCampo==7){ //perdon al que lo lea, no he dormido por mis hijos 
                                $denominador = 20;
                            }
                            if($idCampo==4){ //perdon al que lo lea, no he dormido por mis hijos 
                                $denominador = 10;
                            }
                        }
                        
                        //super hardcode, perdon al que lo lea, pero bueno, el Dr Cea viene a regañarme a las 4pm, y quiero entregar el asunto terminado; ya le explique la situación por telefono y no me entendió; eso hizo perder en mi la esperanza de que alguien en la unión me entendiera, porque hasta ahora el que trabaja más ordenado es el Dr. Cea, pero bueno, fue la solución que se me ocurrio para antes de las 4pm.   30/Agosto/2018 14:48 pm
                        /*
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        */
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                            WHERE d.idDistrito in (".$idCampo.")
                            AND m.anio = ".$anio." AND e.".$palabrin." != 0 GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                //super hardcode
                                if(intval($row3["numerador"])>$denominador){
                                    $row3["numerador"] = $denominador;
                                }
                                $sql33=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador
                                    FROM MetasEstrategicasIglesias m 
                                    INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                                    INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                    WHERE d.idDistrito in (".$idCampo.")
                                    AND m.anio = ".$anio." AND m.idGrupo = ".$row3["idGrupo"]." AND m.metaNumero = 0 GROUP BY m.idGrupo 
                                    order by d.nombre asc, m.idGrupo asc ");
                                if($query33 = mysqli_query($recordset->conn,$sql33))
                                {
                                    if($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                                    {
                                        $row3["numerador"] = intval($row3["numerador"]) + intval($row33["numerador"]);
                                        if(intval($row3["numerador"])>$denominador){
                                            $row3["numerador"] = $denominador;
                                        }
                                    }
                                }
                                



                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  d.idDistrito in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018InformeTrimestral_Iglesia':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idGrupo"]))
                        {
                            $idCampo = $_POST["idGrupo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idGrupo"]))
                            {
                                $idCampo = $_SESSION["idGrupo"];
                            }    
                        }
                        $denominador = 1;
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                            WHERE g.idGrupo in (".$idCampo.")
                            AND m.anio = ".$anio." GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  d.idDistrito in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018InformeTrimestralDistrito':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idDistrito"]))
                        {
                            $idCampo = $_POST["idDistrito"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idDistrito"]))
                            {
                                $idCampo = $_SESSION["idDistrito"];
                            }    
                        }
                        $denominador = 1;
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                            WHERE d.idDistrito in (".$idCampo.")
                            AND m.anio = ".$anio." GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  d.idDistrito in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018InformeTrimestral_PorTrimestre':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $trimestre = intval($_POST['trimestre']);
                        $palabrin = "Primero";
                        if($trimestre==2){
                            $palabrin = "Segundo";
                        } else {
                            if($trimestre==3){
                                $palabrin = "Tercero";
                            } else {
                                if($trimestre==4){
                                    $palabrin = "Cuarto";
                                } 
                            }
                        }
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $denominador = 1;
                        if($trimestre>=3 && $anio==2019){ //perdon al que lo lea, no he dormido por mis hijos y los pastores dan mucha lata
                            $denominador = 30;    
                            if($idCampo==7){ //perdon al que lo lea, no he dormido por mis hijos 
                                $denominador = 20;
                            }
                            if($idCampo==4){ //perdon al que lo lea, no he dormido por mis hijos 
                                $denominador = 10;
                            }
                        }
                        
                        //super hardcode, perdon al que lo lea, pero bueno, el Dr Cea viene a regañarme a las 4pm, y quiero entregar el asunto terminado; ya le explique la situación por telefono y no me entendió; eso hizo perder en mi la esperanza de que alguien en la unión me entendiera, porque hasta ahora el que trabaja más ordenado es el Dr. Cea, pero bueno, fue la solución que se me ocurrio para antes de las 4pm.   30/Agosto/2018 12:52 pm
                        /*
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }*/
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito, d.idDistrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                            WHERE d.idCampo in (".$idCampo.")
                            AND m.anio = ".$anio." AND e.".$palabrin." != 0 GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                //super hardcode
                                if(intval($row3["numerador"])>$denominador){
                                    $row3["numerador"] = $denominador;
                                }
                                $row3["denominador"] = $denominador;
                                 $sql33=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador
                                    FROM MetasEstrategicasIglesias m 
                                    INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                                    INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                    WHERE d.idDistrito in (".$row3["idDistrito"].")
                                    AND m.anio = ".$anio." AND m.idGrupo = ".$row3["idGrupo"]." AND m.metaNumero = 0 GROUP BY m.idGrupo 
                                    order by d.nombre asc, m.idGrupo asc ");
                                if($query33 = mysqli_query($recordset->conn,$sql33))
                                {
                                    if($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                                    {
                                        $row3["numerador"] = intval($row3["numerador"]) + intval($row33["numerador"]);
                                        if(intval($row3["numerador"])>$denominador){
                                            $row3["numerador"] = $denominador;
                                        }
                                    }
                                }
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  d.idCampo in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018InformeTrimestral'://trimestre
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $denominador = 1;
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        if($anio==2019){ //perdon al que lo lea, no he dormido por mis hijos y los pastores dan mucha lata
                            $denominador = 30;    
                            if($idCampo==12){ //perdon al que lo lea, no he dormido por mis hijos 
                                $denominador = 30;
                            }
                            if($idCampo==4){ //perdon al que lo lea, no he dormido por mis hijos 
                                $denominador = 10;
                            }
                        }
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito,(SELECT count(*) FROM  MetasEstrategicasIglesias x
                            WHERE x.idGrupo = g.idGrupo AND x.anio = ".$anio." AND x.metaNumero !=0) as denominador
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                            WHERE d.idCampo in (".$idCampo.")
                            AND m.anio = ".$anio." GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                $row3["idCampo"] = $idCampo;
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  d.idCampo in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018Distrito':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idDistrito"]))
                        {
                            $idCampo = $_POST["idDistrito"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idDistrito"]))
                            {
                                $idCampo = $_SESSION["idDistrito"];
                            }    
                        }
                        $denominador = 1;
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE d.idDistrito in (".$idCampo.")
                            AND m.anio = ".$anio." GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  d.idDistrito in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo2018':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $denominador = 1;
                        $sql3=("SELECT COUNT(d.idDepartamentosAccionesIglesias) as denominador
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE  d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $denominador = $row3["denominador"];
                            }
                        }
                        $sql3=("SELECT COUNT(m.idMetasEstrategicasIglesias) as numerador, m.idGrupo, g.nombre, d.nombre as distrito
                            FROM MetasEstrategicasIglesias m 
                            INNER JOIN Grupos g on g.idGrupo = m.idGrupo
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE d.idCampo in (".$idCampo.")
                            AND m.anio = ".$anio." GROUP BY m.idGrupo 
                            order by d.nombre asc, m.idGrupo asc ");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE  d.idCampo in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).', "denominador" : '.$denominador.'}';
                        exit(0);
                    break;
                    case 'verIglesiasQueYaPresentaronPlanDelCampo':  
                        checarSesionUsuarios();
                        $iglesias = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $idCampo = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }    
                        }
                        $sql3=("SELECT DISTINCT m.idGrupo, g.nombre, d.nombre as distrito
                        FROM Distritos d
                        INNER JOIN Grupos g on g.idDistrito = d.idDistrito
                        INNER JOIN MetasEstrategicasIglesias m on m.idGrupo = g.idGrupo
                        WHERE d.idCampo in (".$idCampo.")
                        AND m.anio = ".$anio);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($iglesias, $row3);
                            }
                        }
                       

                        $sql3=("SELECT DISTINCT g.idGrupo, g.nombre, d.nombre as distrito
                        FROM Grupos g
                        LEFT JOIN MetasEstrategicasIglesias m on m.idGrupo = g.idGrupo
                        INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                        WHERE m.idGrupo IS NULL AND d.idCampo in (".$idCampo.")
                        ORDER BY d.idDistrito ASC");
                         if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["distrito"] = ($row3["distrito"]);
                                array_push($no, $row3);
                            }
                        }
                        echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).', "no" : '.json_encode($no).'}';
                        exit(0);
                    break;
                    case 'verPlanCampoDepartamento':  
                        checarSesionUsuarios();
                        $acciones = array();
                        $no = array();
                        $anio = $_POST['anio'];
                        $tipo = $_POST['tipo'];
                        $idCampo = $_POST['idCampo'];
                        $nombre='';
                        $departamento='';
                        $sql33=("SELECT nombre FROM Campos WHERE idCampo = ".$idCampo);
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $nombre = ($row33["nombre"]);
                            }
                        }
                        $idDepartamento = $_POST['idDepartamento'];
                        $sql33=("SELECT nombre FROM Departamentos WHERE idDepartamento = ".$idDepartamento);
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $departamento = ($row33["nombre"]);
                            }
                        }
                        $first = true;
                        $idAccionEstrategicaLista = '';
                        $sql33=("SELECT m.motor, a.indicador, o.objetivo, a.accion, mm.meta, mm.metaNumero, mm.indicador, mm.idUsuarioCampo, a.idAccionEstrategica, mm.idMetasEstrategicas,mm.idDepartamentosAcciones, IFNULL(e.Primero,0) as Primero, IFNULL(e.Segundo,0) as Segundo, IFNULL(e.Tercero,0) as Tercero, IFNULL(e.Cuarto,0) as Cuarto
                                    FROM Motores m
                                    INNER JOIN ObjetivosEspecificos o on o.motor = m.idMotor
                                    INNER JOIN AccionesEstrategicas a on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                                    INNER JOIN DepartamentosAcciones d on d.idAccionEstrategica = a.idAccionEstrategica

                                    INNER JOIN MetasEstrategicas mm on mm.idDepartamentosAcciones = d.idDepartamentosAcciones
                                    LEFT JOIN EvaluacionCampo e on e.idMetasEstrategicas = mm.idMetasEstrategicas
                                    WHERE mm.idCampo = ".$idCampo." AND d.idDepartamento = ".$idDepartamento." AND mm.anio = ".$anio);
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $row33["objetivo"] = ($row33["objetivo"]);
                                $row33["accion"] = ($row33["accion"]);
                                $row33["meta"] = ($row33["meta"]);
                                $row33["actividadesSugerentes"] = array();
                                if($first)
                                {
                                    $first = false;
                                    $idAccionEstrategicaLista = $row33["idAccionEstrategica"];
                                }
                                else
                                {
                                    $idAccionEstrategicaLista = $idAccionEstrategicaLista.",".$row33["idAccionEstrategica"];
                                }
                                $sql3=("SELECT  idActividadesMetas, actividad
                                            FROM ActividadesMetas 
                                            WHERE idMetasEstrategicas = ".$row33["idMetasEstrategicas"]." order by idActividadesMetas asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["actividad"] = ($row3["actividad"]);
                                        array_push($row33["actividadesSugerentes"], $row3);
                                    }
                                }
                                $row33["calendario"] = array();
                                $sql3=("SELECT  idFechasMetas, fechaInicial, fechaFinal
                                            FROM FechasMetas 
                                            WHERE idMetasEstrategicas = ".$row33["idMetasEstrategicas"]." order by idFechasMetas asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        array_push($row33["calendario"], $row3);
                                    }
                                }
                                $row33["presupuesto"] = array();
                                $sql3=("SELECT  idPresupuestoMetas, presupuesto, concepto
                                            FROM PresupuestoMetas 
                                            WHERE idMetasEstrategicas = ".$row33["idMetasEstrategicas"]." order by idPresupuestoMetas asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["concepto"] = ($row3["concepto"]);
                                        array_push($row33["presupuesto"], $row3);
                                    }
                                }

                                $row33["verificacion"] = array();
                                $sql3=("SELECT  idVerificacionMetas, archivo, descripcion
                                            FROM VerificacionMetas 
                                            WHERE idMetasEstrategicas = ".$row33["idMetasEstrategicas"]." order by idVerificacionMetas asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["descripcion"] = ($row3["descripcion"]);
                                        array_push($row33["verificacion"], $row3);
                                    }
                                }

                                array_push($acciones, $row33);
                               
                            }
                        }
                        $sql33=("SELECT m.motor, o.objetivo, a.accion, a.tipo , a.idAccionEstrategica
                                    FROM Motores m
                                    INNER JOIN ObjetivosEspecificos o on o.motor = m.idMotor
                                    INNER JOIN AccionesEstrategicas a on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                                    INNER JOIN DepartamentosAcciones d on d.idAccionEstrategica = a.idAccionEstrategica
                                    WHERE d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." AND a.idAccionEstrategica NOT IN (".$idAccionEstrategicaLista.")");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $row33["objetivo"] = ($row33["objetivo"]);
                                $row33["accion"] = ($row33["accion"]);
                                array_push($no, $row33);
                            }
                        }
                        echo '{ "success" : 1, "departamento" : "'.$departamento.'", "nombre" : "'.$nombre.'", "acciones" : '.json_encode($acciones).', "no" : '.json_encode($no).'}';
                        exit(0);
                    break;
                    case 'verAccionesDeCampoMonitoreo':  
                        checarSesionUsuarios();
                        $campos = array();
                        $acciones = array();
                        $actividadesSugerentes = array();

                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo = 0;
                        if(isset($_POST['tipo']))
                        {
                            $tipo = $_POST['tipo'];
                        }
                        

                        $idCamposUMN = '';
                        $first = true;
                              
                        $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE dependeDe in (11,0) order by dependeDe desc, idCampo asc");
                        if($_SESSION["dependeDe"]!=0)//depende de la union
                        {
                             $sql33=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE idCampo = ".$_SESSION["idCampo"]." order by dependeDe desc, idCampo asc");
                        }
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                $rowX = array();
                                $rowX["idCampo"] = ($row33["idCampo"]);
                                $rowX["nombre"] = ($row33["nombre"]);
                                $rowX["departamentosQueYaInformaron"] = array();
                                $sql3=("SELECT DISTINCT d.idDepartamento , dd.nombre
                                FROM MetasEstrategicas2018 m
                                INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones
                                INNER JOIN Departamentos dd on dd.idDepartamento = d.idDepartamento
                                WHERE m.idCampo = ".$idCampo." AND m.anio = ".$anio." AND d.anio = ".$anio."
                                order by d.idDepartamento asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["nombre"] = ($row3["nombre"]);
                                        if($row3["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                        {
                                         //   $row3["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                        }
                                        
                                        array_push($rowX["departamentosQueYaInformaron"], $row3);
                                    }
                                }
                                $campos[$idCampo] = $rowX;
                                //array_push($campos, $row33["nombre"])
                                if($first)
                                {
                                    $first = false;
                                    $idCamposUMN = $row33["idCampo"];
                                }
                                else
                                {
                                    $idCamposUMN = $idCamposUMN.",".$row33["idCampo"];
                                }
                            }
                        }




                        $sql3=("SELECT IFNULL(SUM(m.metaNumero),0) as sumaDeMetas, a.accion, d.idDepartamentosAcciones
                        FROM MetasEstrategicas2018 m
                        INNER JOIN DepartamentosAcciones2018 d on d.idDepartamentosAcciones = m.idDepartamentosAcciones
                        INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                        WHERE m.idCampo in (".$idCamposUMN.")
                        AND m.anio = ".$anio." AND d.anio = ".$anio." AND a.anio = ".$anio." AND d.idDepartamento = ".$idDepartamento." GROUP BY m.idDepartamentosAcciones ");

                    

                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                
                                $row3["accion"] = ($row3["accion"]);
                                array_push($acciones, $row3);
                            }
                        }
                        echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "campos" : '.json_encode($campos).'}';
                        exit(0);
                    break;
                    case 'verAccionesDeIglesiaMonitoreoUMN':  
                        checarSesionUsuarios();
                        
                        $acciones = array();
                        $actividadesSugerentes = array();

                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        
                        $tipo = 0;
                        if(isset($_POST['tipo']))
                        {
                            $tipo = $_POST['tipo'];
                        }

                        $sql3=("SELECT idActividadesSugerentesIglesia, archivo, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamento = ".$idDepartamento." order by idActividadesSugerentesIglesia asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["descripcion"] = ($row3["descripcion"]);
                                $rowY["ene"] = $row3["ene"];
                                $rowY["feb"] = $row3["feb"];
                                $rowY["mar"] = $row3["mar"];
                                $rowY["abr"] = $row3["abr"];
                                $rowY["may"] = $row3["may"];
                                $rowY["jun"] = $row3["jun"];
                                $rowY["jul"] = $row3["jul"];
                                $rowY["ago"] = $row3["ago"];
                                $rowY["sep"] = $row3["sep"];
                                $rowY["oct"] = $row3["oct"];
                                $rowY["nov"] = $row3["nov"];
                                $rowY["dic"] = $row3["dic"];
                                $rowY["archivo"] = $row3["archivo"];
                                $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                array_push($actividadesSugerentes, $rowY);
                            }
                        }
                        $idCamposUMN = '';
                        $first = true;
                              
                        $sql33=("SELECT idCampo
                                    FROM Campos 
                                    WHERE dependeDe = 11 order by idCampo asc");
                        if($query33 = mysqli_query($recordset->conn,$sql33))
                        {
                            while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                            {
                                $idCampo = $row33["idCampo"];
                                if($first)
                                {
                                    $first = false;
                                    $idCamposUMN = $row33["idCampo"];
                                }
                                else
                                {
                                    $idCamposUMN = $idCamposUMN.",".$row33["idCampo"];
                                }
                           }
                       }
                            $idGrupoDeCampos = '';
                                $first = true;
                                $sql3=("SELECT idDistrito
                                            FROM Distritos 
                                            WHERE idCampo in (".$idCamposUMN.") order by nombre asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $sql4=("SELECT idGrupo
                                            FROM Grupos 
                                            WHERE idDistrito = ".$row3["idDistrito"]." order by idGrupo asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                if($first)
                                                {
                                                    $first = false;
                                                    $idGrupoDeCampos = $row4["idGrupo"];
                                                }
                                                else
                                                {
                                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                                }
                                            }
                                        }
                                    }
                                }


                      //verAccionesDeDistritoMonitoreo'
                     
                        $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE d.idDepartamento = ".$idDepartamento." AND d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if(intval($tipo)==3)//todos
                        {
                            $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo, dd.nombre
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            INNER JOIN Departamentos dd on d.idDepartamento = dd.idDepartamento
                            WHERE d.anio = ".$anio." AND d.tipo = 2 order by d.idDepartamentosAccionesIglesias asc");
                        }
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                    {
                                        $row2["accion"] = ($row2["accion"]);
                                        $row2["accionPasado"] = ($row2["accionPasado"]);
                                        $rowX = array();
                                        if(intval($tipo)==3)//todos
                                        {
                                            $row2["nombre"] = ($row2["nombre"]);
                                            $rowX["nombre"] = $row2["nombre"];
                                        }
                                        $rowX["accion"] = $row2["accion"];
                                        $rowX["accionPasado"] = $row2["accionPasado"];
                                        $rowX["tipo"] = $row2["tipo"];
                                        $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                        $rowX["indicador"] = $row2["indicador"];
                                        $rowX["motor"] = $row2["motor"];
                                        $rowX["objetivo"] = ($row2["objetivo"]);
                                        $rowX["procesoResultado"] = $row2["tipo"];

                                        $rowX["actividadesSugerentes"] = array();
                                        $sql3=("SELECT  idActividadesSugerentesIglesia, descripcion,
                                            FROM ActividadesSugerentesIglesia 
                                            WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." order by idActividadesSugerentesIglesia asc");
                                        if($query3 = mysqli_query($recordset->conn,$sql3))
                                        {
                                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                            {
                                                $rowY = array();
                                                $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                                $rowY["descripcion"] = ($row3["descripcion"]);
                                                array_push($rowX["actividadesSugerentes"], $rowY);
                                            }
                                        }
                                       
                                      
                                        
                                        
                                        $rowX["metas"] = array();
                                        $sql3=("SELECT anio, metaNumero, idMetasEstrategicasIglesias
                                            FROM MetasEstrategicasIglesias 
                                            WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND idGrupo in (".$idGrupoDeCampos.")
                                            AND anio = ".$anio." order by idMetasEstrategicasIglesias asc");
                                        //echo $sql3;
                                        //exit();
                                        
                                        $rowX["sumaDeMetas"] = 0;
                                        $rowX["sumaDePrimeros"] = 0;
                                        $rowX["sumaDeSegundos"] = 0;
                                        $rowX["sumaDeTerceros"] = 0;
                                        $rowX["sumaDeCuartos"] = 0;
                                        
                                        $rowX["promedioDeMetas"] = 0;
                                        $cuantos = 0;
                                        if($query3 = mysqli_query($recordset->conn,$sql3))
                                        {
                                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                            {
                                                $cuantos = $cuantos +1;
                                                $rowY = array();
                                                $rowY["indicador"] = $row2["indicador"];
                                                $rowY["metaNumero"] = $row3["metaNumero"];
                                                $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row3["metaNumero"];
                                                $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                                $rowY["idEvaluacionIglesias"] = -1;
                                                $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                            FROM EvaluacionIglesias 
                                                            WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                                if($query333 = mysqli_query($recordset->conn,$sql333))
                                                {
                                                    if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                                    {
                                                        if(intval($row333["Primero"])<=0){$row333["Primero"]=0;}
                                                        if(intval($row333["Segundo"])<=0){$row333["Segundo"]=0;}
                                                        if(intval($row333["Tercero"])<=0){$row333["Tercero"]=0;}
                                                        if(intval($row333["Cuarto"])<=0){$row333["Cuarto"]=0;}
                                                        $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row333["Primero"];
                                                        $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row333["Segundo"];
                                                        $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row333["Tercero"];
                                                        $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row333["Cuarto"];
                                                        $rowY["Primero"] = $row333["Primero"];
                                                        $rowY["Segundo"] = $row333["Segundo"];
                                                        $rowY["Tercero"] = $row333["Tercero"];
                                                        $rowY["Cuarto"] = $row333["Cuarto"];
                                                        $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                                    }
                                                }
                                                array_push($rowX["metas"], $rowY);
                                            }
                                        }
                                        if($cuantos==0)
                                        {
                                            $cuantos = 1;
                                        }
                                        $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);


                                        $rowX["actividades"] = array();
                                        $sql4=("SELECT  a.idActividadesIglesias, a.actividadOtra, a.idActividadesSugerentesIglesia, asi.archivo,IFNULL(asi.titulo,'') as titulo, IFNULL(asi.descripcion,'') as descripcion, asi.ene, asi.feb, asi.mar, asi.abr, asi.may, asi.jun, asi.jul, asi.ago, asi.sep, asi.oct, asi.nov, asi.dic
                                                    FROM ActividadesIglesias a
                                                    LEFT JOIN ActividadesSugerentesIglesia asi on a.idActividadesSugerentesIglesia = asi.idActividadesSugerentesIglesia
                                                    WHERE a.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                                    AND a.anio = ".$anio." AND a.idGrupo in (".$idGrupoDeCampos.") 
                                                     order by a.idActividadesIglesias asc");
                                        //echo $sql4;

                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                $rowY = array();
                                                $rowY["actividadOtra"] = ($row4["actividadOtra"]);
                                                $rowY["idActividadesSugerentesIglesia"] = $row4["idActividadesSugerentesIglesia"];
                                                $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                                $rowY["descripcion"] = ($row4["descripcion"]);
                                                $rowY["titulo"] = ($row4["titulo"]);
                                                $rowY["archivo"] = $row4["archivo"];
                                                array_push($rowX["actividades"], $rowY);
                                            }
                                        }
                                        $rowX["fechas"] = array();
                                        $sql4=("SELECT f.idFechasMetasIglesias, f.fecha, f.idActividadesIglesias, f.fechaFinal
                                                    FROM FechasMetasIglesias f
                                                    WHERE f.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                                    AND f.anio = ".$anio." AND f.idGrupo in (".$idGrupoDeCampos.")
                                                     order by f.idFechasMetasIglesias asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                $rowY = array();
                                                $rowY["fecha"] = ($row4["fecha"]);
                                                $rowY["fechaFinal"] = ($row4["fechaFinal"]);
                               
                                                if(intval($row4["idActividadesIglesias"])==-2)
                                                {
                                                    $rowY["actividad"] = "Sin actividad";    
                                                }
                                                else
                                                {
                                                    $sql41=("SELECT a.actividadOtra, aa.titulo
                                                        FROM ActividadesIglesias a
                                                        INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                        WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                                    if($query41 = mysqli_query($recordset->conn,$sql41))
                                                    {
                                                        if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                        {
                                                            $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                            $row41["titulo"] = ($row41["titulo"]);
                                                            $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                        }
                                                    }
                                                }
                                                $rowY["idFechasMetasIglesias"] = $row4["idFechasMetasIglesias"];
                                                array_push($rowX["fechas"], $rowY);
                                            }
                                        }
                                        $rowX["lugares"] = array();
                                        $sql4=("SELECT idLugaresMetasIglesias, lugar, idActividadesIglesias
                                                    FROM LugaresMetasIglesias 
                                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                                    AND anio = ".$anio." AND idGrupo in (".$idGrupoDeCampos.")
                                                    order by idLugaresMetasIglesias asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                $rowY = array();
                                                $rowY["lugar"] = ($row4["lugar"]);
                                                if(intval($row4["idActividadesIglesias"])==-2)
                                                {
                                                    $rowY["actividad"] = "Sin actividad";    
                                                }
                                                else
                                                {
                                                    $sql41=("SELECT a.actividadOtra, aa.titulo
                                                        FROM ActividadesIglesias a
                                                        INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                        WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                                    if($query41 = mysqli_query($recordset->conn,$sql41))
                                                    {
                                                        if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                        {
                                                            $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                            $row41["titulo"] = ($row41["titulo"]);
                                                            $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                        }
                                                    }
                                                }
                                                $rowY["idLugaresMetasIglesias"] = $row4["idLugaresMetasIglesias"];
                                                array_push($rowX["lugares"], $rowY);
                                            }
                                        }
                                        $rowX["presupuesto"] = array();
                                        $sql4=("SELECT idPresupuestoMetasIglesias, presupuesto, concepto, idActividadesIglesias
                                            FROM PresupuestoMetasIglesias 
                                            WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                            AND anio = ".$anio." AND idGrupo in (".$idGrupoDeCampos.")
                                            order by idPresupuestoMetasIglesias asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                $rowY = array();
                                                $rowY["presupuesto"] = ($row4["presupuesto"]);
                                                $rowY["concepto"] =  ($row4["concepto"]);
                                                if(intval($row4["idActividadesIglesias"])==-2)
                                                {
                                                    $rowY["actividad"] = "Sin actividad";    
                                                }
                                                else
                                                {
                                                    $sql41=("SELECT a.actividadOtra, aa.titulo
                                                        FROM ActividadesIglesias a
                                                        INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                        WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                                    if($query41 = mysqli_query($recordset->conn,$sql41))
                                                    {
                                                        if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                        {
                                                            $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                            $row41["titulo"] = ($row41["titulo"]);
                                                            $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                        }
                                                    }
                                                }
                                                $rowY["idPresupuestoMetasIglesias"] = $row4["idPresupuestoMetasIglesias"];
                                                array_push($rowX["presupuesto"], $rowY);
                                            }
                                        }
                                        array_push($acciones, $rowX);
                                    }
                             
                            
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "actividadesSugerentes" : '.json_encode($actividadesSugerentes).'}';
                            exit(0);
                        }
                    break;
                    case 'verAccionesDeCampoMonitoreoNewDetalleDistritoIglesia':  
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $anio = $_POST['anio'];
                        $idDistrito = $_POST['idDistrito'];
                        $sqlZ=("SELECT idGrupo, nombre
                                    FROM Grupos 
                                    WHERE idDistrito = ".$idDistrito." order by nombre asc");
                        if($queryZ = mysqli_query($recordset->conn,$sqlZ))
                        {
                            while($rowZ=mysqli_fetch_array($queryZ,MYSQLI_ASSOC))
                            {
                                $idGrupo  = $rowZ["idGrupo"];  
                                $rowZ["nombre"] = ($rowZ["nombre"]);
                                $idGrupoDeCampos = '';
                                $first = true;  
                                $sql4=("SELECT idGrupo
                                    FROM Grupos 
                                    WHERE idGrupo = ".$idGrupo." order by idGrupo asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        if($first)
                                        {
                                            $first = false;
                                            $idGrupoDeCampos = $row4["idGrupo"];
                                        }
                                        else
                                        {
                                            $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                        }
                                    }
                                }                            
                                $rowX = array();
                                $rowX["idDepartamentosAccionesIglesias"] = $idDepartamentosAccionesIglesias;
                                $rowX["idGrupo"] = $idGrupo;
                                $rowX["nombre"] = $rowZ["nombre"];
                                $rowX["metas"] = array();
                                $sql3=("SELECT anio, metaNumero, idMetasEstrategicasIglesias
                                    FROM MetasEstrategicasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias."
                                    AND idGrupo in (".$idGrupoDeCampos.")
                                    AND anio = ".$anio." order by idMetasEstrategicasIglesias asc");
                                $rowX["sumaDeMetas"] = 0;
                                $rowX["sumaDePrimeros"] = 0;
                                $rowX["sumaDeSegundos"] = 0;
                                $rowX["sumaDeTerceros"] = 0;
                                $rowX["sumaDeCuartos"] = 0;
                                $rowX["promedioDeMetas"] = 0;
                                $cuantos = 0;
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                    FROM EvaluacionIglesias 
                                                    WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {
                                                if(intval($row333["Primero"])<=0){$row333["Primero"]=0;}
                                                if(intval($row333["Segundo"])<=0){$row333["Segundo"]=0;}
                                                if(intval($row333["Tercero"])<=0){$row333["Tercero"]=0;}
                                                if(intval($row333["Cuarto"])<=0){$row333["Cuarto"]=0;}

                                                $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row333["Primero"];
                                                $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row333["Segundo"];
                                                $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row333["Tercero"];
                                                $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row333["Cuarto"];
                                                $rowY["Primero"] = $row333["Primero"];
                                                $rowY["Segundo"] = $row333["Segundo"];
                                                $rowY["Tercero"] = $row333["Tercero"];
                                                $rowY["Cuarto"] = $row333["Cuarto"];
                                                $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                            }
                                        }
                                        array_push($rowX["metas"], $rowY);
                                    }
                                }
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);
                                array_push($acciones, $rowX);
                            }
                        }
                        echo '{ "success" : 1, "acciones" : '.json_encode($acciones).'}';
                            exit(0);
                    break;
                    case 'verAccionesDeCampoMonitoreoNewDetalleDistrito':  
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $anio = $_POST['anio'];
                        $idCampo = $_POST['idCampo'];
                        $sqlZ=("SELECT idDistrito, nombre
                                    FROM Distritos 
                                    WHERE idCampo = ".$idCampo." order by nombre asc");
                        if($queryZ = mysqli_query($recordset->conn,$sqlZ))
                        {
                            while($rowZ=mysqli_fetch_array($queryZ,MYSQLI_ASSOC))
                            {
                                $idDistrito  = $rowZ["idDistrito"];  
                                $rowZ["nombre"] = ($rowZ["nombre"]);
                                $idGrupoDeCampos = '';
                                $first = true;  
                                $sql4=("SELECT idGrupo
                                    FROM Grupos 
                                    WHERE idDistrito = ".$idDistrito." order by idGrupo asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        if($first)
                                        {
                                            $first = false;
                                            $idGrupoDeCampos = $row4["idGrupo"];
                                        }
                                        else
                                        {
                                            $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                        }
                                    }
                                }                            
                                $rowX = array();
                                $rowX["idDepartamentosAccionesIglesias"] = $idDepartamentosAccionesIglesias;
                                $rowX["idDistrito"] = $idDistrito;
                                $rowX["nombre"] = $rowZ["nombre"];
                                $rowX["metas"] = array();
                                $sql3=("SELECT anio, metaNumero, idMetasEstrategicasIglesias
                                    FROM MetasEstrategicasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias."
                                    AND idGrupo in (".$idGrupoDeCampos.")
                                    AND anio = ".$anio." order by idMetasEstrategicasIglesias asc");
                                $rowX["sumaDeMetas"] = 0;
                                $rowX["sumaDePrimeros"] = 0;
                                $rowX["sumaDeSegundos"] = 0;
                                $rowX["sumaDeTerceros"] = 0;
                                $rowX["sumaDeCuartos"] = 0;
                                $rowX["promedioDeMetas"] = 0;
                                $cuantos = 0;
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                    FROM EvaluacionIglesias 
                                                    WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {
                                                if(intval($row333["Primero"])<=0){$row333["Primero"]=0;}
                                                if(intval($row333["Segundo"])<=0){$row333["Segundo"]=0;}
                                                if(intval($row333["Tercero"])<=0){$row333["Tercero"]=0;}
                                                if(intval($row333["Cuarto"])<=0){$row333["Cuarto"]=0;}
                                                $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row333["Primero"];
                                                $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row333["Segundo"];
                                                $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row333["Tercero"];
                                                $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row333["Cuarto"];
                                                $rowY["Primero"] = $row333["Primero"];
                                                $rowY["Segundo"] = $row333["Segundo"];
                                                $rowY["Tercero"] = $row333["Tercero"];
                                                $rowY["Cuarto"] = $row333["Cuarto"];
                                                $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                            }
                                        }
                                        array_push($rowX["metas"], $rowY);
                                    }
                                }
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);
                                array_push($acciones, $rowX);
                            }
                        }
                        echo '{ "success" : 1, "acciones" : '.json_encode($acciones).'}';
                            exit(0);
                    break;
                    case 'verAccionesDeCampoMonitoreoNewDetalle':  
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $anio = $_POST['anio'];
                        $idCampo = $_POST['idCampo'];
                        $sqlZ=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE idCampo in (".$idCampo.") order by idCampo asc");
                        if($queryZ = mysqli_query($recordset->conn,$sqlZ))
                        {
                            while($rowZ=mysqli_fetch_array($queryZ,MYSQLI_ASSOC))
                            {
                                $idCampo  = $rowZ["idCampo"];  
                                $rowZ["nombre"] = ($rowZ["nombre"]);
                                $idGrupoDeCampos = '';
                                $first = true;  
                                $sql3=("SELECT idDistrito
                                    FROM Distritos 
                                    WHERE idCampo = ".$idCampo." order by nombre asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $sql4=("SELECT idGrupo
                                            FROM Grupos 
                                            WHERE idDistrito = ".$row3["idDistrito"]." order by idGrupo asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                if($first)
                                                {
                                                    $first = false;
                                                    $idGrupoDeCampos = $row4["idGrupo"];
                                                }
                                                else
                                                {
                                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                                }
                                            }
                                        }
                                    }
                                }
                                $rowX = array();
                                $rowX["idDepartamentosAccionesIglesias"] = $idDepartamentosAccionesIglesias;
                                $rowX["idCampo"] = $idCampo;
                                $rowX["nombre"] = $rowZ["nombre"];
                                $rowX["metas"] = array();
                                $sql3=("SELECT anio, metaNumero, idMetasEstrategicasIglesias
                                    FROM MetasEstrategicasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$idDepartamentosAccionesIglesias."
                                    AND idGrupo in (".$idGrupoDeCampos.")
                                    AND anio = ".$anio." order by idMetasEstrategicasIglesias asc");
                                $rowX["sumaDeMetas"] = 0;
                                $rowX["sumaDePrimeros"] = 0;
                                $rowX["sumaDeSegundos"] = 0;
                                $rowX["sumaDeTerceros"] = 0;
                                $rowX["sumaDeCuartos"] = 0;
                                $rowX["promedioDeMetas"] = 0;
                                $cuantos = 0;
                                $acumulador = 0;
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $acumulador = $acumulador + $row3["metaNumero"];
                                        $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row3["metaNumero"]; //¿?
                                      //  $rowX["sumaDeMetas"] = $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                    FROM EvaluacionIglesias 
                                                    WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {

                                                 if(intval($row333["Primero"])<=0){$row333["Primero"]=0;}
                                                if(intval($row333["Segundo"])<=0){$row333["Segundo"]=0;}
                                                if(intval($row333["Tercero"])<=0){$row333["Tercero"]=0;}
                                                if(intval($row333["Cuarto"])<=0){$row333["Cuarto"]=0;}
                                  

                                                $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row333["Primero"];
                                                $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row333["Segundo"];
                                                $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row333["Tercero"];
                                                $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row333["Cuarto"];
                                                $rowY["Primero"] = $row333["Primero"];
                                                $rowY["Segundo"] = $row333["Segundo"];
                                                $rowY["Tercero"] = $row333["Tercero"];
                                                $rowY["Cuarto"] = $row333["Cuarto"];
                                                $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                            }
                                        }
                                        array_push($rowX["metas"], $rowY);
                                    }
                                }
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);
                                array_push($acciones, $rowX);
                            }
                        }
                        echo '{ "success" : 1, "acciones" : '.json_encode($acciones).'}';
                            exit(0);
                    break;
                    case 'verAccionesDeCampoMonitoreoNewNew':
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo = 0;
                        if(isset($_POST['tipo']))
                        {
                            $tipo = $_POST['tipo'];
                        }
                        $idGrupoDeCampos = '';
                        $first = true;
                        $idCampo  = -1;
                        if(isset($_SESSION["idCampo"]))
                        {
                            $idCampo = $_SESSION["idCampo"];
                        }
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        if(intval($idCampo)==11)
                        {
                            $idCampo = "1,2,3,4,5,6,7,8,9,10,12";    
                        }
                        $sql4=("SELECT g.idGrupo
                            FROM Grupos g
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE d.idCampo in (".$idCampo.") order by g.idGrupo asc");

                            $first = true;  
                                $sql3=("SELECT idDistrito
                                    FROM Distritos 
                                    WHERE idCampo in (".$idCampo.") order by nombre asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $sql4=("SELECT idGrupo
                                            FROM Grupos 
                                            WHERE idDistrito = ".$row3["idDistrito"]." order by idGrupo asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                if($first)
                                                {
                                                    $first = false;
                                                    $idGrupoDeCampos = $row4["idGrupo"];
                                                }
                                                else
                                                {
                                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                                }
                                            }
                                        }
                                    }
                                }



/*
                        if($idCampo==11)//UMN
                        {
                            $sql4=("SELECT g.idGrupo
                            FROM Grupos g
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE d.idCampo != 11 order by g.idGrupo asc");
                        }
                        if($query4 = mysqli_query($recordset->conn,$sql4))
                        {
                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                            {
                                if($first)
                                {
                                    $first = false;
                                    $idGrupoDeCampos = $row4["idGrupo"];
                                }
                                else
                                {
                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                }
                            }
                        }*/
                        $cuantos=0;
                        $sql2=("SELECT  d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, d.tipo, mm.anio, mm.metaNumero, mm.idMetasEstrategicasIglesias, IFNULL(e.Primero,0) as Primero, IFNULL(e.Segundo,0) as Segundo, IFNULL(e.Tercero,0) as Tercero, IFNULL(e.Cuarto,0) as Cuarto, IFNULL(e.idEvaluacionIglesias,0) as idEvaluacionIglesias, d.idDepartamento
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN MetasEstrategicasIglesias mm on mm.idDepartamentosAccionesIglesias = d.idDepartamentosAccionesIglesias
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = mm.idMetasEstrategicasIglesias
                            WHERE d.idDepartamento = ".$idDepartamento." AND mm.idGrupo in (".$idGrupoDeCampos.") AND d.anio = ".$anio." AND mm.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc, mm.idMetasEstrategicasIglesias asc");
                        if(intval($tipo)==3)//todos
                        {
                            $sql2=("SELECT  d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, d.tipo, mm.anio, mm.metaNumero, mm.idMetasEstrategicasIglesias, IFNULL(e.Primero,0) as Primero, IFNULL(e.Segundo,0) as Segundo, IFNULL(e.Tercero,0) as Tercero, IFNULL(e.Cuarto,0) as Cuarto, IFNULL(e.idEvaluacionIglesias,0) as idEvaluacionIglesias, d.idDepartamento
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN MetasEstrategicasIglesias mm on mm.idDepartamentosAccionesIglesias = d.idDepartamentosAccionesIglesias
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = mm.idMetasEstrategicasIglesias
                            WHERE d.anio = ".$anio." AND mm.idGrupo in (".$idGrupoDeCampos.") AND mm.anio = ".$anio." AND d.tipo = 2 order by d.idDepartamentosAccionesIglesias asc, mm.idMetasEstrategicasIglesias asc ");
                        }
                        //atencion!!! debe de ser LEFT JOIN, pero se tarda mucho!! entonces puse INNER en EvaluacionIglesias, eso significa que si una iglesia no ha evaluado, no aparecerá su meta tampoco :(  hardcode
                        //echo $sql2;
                        //exit();
                        $primeraVez = true;
                        $idDepartamentosAccionesIglesiasActual = 0;
                        $idDepartamentosAccionesIglesiasAnterior = 0;
                        $rowX = array();
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                if($primeraVez)
                                {
                                    $primeraVez = false;
                                    //$row2["accion"] = ($row2["accion"]);
                                    $row2["accionPasado"] = ($row2["accionPasado"]);
                                    $rowX = array();
                                    if(intval($tipo)==3)//todos
                                    {
                                        //$row2["nombre"] = ($row2["nombre"]);
                                        //$rowX["nombre"] = $row2["nombre"];
                                    }
                                   // $rowX["accion"] = $row2["accion"];
                                    $rowX["accionPasado"] = $row2["accionPasado"];
                                    $rowX["tipo"] = $row2["tipo"];
                                    $rowX["idDepartamento"] = $row2["idDepartamento"];
                                    $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                    $idDepartamentosAccionesIglesiasActual = $row2["idDepartamentosAccionesIglesias"];
                                    $idDepartamentosAccionesIglesiasAnterior = $idDepartamentosAccionesIglesiasActual;
                                    $rowX["indicador"] = $row2["indicador"];
                                    $rowX["procesoResultado"] = $row2["tipo"];
                                    $rowX["metas"] = array();
                                    $rowX["sumaDeMetas"] = 0;
                                    $rowX["sumaDePrimeros"] = 0;
                                    $rowX["sumaDeSegundos"] = 0;
                                    $rowX["sumaDeTerceros"] = 0;
                                    $rowX["sumaDeCuartos"] = 0;
                                    $rowX["promedioDeMetas"] = 0;
                                    $cuantos = 0;
                                }
                                $idDepartamentosAccionesIglesiasActual = $row2["idDepartamentosAccionesIglesias"];
                                if($idDepartamentosAccionesIglesiasActual == $idDepartamentosAccionesIglesiasAnterior)
                                {
                                    $cuantos = $cuantos +1;
                                    $rowY = array();
                                    $rowY["indicador"] = $row2["indicador"];
                                    $rowY["metaNumero"] = $row2["metaNumero"];
                                    $rowX["idDepartamento"] = $row2["idDepartamento"];
                                    $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row2["metaNumero"];
                                    $rowY["idMetasEstrategicasIglesias"] = $row2["idMetasEstrategicasIglesias"];
                                    $rowY["idEvaluacionIglesias"] = -1;
                                    if(intval($row2["Primero"])<=0){$row2["Primero"]=0;}
                                                if(intval($row2["Segundo"])<=0){$row2["Segundo"]=0;}
                                                if(intval($row2["Tercero"])<=0){$row2["Tercero"]=0;}
                                                if(intval($row2["Cuarto"])<=0){$row2["Cuarto"]=0;}
                                    $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row2["Primero"];
                                    $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row2["Segundo"];
                                    $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row2["Tercero"];
                                    $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row2["Cuarto"];
                                    $rowY["Primero"] = $row2["Primero"];
                                    $rowY["Segundo"] = $row2["Segundo"];
                                    $rowY["Tercero"] = $row2["Tercero"];
                                    $rowY["Cuarto"] = $row2["Cuarto"];
                                    $rowY["idEvaluacionIglesias"] = $row2["idEvaluacionIglesias"];
                                    array_push($rowX["metas"], $rowY);
                                    
                                }
                                else
                                {
                                    if($cuantos==0)
                                    {
                                        $cuantos = 1;
                                    }

                                    $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);
                                    array_push($acciones, $rowX);
                                 //   $row2["accion"] = ($row2["accion"]);
                                    $row2["accionPasado"] = ($row2["accionPasado"]);
                                    $rowX = array();
                                    if(intval($tipo)==3)//todos
                                    {
                                        //$row2["nombre"] = ($row2["nombre"]);
                                        //$rowX["nombre"] = $row2["nombre"];
                                    }
                              //      $rowX["accion"] = $row2["accion"];
                                    $rowX["accionPasado"] = $row2["accionPasado"];
                                    $rowX["tipo"] = $row2["tipo"];
                                    $rowX["idDepartamento"] = $row2["idDepartamento"];
                                    $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                    $idDepartamentosAccionesIglesiasActual = $row2["idDepartamentosAccionesIglesias"];
                                    $idDepartamentosAccionesIglesiasAnterior = $idDepartamentosAccionesIglesiasActual;
                                    $rowX["indicador"] = $row2["indicador"];
                                    $rowX["procesoResultado"] = $row2["tipo"];
                                    $rowX["metas"] = array();
                                    $rowX["sumaDeMetas"] = 0;
                                    $rowX["sumaDePrimeros"] = 0;
                                    $rowX["sumaDeSegundos"] = 0;
                                    $rowX["sumaDeTerceros"] = 0;
                                    $rowX["sumaDeCuartos"] = 0;
                                    $rowX["promedioDeMetas"] = 0;
                                    $cuantos = 0;
                                }
                                $idDepartamentosAccionesIglesiasAnterior = $idDepartamentosAccionesIglesiasActual;
                            }//while
                            if($cuantos==0)
                            {
                                $cuantos = 1;
                            }
                            if(!isset($rowX["sumaDeMetas"])){
                                $rowX["sumaDeMetas"] = 0;
                            }
                            $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);
                            array_push($acciones, $rowX);
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "idCampo" : "'.$idCampo.'"}';
                            //, "sql2" : "'.$sql2.'" 
                            exit(0);
                        }
                        echo '{ "success" : -1, "sql" : ""}';
                        exit(0);
                    break;
                    case 'verAccionesDeCampoMonitoreoNew':  
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo = 0;
                        if(isset($_POST['tipo']))
                        {
                            $tipo = $_POST['tipo'];
                        }
                        $idGrupoDeCampos = '';
                        $first = true;
                        $idCampo  = -1;
                        if(isset($_SESSION["idCampo"]))
                        {
                            $idCampo = $_SESSION["idCampo"];
                        }
                        else
                        {
                            $idCampo = $_POST["idCampo"];    
                        }
                        
                        $sql4=("SELECT g.idGrupo
                            FROM Grupos g
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE d.idCampo = ".$idCampo." order by g.idGrupo asc");
                        if($idCampo==11)//UMN
                        {
                            $sql4=("SELECT g.idGrupo
                            FROM Grupos g
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE d.idCampo != 11 order by g.idGrupo asc");
                        }
                        if($query4 = mysqli_query($recordset->conn,$sql4))
                        {
                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                            {
                                if($first)
                                {
                                    $first = false;
                                    $idGrupoDeCampos = $row4["idGrupo"];
                                }
                                else
                                {
                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                }
                            }
                        }
                    

                            


                        
                          $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE d.idDepartamento = ".$idDepartamento." AND d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if(intval($tipo)==3)//todos
                        {
                            $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo, dd.nombre
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            INNER JOIN Departamentos dd on d.idDepartamento = dd.idDepartamento
                            WHERE d.anio = ".$anio." AND d.tipo = 2 order by d.idDepartamentosAccionesIglesias asc");
                        }
                        
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                
                                $rowX = array();
                                $row2["accion"] = ($row2["accion"]);
                                $row2["accionPasado"] = ($row2["accionPasado"]);
                                if(intval($tipo)==3)//todos
                                {
                                    $row2["nombre"] = ($row2["nombre"]);
                                    $rowX["nombre"] = $row2["nombre"];
                                }
                                $rowX["accion"] = $row2["accion"];
                                $rowX["accionPasado"] = $row2["accionPasado"];
                                $rowX["tipo"] = $row2["tipo"];
                                $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                $rowX["indicador"] = $row2["indicador"];
                                $rowX["motor"] = ($row2["motor"]);
                                $rowX["objetivo"] = ($row2["objetivo"]);
                                $rowX["procesoResultado"] = $row2["tipo"];

                                
                               
                              
                                //INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                                    
                                //, e.idEvaluacionIglesias, e.Primero, e.Segundo, e.Tercero, e.Cuarto
                                $rowX["metas"] = array();
                                /*
                                $sql3=("SELECT m.anio, m.metaNumero, m.idMetasEstrategicasIglesias
                                    FROM MetasEstrategicasIglesias m
                                    WHERE m.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                    AND m.idGrupo in (".$idGrupoDeCampos.")
                                    AND m.anio = ".$anio."  order by m.idMetasEstrategicasIglesias asc");
*/
                                $sql3=("SELECT m.anio, m.metaNumero, m.idMetasEstrategicasIglesias, IFNULL(e.Primero,0) as Primero, IFNULL(e.Segundo,0) as Segundo, IFNULL(e.Tercero,0) as Tercero, IFNULL(e.Cuarto,0) as Cuarto, IFNULL(e.idEvaluacionIglesias,0) as idEvaluacionIglesias
                                    FROM MetasEstrategicasIglesias m
                                    LEFT JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = m.idMetasEstrategicasIglesias
                                    WHERE m.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                    AND m.idGrupo in (".$idGrupoDeCampos.")
                                    AND m.anio = ".$anio."  order by m.idMetasEstrategicasIglesias asc");


                                //echo $sql3;
                                //exit();
                                
                                $rowX["sumaDeMetas"] = 0;
                                $rowX["sumaDePrimeros"] = 0;
                                $rowX["sumaDeSegundos"] = 0;
                                $rowX["sumaDeTerceros"] = 0;
                                $rowX["sumaDeCuartos"] = 0;
                                $rowX["promedioDeMetas"] = 0;
                                $cuantos = 0;
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["indicador"] = $row2["indicador"];
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;

                                        /*$sql333=("SELECT e.idEvaluacionIglesias, e.Primero, e.Segundo, e.Tercero, e.Cuarto
                                                    FROM EvaluacionIglesias e
                                                    WHERE e.idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {*/
                                                 if(intval($row3["Primero"])<=0){$row3["Primero"]=0;}
                                                if(intval($row3["Segundo"])<=0){$row3["Segundo"]=0;}
                                                if(intval($row3["Tercero"])<=0){$row3["Tercero"]=0;}
                                                if(intval($row3["Cuarto"])<=0){$row3["Cuarto"]=0;}
                                                $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row3["Primero"];
                                                $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row3["Segundo"];
                                                $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row3["Tercero"];
                                                $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row3["Cuarto"];
                                                $rowY["Primero"] = $row3["Primero"];
                                                $rowY["Segundo"] = $row3["Segundo"];
                                                $rowY["Tercero"] = $row3["Tercero"];
                                                $rowY["Cuarto"] = $row3["Cuarto"];
                                                $rowY["idEvaluacionIglesias"] = $row3["idEvaluacionIglesias"];
                                            //}
                                       // }
                                        array_push($rowX["metas"], $rowY);
                                    }
                                }
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);
                                array_push($acciones, $rowX);
                            }
                            
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).'}';
                            exit(0);
                        }
                    break;
                    case 'verAccionesDeDistritoMonitoreo':  
                        checarSesionUsuarios();
                        $acciones = array();
                        $actividadesSugerentes = array();
                        //verAccionesDeIglesia'
                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo = 0;
                        if(isset($_POST['tipo']))
                        {
                            $tipo = $_POST['tipo'];
                        }
                        $idGrupoDeCampos = '';
                        $first = true;
                        $idDistrito  = -1;
                        if(isset($_SESSION["idDistrito"]))
                        {
                            $idDistrito = $_SESSION["idDistrito"];
                        }
                        else
                        {
                            $idDistrito = $_POST["idDistrito"];    
                        }
                        
                        $sql4=("SELECT idGrupo
                            FROM Grupos 
                            WHERE idDistrito = ".$idDistrito." order by idGrupo asc");
                        if($query4 = mysqli_query($recordset->conn,$sql4))
                        {
                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                            {
                                if($first)
                                {
                                    $first = false;
                                    $idGrupoDeCampos = $row4["idGrupo"];
                                }
                                else
                                {
                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                }
                            }
                        }
                            


                        $sql3=("SELECT idActividadesSugerentesIglesia, archivo, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamento = ".$idDepartamento." order by idActividadesSugerentesIglesia asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["descripcion"] = ($row3["descripcion"]);
                                $rowY["ene"] = $row3["ene"];
                                $rowY["feb"] = $row3["feb"];
                                $rowY["mar"] = $row3["mar"];
                                $rowY["abr"] = $row3["abr"];
                                $rowY["may"] = $row3["may"];
                                $rowY["jun"] = $row3["jun"];
                                $rowY["jul"] = $row3["jul"];
                                $rowY["ago"] = $row3["ago"];
                                $rowY["sep"] = $row3["sep"];
                                $rowY["oct"] = $row3["oct"];
                                $rowY["nov"] = $row3["nov"];
                                $rowY["dic"] = $row3["dic"];
                                $rowY["archivo"] = $row3["archivo"];
                                $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                array_push($actividadesSugerentes, $rowY);
                            }
                        }
                        
                          $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE d.idDepartamento = ".$idDepartamento." AND d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if(intval($tipo)==3)//todos
                        {
                            $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo, dd.nombre
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            INNER JOIN Departamentos dd on d.idDepartamento = dd.idDepartamento
                            WHERE d.anio = ".$anio." AND d.tipo = 2 order by d.idDepartamentosAccionesIglesias asc");
                        }
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                $row2["accionPasado"] = ($row2["accionPasado"]);
                                $rowX = array();
                                if(intval($tipo)==3)//todos
                                {
                                    $row2["nombre"] = ($row2["nombre"]);
                                    $rowX["nombre"] = $row2["nombre"];
                                }
                                $rowX["accion"] = $row2["accion"];
                                $rowX["accionPasado"] = $row2["accionPasado"];
                                $rowX["tipo"] = $row2["tipo"];
                                $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                $rowX["indicador"] = $row2["indicador"];
                                $rowX["motor"] = ($row2["motor"]);
                                $rowX["objetivo"] = ($row2["objetivo"]);
                                $rowX["procesoResultado"] = $row2["tipo"];

                                $rowX["actividadesSugerentes"] = array();
                                $sql3=("SELECT  idActividadesSugerentesIglesia, descripcion, titulo
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." order by idActividadesSugerentesIglesia asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                        
                                        $rowY["titulo"] = ($row3["titulo"]);
                                        $rowY["descripcion"] = ($row3["descripcion"]);
                                        
                                        array_push($rowX["actividadesSugerentes"], $rowY);
                                    }
                                }
                               
                              
                                
                                
                                $rowX["metas"] = array();
                                $sql3=("SELECT anio, metaNumero, idMetasEstrategicasIglesias
                                    FROM MetasEstrategicasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                    AND idGrupo in (".$idGrupoDeCampos.")
                                    AND anio = ".$anio." order by idMetasEstrategicasIglesias asc");


                                //echo $sql3;
                                //exit();
                                
                                $rowX["sumaDeMetas"] = 0;
                                $rowX["sumaDePrimeros"] = 0;
                                $rowX["sumaDeSegundos"] = 0;
                                $rowX["sumaDeTerceros"] = 0;
                                $rowX["sumaDeCuartos"] = 0;
                                $rowX["promedioDeMetas"] = 0;
                                $cuantos = 0;
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["indicador"] = $row2["indicador"];
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                    FROM EvaluacionIglesias 
                                                    WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {
                                                if(intval($row333["Primero"])<=0){$row333["Primero"]=0;}
                                                if(intval($row333["Segundo"])<=0){$row333["Segundo"]=0;}
                                                if(intval($row333["Tercero"])<=0){$row333["Tercero"]=0;}
                                                if(intval($row333["Cuarto"])<=0){$row333["Cuarto"]=0;}
                                               
                                                $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row333["Primero"];
                                                $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row333["Segundo"];
                                                $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row333["Tercero"];
                                                $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row333["Cuarto"];
                                                $rowY["Primero"] = $row333["Primero"];
                                                $rowY["Segundo"] = $row333["Segundo"];
                                                $rowY["Tercero"] = $row333["Tercero"];
                                                $rowY["Cuarto"] = $row333["Cuarto"];
                                                $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                            }
                                        }
                                        array_push($rowX["metas"], $rowY);
                                    }
                                }
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);


                                $rowX["actividades"] = array();
                                $sql4=("SELECT  a.idActividadesIglesias, a.actividadOtra, a.idActividadesSugerentesIglesia, asi.archivo,IFNULL(asi.titulo,'') as titulo, IFNULL(asi.descripcion,'') as descripcion, asi.ene, asi.feb, asi.mar, asi.abr, asi.may, asi.jun, asi.jul, asi.ago, asi.sep, asi.oct, asi.nov, asi.dic
                                            FROM ActividadesIglesias a
                                            LEFT JOIN ActividadesSugerentesIglesia asi on a.idActividadesSugerentesIglesia = asi.idActividadesSugerentesIglesia
                                            WHERE a.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND a.anio = ".$anio." AND a.idGrupo in (".$idGrupoDeCampos.") 
                                             order by a.idActividadesIglesias asc");
                                //echo $sql4;

                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["actividadOtra"] = ($row4["actividadOtra"]);
                                        $rowY["idActividadesSugerentesIglesia"] = $row4["idActividadesSugerentesIglesia"];
                                        $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                        $rowY["descripcion"] = ($row4["descripcion"]);
                                        $rowY["titulo"] = ($row4["titulo"]);
                                        $rowY["archivo"] = $row4["archivo"];
                                        array_push($rowX["actividades"], $rowY);
                                    }
                                }
                                $rowX["fechas"] = array();
                                $sql4=("SELECT f.idFechasMetasIglesias, f.fecha, f.idActividadesIglesias, f.fechaFinal
                                            FROM FechasMetasIglesias f
                                            WHERE f.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND f.anio = ".$anio." AND f.idGrupo in (".$idGrupoDeCampos.")
                                             order by f.idFechasMetasIglesias asc");


                                

                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["fecha"] = ($row4["fecha"]);
                                        $rowY["fechaFinal"] = ($row4["fechaFinal"]);
                               
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT a.actividadOtra, aa.titulo
                                                FROM ActividadesIglesias a
                                                INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]." AND a.anio = ".$anio);
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idFechasMetasIglesias"] = $row4["idFechasMetasIglesias"];
                                        array_push($rowX["fechas"], $rowY);
                                    }
                                }
                                $rowX["lugares"] = array();
                                $sql4=("SELECT idLugaresMetasIglesias, lugar, idActividadesIglesias
                                            FROM LugaresMetasIglesias 
                                            WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                            AND anio = ".$anio." AND idGrupo in (".$idGrupoDeCampos.")
                                            order by idLugaresMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["lugar"] = ($row4["lugar"]);
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT a.actividadOtra, aa.titulo
                                                FROM ActividadesIglesias a
                                                INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]." AND a.anio = ".$anio);
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idLugaresMetasIglesias"] = $row4["idLugaresMetasIglesias"];
                                        array_push($rowX["lugares"], $rowY);
                                    }
                                }
                                $rowX["presupuesto"] = array();
                                $sql4=("SELECT idPresupuestoMetasIglesias, presupuesto, concepto, idActividadesIglesias
                                    FROM PresupuestoMetasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                    AND anio = ".$anio." AND idGrupo in (".$idGrupoDeCampos.")
                                    order by idPresupuestoMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["presupuesto"] = ($row4["presupuesto"]);
                                        $rowY["concepto"] =  ($row4["concepto"]);
                                        
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT a.actividadOtra, aa.titulo
                                                FROM ActividadesIglesias a
                                                INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]." AND a.anio = ".$anio);
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idPresupuestoMetasIglesias"] = $row4["idPresupuestoMetasIglesias"];
                                        array_push($rowX["presupuesto"], $rowY);
                                    }
                                }
                                array_push($acciones, $rowX);
                            }
                            
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "actividadesSugerentes" : '.json_encode($actividadesSugerentes).'}';
                            exit(0);
                        }
                    break;
                    case 'verAccionesDeIglesiaMonitoreo':  
                        checarPermisoAdministrador();  
                        checarSesionUsuarios();
                        $acciones = array();
                        $actividadesSugerentes = array();

                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo = 0;
                        if(isset($_POST['tipo']))
                        {
                            $tipo = $_POST['tipo'];
                        }
                        $idGrupoDeCampos = '';
                        $first = true;
                        //
                        //verAccionesDeDistritoMonitoreo
                        $sql3=("SELECT idDistrito
                                    FROM Distritos 
                                    WHERE idCampo = ".$_SESSION["idCampo"]." order by nombre asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql4=("SELECT idGrupo
                                    FROM Grupos 
                                    WHERE idDistrito = ".$row3["idDistrito"]." order by idGrupo asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        if($first)
                                        {
                                            $first = false;
                                            $idGrupoDeCampos = $row4["idGrupo"];
                                        }
                                        else
                                        {
                                            $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                        }
                                    }
                                }
                            }
                        }


                        $sql3=("SELECT idActividadesSugerentesIglesia, archivo, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamento = ".$idDepartamento." order by idActividadesSugerentesIglesia asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["descripcion"] = ($row3["descripcion"]);
                                $rowY["ene"] = $row3["ene"];
                                $rowY["feb"] = $row3["feb"];
                                $rowY["mar"] = $row3["mar"];
                                $rowY["abr"] = $row3["abr"];
                                $rowY["may"] = $row3["may"];
                                $rowY["jun"] = $row3["jun"];
                                $rowY["jul"] = $row3["jul"];
                                $rowY["ago"] = $row3["ago"];
                                $rowY["sep"] = $row3["sep"];
                                $rowY["oct"] = $row3["oct"];
                                $rowY["nov"] = $row3["nov"];
                                $rowY["dic"] = $row3["dic"];
                                $rowY["archivo"] = $row3["archivo"];
                                $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                array_push($actividadesSugerentes, $rowY);
                            }
                        }

                        $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            WHERE d.idDepartamento = ".$idDepartamento." AND d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if(intval($tipo)==3)//todos
                        {
                            $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo, dd.nombre
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN Motores m on m.idMotor = d.motor
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos
                            INNER JOIN Departamentos dd on d.idDepartamento = dd.idDepartamento
                            WHERE d.anio = ".$anio." AND d.tipo = 2 order by d.idDepartamentosAccionesIglesias asc");
                        }
                     
                        
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                $row2["accionPasado"] = ($row2["accionPasado"]);
                                $rowX = array();
                                if(intval($tipo)==3)//todos
                                {
                                    $row2["nombre"] = ($row2["nombre"]);
                                    $rowX["nombre"] = $row2["nombre"];
                                }
                                $rowX["accion"] = $row2["accion"];
                                $rowX["accionPasado"] = $row2["accionPasado"];
                                $rowX["tipo"] = $row2["tipo"];
                                $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                $rowX["indicador"] = $row2["indicador"];
                                $rowX["motor"] = $row2["motor"];
                                $rowX["objetivo"] = ($row2["objetivo"]);
                                $rowX["procesoResultado"] = $row2["tipo"];

                                $rowX["actividadesSugerentes"] = array();
                                $sql3=("SELECT  idActividadesSugerentesIglesia, descripcion,
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." order by idActividadesSugerentesIglesia asc");

                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                        $rowY["descripcion"] = ($row3["descripcion"]);
                                        array_push($rowX["actividadesSugerentes"], $rowY);
                                    }
                                }
                               
                              
                                
                                
                                $rowX["metas"] = array();
                                $sql3=("SELECT anio, metaNumero, idMetasEstrategicasIglesias
                                    FROM MetasEstrategicasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                    AND idGrupo in (".$idGrupoDeCampos.")
                                    AND anio = ".$anio." order by idMetasEstrategicasIglesias asc");
                                //echo $sql3;
                                //exit();
                                
                                $rowX["sumaDeMetas"] = 0;
                                $rowX["sumaDePrimeros"] = 0;
                                $rowX["sumaDeSegundos"] = 0;
                                $rowX["sumaDeTerceros"] = 0;
                                $rowX["sumaDeCuartos"] = 0;
                                $rowX["promedioDeMetas"] = 0;
                                $cuantos = 0;
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["indicador"] = $row2["indicador"];
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                    FROM EvaluacionIglesias 
                                                    WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {
                                                $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row333["Primero"];
                                                $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row333["Segundo"];
                                                $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row333["Tercero"];
                                                $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row333["Cuarto"];
                                                $rowY["Primero"] = $row333["Primero"];
                                                $rowY["Segundo"] = $row333["Segundo"];
                                                $rowY["Tercero"] = $row333["Tercero"];
                                                $rowY["Cuarto"] = $row333["Cuarto"];
                                                $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                            }
                                        }
                                        array_push($rowX["metas"], $rowY);
                                    }
                                }
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);


                                $rowX["actividades"] = array();
                                $sql4=("SELECT  a.idActividadesIglesias, a.actividadOtra, a.idActividadesSugerentesIglesia, asi.archivo,IFNULL(asi.titulo,'') as titulo, IFNULL(asi.descripcion,'') as descripcion, asi.ene, asi.feb, asi.mar, asi.abr, asi.may, asi.jun, asi.jul, asi.ago, asi.sep, asi.oct, asi.nov, asi.dic
                                            FROM ActividadesIglesias a
                                            LEFT JOIN ActividadesSugerentesIglesia asi on a.idActividadesSugerentesIglesia = asi.idActividadesSugerentesIglesia
                                            WHERE a.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND a.anio = ".$anio." AND a.idGrupo in (".$idGrupoDeCampos.") 
                                             order by a.idActividadesIglesias asc");
                                
                                //echo $sql4;

                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["actividadOtra"] = ($row4["actividadOtra"]);
                                        $rowY["idActividadesSugerentesIglesia"] = $row4["idActividadesSugerentesIglesia"];
                                        $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                        $rowY["descripcion"] = ($row4["descripcion"]);
                                        $rowY["titulo"] = ($row4["titulo"]);
                                        $rowY["archivo"] = $row4["archivo"];
                                        array_push($rowX["actividades"], $rowY);
                                    }
                                }
                                $rowX["fechas"] = array();
                                $sql4=("SELECT f.idFechasMetasIglesias, f.fecha, f.idActividadesIglesias,f.fechaFinal, f.idActividadesIglesias
                                            FROM FechasMetasIglesias f
                                            WHERE f.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND f.anio = ".$anio." AND f.idGrupo in (".$idGrupoDeCampos.")
                                             order by f.idFechasMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["fecha"] = ($row4["fecha"]);
                                        $rowY["fechaFinal"] = ($row4["fechaFinal"]);
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT a.actividadOtra, aa.titulo
                                                FROM ActividadesIglesias a
                                                INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idFechasMetasIglesias"] = $row4["idFechasMetasIglesias"];
                                        array_push($rowX["fechas"], $rowY);
                                    }
                                }
                                $rowX["lugares"] = array();
                                $sql4=("SELECT idLugaresMetasIglesias, lugar, idActividadesIglesias
                                            FROM LugaresMetasIglesias 
                                            WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                            AND anio = ".$anio." AND idGrupo in (".$idGrupoDeCampos.")
                                            order by idLugaresMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["lugar"] = ($row4["lugar"]);
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT a.actividadOtra, aa.titulo
                                                FROM ActividadesIglesias a
                                                INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idLugaresMetasIglesias"] = $row4["idLugaresMetasIglesias"];
                                        array_push($rowX["lugares"], $rowY);
                                    }
                                }
                                $rowX["presupuesto"] = array();
                                $sql4=("SELECT idPresupuestoMetasIglesias, presupuesto, concepto, idActividadesIglesias
                                    FROM PresupuestoMetasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                    AND anio = ".$anio." AND idGrupo in (".$idGrupoDeCampos.")
                                    order by idPresupuestoMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["presupuesto"] = ($row4["presupuesto"]);
                                        $rowY["concepto"] =  ($row4["concepto"]);
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT a.actividadOtra, aa.titulo
                                                FROM ActividadesIglesias a
                                                INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia
                                                WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idPresupuestoMetasIglesias"] = $row4["idPresupuestoMetasIglesias"];
                                        array_push($rowX["presupuesto"], $rowY);
                                    }
                                }
                                array_push($acciones, $rowX);
                            }
                            
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "actividadesSugerentes" : '.json_encode($actividadesSugerentes).'}';
                            exit(0);
                        }
                    break;
                    case 'cargaActividadesDeUnCampo':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $fechas = array();
                        $presupuesto = array();
                        $verificacion = array();
                       
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        
                        $anio = $_POST['anio'];

                        
                        
                         $sql4=("SELECT  a.idActividadesMetas, a.actividad
                                    FROM ActividadesMetas a
                                    WHERE a.idMetasEstrategicas = ".$idMetasEstrategicas."
                                     order by a.idActividadesMetas asc");
                        //echo $sql4;

                        if($query4 = mysqli_query($recordset->conn,$sql4))
                        {
                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["actividadOtra"] = ($row4["actividad"]);
                                $rowY["idActividadesMetas"] = $row4["idActividadesMetas"];
                                $rowY["descripcion"] = ($row4["actividad"]);
                                $rowY["titulo"] = ($row4["actividad"]);
                                array_push($acciones, $rowY);
                            }
                        }
                            

                        $sql44=("SELECT f.idFechasMetas, f.fechaInicial, f.fechaFinal
                            FROM FechasMetas f
                            WHERE f.idMetasEstrategicas = ".$idMetasEstrategicas."
                             order by f.idFechasMetas asc");
                        if($query44 = mysqli_query($recordset->conn,$sql44))
                        {
                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["idFechasMetas"] = $row44["idFechasMetas"];
                                $rowY["fechaInicial"] = $row44["fechaInicial"];
                                $rowY["fechaFinal"] = $row44["fechaFinal"];
                                array_push($fechas, $rowY);
                            }
                        }
                        
                        
                        $sql44=("SELECT idVerificacionMetas, descripcion
                            FROM VerificacionMetas 
                            WHERE idMetasEstrategicas = ".$idMetasEstrategicas." 
                            order by idVerificacionMetas asc");
                        if($query44 = mysqli_query($recordset->conn,$sql44))
                        {
                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["idVerificacionMetas"] = $row44["idVerificacionMetas"];
                                $rowY["descripcion"] = ($row44["descripcion"]);
                                array_push($verificacion, $rowY);
                            }
                        }

                        $rowY["presupuesto"] = array();
                        $sql44=("SELECT idPresupuestoMetas, presupuesto, concepto
                    FROM PresupuestoMetas 
                    WHERE idMetasEstrategicas = ".$idMetasEstrategicas." 
                    order by idMetasEstrategicas asc");
                        if($query44 = mysqli_query($recordset->conn,$sql44))
                        {
                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["idPresupuestoMetas"] = $row4["idPresupuestoMetas"];
                                $rowY["presupuesto"] = ($row44["presupuesto"]);
                                $rowY["concepto"] =  ($row44["concepto"]);
                                array_push($presupuesto, $rowY);
                            
                            }
                        }
                        
                                    
                                
                              
                            
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "fechas" : '.json_encode($fechas).', "verificacion" : '.json_encode($verificacion).', "presupuesto" : '.json_encode($presupuesto).'}';
                            exit(0);
                        
                    break;
                    
                    case 'cargaActividadesDeUnaIglesia':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $actividadesSugerentes = array();

                        $idGrupo = $_POST['idGrupo'];
                        $idMetasEstrategicasIglesias = $_POST['idMetasEstrategicasIglesias'];
                        
                        $anio = $_POST['anio'];

                        
                        $sql2=("SELECT idDepartamentosAccionesIglesias
                            FROM MetasEstrategicasIglesias 
                            WHERE idMetasEstrategicasIglesias = ".$idMetasEstrategicasIglesias);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $rowX = array();
                                $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                
                                
                                
                                $rowX["actividades"] = array();
                                $sql4=("SELECT  a.idActividadesIglesias, a.actividadOtra, a.idActividadesSugerentesIglesia, asi.archivo,IFNULL(asi.titulo,'') as titulo, IFNULL(asi.descripcion,'') as descripcion, asi.ene, asi.feb, asi.mar, asi.abr, asi.may, asi.jun, asi.jul, asi.ago, asi.sep, asi.oct, asi.nov, asi.dic
                                            FROM ActividadesIglesias a
                                            LEFT JOIN ActividadesSugerentesIglesia asi on a.idActividadesSugerentesIglesia = asi.idActividadesSugerentesIglesia
                                            WHERE a.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND a.anio = ".$anio." AND a.idGrupo = ".$idGrupo." 
                                             order by a.idActividadesIglesias asc");
                                //echo $sql4;

                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["actividadOtra"] = ($row4["actividadOtra"]);
                                        $rowY["idActividadesSugerentesIglesia"] = $row4["idActividadesSugerentesIglesia"];
                                        $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                        $rowY["descripcion"] = ($row4["descripcion"]);
                                        $rowY["titulo"] = ($row4["titulo"]);
                                        $rowY["archivo"] = $row4["archivo"];
                                        $rowY["fechas"] = array();
                                        $sql44=("SELECT f.idFechasMetasIglesias, f.fecha, f.idActividadesIglesias
                                            FROM FechasMetasIglesias f
                                            WHERE f.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND f.anio = ".$anio." AND f.idGrupo = ".$idGrupo."
                                            AND f.idActividadesIglesias = ".$row4["idActividadesIglesias"]."
                                             order by f.idFechasMetasIglesias asc");
                                        if($query44 = mysqli_query($recordset->conn,$sql44))
                                        {
                                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                                            {
                                                array_push($rowY["fechas"], $row44["fecha"]);
                                            }
                                        }
                                        
                                        $rowY["lugares"] = array();
                                        $sql44=("SELECT idLugaresMetasIglesias, lugar, idActividadesIglesias
                                            FROM LugaresMetasIglesias 
                                            WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                            AND anio = ".$anio." AND idGrupo = ".$idGrupo."
                                             AND idActividadesIglesias = ".$row4["idActividadesIglesias"]."
                                            order by idLugaresMetasIglesias asc");
                                        if($query44 = mysqli_query($recordset->conn,$sql44))
                                        {
                                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                                            {
                                                array_push($rowY["lugares"], ($row44["lugar"]));
                                            }
                                        }

                                        $rowY["presupuesto"] = array();
                                        $sql44=("SELECT idPresupuestoMetasIglesias, presupuesto, concepto, idActividadesIglesias
                                    FROM PresupuestoMetasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                    AND anio = ".$anio." AND idGrupo = ".$idGrupo."
                                      AND idActividadesIglesias = ".$row4["idActividadesIglesias"]."
                                    order by idPresupuestoMetasIglesias asc");
                                        if($query44 = mysqli_query($recordset->conn,$sql44))
                                        {
                                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                                            {
                                                $rowZ = array();
                                                $rowZ["presupuesto"] = ($row44["presupuesto"]);
                                                $rowZ["concepto"] =  ($row44["concepto"]);
                                                array_push($rowY["presupuesto"], $rowZ);
                                            
                                            }
                                        }
                                        array_push($rowX["actividades"], $rowY);
                                    }
                                }
                                array_push($acciones, $rowX);
                            }
                            
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).'}';
                            exit(0);
                        }
                    break;                
                    case 'guardarEvaluacionCampo':    
                        checarSesionUsuarios();

                        $message = urlencode($_SESSION["nombre"]. " está autoevaluándose");
                                        
                        $idE = intval($_POST['idE']);
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $primero = $_POST['primero'];
                        $segundo = $_POST['segundo'];
                        $tercero = $_POST['tercero'];
                        $cuarto = $_POST['cuarto'];
                        $sql3=("SELECT idEvaluacionCampo
                                    FROM EvaluacionCampo2018 
                                    WHERE idMetasEstrategicas = ".$idMetasEstrategicas);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql=("SELECT updateEvaluacionCampo2018Primero('".$primero."', ".$segundo.", ".$tercero." ,".$cuarto.", ".$idMetasEstrategicas.");");
                                //$sql=("UPDATE EvaluacionCampo2018 SET Primero =  '".$primero."', Segundo = ".$segundo." , Tercero = ".$tercero." , Cuarto = ".$cuarto." WHERE idMetasEstrategicas = ".$idMetasEstrategicas);
                                if($idE!=0)
                                {
                                    $sql=("SELECT updateEvaluacionCampo2018idEvaluacionCampo('".$primero."', ".$segundo.", ".$tercero." ,".$cuarto.", ".$idE.");");
                                    //$sql=("UPDATE EvaluacionCampo2018 SET Primero =  '".$primero."', Segundo = ".$segundo." , Tercero = ".$tercero." , Cuarto = ".$cuarto." WHERE idEvaluacionCampo = ".$idE);
                                    
                                }
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    echo '{ "success" : 1 }';
                                    $test = file_get_contents("http://unionnorte.org/apiradio.php?servicio=notifications&accion=mandaNotificacionST&passphrase=asdwer&message=".$message);
                                    exit();
                                }
                            }
                            else
                            {
                                $sql2=("SELECT insertEvaluacionCampo2018IdMetasEstrategicas(".$idMetasEstrategicas.", ".$primero.", ".$segundo.", ".$tercero.", ".$cuarto.")");
                                //$sql2=("INSERT INTO EvaluacionCampo2018 (idMetasEstrategicas, Primero, Segundo, Tercero, Cuarto) VALUES (".$idMetasEstrategicas.", ".$primero.", ".$segundo.", ".$tercero.", ".$cuarto.")");
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    echo '{ "success" : 1 }';
                                    $test = file_get_contents("http://unionnorte.org/apiradio.php?servicio=notifications&accion=mandaNotificacionST&passphrase=asdwer&message=".$message);
                                    exit(0);
                                }
                            }
                        }
                    break;
                    case 'guardarEvaluacion':    
                        checarSesionUsuarios();
                        $idMetasEstrategicasIglesias = $_POST['idMetasEstrategicasIglesias'];
                        $primero = $_POST['primero'];
                        $segundo = $_POST['segundo'];
                        $tercero = $_POST['tercero'];
                        $cuarto = $_POST['cuarto'];
                        $sql3=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                    FROM EvaluacionIglesias 
                                    WHERE idMetasEstrategicasIglesias = ".$idMetasEstrategicasIglesias);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $sql=("SELECT updateEvaluacionIglesiasidMetasEstrategicasIglesias SET ('".$primero."', ".$segundo.", ".$tercero." ,".$cuarto.", ".$idMetasEstrategicasIglesias.");");
                                //$sql=("UPDATE EvaluacionIglesias SET Primero =  '".$primero."', Segundo = ".$segundo." , Tercero = ".$tercero." , Cuarto = ".$cuarto." WHERE idMetasEstrategicasIglesias = ".$idMetasEstrategicasIglesias);
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    echo '{ "success" : 1 }';
                                    exit();
                                }
                            }
                            else
                            {
                                $sql2=("SELECT insertEvaluacionIglesiasIdMetasEstrategicasIglesias(".$idMetasEstrategicasIglesias.", ".$primero.", ".$segundo.", ".$tercero.", ".$cuarto.")");
                                //$sql2=("INSERT INTO EvaluacionIglesias (idMetasEstrategicasIglesias, Primero, Segundo, Tercero, Cuarto) VALUES (".$idMetasEstrategicasIglesias.", ".$primero.", ".$segundo.", ".$tercero.", ".$cuarto.")");
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                        }
                    break;
                    case 'verAccionesDeIglesia':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $actividadesSugerentes = array();

                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo = 0;
                        if(isset($_POST['tipo']))
                        {
                            $tipo = $_POST['tipo'];
                        }
                        $idGrupo = 0;
                        if(isset($_POST['idGrupo']))
                        {
                            $idGrupo = $_POST['idGrupo'];
                        } 
                        else
                        {
                            if(isset($_SESSION['idGrupo']))
                            {
                                $idGrupo = $_SESSION['idGrupo'];
                            }   
                        }

                        $sql3=("SELECT idActividadesSugerentesIglesia, archivo, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamento = ".$idDepartamento." order by idActividadesSugerentesIglesia asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $rowY = array();
                                $rowY["descripcion"] = ($row3["descripcion"]);
                                $rowY["ene"] = $row3["ene"];
                                $rowY["feb"] = $row3["feb"];
                                $rowY["mar"] = $row3["mar"];
                                $rowY["abr"] = $row3["abr"];
                                $rowY["may"] = $row3["may"];
                                $rowY["jun"] = $row3["jun"];
                                $rowY["jul"] = $row3["jul"];
                                $rowY["ago"] = $row3["ago"];
                                $rowY["sep"] = $row3["sep"];
                                $rowY["oct"] = $row3["oct"];
                                $rowY["nov"] = $row3["nov"];
                                $rowY["dic"] = $row3["dic"];
                                $rowY["archivo"] = $row3["archivo"];
                                $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                array_push($actividadesSugerentes, $rowY);
                            }
                        }
                        $sql2=("SELECT  accion, accionPasado, idDepartamentosAccionesIglesias, indicador, motor, objetivo, tipo FROM verAccionesDeIglesia_sql2 WHERE idDepartamento = ".$idDepartamento." AND anio = ".$anio." order by idDepartamentosAccionesIglesias asc");
                        //$sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo FROM DepartamentosAccionesIglesias d INNER JOIN Motores m on m.idMotor = d.motor INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos WHERE d.idDepartamento = ".$idDepartamento." AND d.anio = ".$anio." order by d.idDepartamentosAccionesIglesias asc");
                        if(intval($tipo)==3)//todos
                        {
                            $sql2=("SELECT accion, accionPasado, idDepartamentosAccionesIglesias, indicador, motor, objetivo, tipo, nombre FROM verAccionesDeIglesiaDepartamentosAccionesIglesias WHERE anio = ".$anio." AND tipo = 2 order by idDepartamentosAccionesIglesias asc");

                            //$sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, m.motor, o.objetivo, d.tipo, dd.nombre FROM DepartamentosAccionesIglesias d INNER JOIN Motores m on m.idMotor = d.motor INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = d.idObjetivosEspecificos INNER JOIN Departamentos dd on d.idDepartamento = dd.idDepartamento WHERE d.anio = ".$anio." AND d.tipo = 2 order by d.idDepartamentosAccionesIglesias asc");
                        }
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                $row2["accionPasado"] = ($row2["accionPasado"]);
                                $rowX = array();
                                if(intval($tipo)==3)//todos
                                {
                                    $row2["nombre"] = ($row2["nombre"]);
                                    $rowX["nombre"] = $row2["nombre"];
                                }
                                $rowX["accion"] = $row2["accion"];
                                $rowX["accionPasado"] = $row2["accionPasado"];
                                $rowX["tipo"] = $row2["tipo"];
                                $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                $rowX["indicador"] = $row2["indicador"];
                                $rowX["motor"] = ($row2["motor"]);
                                $rowX["procesoResultado"] = $row2["tipo"];
                                $rowX["objetivo"] = ($row2["objetivo"]);

                                $rowX["actividadesSugerentes"] = array();
                                $sql3=("SELECT idActividadesSugerentesIglesia, descripcion, titulo
                                    FROM ActividadesSugerentesIglesia 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." order by idActividadesSugerentesIglesia asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["idActividadesSugerentesIglesia"] = $row3["idActividadesSugerentesIglesia"];
                                        $rowY["titulo"] = ($row3["titulo"]);
                                        $rowY["descripcion"] = ($row3["descripcion"]);
                                        array_push($rowX["actividadesSugerentes"], $rowY);
                                    }
                                }
                               
                              
                                
                                
                                $rowX["metas"] = array();
                                $sql3=("SELECT anio, metaNumero, idMetasEstrategicasIglesias
                                    FROM MetasEstrategicasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                    AND idGrupo = ".$idGrupo."
                                    AND anio = ".$anio." order by idMetasEstrategicasIglesias asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["indicador"] = $row2["indicador"];
                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row3["idMetasEstrategicasIglesias"];
                                        $rowY["Primero"] = 0;
                                        $rowY["Segundo"] = 0;
                                        $rowY["Tercero"] = 0;
                                        $rowY["Cuarto"] = 0;
                                        $rowY["idEvaluacionIglesias"] = -1;
                                        $sql333=("SELECT idEvaluacionIglesias, Primero, Segundo, Tercero, Cuarto
                                                    FROM EvaluacionIglesias 
                                                    WHERE idMetasEstrategicasIglesias = ".$rowY["idMetasEstrategicasIglesias"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {
                                                $rowY["Primero"] = $row333["Primero"];
                                                $rowY["Segundo"] = $row333["Segundo"];
                                                $rowY["Tercero"] = $row333["Tercero"];
                                                $rowY["Cuarto"] = $row333["Cuarto"];
                                                $rowY["idEvaluacionIglesias"] = $row333["idEvaluacionIglesias"];
                                            }
                                        }
                                        array_push($rowX["metas"], $rowY);
                                    }
                                }
                                $rowX["actividades"] = array();
                                $sql4=("SELECT idActividadesIglesias, actividadOtra, idActividadesSugerentesIglesia, archivo,IFNULL(titulo,'') as titulo, IFNULL(descripcion,'') as descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic FROM verAccionesDeIglesiaActividadesIglesias WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." AND anio = ".$anio." AND idGrupo = ".$idGrupo." order by idActividadesIglesias asc");

                                //$sql4=("SELECT  a.idActividadesIglesias, a.actividadOtra, a.idActividadesSugerentesIglesia, asi.archivo,IFNULL(asi.titulo,'') as titulo, IFNULL(asi.descripcion,'') as descripcion, asi.ene, asi.feb, asi.mar, asi.abr, asi.may, asi.jun, asi.jul, asi.ago, asi.sep, asi.oct, asi.nov, asi.dic FROM ActividadesIglesias a LEFT JOIN ActividadesSugerentesIglesia asi on a.idActividadesSugerentesIglesia = asi.idActividadesSugerentesIglesia WHERE a.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." AND a.anio = ".$anio." AND a.idGrupo = ".$idGrupo." order by a.idActividadesIglesias asc");
                                //echo $sql4;

                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["actividadOtra"] = ($row4["actividadOtra"]);
                                        $rowY["idActividadesSugerentesIglesia"] = $row4["idActividadesSugerentesIglesia"];
                                        $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                        $rowY["descripcion"] = ($row4["descripcion"]);
                                        $rowY["titulo"] = ($row4["titulo"]);
                                        $rowY["archivo"] = $row4["archivo"];
                                        array_push($rowX["actividades"], $rowY);
                                    }
                                }
                                $rowX["fechas"] = array();
                                $sql4=("SELECT f.idFechasMetasIglesias, f.fecha, f.idActividadesIglesias, f.fechaFinal, f.idActividadesIglesias
                                            FROM FechasMetasIglesias f
                                            WHERE f.idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]."
                                            AND f.anio = ".$anio." AND f.idGrupo = ".$idGrupo."
                                             order by f.idFechasMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["fecha"] = ($row4["fecha"]);
                                        $rowY["fechaFinal"] = ($row4["fechaFinal"]);
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT actividadOtra, titulo FROM verAccionesDeIglesiaActividadesSugerentesIglesia WHERE idActividadesIglesias = ".$row4["idActividadesIglesias"].")");

                                            //$sql41=("SELECT a.actividadOtra, aa.titulo FROM ActividadesIglesias a INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idFechasMetasIglesias"] = $row4["idFechasMetasIglesias"];
                                        $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                        $rowY["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                        array_push($rowX["fechas"], $rowY);
                                    }
                                }
                                $rowX["lugares"] = array();
                                $sql4=("SELECT idLugaresMetasIglesias, lugar, idActividadesIglesias
                                            FROM LugaresMetasIglesias 
                                            WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                            AND anio = ".$anio." AND idGrupo = ".$idGrupo."
                                            order by idLugaresMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["lugar"] = ($row4["lugar"]);
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                            $sql41=("SELECT actividadOtra, titulo FROM verAccionesDeIglesiaActividadesSugerentesIglesia WHERE idActividadesIglesias = ".$row4["idActividadesIglesias"].")");

                                            //$sql41=("SELECT a.actividadOtra, aa.titulo FROM ActividadesIglesias a INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idLugaresMetasIglesias"] = $row4["idLugaresMetasIglesias"];
                                        $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                        array_push($rowX["lugares"], $rowY);
                                    }
                                }
                                $rowX["presupuesto"] = array();
                                $sql4=("SELECT idPresupuestoMetasIglesias, presupuesto, concepto, idActividadesIglesias
                                    FROM PresupuestoMetasIglesias 
                                    WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." 
                                    AND anio = ".$anio." AND idGrupo = ".$idGrupo."
                                    order by idPresupuestoMetasIglesias asc");
                                if($query4 = mysqli_query($recordset->conn,$sql4))
                                {
                                    while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["presupuesto"] = ($row4["presupuesto"]);
                                        $rowY["concepto"] =  ($row4["concepto"]);
                                        if(intval($row4["idActividadesIglesias"])==-2)
                                        {
                                            $rowY["actividad"] = "Sin actividad";    
                                        }
                                        else
                                        {
                                        	$sql41=("SELECT actividadOtra, titulo FROM verAccionesDeIglesiaActividadesSugerentesIglesia WHERE idActividadesIglesias = ".$row4["idActividadesIglesias"].")");

                                            //$sql41=("SELECT a.actividadOtra, aa.titulo FROM ActividadesIglesias a INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia WHERE a.idActividadesIglesias = ".$row4["idActividadesIglesias"]."");
                                            if($query41 = mysqli_query($recordset->conn,$sql41))
                                            {
                                                if($row41=mysqli_fetch_array($query41,MYSQLI_ASSOC))
                                                {
                                                    $row41["actividadOtra"] = ($row41["actividadOtra"]);
                                                    $row41["titulo"] = ($row41["titulo"]);
                                                    $rowY["actividad"] = $row41["actividadOtra"]." ".$row41["titulo"];
                                                }
                                            }
                                        }
                                        $rowY["idPresupuestoMetasIglesias"] = $row4["idPresupuestoMetasIglesias"];
                                        $rowY["idActividadesIglesias"] = $row4["idActividadesIglesias"];
                                        array_push($rowX["presupuesto"], $rowY);
                                    }
                                }
                                array_push($acciones, $rowX);
                            }
                            
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "actividadesSugerentes" : '.json_encode($actividadesSugerentes).'}';
                            exit(0);
                        }
                    break;
                    case 'verAccionesDeCampoEvaluacionCampoDetalle':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $idMetasEstrategicas = $_POST['idMetasEstrategicas'];
                        $anio = $_POST['anio'];
                        $tipo=2;//campo
                        $idCampo = $_POST["idCampo"];
                        $rowX = array();
                        $rowX["idDepartamentosAcciones"] = $idDepartamentosAcciones;
                        $rowX["metas"] = array();
                        $sql44=("SELECT m.idMetas2018, m.tipoMeta, m.metaString
                            FROM Metas2018 m
                            WHERE m.idDepartamentosAcciones = ".$idDepartamentosAcciones." order by m.idMetas2018 asc");
                        if($query44 = mysqli_query($recordset->conn,$sql44))
                        {
                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                            {
                              
                                $sql3=("SELECT IFNULL(metaNumero,-1) as metaNumero, IFNULL(idMetasEstrategicas,0) as idMetasEstrategicas, idCampo, nombre FROM verAccionesDeCampoEvaluacionCampoDetalleMetEstrat2018 WHERE anio = ".$anio." AND idCampo in (".$idCampo.") AND idMetas2018 = ".$row44["idMetas2018"].")");

                                //$sql3=("SELECT IFNULL(me.metaNumero,-1) as metaNumero, IFNULL(me.idMetasEstrategicas,0) as idMetasEstrategicas, me.idCampo, c.nombre FROM MetasEstrategicas2018  me INNER JOIN Campos c on c.idCampo = me.idCampo WHERE me.anio = ".$anio." AND me.idCampo in (".$idCampo.") AND me.idMetas2018 = ".$row44["idMetas2018"]);
                                
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowY = array();
                                        $rowY["metaNumero"] = 0;
                                        $rowY["Primero"] = 0;
                                        $rowY["Segundo"] = 0;
                                        $rowY["Tercero"] = 0;
                                        $rowY["Cuarto"] = 0;
                                        $rowY["idCampo"] = $row3["idCampo"];
                                        $rowY["campo"] = ($row3["nombre"]);
                                        $rowY["indicador"] = $row44["tipoMeta"];
                                        $rowY["metaNumero"] += $row3["metaNumero"];
                                        $rowY["tipoMeta"] = $row44["tipoMeta"];
                                        $rowY["meta"] = ($row44["metaString"]);
                                        $rowY["idMetasEstrategicas"] = $row3["idMetasEstrategicas"];
                                        $rowY["idEvaluacionCampo"] = -1;
                                        $sql333=("SELECT idEvaluacionCampo, Primero, Segundo, Tercero, Cuarto
                                                    FROM EvaluacionCampo2018 
                                                    WHERE idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]);
                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                        {
                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                            {
                                                $rowY["Primero"] += $row333["Primero"];
                                                $rowY["Segundo"] += $row333["Segundo"];
                                                $rowY["Tercero"] += $row333["Tercero"];
                                                $rowY["Cuarto"] += $row333["Cuarto"];
                                                $rowY["idEvaluacionCampo"] = $row333["idEvaluacionCampo"];
                                            }
                                        }
                                        array_push($rowX["metas"], $rowY);        
                                    }
                                }
                            }
                        }
                        array_push($acciones, $rowX);
                        echo '{ "success" : 1, "acciones" : '.json_encode($acciones).' }';
                        exit(0);
                    break;
                    case 'verAccionesDeCampoEvaluacionCampo':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo=2;//campo
                        $idCampo = $_SESSION["idCampo"];
                        $procesoResultado = 0;
                        if(isset($_POST["proceso"]))//UMN
                        {
                            $procesoResultado=$_POST["proceso"];
                        }
                       
                         $sql2=("SELECT DISTINCT idObjetivosEspecificos, objetivo , motor FROM verAccionesDeCampoEvaluacionCampoObjetivosEspecificos WHERE motor in (1,2,3,4,5) AND idDepartamento = ".$idDepartamento." AND tipo = ".$tipo." AND anio = ".$anio." order by motor asc, idObjetivosEspecificos asc");

                         //$sql2=("SELECT DISTINCT o.idObjetivosEspecificos, o.objetivo , o.motor FROM ObjetivosEspecificos o INNER JOIN AccionesEstrategicas2018 a on a.idObjetivosEspecificos = o.idObjetivosEspecificos INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica WHERE o.motor in (1,2,3,4,5) AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." AND d.anio = ".$anio." order by o.motor asc, o.idObjetivosEspecificos asc");

                                                       
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $sql33=("SELECT accion, accionPasado, idAccionEstrategica, idDepartamentosAcciones, indicador, procesoResultado, idDepartamento FROM verAccionesDeCampoEvaluacionCampoAccionesEstrategicas2018 WHERE idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND idDepartamento = ".$idDepartamento." AND tipo = ".$tipo." AND anio = ".$anio."  order by idAccionEstrategica asc");

                                //$sql33=("SELECT a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado, d.idDepartamento FROM AccionesEstrategicas2018 a INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." AND d.anio = ".$anio."  order by a.idAccionEstrategica asc");
                                if($procesoResultado!=0)
                                {
                                    $sql33=("SELECT a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado, d.idDepartamento
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND d.idDepartamento = ".$idDepartamento." AND a.procesoResultado = ".$procesoResultado." AND a.tipo = ".$tipo." AND d.anio = ".$anio." order by a.idAccionEstrategica asc");
                                }
                                if($procesoResultado==3)//todos
                                {
                                       $sql33=("SELECT a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado, d.idDepartamento
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND a.procesoResultado = 2 AND a.tipo = ".$tipo." AND d.anio = ".$anio." order by a.idAccionEstrategica asc");
                                }
                                if($query33 = mysqli_query($recordset->conn,$sql33))
                                {
                                    while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                                    {
                                        $row33["accion"] = ($row33["accion"]);
                                        $row33["accionPasado"] = ($row33["accionPasado"]);
                                        $rowX = array();
                                        $rowX["procesoResultado"] = $row33["procesoResultado"];
                                        $rowX["accion"] = $row33["accion"];
                                        $rowX["accionPasado"] = $row33["accionPasado"];
                                        $rowX["idDepartamentosAcciones"] = $row33["idDepartamentosAcciones"];
                                        $rowX["idDepartamento"] = $row33["idDepartamento"];
                                        $rowX["indicador"] = $row33["indicador"];
                                        $rowX["motor"] = $row2["motor"];
                                        $rowX["metas"] = array();
                                      
                                          $sql44=("SELECT m.idMetas2018, m.tipoMeta, m.metaString
                                            FROM Metas2018 m
                                            WHERE m.idDepartamentosAcciones = ".$row33["idDepartamentosAcciones"]."  order by m.idMetas2018 asc");

                                        if($query44 = mysqli_query($recordset->conn,$sql44))
                                        {
                                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                                            {
                                                $sql3=("SELECT IFNULL(me.metaNumero,-1) as metaNumero, IFNULL(me.idMetasEstrategicas,0) as idMetasEstrategicas
                                                    FROM MetasEstrategicas2018  me
                                                    WHERE me.anio = ".$anio." AND me.idCampo != 11 AND me.idMetas2018 = ".$row44["idMetas2018"]);
                                                $rowY = array();
                                                $rowY["metaNumero"] = 0;
                                                $rowY["Primero"] = 0;
                                                $rowY["Segundo"] = 0;
                                                $rowY["Tercero"] = 0;
                                                $rowY["Cuarto"] = 0;
                                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                                {
                                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                                    {
                                                        $rowY["indicador"] = $row33["indicador"];
                                                        $rowY["metaNumero"] += $row3["metaNumero"];
                                                        $rowY["tipoMeta"] = $row44["tipoMeta"];
                                                        $rowY["meta"] = ($row44["metaString"]);
                                                        $rowY["idMetasEstrategicas"] = $row3["idMetasEstrategicas"];
                                                        $rowY["idEvaluacionCampo"] = -1;
                                                        $sql333=("SELECT idEvaluacionCampo, Primero, Segundo, Tercero, Cuarto
                                                                    FROM EvaluacionCampo2018 
                                                                    WHERE idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]);
                                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                                        {
                                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                                            {
                                                                $rowY["Primero"] += $row333["Primero"];
                                                                $rowY["Segundo"] += $row333["Segundo"];
                                                                $rowY["Tercero"] += $row333["Tercero"];
                                                                $rowY["Cuarto"] += $row333["Cuarto"];
                                                                $rowY["idEvaluacionCampo"] = $row333["idEvaluacionCampo"];
                                                            }
                                                        }
                                                    }
                                                }
                                                array_push($rowX["metas"], $rowY);
                                            }
                                        }
                                        array_push($acciones, $rowX);
                                    }
                                }                                
                            }
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).', "idCampo" : '.$idCampo.' }';
                            exit(0);
                        }
                    break;
                    case 'verAccionesDeCampoEvaluacion':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $anio = $_POST['anio'];
                        $tipo=2;//campo
                        $idCampo = $_SESSION["idCampo"];
                        if($_SESSION["idCampo"]==11)//UMN
                        {
                            $tipo=3;//umn
                            $idCampo = '1,2,3,4,5,6,7,8,9,10,12';
                            $idCampo = $_SESSION["idCampo"];
                        }
                        $procesoResultado = 0;
                        if(isset($_POST["proceso"]))//UMN
                        {
                            $procesoResultado=$_POST["proceso"];
                        }
                        
                        /*$sql2=("SELECT m.motor, a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador
                            FROM AccionesEstrategicas2018 a
                            INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                            INNER JOIN ObjetivosEspecificos o on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                            INNER JOIN Motores m on m.idMotor = o.motor
                            WHERE  d.idDepartamento = ".$idDepartamento." AND d.anio = ".$anio." AND a.tipo = ".$tipo." AND a.esPrivada in (0,".$_SESSION["idCampo"].") order by a.idAccionEstrategica asc");*/
                        //verObjetivos2018'
                         $sql2=("SELECT DISTINCT o.idObjetivosEspecificos, o.objetivo , o.motor
                            FROM ObjetivosEspecificos o 
                            INNER JOIN AccionesEstrategicas2018 a on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                            INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                            WHERE o.motor in (1,2,3,4,5) AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." AND d.anio = ".$anio." order by o.motor asc, o.idObjetivosEspecificos asc");
/*

                           
                   */
                                                       
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $sql33=("SELECT a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." AND d.anio = ".$anio." AND a.esPrivada in (0,".$idCampo.") order by a.idAccionEstrategica asc");
                                if($procesoResultado!=0)
                                {
                                    $sql33=("SELECT a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado, dd.nombre
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    INNER JOIN Departamentos dd on dd.idDepartamento = d.idDepartamento
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND d.idDepartamento = ".$idDepartamento." AND a.procesoResultado = ".$procesoResultado." AND a.tipo = ".$tipo." AND d.anio = ".$anio." AND a.esPrivada in (0,".$idCampo.") order by a.idAccionEstrategica asc");
                                }
                                if($procesoResultado==3)//todos
                                {
                                       $sql33=("SELECT a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado, dd.nombre
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    INNER JOIN Departamentos dd on dd.idDepartamento = d.idDepartamento
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND a.procesoResultado = 2 AND a.tipo = ".$tipo." AND d.anio = ".$anio." AND a.esPrivada in (0,".$idCampo.") order by a.idAccionEstrategica asc");
                                }
                                if($query33 = mysqli_query($recordset->conn,$sql33))
                                {
                                    while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                                    {
                                        $row33["accion"] = ($row33["accion"]);
                                        $row33["accionPasado"] = ($row33["accionPasado"]);
                                        $rowX = array();
                                        if(isset($row33["nombre"]))
                                        {
                                            $rowX["nombre"] = ($row33["nombre"]);    
                                        }
                                        
                                        $rowX["procesoResultado"] = $row33["procesoResultado"];
                                        $rowX["accion"] = $row33["accion"];
                                        $rowX["accionPasado"] = $row33["accionPasado"];
                                        $rowX["idDepartamentosAcciones"] = $row33["idDepartamentosAcciones"];
                                        $rowX["indicador"] = $row33["indicador"];
                                        $rowX["motor"] = $row2["motor"];
                                        $rowX["metas"] = array();
                                        /*
                                        
                                               $sql3=("SELECT anio, meta, idMetasEstrategicas, indicador, metaNumero
                                            FROM MetasEstrategicas2018 
                                            WHERE idDepartamentosAcciones = ".$row33["idDepartamentosAcciones"]."
                                            AND idCampo = ".$_SESSION["idCampo"]."
                                            AND anio = ".$anio." order by idMetasEstrategicas asc ");
                                     
                                       
                                        */
                                          $sql44=("SELECT m.idMetas2018, m.tipoMeta, m.metaString
                                            FROM Metas2018 m
                                            WHERE m.idDepartamentosAcciones = ".$row33["idDepartamentosAcciones"]."  order by m.idMetas2018 asc");

                                        if($query44 = mysqli_query($recordset->conn,$sql44))
                                        {
                                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                                            {
                                                $sql3=("SELECT IFNULL(me.metaNumero,-1) as metaNumero, IFNULL(me.idMetasEstrategicas,0) as idMetasEstrategicas
                                                    FROM MetasEstrategicas2018  me
                                                    WHERE me.anio = ".$anio." AND me.idCampo in (".$idCampo.") AND me.idMetas2018 = ".$row44["idMetas2018"]);

                                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                                {
                                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                                    {
                                                        $rowY = array();
                                                        $rowY["indicador"] = $row33["indicador"];
                                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                                        $rowY["tipoMeta"] = $row44["tipoMeta"];
                                                        $rowY["meta"] = ($row44["metaString"]);
                                                        $rowY["idMetasEstrategicas"] = $row3["idMetasEstrategicas"];
                                                        $rowY["Primero"] = 0;
                                                        $rowY["Segundo"] = 0;
                                                        $rowY["Tercero"] = 0;
                                                        $rowY["Cuarto"] = 0;
                                                        $rowY["idEvaluacionCampo"] = -1;
                                                        $sql333=("SELECT idEvaluacionCampo, Primero, Segundo, Tercero, Cuarto
                                                                    FROM EvaluacionCampo2018 
                                                                    WHERE idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]);
                                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                                        {
                                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                                            {
                                                                $rowY["Primero"] += $row333["Primero"];
                                                                $rowY["Segundo"] += $row333["Segundo"];
                                                                $rowY["Tercero"] += $row333["Tercero"];
                                                                $rowY["Cuarto"] += $row333["Cuarto"];
                                                                $rowY["idEvaluacionCampo"] = $row333["idEvaluacionCampo"];
                                                            }
                                                        }
                                                        $rowY["actividades"] = array();
                                                        $sql4=("SELECT  a.idActividadesMetas, a.actividad
                                                                    FROM ActividadesMetas a
                                                                    WHERE a.idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]." AND a.anio = ".$anio."
                                                                     order by a.idActividadesMetas asc");
                                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                                        {
                                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                            {
                                                                $rowZ = array();
                                                                $rowZ["actividad"] = ($row4["actividad"]);
                                                                $rowZ["idActividadesMetas"] = $row4["idActividadesMetas"];
                                                                array_push($rowY["actividades"], $rowZ);
                                                            }
                                                        }
                                                        $rowY["fechas"] = array();
                                                        $sql4=("SELECT  a.idFechasMetas, a.fechaInicial, a.fechaFinal
                                                                    FROM FechasMetas a 
                                                                    WHERE a.idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]." AND a.anio = ".$anio."
                                                                     order by a.idFechasMetas asc");
                                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                                        {
                                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                            {
                                                                $rowZ = array();
                                                                $rowZ["fechaInicial"] = ($row4["fechaInicial"]);
                                                                $rowZ["fechaFinal"] = ($row4["fechaFinal"]);
                                                                $rowZ["idFechasMetas"] = $row4["idFechasMetas"];
                                                                array_push($rowY["fechas"], $rowZ);
                                                            }
                                                        }
                                                        $rowY["presupuesto"] = array();
                                                        $sql4=("SELECT  a.idPresupuestoMetas, a.presupuesto, a.concepto
                                                                    FROM PresupuestoMetas a
                                                                    WHERE a.idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]." AND a.anio = ".$anio."
                                                                     order by a.idPresupuestoMetas asc");
                                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                                        {
                                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                            {
                                                                $rowZ = array();
                                                                $rowZ["presupuesto"] = ($row4["presupuesto"]);
                                                                $rowZ["concepto"] = ($row4["concepto"]);
                                                                $rowZ["idPresupuestoMetas"] = $row4["idPresupuestoMetas"];
                                                                array_push($rowY["presupuesto"], $rowZ);
                                                            }
                                                        }
                                                        array_push($rowX["metas"], $rowY);
                                                    }
                                                }
                                            }
                                        }
                                        array_push($acciones, $rowX);
                                    }
                                }                                
                            }
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).' }';
                            exit(0);
                        }
                    break;
                    case 'verAccionesDeCampoEvaluacionConIglesia2019':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $anio = $_POST['anio'];
                        $tipo=$_POST['tipo'];
                        $idCampo = $_SESSION["idCampo"];
                        
                        $idDepartamento=$_POST["idDepartamento"];
                        if($_SESSION["idCampo"]==11)//UMN
                        {
                            $tipo=3;//umn
                           // $idCampo = '1,2,3,4,5,6,7,8,9,10,12';
                          //  $idCampo = $_SESSION["idCampo"];
                        }
                        $procesoResultado = 2;
                        if(isset($_POST["tipoGlobal"])) {
                             $tipo=$_POST["tipoGlobal"];
                        }
                        
                        if(isset($_POST["proceso"]))//UMN
                        {
                            $procesoResultado=$_POST["proceso"];
                            if($procesoResultado>=2){
                                $procesoResultado=2;
                            }
                        }
                        
                     
                         $sql2=("SELECT DISTINCT o.idObjetivosEspecificos, o.objetivo , o.motor
                            FROM ObjetivosEspecificos o 
                            INNER JOIN AccionesEstrategicas2018 a on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                            INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                            WHERE o.motor in (1,2,3,4,5) AND a.tipo = ".$tipo." AND d.anio = ".$anio." order by o.motor asc, o.idObjetivosEspecificos asc");

                                                       
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $sql33=("SELECT a.accion, a.accionPasado, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado, dd.nombre
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    INNER JOIN Departamentos dd on dd.idDepartamento = d.idDepartamento
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]." AND a.procesoResultado = ".$procesoResultado." AND a.tipo = ".$tipo." AND d.anio = ".$anio." AND a.esPrivada in (0,".$idCampo.")
                                    AND d.idDepartamento = ".$idDepartamento."
                                     order by a.idAccionEstrategica asc");//2 resultado??
                                
                                if($query33 = mysqli_query($recordset->conn,$sql33))
                                {
                                    while($row33=mysqli_fetch_array($query33,MYSQLI_ASSOC))
                                    {
                                        $row33["accion"] = ($row33["accion"]);
                                        $row33["accionPasado"] = ($row33["accionPasado"]);
                                        $rowX = array();
                                        if(isset($row33["nombre"]))
                                        {
                                            $rowX["nombre"] = ($row33["nombre"]);    
                                        }
                                        
                                        $rowX["procesoResultado"] = $row33["procesoResultado"];
                                        $rowX["accion"] = $row33["accion"];
                                        $rowX["accionPasado"] = $row33["accionPasado"];
                                        $rowX["idDepartamentosAcciones"] = $row33["idDepartamentosAcciones"];
                                        $rowX["indicador"] = $row33["indicador"];
                                        $rowX["motor"] = $row2["motor"];
                                        $rowX["metas"] = array();
                                       
                                          $sql44=("SELECT m.idMetas2018, m.tipoMeta, m.metaString
                                            FROM Metas2018 m
                                            WHERE m.idDepartamentosAcciones = ".$row33["idDepartamentosAcciones"]."  order by m.idMetas2018 asc");

                                        if($query44 = mysqli_query($recordset->conn,$sql44))
                                        {
                                            while($row44=mysqli_fetch_array($query44,MYSQLI_ASSOC))
                                            {
                                                $sql3=("SELECT IFNULL(me.metaNumero,-1) as metaNumero, IFNULL(me.idMetasEstrategicas,0) as idMetasEstrategicas, me.indicador
                                                    FROM MetasEstrategicas2018  me
                                                    WHERE me.anio = ".$anio." AND me.idCampo in (".$idCampo.") AND me.idMetas2018 = ".$row44["idMetas2018"]);

                                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                                {
                                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                                    {
                                                        $rowY = array();
                                                        $rowY["indicador"] = $row3["indicador"];
                                                        $rowY["metaNumero"] = $row3["metaNumero"];
                                                        $rowY["tipoMeta"] = $row44["tipoMeta"];
                                                        $rowY["meta"] = ($row44["metaString"]);
                                                        $rowY["idMetasEstrategicas"] = $row3["idMetasEstrategicas"];
                                                        $rowY["Primero"] = 0;
                                                        $rowY["Segundo"] = 0;
                                                        $rowY["Tercero"] = 0;
                                                        $rowY["Cuarto"] = 0;
                                                        $rowY["idEvaluacionCampo"] = -1;
                                                        $sql333=("SELECT idEvaluacionCampo, Primero, Segundo, Tercero, Cuarto
                                                                    FROM EvaluacionCampo2018 
                                                                    WHERE idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]);
                                                        if($query333 = mysqli_query($recordset->conn,$sql333))
                                                        {
                                                            if($row333=mysqli_fetch_array($query333,MYSQLI_ASSOC))
                                                            {
                                                                if(intval($row333["Primero"])<=0){$row333["Primero"]=0;}
                                                                if(intval($row333["Segundo"])<=0){$row333["Segundo"]=0;}
                                                                if(intval($row333["Tercero"])<=0){$row333["Tercero"]=0;}
                                                                if(intval($row333["Cuarto"])<=0){$row333["Cuarto"]=0;}
                                                                $rowY["Primero"] += $row333["Primero"];
                                                                $rowY["Segundo"] += $row333["Segundo"];
                                                                $rowY["Tercero"] += $row333["Tercero"];
                                                                $rowY["Cuarto"] += $row333["Cuarto"];
                                                                $rowY["idEvaluacionCampo"] = $row333["idEvaluacionCampo"];
                                                            }
                                                        }
                                                        $rowY["actividades"] = array();
                                                        $sql4=("SELECT  a.idActividadesMetas, a.actividad
                                                                    FROM ActividadesMetas a
                                                                    WHERE a.idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]." AND a.anio = ".$anio."
                                                                     order by a.idActividadesMetas asc");
                                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                                        {
                                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                            {
                                                                $rowZ = array();
                                                                $rowZ["actividad"] = ($row4["actividad"]);
                                                                $rowZ["idActividadesMetas"] = $row4["idActividadesMetas"];
                                                                array_push($rowY["actividades"], $rowZ);
                                                            }
                                                        }
                                                        $rowY["fechas"] = array();
                                                        $sql4=("SELECT  a.idFechasMetas, a.fechaInicial, a.fechaFinal
                                                                    FROM FechasMetas a 
                                                                    WHERE a.idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]." AND a.anio = ".$anio."
                                                                     order by a.idFechasMetas asc");
                                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                                        {
                                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                            {
                                                                $rowZ = array();
                                                                $rowZ["fechaInicial"] = ($row4["fechaInicial"]);
                                                                $rowZ["fechaFinal"] = ($row4["fechaFinal"]);
                                                                $rowZ["idFechasMetas"] = $row4["idFechasMetas"];
                                                                array_push($rowY["fechas"], $rowZ);
                                                            }
                                                        }
                                                        $rowY["presupuesto"] = array();
                                                        $sql4=("SELECT  a.idPresupuestoMetas, a.presupuesto, a.concepto
                                                                    FROM PresupuestoMetas a
                                                                    WHERE a.idMetasEstrategicas = ".$rowY["idMetasEstrategicas"]." AND a.anio = ".$anio."
                                                                     order by a.idPresupuestoMetas asc");
                                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                                        {
                                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                            {
                                                                $rowZ = array();
                                                                $rowZ["presupuesto"] = ($row4["presupuesto"]);
                                                                $rowZ["concepto"] = ($row4["concepto"]);
                                                                $rowZ["idPresupuestoMetas"] = $row4["idPresupuestoMetas"];
                                                                array_push($rowY["presupuesto"], $rowZ);
                                                            }
                                                        }
                                                        array_push($rowX["metas"], $rowY);
                                                    }
                                                }
                                            }
                                        }
                                        $rowX["tipo"] = "campo";
                                        $rowX["idCampo"] = $idCampo;
                                        array_push($acciones, $rowX);
                                    }
                                }                                
                            }
                            ///////////////////////////////////////
                            $sql4=("SELECT g.idGrupo
                                FROM Grupos g
                                INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                                WHERE d.idCampo in (".$idCampo.") order by g.idGrupo asc");
                            $idGrupoDeCampos = '';
                            $first = true;
                            if($query4 = mysqli_query($recordset->conn,$sql4))
                            {
                                while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                {
                                    if($first)
                                    {
                                        $first = false;
                                        $idGrupoDeCampos = $row4["idGrupo"];
                                    }
                                    else
                                    {
                                        $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                    }
                                }
                            }
                            $cuantos=0;
                            $sql2=("SELECT d.accion, d.accionPasado, d.idDepartamentosAccionesIglesias, d.indicador, d.tipo, mm.anio, mm.metaNumero, mm.idMetasEstrategicasIglesias, IFNULL(e.Primero,0) as Primero, IFNULL(e.Segundo,0) as Segundo, IFNULL(e.Tercero,0) as Tercero, IFNULL(e.Cuarto,0) as Cuarto, IFNULL(e.idEvaluacionIglesias,0) as idEvaluacionIglesias, d.idDepartamento
                            FROM DepartamentosAccionesIglesias d
                            INNER JOIN MetasEstrategicasIglesias mm on mm.idDepartamentosAccionesIglesias = d.idDepartamentosAccionesIglesias
                            INNER JOIN EvaluacionIglesias e on e.idMetasEstrategicasIglesias = mm.idMetasEstrategicasIglesias
                            WHERE mm.idGrupo in (".$idGrupoDeCampos.") AND d.anio = ".$anio." AND mm.anio = ".$anio." AND d.tipo = 2  order by d.idDepartamentosAccionesIglesias asc, mm.idMetasEstrategicasIglesias asc");
                            $primeraVez = true;
                            $idDepartamentosAccionesIglesiasActual = 0;
                            $idDepartamentosAccionesIglesiasAnterior = 0;
                            $rowX = array();
                            $tipo = 3;
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                {
                                    if($primeraVez)
                                    {
                                        $primeraVez = false;
                                        $row2["accion"] = ($row2["accion"]);
                                        $row2["accionPasado"] = ($row2["accionPasado"]);
                                        $rowX = array();
                                        $rowX["accion"] = $row2["accion"];
                                        $rowX["accionPasado"] = $row2["accionPasado"];
                                        $rowX["tipo"] = $row2["tipo"];
                                        $rowX["idDepartamento"] = $row2["idDepartamento"];
                                        $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                        $idDepartamentosAccionesIglesiasActual = $row2["idDepartamentosAccionesIglesias"];
                                        $idDepartamentosAccionesIglesiasAnterior = $idDepartamentosAccionesIglesiasActual;
                                        $rowX["indicador"] = $row2["indicador"];
                                        $rowX["procesoResultado"] = $row2["tipo"];
                                        $rowX["metas"] = array();
                                        $rowX["sumaDeMetas"] = 0;
                                        $rowX["sumaDePrimeros"] = 0;
                                        $rowX["sumaDeSegundos"] = 0;
                                        $rowX["sumaDeTerceros"] = 0;
                                        $rowX["sumaDeCuartos"] = 0;
                                        $rowX["promedioDeMetas"] = 0;
                                        $cuantos = 0;
                                    }
                                    $idDepartamentosAccionesIglesiasActual = $row2["idDepartamentosAccionesIglesias"];
                                    if($idDepartamentosAccionesIglesiasActual == $idDepartamentosAccionesIglesiasAnterior)
                                    {
                                        $cuantos = $cuantos +1;
                                        $rowY = array();
                                        $rowY["indicador"] = $row2["indicador"];
                                        $rowY["metaNumero"] = $row2["metaNumero"];
                                        $rowX["idDepartamento"] = $row2["idDepartamento"];
                                        $rowX["sumaDeMetas"] = $rowX["sumaDeMetas"] + $row2["metaNumero"];
                                        $rowY["idMetasEstrategicasIglesias"] = $row2["idMetasEstrategicasIglesias"];
                                        $rowY["idEvaluacionIglesias"] = -1;
                                        $rowX["sumaDePrimeros"] = $rowX["sumaDePrimeros"] + $row2["Primero"];
                                        $rowX["sumaDeSegundos"] = $rowX["sumaDeSegundos"] + $row2["Segundo"];
                                        $rowX["sumaDeTerceros"] = $rowX["sumaDeTerceros"] + $row2["Tercero"];
                                        $rowX["sumaDeCuartos"] = $rowX["sumaDeCuartos"] + $row2["Cuarto"];
                                        $rowY["Primero"] = $row2["Primero"];
                                        $rowY["Segundo"] = $row2["Segundo"];
                                        $rowY["Tercero"] = $row2["Tercero"];
                                        $rowY["Cuarto"] = $row2["Cuarto"];
                                        $rowY["idEvaluacionIglesias"] = $row2["idEvaluacionIglesias"];
                                        array_push($rowX["metas"], $rowY);
                                    }
                                    else
                                    {
                                        if($cuantos==0)
                                        {
                                            $cuantos = 1;
                                        }
                                        $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);
                                        array_push($acciones, $rowX);
                                        $row2["accion"] = ($row2["accion"]);
                                        $row2["accionPasado"] = ($row2["accionPasado"]);
                                        $rowX = array();
                                        $rowX["accion"] = $row2["accion"];
                                        $rowX["accionPasado"] = $row2["accionPasado"];
                                        $rowX["tipo"] = $row2["tipo"];
                                        $rowX["idDepartamento"] = $row2["idDepartamento"];
                                        $rowX["idDepartamentosAccionesIglesias"] = $row2["idDepartamentosAccionesIglesias"];
                                        $idDepartamentosAccionesIglesiasActual = $row2["idDepartamentosAccionesIglesias"];
                                        $idDepartamentosAccionesIglesiasAnterior = $idDepartamentosAccionesIglesiasActual;
                                        $rowX["indicador"] = $row2["indicador"];
                                        $rowX["procesoResultado"] = $row2["tipo"];
                                        $rowX["metas"] = array();
                                        $rowX["sumaDeMetas"] = 0;
                                        $rowX["sumaDePrimeros"] = 0;
                                        $rowX["sumaDeSegundos"] = 0;
                                        $rowX["sumaDeTerceros"] = 0;
                                        $rowX["sumaDeCuartos"] = 0;
                                        $rowX["promedioDeMetas"] = 0;
                                        $cuantos = 0;
                                    }
                                    $idDepartamentosAccionesIglesiasAnterior = $idDepartamentosAccionesIglesiasActual;
                                }//while
                                if($cuantos==0)
                                {
                                    $cuantos = 1;
                                }
                                if(isset($rowX["sumaDeMetas"]))
                                {
                                    $rowX["promedioDeMetas"] = round($rowX["sumaDeMetas"]/$cuantos,2);    
                                }
                                else
                                {
                                    $rowX["promedioDeMetas"] = 0;
                                }
                                
                                $rowX["idGrupoDeCampos"] = $idGrupoDeCampos;
                                array_push($acciones, $rowX);
                            }//if
                            //////////////////////////////////////
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).' }';
                            exit(0);
                        }
                    break;
                    case 'verAcciones':    
                        checarSesionUsuarios();
                        $acciones = array();
                        $idUsuarioCampo = $_SESSION['idUsuarioCampo'];
                        $idObjetivosEspecificos = $_POST['idObjetivosEspecificos'];
                        $idDepartamento = $_POST['idDepartamento'];
                        //ya con lo de a.tipo distinguimos si es union o campo o iglesia!
                        $sql2=("SELECT a.accion, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador
                            FROM AccionesEstrategicas a
                            INNER JOIN DepartamentosAcciones d on d.idAccionEstrategica = a.idAccionEstrategica
                            WHERE a.idObjetivosEspecificos = ".$idObjetivosEspecificos."  AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$_POST["tipo"]." AND a.esPrivada in (0,".$_SESSION["idCampo"].") order by a.idAccionEstrategica asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                $rowX = array();
                                $rowX["accion"] = $row2["accion"];
                                $rowX["idAccionEstrategica"] = $row2["idAccionEstrategica"];
                                $rowX["indicador"] = $row2["indicador"];
                                $rowX["idDepartamentosAcciones"] = $row2["idDepartamentosAcciones"];
                                if(intval($_POST["tipo"])==2) //cargar las acciones del campo
                                {
                                    $rowX["directrices"] = array();
                                    $sql3=("SELECT idDirectricesAcciones, fechaInicial, fechaFinal, archivo, descripcion
                                        FROM DirectricesAcciones 
                                        WHERE idDepartamentosAcciones = ".$row2["idDepartamentosAcciones"]." order by idDirectricesAcciones asc");
                                    if($query3 = mysqli_query($recordset->conn,$sql3))
                                    {
                                        while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                        {
                                            $rowY = array();
                                            $rowY["descripcion"] = ($row3["descripcion"]);
                                            $rowY["fechaInicial"] = $row3["fechaInicial"];
                                            $rowY["fechaFinal"] = $row3["fechaFinal"];
                                            $rowY["archivo"] = $row3["archivo"];
                                            $rowY["idDirectricesAcciones"] = $row3["idDirectricesAcciones"];
                                            array_push($rowX["directrices"], $rowY);
                                        }
                                    }
                                    
                                }
                                $rowX["metas"] = array();
                                                   
                                if(intval($_POST["tipo"])==3 || intval($_POST["tipo"])==2) //cargar las acciones de la union y de campo
                                {
                                   /* $sql3=("SELECT m.meta, m.indicador, m.metaNumero, m.idMetasEstrategicas
                                        FROM MetasEstrategicas m
                                        WHERE m.idDepartamentosAcciones = ".$row2["idDepartamentosAcciones"]." AND m.idUsuarioCampo = ".$idUsuarioCampo." order by m.idMetasEstrategicas asc");*/
                                    $sql3=("SELECT m.meta, m.indicador, m.metaNumero, m.idMetasEstrategicas
                                        FROM MetasEstrategicas m
                                        INNER JOIN DepartamentosAcciones a on a.idDepartamentosAcciones = m.idDepartamentosAcciones
                                        WHERE m.idDepartamentosAcciones = ".$row2["idDepartamentosAcciones"]." AND a.idDepartamento = ".$idDepartamento." AND m.idCampo = ".$_SESSION["idCampo"]." order by m.idMetasEstrategicas asc");
                                    if($query3 = mysqli_query($recordset->conn,$sql3))
                                    {
                                        while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                        {
                                            $rowY = array();
                                            $rowY["fechas"] = array();
                                            $rowY["actividades"] = array();
                                            $rowY["verificacion"] = array();
                                            
                                            $rowY["meta"] = ($row3["meta"]);
                                            $rowY["indicador"] = $row3["indicador"];
                                            $rowY["metaNumero"] = $row3["metaNumero"];
                                            $rowY["idMetasEstrategicas"] = $row3["idMetasEstrategicas"];
                                            $rowY["presupuesto"] = array();
                                            $sql4=("SELECT p.idPresupuestoMetas, p.presupuesto, p.concepto
                                                FROM PresupuestoMetas p
                                                WHERE p.idMetasEstrategicas = ".$row3["idMetasEstrategicas"]." order by p.idPresupuestoMetas asc");
                                            if($query4 = mysqli_query($recordset->conn,$sql4))
                                            {
                                                while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                {
                                                    $rowZ = array();
                                                    $rowZ["idPresupuestoMetas"] = $row4["idPresupuestoMetas"];
                                                    $rowZ["presupuesto"] = ($row4["presupuesto"]);
                                                    $rowZ["concepto"] = ($row4["concepto"]);
                                                    array_push($rowY["presupuesto"], $rowZ);
                                                }
                                            }
                                            $sql4=("SELECT idFechasMetas, fechaInicial, fechaFinal
                                                FROM FechasMetas 
                                                WHERE idMetasEstrategicas = ".$row3["idMetasEstrategicas"]." order by idFechasMetas asc");
                                            if($query4 = mysqli_query($recordset->conn,$sql4))
                                            {
                                                while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                {
                                                    $rowZ = array();
                                                    $rowZ["idFechasMetas"] = $row4["idFechasMetas"];
                                                    $rowZ["fechaInicial"] = $row4["fechaInicial"];
                                                    $rowZ["fechaFinal"] = $row4["fechaFinal"];
                                                    array_push($rowY["fechas"], $rowZ);
                                                }
                                            }
                                            $sql4=("SELECT idActividadesMetas, actividad
                                                FROM ActividadesMetas 
                                                WHERE idMetasEstrategicas = ".$row3["idMetasEstrategicas"]." order by idActividadesMetas asc");
                                            if($query4 = mysqli_query($recordset->conn,$sql4))
                                            {
                                                while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                {
                                                    $rowZ = array();
                                                    $rowZ["idActividadesMetas"] = $row4["idActividadesMetas"];
                                                    $rowZ["actividad"] = ($row4["actividad"]);
                                                    array_push($rowY["actividades"], $rowZ);
                                                }
                                            }
                                             $sql4=("SELECT idVerificacionMetas, fechaInicial, fechaFinal, descripcion, archivo
                                                FROM VerificacionMetas 
                                                WHERE idMetasEstrategicas = ".$row3["idMetasEstrategicas"]." order by idVerificacionMetas asc");
                                            if($query4 = mysqli_query($recordset->conn,$sql4))
                                            {
                                                while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                                {
                                                    $rowZ = array();
                                                    $rowZ["idVerificacionMetas"] = $row4["idVerificacionMetas"];
                                                    $rowZ["descripcion"] = ($row4["descripcion"]);
                                                    $rowZ["fechaInicial"] = $row4["fechaInicial"];
                                                    $rowZ["fechaFinal"] = $row4["fechaFinal"];
                                                    $rowZ["archivo"] = $row4["archivo"];
                                                    array_push($rowY["verificacion"], $rowZ);
                                                }
                                            }
                                            array_push($rowX["metas"], $rowY);
                                        }
                                    }
                                }
                                array_push($acciones, $rowX);
                            }
                            echo '{ "success" : 1, "acciones" : '.json_encode($acciones).'}';
                            exit(0);
                        }
                    break;
                    case 'mete2021_Iglesias_asdajlsdlajdslakj':
                        $sql=("DELETE FROM DepartamentosAccionesIglesias WHERE anio = 2021");
                        if($query = mysqli_query($recordset->conn,$sql)){}



                    $sql2=("SELECT idDepartamentosAccionesIglesias, idDepartamento, motor, accion, accionPasado, indicador, idObjetivosEspecificos, anio, tipo FROM DepartamentosAccionesIglesias WHERE anio = 2020");
                    if($query2 = mysqli_query($recordset->conn,$sql2))
                    {
                        while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                        {
                            $sql3=("INSERT INTO DepartamentosAccionesIglesias ( idDepartamento, motor, accion, accionPasado, indicador, idObjetivosEspecificos, anio, tipo) VALUES (".$row2["idDepartamento"].", ".$row2["motor"].", '".$row2["accion"]."', '".$row2["accionPasado"]."',".$row2["indicador"].", ".$row2["idObjetivosEspecificos"].",  2021, ".$row2["tipo"].")");
                            if($query3 = mysqli_query($recordset->conn,$sql3))
                            {
                                $idDepartamentosAccionesIglesias = mysqli_insert_id($recordset->conn);
                                $sql22=("SELECT idDepartamento, archivo, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic, titulo, origen FROM ActividadesSugerentesIglesia WHERE idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." AND origen = -1");
                                if($query22= mysqli_query($recordset->conn,$sql22))
                                {
                                    while($row22=mysqli_fetch_array($query22,MYSQLI_ASSOC))
                                    {
                                        $sql33=("INSERT INTO ActividadesSugerentesIglesia ( idDepartamentosAccionesIglesias, idDepartamento, archivo, descripcion, ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic, titulo, origen) VALUES (".$idDepartamentosAccionesIglesias.", ".$row22["idDepartamento"].", '".$row22["archivo"]."', '".$row22["descripcion"]."', ".$row22["ene"].", ".$row22["feb"].", ".$row22["mar"].", ".$row22["abr"].", ".$row22["may"].", ".$row22["jun"].", ".$row22["jul"].", ".$row22["ago"].", ".$row22["sep"].", ".$row22["oct"].", ".$row22["nov"].", ".$row22["dic"].", '".$row22["titulo"]."', ".$row22["origen"]." )");
                                        if($query33 = mysqli_query($recordset->conn,$sql33)) {}else {echo $sql33;}
                                    }
                                }

                            }
                        }
                    }
                    echo '{ "success" : 1}';
                    exit(0);
                    break;
                    case 'mete2021_asdjasdhjlasxxnduei37h':
                    $sql=("DELETE FROM DepartamentosAcciones2018 WHERE anio = 2021");
                    if($query = mysqli_query($recordset->conn,$sql)){}


                    $sql=("DELETE FROM Metas2018 WHERE anio = 2021");
                    if($query = mysqli_query($recordset->conn,$sql)){}

                    $sql2=("SELECT idDepartamentosAcciones, idDepartamento, idAccionEstrategica, puedeCapturar, esDepartamentoEje, anio FROM DepartamentosAcciones2018 WHERE anio = 2020");
                    if($query2 = mysqli_query($recordset->conn,$sql2))
                    {
                        while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                        {
                            $sql3=("INSERT INTO DepartamentosAcciones2018 ( idDepartamento, idAccionEstrategica, puedeCapturar, esDepartamentoEje, anio) VALUES (".$row2["idDepartamento"].", ".$row2["idAccionEstrategica"].", ".$row2["puedeCapturar"].", ".$row2["esDepartamentoEje"].", 2021)");
                            if($query3 = mysqli_query($recordset->conn,$sql3))
                            {
                                $idDepartamentosAcciones = mysqli_insert_id($recordset->conn);
                                $sql22=("SELECT tipoMeta, metaString FROM Metas2018 WHERE idDepartamentosAcciones = ".$row2["idDepartamentosAcciones"]);
                                if($query22= mysqli_query($recordset->conn,$sql22))
                                {
                                    while($row22=mysqli_fetch_array($query22,MYSQLI_ASSOC))
                                    {
                                        $sql33=("INSERT INTO Metas2018 ( idDepartamentosAcciones, tipoMeta, metaString, anio) VALUES (".$idDepartamentosAcciones.", ".$row22["tipoMeta"].", '".$row22["metaString"]."', 2021)");
                                        if($query33 = mysqli_query($recordset->conn,$sql33)) {}else {echo $sql33;}
                                    }
                                }
                               

                            } 
                            else {
                                echo $sql3;
                            }
                        
                        
                        }
                    }
                    return;

                    break;
                    case 'verObjetivos2018':  
                        //DirectricesAcciones  
                        checarSesionUsuarios();
                        $objetivos = array();
                        $idMotor = $_POST['idMotor'];
                        $tipo = $_POST['tipo'];
                        $anio = $_POST['anio'];
                        $idDepartamento = $_POST['idDepartamento'];
                        $idCampo = $_SESSION["idCampo"];
                        if(isset($_POST["idCampoGlobal"]))
                        {
                            $ver = $_POST["idCampoGlobal"];
                            if(intval($ver)!=0)
                            {
                                $idCampo = $ver;
                            }
                        }
                        //solo las de union
                        //o.motor = ".$idMotor."
                        /*$sql2=("CALL getObjetivosEspecificos_idObjetivosEspecificos_objetivo_motor (".$idDepartamento.", ".$tipo.", ".$anio.")");*/
                        
                        $sql2=("SELECT DISTINCT o.idObjetivosEspecificos, o.objetivo , o.motor
                            FROM ObjetivosEspecificos o 
                            INNER JOIN AccionesEstrategicas2018 a on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                            INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                            WHERE o.motor in (1,2,3,4,5) AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." AND d.anio = ".$anio." order by o.motor asc, o.idObjetivosEspecificos asc");
                            
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["objetivo"] = ($row2["objetivo"]);
                                $row2["motor"] = ($row2["motor"]);
                                $row2["acciones"] = array();
                               /* $sql3=("CALL getAccionesEstrategicas2018AccionIdAccionEstrategica (".$row2["idObjetivosEspecificos"].", ".$idDepartamento.", ".$tipo.", ".$anio.", 0,".$idCampo.")");*/
                                //CALL getAccionesEstrategicas2018AccionIdAccionEstrategica (1, 15, 3, 2021, 0,11);
                                $sql3=("SELECT a.accion, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador, a.procesoResultado, a.accionPasado, a.aclaracion
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." AND d.anio = ".$anio." AND a.esPrivada in (0,".$idCampo.") order by a.idAccionEstrategica asc");
                                    
                                    
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {

                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {

                                        $row3["idCampo"] = $_SESSION["idCampo"];
                                        $row3["accion"] = ($row3["accion"]);
                                        $row3["accionPasado"] = ($row3["accionPasado"]);
                                        $row3["aclaracion"] = ($row3["aclaracion"]);
                                        $row3["directrices"] = array();
                                        $sql4=("CALL getDirectricesAccionesDescripcionIdDirectricesAccArch (".$row3["idDepartamentosAcciones"].", ".$anio.")");

                                        $sql4=("SELECT descripcion, idDirectricesAcciones, archivo
                                            FROM DirectricesAcciones 
                                            WHERE idDepartamentosAcciones = ".$row3["idDepartamentosAcciones"]." AND anio = ".$anio." order by idDirectricesAcciones asc");
                                        

                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                $row4["descripcion"] = ($row4["descripcion"]);
                                                $row4["archivo"] = ($row4["archivo"]);
                                                array_push($row3["directrices"], $row4);
                                            }
                                        }
                                        $row3["metas"] = array();
                                        $sql4=("CALL getMetas2018IdMet2018TipMetMetStrng (".$row3["idDepartamentosAcciones"].")");
                                        
                                        $sql4=("SELECT m.idMetas2018, m.tipoMeta, m.metaString
                                            FROM Metas2018 m
                                            WHERE m.idDepartamentosAcciones = ".$row3["idDepartamentosAcciones"]."  order by m.idMetas2018 asc");
                                        
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                $row4["metaString"] = ($row4["metaString"]);

                                                $row4["fecha"] = array();
                                                $row4["gasto"] = "";
                                                $row4["actividad"] = "";
                                                $row4["idMetasEstrategicas"] = 0;
                                                $row4["metaNumero"] = 0;
                                                $sql5=("CALL getMetasEstrategicas2018IDNULLMetNum (".$anio.",  ".$idCampo.", ".$row4["idMetas2018"].")");
                                                
                                                $sql5=("SELECT IFNULL(me.metaNumero,-1) as metaNumero, IFNULL(me.idMetasEstrategicas,0) as idMetasEstrategicas
                                                    FROM MetasEstrategicas2018  me
                                                    WHERE me.anio = ".$anio." AND me.idCampo = ".$idCampo." AND me.idMetas2018 = ".$row4["idMetas2018"]);
                                                if($query5 = mysqli_query($recordset->conn,$sql5))
                                                {
                                                    if($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                                    {
                                                        $row4["metaNumero"] = $row5["metaNumero"];
                                                        $row4["idMetasEstrategicas"] = $row5["idMetasEstrategicas"];
                                                    }
                                                }
                                                $sql5=("CALL getFechasMetasFchaIniIdFchaMetIdMetEstrat (".$row4["idMetasEstrategicas"].", ".$anio.")");
                                                
                                                $sql5=("SELECT fechaInicial, idFechasMetas, idMetasEstrategicas
                                                    FROM FechasMetas 
                                                    WHERE idMetasEstrategicas = ".$row4["idMetasEstrategicas"]." AND anio = ".$anio);
                                                if($query5 = mysqli_query($recordset->conn,$sql5))
                                                {
                                                    while($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                                    {
                                                        $row5["fechaInicial"] = ($row5["fechaInicial"]);
                                                        array_push($row4["fecha"], $row5);
                                                    }
                                                }
                                                $sql5=("CALL getActividadesMetasActIdMetEstrat (".$row4["idMetasEstrategicas"].", ".$anio.")");
                                                
                                                $sql5=("SELECT actividad
                                                    FROM ActividadesMetas 
                                                    WHERE idMetasEstrategicas = ".$row4["idMetasEstrategicas"]." AND anio = ".$anio);
                                                if($query5 = mysqli_query($recordset->conn,$sql5))
                                                {
                                                    if($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                                    {
                                                        $row5["actividad"] = ($row5["actividad"]);
                                                        $row4["actividad"] = $row5["actividad"];
                                                    }
                                                }
                                                $sql5=("CALL getPresupuestoMetasConceptIdMetEstrat (".$row4["idMetasEstrategicas"].", ".$anio.")");
                                                
                                                $sql5=("SELECT concepto
                                                    FROM PresupuestoMetas 
                                                    WHERE idMetasEstrategicas = ".$row4["idMetasEstrategicas"]." AND anio = ".$anio);
                                                if($query5 = mysqli_query($recordset->conn,$sql5))
                                                {
                                                    if($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                                    {
                                                        $row5["concepto"] = ($row5["concepto"]);
                                                        $row4["gasto"] = $row5["concepto"];
                                                    }
                                                }
                                                array_push($row3["metas"], $row4);
                                            }
                                        }

                                        array_push($row2["acciones"], $row3);
                                    }
                                }
                                array_push($objetivos, $row2);
                            }
                            echo '{ "success" : 1, "objetivos" : '.json_encode($objetivos).'}';
                            exit(0);
                        }
                    break;
                    case 'verObjetivos':    
                        checarSesionUsuarios();
                        $objetivos = array();
                        $idMotor = $_POST['idMotor'];
                        $tipo = $_POST['tipo'];
                        $idDepartamento = $_POST['idDepartamento'];
                        //solo las de union
                        $sql2=("SELECT DISTINCT o.idObjetivosEspecificos, o.objetivo 
                            FROM ObjetivosEspecificos o 
                            INNER JOIN AccionesEstrategicas a on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                            INNER JOIN DepartamentosAcciones d on d.idAccionEstrategica = a.idAccionEstrategica
                            WHERE o.motor = ".$idMotor." AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." order by o.idObjetivosEspecificos asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["objetivo"] = ($row2["objetivo"]);
                                array_push($objetivos, $row2);
                            }
                            echo '{ "success" : 1, "objetivos" : '.json_encode($objetivos).'}';
                            exit(0);
                        }
                    break;
                    case 'verPuntosPorIdEvento':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $puntos = array();
                        $idEvento = $_POST['idEvento'];
                        $sql2=("SELECT idPunto, titulo, descripcion, bloqueado, activo FROM Puntos WHERE idEvento = ".$idEvento." order by idPunto asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["titulo"] = ($row2["titulo"]);
                                $row2["descripcion"] = ($row2["descripcion"]);
                                array_push($puntos, $row2);
                            }
                            echo '{ "success" : 1, "puntos" : '.json_encode($puntos).'}';
                            exit(0);
                        }
                    break;
                    case 'verJuntas':
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $juntas = array();
                        $sql2=("SELECT idEvento, titulo FROM Eventos WHERE activo = 1 AND idCampo = ".$_SESSION["idCampo"]." order by idEvento asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["titulo"] = ($row2["titulo"]);
                                array_push($juntas, $row2);
                            }
                            echo '{ "success" : 1, "juntas" : '.json_encode($juntas).'}';
                            exit(0);
                        }  
                    break;
                }
        break;
        case 'calendario':
                switch($accion)
                {
                    case 'deboPonerCalendario':    
                        checarSesionUsuarios();
                        $idFechasMetas = $_POST['idFechasMetas'];
                        $nuevoValor = $_POST['nuevoValor'];
                        $sql=("UPDATE FechasMetas SET deboPonerCalendario = ".$nuevoValor." WHERE idFechasMetas = ".$idFechasMetas);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'campo':    
                        checarSesionUsuarios();
                        $idCampo = $_SESSION['idCampo'];
                        $anio = $_POST['anio'];
                        $eventos = array();
                        //actividades predefinidas UMN
                        $sql2=("SELECT d.idDepartamento, d.nombre, f.idMetasEstrategicas, a.actividad, f.fechaInicial, f.fechaFinal, f.idFechasMetas, a.idActividadesMetas,m.indicador,m.metaNumero,mm.metaString,mm.tipoMeta, f.deboPonerCalendario
                            FROM FechasMetas f 
                            INNER JOIN MetasEstrategicas2018 m on m.idMetasEstrategicas = f.idMetasEstrategicas
                            INNER JOIN ActividadesMetas a on a.idMetasEstrategicas = m.idMetasEstrategicas
                            INNER JOIN Metas2018 mm on mm.idMetas2018 = m.idMetas2018
                            INNER JOIN DepartamentosAcciones dd on dd.idDepartamentosAcciones = mm.idDepartamentosAcciones
                            INNER JOIN Departamentos d on d.idDepartamento = dd.idDepartamento
                            WHERE  f.anio = ".$anio." AND a.anio = ".$anio." AND m.idCampo = ".$idCampo." AND   f.idMetasEstrategicas = a.idMetasEstrategicas order by d.idDepartamento asc");
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                $row2["descripcion"] = ($row2["actividad"]);
                                $row["title"] = $row2["descripcion"];
                                $fecha = trim($row2["fechaInicial"]);
                                $row["nombre"] = ($row2["nombre"]);
                                $row["deboPonerCalendario"] = $row2["deboPonerCalendario"];
                                $row["color"] = "#979006";
                                $row["idDepartamento"] = $row2["idDepartamento"];
                                $row["idFechasMetas"] = $row2["idFechasMetas"];
                                if($row2["idDepartamento"]==1)
                                {
                                    $row["color"] = "#666600";
                                }
                                if($row2["idDepartamento"]==2)
                                {
                                    $row["color"] = "#006622";
                                }
                                if($row2["idDepartamento"]==3)
                                {
                                    $row["color"] = "#006699";
                                }
                                if($row2["idDepartamento"]==4)
                                {
                                    $row["color"] = "#000000";
                                }
                                if($row2["idDepartamento"]==5){$row["color"] = "#3333ff";}
                                if($row2["idDepartamento"]==6){$row["color"] = "#9933ff";}
                                if($row2["idDepartamento"]==7){$row["color"] = "#cc00cc";}
                                if($row2["idDepartamento"]==8){$row["color"] = "#cc6699";}
                                if($row2["idDepartamento"]==9){$row["color"] = "#cc0000";}
                                if($row2["idDepartamento"]==10){$row["color"] = "#cc6600";}
                                //claritos
                                if($row2["idDepartamento"]==11){$row["color"] = "#00ffff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==12){$row["color"] = "#b3ffcc";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==13){$row["color"] = "#ccffb3";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==14){$row["color"] = "#ffff99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==15){$row["color"] = "#ffcc99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==16){$row["color"] = "#ff9999";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==17){$row["color"] = "#ffb3ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==18){$row["color"] = "#cc99ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==19){$row["color"] = "#99ccff";$row["textColor"] = "#000000";}
                                if(strlen($fecha)==10)//una sola fecha
                                {
                                    $anio=substr($fecha, 6,4);
                                    $mes=substr($fecha, 3,2);
                                    $dia=substr($fecha, 0,2);
                                    $fecha=$anio."-".$mes."-".$dia;
                                    $row["start"] = $fecha;
                                    $row["end"] = $fecha;
                                }
                                else
                                {
                                    if(strlen($fecha)==23)//dos fechas
                                    {
                                        $fechaStart = substr($fecha, 0,10);
                                        $fechaEnd = substr($fecha, 13);
                                        $anio=substr($fechaStart, 6,4);
                                        $mes=substr($fechaStart, 3,2);
                                        $dia=substr($fechaStart, 0,2);
                                        $fechaStart=$anio."-".$mes."-".$dia;
                                        $anio=substr($fechaEnd, 6,4);
                                        $mes=substr($fechaEnd, 3,2);
                                        $dia=substr($fechaEnd, 0,2);
                                        $fechaEnd=$anio."-".$mes."-".$dia;
                                        $row["start"] = $fechaStart;
                                        $row["end"] = $fechaEnd;
                                    }   
                                }
                                array_push($eventos, $row);
                            }
                        }
                        echo '{ "success" : 1, "eventos" : '.json_encode($eventos).'}';
                        exit(0);
                    break;
                    case 'iglesiasDelDistrito':    
                        checarSesionUsuarios();
                        $iglesiasIdGrupo = $_POST['iglesiasIdGrupo'];
                        $arr = explode(',',$iglesiasIdGrupo);
                        $idGrupo = $arr[0];
                        $idCampo = 0;
                        $sql3=('SELECT d.idCampo
                            FROM Grupos g 
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE g.idGrupo = '.$idGrupo);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $idCampo = $row3["idCampo"];
                            }
                        }
                        $anio = $_POST['anio'];
                         $eventos = array();
                        //actividades predefinidas UMN
                        $sql2=("SELECT aa.idDepartamento, d.nombre, f.idDepartamentosAccionesIglesias, a.actividadOtra, f.fecha, f.idFechasMetasIglesias, a.idActividadesIglesias, a.idActividadesSugerentesIglesia, aa.descripcion, f.idGrupo
                            FROM FechasMetasIglesias f 
                            INNER JOIN ActividadesIglesias a on a.idGrupo = f.idGrupo
                            INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia 
                            INNER JOIN Departamentos d on d.idDepartamento = aa.idDepartamento
                            WHERE f.idGrupo in (".$iglesiasIdGrupo.") AND f.anio = ".$anio." AND a.anio = ".$anio." AND a.idGrupo in (".$iglesiasIdGrupo.") AND f.idActividadesIglesias = a.idActividadesIglesias order by aa.idDepartamento asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                $row["nombre"] = ($row2["nombre"]);
                                $row2["descripcion"] = ($row2["descripcion"]);
                                $row["title"] = $row2["descripcion"];
                                $row["esCampo"] = 0;
                                $row["color"] = "#979006";
                                if(array_search($row2["idGrupo"],$arr) !== false) 
                                {
                                    $pos = array_search($row2["idGrupo"],$arr);
                                    if($pos==0){$row["color"] = "#666600";}
                                    if($pos==1){$row["color"] = "#006622";}
                                    if($pos==2){$row["color"] = "#006699";}
                                    if($pos==3){$row["color"] = "#000000";}
                                    if($pos==4){$row["color"] = "#3333ff";}
                                    if($pos==5){$row["color"] = "#9933ff";}
                                    if($pos==6){$row["color"] = "#cc00cc";}
                                    if($pos==7){$row["color"] = "#cc6699";}
                                    if($pos==8){$row["color"] = "#cc0000";}
                                    if($pos==9){$row["color"] = "#cc6600";}

                                    if($pos==10){$row["color"] = "#00ffff";$row["textColor"] = "#000000";}
                                    if($pos==11){$row["color"] = "#b3ffcc";$row["textColor"] = "#000000";}
                                    if($pos==12){$row["color"] = "#ccffb3";$row["textColor"] = "#000000";}
                                    if($pos==13){$row["color"] = "#ffff99";$row["textColor"] = "#000000";}
                                    if($pos==14){$row["color"] = "#ffcc99";$row["textColor"] = "#000000";}
                                    //$row["color"] = "#99ccff";$row["textColor"] = "#000000";
                                }

                                $row["idDepartamento"] = $row2["idDepartamento"];
                               
                              
                            
                                $fecha = trim($row2["fecha"]);

                                if(strlen($fecha)==10)//una sola fecha
                                {
                                    $anio=substr($fecha, 6,4);
                                    $mes=substr($fecha, 3,2);
                                    $dia=substr($fecha, 0,2);
                                    $fecha=$anio."-".$mes."-".$dia;
                                    $row["start"] = $fecha;
                                    $row["end"] = $fecha;
                                }
                                else
                                {
                                    if(strlen($fecha)==23)//dos fechas
                                    {
                                        $fechaStart = substr($fecha, 0,10);
                                        $fechaEnd = substr($fecha, 13);
                                        $anio=substr($fechaStart, 6,4);
                                        $mes=substr($fechaStart, 3,2);
                                        $dia=substr($fechaStart, 0,2);
                                        $fechaStart=$anio."-".$mes."-".$dia;
                                        $anio=substr($fechaEnd, 6,4);
                                        $mes=substr($fechaEnd, 3,2);
                                        $dia=substr($fechaEnd, 0,2);
                                        $fechaEnd=$anio."-".$mes."-".$dia;
                                        $row["start"] = $fechaStart;
                                        $row["end"] = $fechaEnd;
                                    }   
                                }
                                array_push($eventos, $row);
                            }
                        }
                        //actividades puestas por la iglesia
                        $sql2=("SELECT d.idDepartamento, d.nombre, f.idDepartamentosAccionesIglesias, a.actividadOtra, f.fecha, f.idFechasMetasIglesias, a.idActividadesIglesias, a.idActividadesSugerentesIglesia, a.actividadOtra, f.idGrupo
                            FROM FechasMetasIglesias f 
                            INNER JOIN ActividadesIglesias a on a.idGrupo = f.idGrupo
                             INNER JOIN DepartamentosAccionesIglesias dd on dd.idDepartamentosAccionesIglesias = a.idDepartamentosAccionesIglesias 
                             INNER JOIN Departamentos d on d.idDepartamento = dd.idDepartamento
                            WHERE f.idGrupo in (".$iglesiasIdGrupo.") AND f.anio = ".$anio." AND a.anio =  ".$anio." AND a.idGrupo in (".$iglesiasIdGrupo.") AND f.idActividadesIglesias = a.idActividadesIglesias AND dd.anio = ".$anio." order by d.idDepartamento asc");// AND a.idActividadesSugerentesIglesia = -1   ¿?
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                 $row["nombre"] = ($row2["nombre"]);
                               
                                $row2["actividadOtra"] = ($row2["actividadOtra"]);
                                $row["title"] = $row2["actividadOtra"];
                                  $row["color"] = "#979006";
                                  $row["esCampo"] = 0;
                                $row["idDepartamento"] = $row2["idDepartamento"];
                                if(array_search($row2["idGrupo"],$arr) !== false) 
                                {
                                    $pos = array_search($row2["idGrupo"],$arr);
                                    if($pos==0){$row["color"] = "#666600";}
                                    if($pos==1){$row["color"] = "#006622";}
                                    if($pos==2){$row["color"] = "#006699";}
                                    if($pos==3){$row["color"] = "#000000";}
                                    if($pos==4){$row["color"] = "#3333ff";}
                                    if($pos==5){$row["color"] = "#9933ff";}
                                    if($pos==6){$row["color"] = "#cc00cc";}
                                    if($pos==7){$row["color"] = "#cc6699";}
                                    if($pos==8){$row["color"] = "#cc0000";}
                                    if($pos==9){$row["color"] = "#cc6600";}

                                    if($pos==10){$row["color"] = "#00ffff";$row["textColor"] = "#000000";}
                                    if($pos==11){$row["color"] = "#b3ffcc";$row["textColor"] = "#000000";}
                                    if($pos==12){$row["color"] = "#ccffb3";$row["textColor"] = "#000000";}
                                    if($pos==13){$row["color"] = "#ffff99";$row["textColor"] = "#000000";}
                                    if($pos==14){$row["color"] = "#ffcc99";$row["textColor"] = "#000000";}
                                    //$row["color"] = "#99ccff";$row["textColor"] = "#000000";
                                }
                                $fecha = trim($row2["fecha"]);

                                if(strlen($fecha)==10)//una sola fecha
                                {
                                    $anio=substr($fecha, 6,4);
                                    $mes=substr($fecha, 3,2);
                                    $dia=substr($fecha, 0,2);
                                    $fecha=$anio."-".$mes."-".$dia;
                                    $row["start"] = $fecha;
                                    $row["end"] = $fecha;
                                }
                                else
                                {
                                    if(strlen($fecha)==23)//dos fechas
                                    {
                                        $fechaStart = substr($fecha, 0,10);
                                        $fechaEnd = substr($fecha, 13);
                                        $anio=substr($fechaStart, 6,4);
                                        $mes=substr($fechaStart, 3,2);
                                        $dia=substr($fechaStart, 0,2);
                                        $fechaStart=$anio."-".$mes."-".$dia;
                                        $anio=substr($fechaEnd, 6,4);
                                        $mes=substr($fechaEnd, 3,2);
                                        $dia=substr($fechaEnd, 0,2);
                                        $fechaEnd=$anio."-".$mes."-".$dia;
                                        $row["start"] = $fechaStart;
                                        $row["end"] = $fechaEnd;
                                    }   
                                }
                                array_push($eventos, $row);
                            }
                        }
                        //ACTIVIDADES DEL CAMPO LOCAL
                        $sql2=("SELECT d.idDepartamento, d.nombre, f.idMetasEstrategicas, a.actividad, f.fechaInicial, f.fechaFinal, f.idFechasMetas, a.idActividadesMetas,m.indicador,m.metaNumero,mm.metaString,mm.tipoMeta, f.deboPonerCalendario
                            FROM FechasMetas f 
                            INNER JOIN MetasEstrategicas2018 m on m.idMetasEstrategicas = f.idMetasEstrategicas
                            INNER JOIN ActividadesMetas a on a.idMetasEstrategicas = m.idMetasEstrategicas
                            INNER JOIN Metas2018 mm on mm.idMetas2018 = m.idMetas2018
                            INNER JOIN DepartamentosAcciones2018 dd on dd.idDepartamentosAcciones = mm.idDepartamentosAcciones
                            INNER JOIN Departamentos d on d.idDepartamento = dd.idDepartamento
                            INNER JOIN AccionesEstrategicas2018 ac on ac.idAccionEstrategica = dd.idAccionEstrategica
                            WHERE  f.anio = ".$anio." AND a.anio = ".$anio." AND m.idCampo = ".$idCampo." AND ac.tipo = 2 AND   f.idMetasEstrategicas = a.idMetasEstrategicas AND f.deboPonerCalendario = 1 order by d.idDepartamento asc");
                        
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                $row2["descripcion"] = ($row2["actividad"]);
                                $row["title"] = $row2["descripcion"];
                                $fecha = trim($row2["fechaInicial"]);
                                $row["nombre"] = ($row2["nombre"]);
                                $row["deboPonerCalendario"] = $row2["deboPonerCalendario"];
                                $row["color"] = "#979006";
                                $row["esCampo"] = 1;
                                $row["idDepartamento"] = $row2["idDepartamento"];
                                $row["idFechasMetas"] = $row2["idFechasMetas"];
                                $row["color"] = "#99ccff";$row["textColor"] = "#000000";
                                if(strlen($fecha)==10)//una sola fecha
                                {
                                    $anio=substr($fecha, 6,4);
                                    $mes=substr($fecha, 3,2);
                                    $dia=substr($fecha, 0,2);
                                    $fecha=$anio."-".$mes."-".$dia;
                                    $row["start"] = $fecha;
                                    $row["end"] = $fecha;
                                }
                                else
                                {
                                    if(strlen($fecha)==23)//dos fechas
                                    {
                                        $fechaStart = substr($fecha, 0,10);
                                        $fechaEnd = substr($fecha, 13);
                                        $anio=substr($fechaStart, 6,4);
                                        $mes=substr($fechaStart, 3,2);
                                        $dia=substr($fechaStart, 0,2);
                                        $fechaStart=$anio."-".$mes."-".$dia;
                                        $anio=substr($fechaEnd, 6,4);
                                        $mes=substr($fechaEnd, 3,2);
                                        $dia=substr($fechaEnd, 0,2);
                                        $fechaEnd=$anio."-".$mes."-".$dia;
                                        $row["start"] = $fechaStart;
                                        $row["end"] = $fechaEnd;
                                    }   
                                }
                                array_push($eventos, $row);
                            }
                        }
                        echo '{ "success" : 1, "eventos" : '.json_encode($eventos).'}';
                        exit(0);
                    break;
                    case 'iglesia':    
                        checarSesionUsuarios();
                        $idGrupo = $_SESSION['idGrupo'];
                        $idCampo = 0;
                        $sql3=('SELECT d.idCampo
                            FROM Grupos g 
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE g.idGrupo = '.$idGrupo);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $idCampo = $row3["idCampo"];
                            }
                        }
                        $anio = $_POST['anio'];
                        $eventos = array();
                        //actividades predefinidas UMN
                        $sql2=("SELECT aa.idDepartamento, d.nombre, f.idDepartamentosAccionesIglesias, a.actividadOtra, f.fecha, f.idFechasMetasIglesias, a.idActividadesIglesias, a.idActividadesSugerentesIglesia, aa.descripcion
                            FROM FechasMetasIglesias f 
                            INNER JOIN ActividadesIglesias a on a.idGrupo = f.idGrupo
                            INNER JOIN ActividadesSugerentesIglesia aa on aa.idActividadesSugerentesIglesia = a.idActividadesSugerentesIglesia 
                            INNER JOIN Departamentos d on d.idDepartamento = aa.idDepartamento
                            WHERE f.idGrupo = ".$idGrupo." AND f.anio = ".$anio." AND a.anio = ".$anio." AND a.idGrupo = ".$idGrupo." AND f.idActividadesIglesias = a.idActividadesIglesias order by aa.idDepartamento asc");
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                 $row["nombre"] = ($row2["nombre"]);
                               
                                $row2["descripcion"] = ($row2["descripcion"]);
                                $row["title"] = $row2["descripcion"];
                                $row["esCampo"] = 0;
                                  $row["color"] = "#979006";
                                $row["idDepartamento"] = $row2["idDepartamento"];
                                if($row2["idDepartamento"]==1)
                                {
                                    $row["color"] = "#666600";
                                }
                                if($row2["idDepartamento"]==2)
                                {
                                    $row["color"] = "#006622";
                                }
                                if($row2["idDepartamento"]==3)
                                {
                                    $row["color"] = "#006699";
                                }
                                if($row2["idDepartamento"]==4)
                                {
                                    $row["color"] = "#000000";
                                }
                                if($row2["idDepartamento"]==5){$row["color"] = "#3333ff";}
                                if($row2["idDepartamento"]==6){$row["color"] = "#9933ff";}
                                if($row2["idDepartamento"]==7){$row["color"] = "#cc00cc";}
                                if($row2["idDepartamento"]==8){$row["color"] = "#cc6699";}
                                if($row2["idDepartamento"]==9){$row["color"] = "#cc0000";}
                                if($row2["idDepartamento"]==10){$row["color"] = "#cc6600";}
                                //claritos
                                if($row2["idDepartamento"]==11){$row["color"] = "#00ffff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==12){$row["color"] = "#b3ffcc";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==13){$row["color"] = "#ccffb3";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==14){$row["color"] = "#ffff99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==15){$row["color"] = "#ffcc99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==16){$row["color"] = "#ff9999";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==17){$row["color"] = "#ffb3ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==18){$row["color"] = "#cc99ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==19){$row["color"] = "#99ccff";$row["textColor"] = "#000000";}
                                $fecha = trim($row2["fecha"]);

                                if(strlen($fecha)==10)//una sola fecha
                                {
                                    $anio=substr($fecha, 6,4);
                                    $mes=substr($fecha, 3,2);
                                    $dia=substr($fecha, 0,2);
                                    $fecha=$anio."-".$mes."-".$dia;
                                    $row["start"] = $fecha;
                                    $row["end"] = $fecha;
                                }
                                else
                                {
                                    if(strlen($fecha)==23)//dos fechas
                                    {
                                        $fechaStart = substr($fecha, 0,10);
                                        $fechaEnd = substr($fecha, 13);
                                        $anio=substr($fechaStart, 6,4);
                                        $mes=substr($fechaStart, 3,2);
                                        $dia=substr($fechaStart, 0,2);
                                        $fechaStart=$anio."-".$mes."-".$dia;
                                        $anio=substr($fechaEnd, 6,4);
                                        $mes=substr($fechaEnd, 3,2);
                                        $dia=substr($fechaEnd, 0,2);
                                        $fechaEnd=$anio."-".$mes."-".$dia;
                                        $row["start"] = $fechaStart;
                                        $row["end"] = $fechaEnd;
                                    }   
                                }
                                array_push($eventos, $row);
                            }
                        }
                        //actividades puestas por la iglesia
                        $sql2=("SELECT d.idDepartamento, d.nombre, f.idDepartamentosAccionesIglesias, a.actividadOtra, f.fecha, f.idFechasMetasIglesias, a.idActividadesIglesias, a.idActividadesSugerentesIglesia, a.actividadOtra
                            FROM FechasMetasIglesias f 
                            INNER JOIN ActividadesIglesias a on a.idGrupo = f.idGrupo
                             INNER JOIN DepartamentosAccionesIglesias dd on dd.idDepartamentosAccionesIglesias = a.idDepartamentosAccionesIglesias 
                             INNER JOIN Departamentos d on d.idDepartamento = dd.idDepartamento
                            WHERE f.idGrupo = ".$idGrupo." AND f.anio = ".$anio." AND a.anio =  ".$anio." AND a.idGrupo = ".$idGrupo." AND f.idActividadesIglesias = a.idActividadesIglesias AND a.idActividadesSugerentesIglesia = -1 AND dd.anio = ".$anio." order by d.idDepartamento asc");
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                 $row["nombre"] = ($row2["nombre"]);
                               
                                $row2["actividadOtra"] = ($row2["actividadOtra"]);
                                $row["title"] = $row2["actividadOtra"];
                                  $row["color"] = "#979006";
                                  $row["esCampo"] = 0;
                                $row["idDepartamento"] = $row2["idDepartamento"];
                                if($row2["idDepartamento"]==1)
                                {
                                    $row["color"] = "#666600";
                                }
                                if($row2["idDepartamento"]==2)
                                {
                                    $row["color"] = "#006622";
                                }
                                if($row2["idDepartamento"]==3)
                                {
                                    $row["color"] = "#006699";
                                }
                                if($row2["idDepartamento"]==4)
                                {
                                    $row["color"] = "#000000";
                                }
                                if($row2["idDepartamento"]==5){$row["color"] = "#3333ff";}
                                if($row2["idDepartamento"]==6){$row["color"] = "#9933ff";}
                                if($row2["idDepartamento"]==7){$row["color"] = "#cc00cc";}
                                if($row2["idDepartamento"]==8){$row["color"] = "#cc6699";}
                                if($row2["idDepartamento"]==9){$row["color"] = "#cc0000";}
                                if($row2["idDepartamento"]==10){$row["color"] = "#cc6600";}
                                //claritos
                                if($row2["idDepartamento"]==11){$row["color"] = "#00ffff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==12){$row["color"] = "#b3ffcc";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==13){$row["color"] = "#ccffb3";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==14){$row["color"] = "#ffff99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==15){$row["color"] = "#ffcc99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==16){$row["color"] = "#ff9999";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==17){$row["color"] = "#ffb3ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==18){$row["color"] = "#cc99ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==19){$row["color"] = "#99ccff";$row["textColor"] = "#000000";}
                                $fecha = trim($row2["fecha"]);

                                if(strlen($fecha)==10)//una sola fecha
                                {
                                    $anio=substr($fecha, 6,4);
                                    $mes=substr($fecha, 3,2);
                                    $dia=substr($fecha, 0,2);
                                    $fecha=$anio."-".$mes."-".$dia;
                                    $row["start"] = $fecha;
                                    $row["end"] = $fecha;
                                }
                                else
                                {
                                    if(strlen($fecha)==23)//dos fechas
                                    {
                                        $fechaStart = substr($fecha, 0,10);
                                        $fechaEnd = substr($fecha, 13);
                                        $anio=substr($fechaStart, 6,4);
                                        $mes=substr($fechaStart, 3,2);
                                        $dia=substr($fechaStart, 0,2);
                                        $fechaStart=$anio."-".$mes."-".$dia;
                                        $anio=substr($fechaEnd, 6,4);
                                        $mes=substr($fechaEnd, 3,2);
                                        $dia=substr($fechaEnd, 0,2);
                                        $fechaEnd=$anio."-".$mes."-".$dia;
                                        $row["start"] = $fechaStart;
                                        $row["end"] = $fechaEnd;
                                    }   
                                }
                                array_push($eventos, $row);
                            }
                        }
                        //ACTIVIDADES DEL CAMPO LOCAL
                        $sql2=("SELECT d.idDepartamento, d.nombre, f.idMetasEstrategicas, a.actividad, f.fechaInicial, f.fechaFinal, f.idFechasMetas, a.idActividadesMetas,m.indicador,m.metaNumero,mm.metaString,mm.tipoMeta, f.deboPonerCalendario
                            FROM FechasMetas f 
                            INNER JOIN MetasEstrategicas2018 m on m.idMetasEstrategicas = f.idMetasEstrategicas
                            INNER JOIN ActividadesMetas a on a.idMetasEstrategicas = m.idMetasEstrategicas
                            INNER JOIN Metas2018 mm on mm.idMetas2018 = m.idMetas2018
                            INNER JOIN DepartamentosAcciones2018 dd on dd.idDepartamentosAcciones = mm.idDepartamentosAcciones
                            INNER JOIN Departamentos d on d.idDepartamento = dd.idDepartamento
                            INNER JOIN AccionesEstrategicas2018 ac on ac.idAccionEstrategica = dd.idAccionEstrategica
                            WHERE  f.anio = ".$anio." AND a.anio = ".$anio." AND m.idCampo = ".$idCampo." AND ac.tipo = 2 AND   f.idMetasEstrategicas = a.idMetasEstrategicas AND f.deboPonerCalendario = 1 order by d.idDepartamento asc");
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                $row2["descripcion"] = ($row2["actividad"]);
                                $row["title"] = $row2["descripcion"];
                                $fecha = trim($row2["fechaInicial"]);
                                $row["nombre"] = ($row2["nombre"]);
                                $row["deboPonerCalendario"] = $row2["deboPonerCalendario"];
                                $row["color"] = "#979006";
                                $row["esCampo"] = 1;
                                $row["idDepartamento"] = $row2["idDepartamento"];
                                $row["idFechasMetas"] = $row2["idFechasMetas"];
                                if($row2["idDepartamento"]==1)
                                {
                                    $row["color"] = "#666600";
                                }
                                if($row2["idDepartamento"]==2)
                                {
                                    $row["color"] = "#006622";
                                }
                                if($row2["idDepartamento"]==3)
                                {
                                    $row["color"] = "#006699";
                                }
                                if($row2["idDepartamento"]==4)
                                {
                                    $row["color"] = "#000000";
                                }
                                if($row2["idDepartamento"]==5){$row["color"] = "#3333ff";}
                                if($row2["idDepartamento"]==6){$row["color"] = "#9933ff";}
                                if($row2["idDepartamento"]==7){$row["color"] = "#cc00cc";}
                                if($row2["idDepartamento"]==8){$row["color"] = "#cc6699";}
                                if($row2["idDepartamento"]==9){$row["color"] = "#cc0000";}
                                if($row2["idDepartamento"]==10){$row["color"] = "#cc6600";}
                                //claritos
                                if($row2["idDepartamento"]==11){$row["color"] = "#00ffff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==12){$row["color"] = "#b3ffcc";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==13){$row["color"] = "#ccffb3";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==14){$row["color"] = "#ffff99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==15){$row["color"] = "#ffcc99";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==16){$row["color"] = "#ff9999";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==17){$row["color"] = "#ffb3ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==18){$row["color"] = "#cc99ff";$row["textColor"] = "#000000";}
                                if($row2["idDepartamento"]==19){$row["color"] = "#99ccff";$row["textColor"] = "#000000";}
                                if(strlen($fecha)==10)//una sola fecha
                                {
                                    $anio=substr($fecha, 6,4);
                                    $mes=substr($fecha, 3,2);
                                    $dia=substr($fecha, 0,2);
                                    $fecha=$anio."-".$mes."-".$dia;
                                    $row["start"] = $fecha;
                                    $row["end"] = $fecha;
                                }
                                else
                                {
                                    if(strlen($fecha)==23)//dos fechas
                                    {
                                        $fechaStart = substr($fecha, 0,10);
                                        $fechaEnd = substr($fecha, 13);
                                        $anio=substr($fechaStart, 6,4);
                                        $mes=substr($fechaStart, 3,2);
                                        $dia=substr($fechaStart, 0,2);
                                        $fechaStart=$anio."-".$mes."-".$dia;
                                        $anio=substr($fechaEnd, 6,4);
                                        $mes=substr($fechaEnd, 3,2);
                                        $dia=substr($fechaEnd, 0,2);
                                        $fechaEnd=$anio."-".$mes."-".$dia;
                                        $row["start"] = $fechaStart;
                                        $row["end"] = $fechaEnd;
                                    }   
                                }
                                array_push($eventos, $row);
                            }
                        }
                        echo '{ "success" : 1, "eventos" : '.json_encode($eventos).'}';
                        exit(0);
                        /*FechasMetasIglesias
LEFT JOIN ActividadesIglesias a on f.idDepartamentosAccionesIglesias = a.idDepartamentosAccionesIglesias
                            
                          */  
                            //, a.actividadOtra, aa.descripcion, aa.archivo
/*
                        $sql2=("SELECT f.fecha, f.idFechasMetasIglesias, f.idDepartamentosAccionesIglesias
                            FROM FechasMetasIglesias f 
                            WHERE f.idGrupo = ".$idGrupo."  order by f.idFechasMetasIglesias asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $event = array();
                                $originalDate = $row2["fecha"];
                                $newDate = date("Y-m-d", strtotime($originalDate));
                                $otroFormato = date("d/m/Y", strtotime($originalDate));
                                
                                //echo $newDate;
                                //exit();
                                $event["date"] = $newDate;
                                $event["fecha"] = $otroFormato;

                                $event["title"] = '';
                                $sql3=("SELECT a.actividadOtra, aa.descripcion, aa.archivo
                                    FROM ActividadesIglesias a
                                    LEFT JOIN ActividadesSugerentesIglesia aa on a.idActividadesSugerentesIglesia =  aa.idActividadesSugerentesIglesia        
                                    WHERE a.idGrupo = ".$idGrupo." AND idDepartamentosAccionesIglesias = ".$row2["idDepartamentosAccionesIglesias"]." order by a.idActividadesIglesias asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        if($row3["actividadOtra"]!="")
                                        {
                                            $event["title"] = $event["title"].($row3["actividadOtra"]).' ';    
                                        }
                                        else
                                        {
                                            $event["title"] = $event["title"].($row3["descripcion"]).' ';
                                            $event["url"] = 'http://transformameumn.org/images/archivos/'.$row3["archivo"];
                                        }
                                    }
                                }
                                
                                
                                array_push($eventos, $event);
                            }
                            echo '{ "success" : 1, "eventos" : '.json_encode($eventos).'}';
                            exit(0);
                        }
                        */
                    break;
                }
        break;
        case 'iglesias':
                switch($accion)
                {
                     case 'editarPropiedadesDeIglesia':
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $idGrupo = $_POST['idGrupo'];
                        $tipo = $_POST['tipo'];
                        $nombre = ($_POST['nombre']);
                        $sql=("UPDATE Grupos SET nombre =  '".$nombre."', tipo = ".$tipo." WHERE idGrupo = ".$idGrupo);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'editarIglesia':
                        checarSesionUsuarios();
                        $idGrupo = $_POST['idGrupo'];
                        $sql3=("SELECT idGrupo, nombre, tipo FROM Grupos WHERE idGrupo = ".$idGrupo);
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                echo '{ "success" : 1, "tipo" : '.$row3["tipo"].' , "nombre" : "'.($row3["nombre"]).'" , "idGrupo" : '.$row3["idGrupo"].' }';
                                exit(0);
                            }
                        }
                    break;
                    case 'nuevaIglesia':
                        checarSesionUsuarios();
                        $idDistrito = $_POST['idDistrito'];
                        $nombre = $_POST['nombre'];
                        $tipo = $_POST['tipo'];
                        $clave = randomClave();
                        $sql2=("INSERT INTO Grupos (tipo, idDistrito, nombre, clave) VALUES 
                        (".$tipo.", ".$idDistrito.", '".$nombre."', '".$clave."')");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                     case 'eliminarIglesia':
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $idGrupo = $_POST['idGrupo'];

                        
                         $sql2=('SELECT idMetasEstrategicasIglesias
                            FROM MetasEstrategicasIglesias WHERE idGrupo = '.$idGrupo);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                echo '{ "success" : -1 }';
                                exit();
                            }
                        }
                        $sql=("DELETE FROM Grupos WHERE idGrupo = ".$idGrupo);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'resetClave':
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $idGrupo = $_POST['idGrupo'];
                        $nuevaClave = randomClave();
                        $sql=("UPDATE Grupos SET clave =  '".$nuevaClave."' WHERE idGrupo = ".$idGrupo);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                }
        break;
        case 'departamentos':
                switch($accion)
                {
                    case 'reenviarClavesDeIglesias':    
                        checarSesionUsuarios();
                        $idDistritosUsuarios = $_POST["idDistritosUsuarios"];
                        $idUsuarioCampo = 0;

                         $sql2=("SELECT idUsuarioCampo
                            FROM DistritosUsuarios
                            WHERE idDistritosUsuarios = ".$idDistritosUsuarios."");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $idUsuarioCampo = $row2["idUsuarioCampo"];
                            }
                        }

                        $nombrePastor = '';
                        $correoPastor = '';
                        $sql2=("SELECT nombre, correo
                            FROM UsuariosCampos
                            WHERE idUsuarioCampo = ".$idUsuarioCampo."");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $nombrePastor = ($row2["nombre"]);
                                $correoPastor = $row2["correo"];
                            }
                        }

                        $cadMensaje = '<h3>Estimado Pastor '.$nombrePastor.' </h3><br><p>Le reenviamos las claves de sus iglesias para el sistema web "Señor Transformame":</p><ul>';
                          
                        $sql=("SELECT d.idDistrito, d.nombre as distrito, d.clave as claveDistrito, g.nombre as iglesia, g.idGrupo, g.tipo, g.clave as claveIglesia, c.clave as claveCampo
                            FROM Distritos d
                            INNER JOIN Grupos g on d.idDistrito = g.idDistrito
                            INNER JOIN Campos c on c.idCampo = d.idCampo
                            INNER JOIN DistritosUsuarios du on du.idDistrito = d.idDistrito
                            WHERE du.idDistritosUsuarios = ".$idDistritosUsuarios."
                                order by g.idGrupo asc");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            while($row2=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                               $cadMensaje = $cadMensaje.'<li>'.($row2["iglesia"]).'   Clave: <b>'.$row2["claveCampo"].$row2["claveDistrito"].$row2["claveIglesia"].'</b></li>';
                            }
                            $cadMensaje = $cadMensaje.'</ul><p><a target="_blank" href="http://adventistasumn.org/transformame/">Si tiene alguna duda, favor de visitar la siguiente p&aacute;gina.</a></p><p>Dios lo siga bendiciendo.</p>';
                            require 'PHPMailerAutoload.php';
                            $mail = new PHPMailer();
                            $mail->isSMTP();
                            $mail->SMTPDebug = 0;
                            $mail->Debugoutput = 'html';
                            $mail->Host = 'smtp.gmail.com';                               
                            $mail->Port = 587;
                            $mail->SMTPSecure = 'tls';
                            $mail->SMTPAuth = true;
                            $mail->Username = "f.pecina@unav.edu.mx";
                            $mail->Password = "thanks_God1863";
                            $mail->setFrom('juntas@adventistasumn.org', 'Senor Transformame');
                            $mail->addReplyTo('f.pecina@unav.edu.mx', 'Soporte sistemas');
                            $mail->addAddress($correoPastor, 'Pastor');
                            $mail->addBCC('f.pecina@unav.edu.mx', 'CC');
                            $mail->addBCC($_SESSION["correo"], 'CCC');
                            $mail->Subject = 'CLAVES para sistema de Plan Estrategico Senor Transformame';
                            $mail->msgHTML($cadMensaje);
                            if (!$mail->send()) {
                                echo '{ "success" : -1 , "error" : '.$mail->ErrorInfo.'}';
                            } else {
                                echo '{ "success" : 1 }';
                            }
                            exit(0);
                        }
                        echo '{ "success" : 2 }';
                        exit(0);
                    break;
                    case 'eliminaAsignacion':    
                        checarSesionUsuarios();
                        $idDepartamentosUsuarios = $_POST["idDepartamentosUsuarios"];
                        $sql=("DELETE FROM DepartamentosUsuarios WHERE idDepartamentosUsuarios = ".$idDepartamentosUsuarios);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'accionesDepartamentosInsertarACampoDepartamentosAcciones':    
                        checarSesionUsuarios();
                        $idDepartamento = $_POST['idDepartamento'];
                        $idAccionEstrategica = $_POST['idAccionEstrategica'];
                        $anio = $_POST['anio'];
                        $sql=("INSERT INTO DepartamentosAcciones2018 (idDepartamento, idAccionEstrategica, anio) VALUES 
                            (".$idDepartamento.",".$idAccionEstrategica.", ".$anio.")");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'accionesDepartamentosInsertarACampo':    
                        checarSesionUsuarios();
                        $idDepartamento = $_POST['idDepartamento'];
                        $idMotor = $_POST['idMotor'];
                        $anio = $_POST['anio'];
                        $idObjetivo = $_POST['idObjetivo'];
                        $tipo = $_POST['tipo'];
                        $tipoCampo = $_POST['tipoCampo'];
                        $indicador = $_POST['indicador'];
                        $accion = ($_POST['accionI']);
                        $aclaracion = ($_POST['aclaracion']);
                        $accionPasado = ($_POST['accionPasado']);
                        $sql=("INSERT INTO AccionesEstrategicas2018 (idObjetivosEspecificos, accion, accionPasado, tipo, esPrivada, indicador, procesoResultado, anio, aclaracion) VALUES 
                            (".$idObjetivo.",'".$accion."', '".$accionPasado."', ".$tipoCampo.", 0, ".$indicador.", ".$tipo.", ".$anio.", '".$aclaracion."' )");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            //$idAccionEstrategica = mysqli_insert_id($recordset->conn);
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'accionesDepartamentosInsertarAIglesia':    
                        checarSesionUsuarios();
                        $idDepartamento = $_POST['idDepartamento'];
                        $idMotor = $_POST['idMotor'];

                        $anio = $_POST['anio'];
                        $idObjetivo = $_POST['idObjetivo'];
                        $tipo = $_POST['tipo'];
                        $indicador = $_POST['indicador'];
                        $accion = ($_POST['accionI']);
                        $accionPasado = ($_POST['accionPasado']);
                        $sql=("INSERT INTO DepartamentosAccionesIglesias (idDepartamento, motor, accion, indicador, anio, idObjetivosEspecificos, tipo, accionPasado) VALUES 
                            (".$idDepartamento.",".$idMotor.", '".$accion."',".$indicador.",".$anio.",".$idObjetivo.",".$tipo.", '".$accionPasado."')");
                       // echo $sql;
                        //exit();
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'accionesIglesia2018':    
                        checarSesionUsuarios();
                        $tipo = $_POST["tipo"];
                        $idDepartamento = $_POST["idDepartamento"];
                        $objetivos = array();
                        $sql2=("SELECT DISTINCT o.idObjetivosEspecificos, o.objetivo 
                            FROM ObjetivosEspecificos o 
                            INNER JOIN AccionesEstrategicas2018 a on a.idObjetivosEspecificos = o.idObjetivosEspecificos
                            INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                            WHERE d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo." order by o.motor asc, o.idObjetivosEspecificos asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["objetivo"] = ($row2["objetivo"]);
                                $row2["acciones"] = array();
                                $sql3=("SELECT a.accion, a.idAccionEstrategica, d.idDepartamentosAcciones, a.indicador
                                    FROM AccionesEstrategicas2018 a
                                    INNER JOIN DepartamentosAcciones2018 d on d.idAccionEstrategica = a.idAccionEstrategica
                                    WHERE a.idObjetivosEspecificos = ".$row2["idObjetivosEspecificos"]."  AND d.idDepartamento = ".$idDepartamento." AND a.tipo = ".$tipo."  order by a.idAccionEstrategica asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $row3["accion"] = ($row3["accion"]);
                                        array_push($row2["acciones"], $row3);
                                    }
                                }
                                array_push($objetivos, $row2);
                            }
                            echo '{ "success" : 1, "objetivos" : '.json_encode($objetivos).'}';
                            exit(0);
                        }
                    break;
    //INSERT INTO DirectricesAcciones (idDepartamentosAcciones,descripcion,anio) VALUES (2317,'El día 3 de julio del año 2021 convocaremos a la iglesia en general a un día de ayuno y oración.  Motivo: Agradecimiento a Dios por su compañía y pedir a Dios llene con su Santo Espíritu a los delegados que irán a las sesiones cuadrienales de los campos y la Unión' , 2021);
                    case 'accionesCampoLigadasDirectrices':    // y metas :)
                        checarSesionUsuarios();
                        $anio = $_POST["anio"];
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];

                        $directrices = array();
                        $sql2=('SELECT d.descripcion, d.idDirectricesAcciones
                            FROM DirectricesAcciones d
                            INNER JOIN DepartamentosAcciones2018 dd on dd.idDepartamentosAcciones = d.idDepartamentosAcciones
                            WHERE  d.anio = '.$anio.' AND dd.anio = '.$anio.' AND d.idDepartamentosAcciones = '.$idDepartamentosAcciones.'
                            order by d.idDirectricesAcciones asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["descripcion"] = ($row2["descripcion"]);
                                array_push($directrices, $row2);
                            }
                        }
                        $metas = array();
                        $sql2=('SELECT m.metaString, m.idMetas2018, m.tipoMeta, m.idDepartamentosAcciones
                            FROM Metas2018 m
                            INNER JOIN DepartamentosAcciones2018 dd on dd.idDepartamentosAcciones = m.idDepartamentosAcciones
                            WHERE  m.anio = '.$anio.' AND dd.anio = '.$anio.' AND m.idDepartamentosAcciones = '.$idDepartamentosAcciones.'
                            order by m.idDepartamentosAcciones asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["metaString"] = ($row2["metaString"]);
                                array_push($metas, $row2);
                            }
                        }
                        echo '{"success":1,"directrices":'.json_encode($directrices).',"metas":'.json_encode($metas).'}';
                        exit(0);
                    break;
                    case 'accionesCampoLigadas':    
                        checarSesionUsuarios();
                        //responder las acciones de ese departamento
                        //responder todas las acciones estrategicas!
                        $anio = $_POST["anio"];
                        $accionesLigadas = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $sql2=('SELECT a.accion, d.idDepartamentosAcciones
                            FROM DepartamentosAcciones2018 d
                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                            WHERE  d.anio = '.$anio.' AND a.anio = 2020 AND d.idDepartamento = '.$idDepartamento.'
                            order by a.accion asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                array_push($accionesLigadas, $row2);
                            }
                        }
                        echo '{ "success" : 1, "accionesLigadas" : '.json_encode($accionesLigadas).' }';
                        exit(0);
                    break;
                    case 'accionesCampo':    
                        checarSesionUsuarios();
                        //responder las acciones de ese departamento
                        //responder todas las acciones estrategicas!
                        $anio = $_POST["anio"];
                        $objetivos = array();
                        $sql2=('SELECT idObjetivosEspecificos, objetivo, motor
                            FROM ObjetivosEspecificos 
                            order by idObjetivosEspecificos asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["objetivo"] = ($row2["objetivo"]);
                                array_push($objetivos, $row2);
                            }
                        }
                        $accionesLigadas = array();
                        $motores = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $sql2=('SELECT a.accion, a.accionPasado, a.indicador, a.procesoResultado, a.idAccionEstrategica, a.idObjetivosEspecificos, a.aclaracion
                            FROM AccionesEstrategicas2018 a
                            WHERE  a.anio = 2020
                            order by a.idObjetivosEspecificos asc, a.idAccionEstrategica asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accionPasado"] = ($row2["accionPasado"]);
                                $row2["accion"] = ($row2["accion"]);
                                $row2["aclaracion"] = ($row2["aclaracion"]);
                                array_push($accionesLigadas, $row2);
                            }
                        }
                        
                        $sql2=('SELECT m.motor, m.idMotor
                            FROM Motores m
                            order by m.idMotor asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["motor"] = ($row2["motor"]);
                                array_push($motores, $row2);
                            }
                        }
                        echo '{ "success" : 1, "accionesLigadas" : '.json_encode($accionesLigadas).' , "motores" : '.json_encode($motores).', "objetivos" :  '.json_encode($objetivos).'}';
                        exit(0);
                    break;
                    case 'accionesIglesia':    
                        checarSesionUsuarios();
                        //responder las acciones de ese departamento
                        //responder todas las acciones estrategicas!
                        $anio = $_POST["anio"];
                        $objetivos = array();
                        $sql2=('SELECT idObjetivosEspecificos, objetivo, motor
                            FROM ObjetivosEspecificos 
                            order by idObjetivosEspecificos asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["objetivo"] = ($row2["objetivo"]);
                                array_push($objetivos, $row2);
                            }
                        }
                        $accionesLigadas = array();
                        $motores = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $sql2=('SELECT o.accion, o.indicador, o.idDepartamentosAccionesIglesias, m.motor
                            FROM DepartamentosAccionesIglesias o
                            INNER JOIN Motores m on m.idMotor = o.motor
                            WHERE o.idDepartamento = '.$idDepartamento.' AND o.anio = '.$anio.'
                            order by o.motor asc, o.idDepartamentosAccionesIglesias asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                $row2["motor"] = ($row2["motor"]);
                                array_push($accionesLigadas, $row2);
                            }
                        }
                        
                        $sql2=('SELECT m.motor, m.idMotor
                            FROM Motores m
                            order by m.idMotor asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["motor"] = ($row2["motor"]);
                                array_push($motores, $row2);
                            }
                        }
                        echo '{ "success" : 1, "accionesLigadas" : '.json_encode($accionesLigadas).' , "motores" : '.json_encode($motores).', "objetivos" :  '.json_encode($objetivos).'}';
                        exit(0);
                    break;
                    case 'elimineDepartamentosInsertar':    
                        checarSesionUsuarios();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $sql=("DELETE FROM DepartamentosAcciones WHERE idDepartamentosAcciones = ".$idDepartamentosAcciones);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'accionesDepartamentosInsertar':    
                        checarSesionUsuarios();
                        $idDepartamento = $_POST['idDepartamento'];
                        $idAccionEstrategica = $_POST['idAccionEstrategica'];
                        $esDepartamentoEje = $_POST['esDepartamentoEje'];
                        $sql=("INSERT INTO DepartamentosAcciones2018 (idDepartamento, idAccionEstrategica, puedeCapturar, esDepartamentoEje) VALUES 
                            (".$idDepartamento.",".$idAccionEstrategica.", 0,".$esDepartamentoEje.")");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'nuevaDirectriz':    
                        checarSesionUsuarios();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $anio = $_POST['anio'];
                        $descripcion = ($_POST['descripcion']);
                        $sql2=('INSERT INTO DirectricesAcciones (idDepartamentosAcciones,descripcion,anio) VALUES
                            ('.$idDepartamentosAcciones.', "'.$descripcion.'", '.$anio.')');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                             echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'nuevaMeta':    
                        checarSesionUsuarios();
                        $directrices = array();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $anio = $_POST['anio'];
                        $tipoMeta = $_POST['tipoMeta'];
                        $metaString = ($_POST['metaString']);
                        $sql2=('INSERT INTO Metas2018 (idDepartamentosAcciones,tipoMeta,metaString, anio) VALUES
                            ('.$idDepartamentosAcciones.', '.$tipoMeta.', "'.$metaString.'", '.$anio.')');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                             echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'accionesMetaYDirectriz':    
                        checarSesionUsuarios();
                        //responder las acciones de ese departamento
                        //responder todas las acciones estrategicas!
                        $directrices = array();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $anio = $_POST['anio'];
                        $sql2=('SELECT idDirectricesAcciones,  archivo, descripcion
                            FROM DirectricesAcciones 
                            WHERE anio = '.$anio.' AND idDepartamentosAcciones = '.$idDepartamentosAcciones.'
                            ');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["archivo"] = ($row2["archivo"]);
                                $row2["descripcion"] = ($row2["descripcion"]);
                                array_push($directrices, $row2);
                            }
                        }
                        $metas = array();
                        $sql2=('SELECT idMetas2018, tipoMeta, metaString
                            FROM Metas2018 
                            WHERE idDepartamentosAcciones =  '.$idDepartamentosAcciones.' AND anio = '.$anio.'
                            ');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["metaString"] = ($row2["metaString"]);
                                array_push($metas, $row2);
                            }
                        }
                        echo '{ "success" : 1, "metas" : '.json_encode($metas).' , "directrices" : '.json_encode($directrices).' }';
                        exit(0);
                    break;
                    case 'procesoResultado':    
                        checarSesionUsuarios();
                        $idAccionEstrategica = $_POST['idAccionEstrategica'];
                        $procesoResultado = $_POST['procesoResultado'];
                        $sql=("UPDATE AccionesEstrategicas2018 SET procesoResultado =  ".$procesoResultado." WHERE idAccionEstrategica = ".$idAccionEstrategica);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }  
                    break;
                    case 'eliminaAccion':    
                        checarSesionUsuarios();
                        $idDepartamentosAcciones = $_POST['idDepartamentosAcciones'];
                        $sql4=("SELECT m.idMetas2018, m.tipoMeta, m.metaString
                        FROM Metas2018 m
                        WHERE m.idDepartamentosAcciones = ".$idDepartamentosAcciones."  order by m.idMetas2018 asc");
                        if($query4 = mysqli_query($recordset->conn,$sql4))
                        {
                            if($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                            {
                                echo '{ "success" : 2 }';
                                exit(0);
                            }
                            else
                            {
                                $sql2=('DELETE FROM DepartamentosAcciones2018 WHERE idDepartamentosAcciones = '.$idDepartamentosAcciones);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                        }
                    break;
                    case 'acciones':    
                        checarSesionUsuarios();
                        //responder las acciones de ese departamento
                        //responder todas las acciones estrategicas!
                        $accionesPosibles = array();
                        $idDepartamento = $_POST['idDepartamento'];
                        $sql2=('SELECT a.accion, a.tipo, a.idAccionEstrategica, o.objetivo, m.motor
                            FROM AccionesEstrategicas2018 a
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = a.idObjetivosEspecificos
                            INNER JOIN Motores m on m.idMotor = o.motor
                            order by o.motor asc, o.idObjetivosEspecificos asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                $row2["objetivo"] = ($row2["objetivo"]);
                                $row2["motor"] = ($row2["motor"]);
                                array_push($accionesPosibles, $row2);
                            }
                        }
                        $accionesLigadas = array();
                        $sql2=('SELECT d.idDepartamentosAcciones, d.esDepartamentoEje, a.accion, o.objetivo, m.motor, a.tipo, a.procesoResultado, a.idAccionEstrategica
                            FROM DepartamentosAcciones2018 d
                            INNER JOIN AccionesEstrategicas2018 a on a.idAccionEstrategica = d.idAccionEstrategica
                            INNER JOIN ObjetivosEspecificos o on o.idObjetivosEspecificos = a.idObjetivosEspecificos
                            INNER JOIN Motores m on m.idMotor = o.motor
                            WHERE d.idDepartamento =  '.$idDepartamento.'
                            order by a.tipo desc, o.motor asc, o.idObjetivosEspecificos asc, a.idAccionEstrategica asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                $row2["objetivo"] = ($row2["objetivo"]);
                                $row2["motor"] = ($row2["motor"]);
                                $row2["idDepartamentosAcciones"] = $row2["idDepartamentosAcciones"];
                                array_push($accionesLigadas, $row2);
                            }
                        }
                        echo '{ "success" : 1, "accionesLigadas" : '.json_encode($accionesLigadas).' , "accionesPosibles" : '.json_encode($accionesPosibles).' }';
                        exit(0);
                    break;
                    case 'verLosQueMeTocanMonitoreoCampo':    
                        checarSesionUsuarios();
                        $departamentos = array();
                        $sql2='';
                        if($_SESSION["departamento"]==0)//admon
                        {
                            $sql2=('SELECT d.idDepartamento, d.nombre
                            FROM Departamentos d
                            WHERE d.tipo >= 1
                            order by d.nombre asc');
                            if($_SESSION["dependeDe"]==0)//umn
                            {
                                $sql2=('SELECT d.idDepartamento, d.nombre
                                    FROM Departamentos d
                                    order by d.nombre asc');
                            }
                        }
                        else
                        {
                            $sql2=('SELECT d.idDepartamento, d.nombre
                            FROM Departamentos d
                            INNER JOIN DepartamentosUsuarios du on du.idDepartamento = d.idDepartamento
                            INNER JOIN UsuariosCampos u on u.idUsuarioCampo = du.idUsuarioCampo
                            WHERE u.idUsuarioCampo =  '.$_SESSION["idUsuarioCampo"].'
                            order by d.nombre asc');
                        }
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                if($row2["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                {
                                  //  $row2["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                    array_push($departamentos, $row2);
                                }
                                else
                                {
                                    if($row2["idDepartamento"]==2)//hardcode maximus, perdon el que lo lea, pero..
                                    {
                                        array_push($departamentos, $row2);   
                                    }   
                                    else
                                    {
                                        //$row2["nombre"] = ($row2["nombre"]);
                                        array_push($departamentos, $row2);        
                                    }
                                }
                                
                                
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).' }';
                        exit(0);
                    break;
                    case 'verLosQueMeTocanMonitoreoMasDistritosDelCampo':    
                        checarSesionUsuarios();
                        $distritos = array();
                        $idCampo = 0;
                        $idDistrito = -1;
                        if(isset($_POST["idCampo"]))
                        {
                            $idCampo = $_POST["idCampo"];
                        }
                        else
                        {
                            if(isset($_SESSION["idCampo"]))
                            {
                                $idCampo = $_SESSION["idCampo"];
                            }   
                            else
                            {
                                if(isset($_SESSION["idDistrito"]))
                                {
                                    $idDistrito = $_SESSION["idDistrito"];
                                }   
                            }
                        }
                        $sql3=("SELECT idDistrito, nombre
                                    FROM Distritos 
                                    WHERE idCampo = ".$idCampo." order by nombre asc");
                        if(intval($idDistrito)>0)
                        {
                            $sql3=("SELECT idDistrito, nombre
                                    FROM Distritos 
                                    WHERE idDistrito = ".$idDistrito." order by nombre asc");
                        }
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                array_push($distritos, $row3);
                            }
                        }
                        $departamentos = array();
                        
                        $sql2=('SELECT d.idDepartamento, d.nombre
                                FROM Departamentos d
                                WHERE d.tipo = 2
                                order by d.nombre asc');
                        
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($departamentos, $row2);
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).', "distritos" : '.json_encode($distritos).' }';
                        exit(0);
                    break;
                    case 'verLosQueMeTocanMonitoreo':    
                        checarSesionUsuarios();
                        $departamentos = array();
                        $sql2='';
                        if(isset($_SESSION["idUsuarioCampo"]))//admon
                        {
                            $sql2=('SELECT d.idDepartamento, d.nombre
                                FROM Departamentos d
                                INNER JOIN DepartamentosUsuarios du on du.idDepartamento = d.idDepartamento
                                INNER JOIN UsuariosCampos u on u.idUsuarioCampo = du.idUsuarioCampo
                                WHERE u.idUsuarioCampo =  '.$_SESSION["idUsuarioCampo"].'
                                order by d.nombre asc');
                        }
                        if(isset($_SESSION["departamento"]))//admon
                        {
                            if($_SESSION["departamento"]==0)//admon
                            {
                                $sql2=('SELECT d.idDepartamento, d.nombre
                                FROM Departamentos d
                                WHERE d.tipo = 2
                                order by d.nombre asc');    
                            }
                            else
                            {
                                if(isset($_POST["hash"]))
                                {
                                    $sql2=('SELECT d.idDepartamento, d.nombre
                                    FROM Departamentos d
                                    WHERE d.tipo = 2
                                    order by d.nombre asc');
                                }
                            }
                        }
                        else
                        {
                            if(isset($_POST["hash"]))
                            {
                                $sql2=('SELECT d.idDepartamento, d.nombre
                                FROM Departamentos d
                                WHERE d.tipo = 2
                                order by d.nombre asc');
                            }
                        }
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($departamentos, $row2);
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).' }';
                        exit(0);
                    break;
                    case 'verLosQueMeTocan':    
                        checarSesionUsuarios();
                        $departamentos = array();
                        $sql2=('SELECT d.idDepartamento, d.nombre
                            FROM Departamentos d
                            INNER JOIN DepartamentosUsuarios du on du.idDepartamento = d.idDepartamento
                            INNER JOIN UsuariosCampos u on u.idUsuarioCampo = du.idUsuarioCampo
                            WHERE u.idUsuarioCampo =  '.$_SESSION["idUsuarioCampo"].'
                            order by d.idDepartamento asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                if($row2["idDepartamento"]==6)//ESC SA
                                {
                                  //  $row2["nombre"] = "Escuela Sábatica y Ministerios Personales";
                                }
                                if($row2["idDepartamento"]==12)//ancianos
                                {
                                    $row2["nombre"] = "Secretaría Ministerial";
                                }
                                if($row2["idDepartamento"]==13)//siema
                                {
                                    $row2["nombre"] = "SIEMA";
                                }
                                if($row2["idDepartamento"]!=18 )//mision y min per  && $row2["idDepartamento"]!=2
                                {
                                    array_push($departamentos, $row2);
                                }
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).', "idCampo" : '.$_SESSION["idCampo"].' }';
                        exit(0);
                    break;
                    case 'nuevaAccionDeCampo':    
                        checarSesionUsuarios();
                        $accionI = ($_POST['accionI']);
                        $idDepartamento = $_POST['idDepartamento'];
                        $idObjetivosEspecificos = $_POST['idObjetivosEspecificos'];
                        $sql=("INSERT INTO AccionesEstrategicas (idObjetivosEspecificos, accion, tipo, esPrivada) VALUES 
                            (".$idObjetivosEspecificos.",'".$accionI."', 2,".$_SESSION["idCampo"].")");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            $idAccionEstrategica = mysqli_insert_id($recordset->conn);
                            $sql2=("INSERT INTO DepartamentosAcciones (idDepartamento, idAccionEstrategica, puedeCapturar, esDepartamentoEje) VALUES 
                            (".$idDepartamento.",".$idAccionEstrategica.", 0, 0)");
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                echo '{ "success" : 1 }';
                                exit();
                            }                            
                        }
                    break;
                    case 'dameAcciones':    
                        checarSesionUsuarios();
                        $idMotor = $_POST['idMotor'];
                        $idDepartamento = $_POST['idDepartamento'];
                        $idObjetivosEspecificos = $_POST['idObjetivosEspecificos'];
                        $acciones = array();
                        $sql2=('SELECT a.idAccionEstrategica, a.accion
                            FROM AccionesEstrategicas a
                            WHERE a.tipo = 2 AND a.idObjetivosEspecificos = '.$idObjetivosEspecificos.'
                            AND esPrivada in (0,'.$_SESSION["idCampo"].')
                            order by a.idAccionEstrategica asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["accion"] = ($row2["accion"]);
                                array_push($acciones, $row2);
                            }
                        }
                        echo '{ "success" : 1, "acciones" : '.json_encode($acciones).' }';
                        exit(0);
                    break;
                    case 'dameObjetivos':    
                        checarSesionUsuarios();
                        $idMotor = $_POST['idMotor'];
                        $idDepartamento = $_POST['idDepartamento'];
                        $objetivos = array();
                        $sql2=('SELECT o.objetivo, o.idObjetivosEspecificos
                            FROM ObjetivosEspecificos o
                            WHERE o.motor = '.$idMotor.'
                            order by o.motor asc, o.idObjetivosEspecificos asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["objetivo"] = ($row2["objetivo"]);
                                array_push($objetivos, $row2);
                            }
                        }
                        echo '{ "success" : 1, "objetivos" : '.json_encode($objetivos).' }';
                        exit(0);
                    break;
                    case 'listaNuevaAccion':    
                        checarSesionUsuarios();
                        $departamentos = array();
                        $sql2=('SELECT idDepartamento, nombre
                            FROM Departamentos 
                            order by idDepartamento asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($departamentos, $row2);
                            }
                        }
                        $motores = array();
                        $sql2=('SELECT m.motor, m.idMotor
                            FROM Motores m
                            order by m.idMotor asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["motor"] = ($row2["motor"]);
                                array_push($motores, $row2);
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).' , "motores" : '.json_encode($motores).'}';
                        exit(0);
                    break;
                    case 'listaSencillaUMN':    
                        checarSesionUsuarios();
                        $departamentos = array();
                        $sql2=('SELECT idDepartamento, nombre
                            FROM Departamentos 
                            order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                if($row2["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                {
                                    //$row2["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                    array_push($departamentos, $row2);
                                }
                                else
                                {
                                    if($row2["idDepartamento"]==2)//hardcode maximus, perdon el que lo lea, pero..
                                    {
                                      array_push($departamentos, $row2);           
                                    }   
                                    else
                                    {
                                        array_push($departamentos, $row2);        
                                    }
                                }
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).' }';
                        exit(0);
                    break;
                    case 'listaSencillaCampo':    
                        checarSesionUsuarios();
                        $departamentos = array();
                        $sql2=('SELECT idDepartamento, nombre
                            FROM Departamentos 
                            WHERE tipo >= 1 order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                if($row2["idDepartamento"]==6)//hardcode maximus, perdon el que lo lea, pero..
                                {
                                    //$row2["nombre"] = "Escuela Sábatica y Ministerios Personales";    
                                    array_push($departamentos, $row2);
                                }
                                else
                                {
                                    if($row2["idDepartamento"]==2)//hardcode maximus, perdon el que lo lea, pero..
                                    {
                                        array_push($departamentos, $row2);        
                                    }   
                                    else
                                    {
                                        $row2["nombre"] = ($row2["nombre"]);
                                        array_push($departamentos, $row2);        
                                    }
                                }
                                
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).' }';
                        exit(0);
                    break;
                    case 'listaSencilla':    
                        checarSesionUsuarios();
                        $departamentos = array();
                        $sql2=('SELECT idDepartamento, nombre
                            FROM Departamentos 
                            WHERE tipo = 2 order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($departamentos, $row2);
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).' }';
                        exit(0);
                    break;
                    case 'nuevoActividadIglesia':    
                        checarSesionUsuarios();
                        $idDepartamentosAccionesIglesias = $_POST['idDepartamentosAccionesIglesias'];
                        $descripcionActividad = ($_POST['descripcionActividad']);
                        $tituloActividad = ($_POST['tituloActividad']);
                        $idDepartamento=-1;
                        $sql2=('SELECT idDepartamento
                            FROM DepartamentosAccionesIglesias
                            WHERE  idDepartamentosAccionesIglesias = '.$idDepartamentosAccionesIglesias);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $idDepartamento = $row2["idDepartamento"];
                                $sql=("INSERT INTO ActividadesSugerentesIglesia (idDepartamento, descripcion, idDepartamentosAccionesIglesias, titulo, origen) VALUES 
                                        (".$idDepartamento.",'".$descripcionActividad."',".$idDepartamentosAccionesIglesias.",'".$tituloActividad."', -1)");
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                        }
                        
                    break;
                    case 'dameActividadesDeLaAccionIglesia':    
                        checarSesionUsuarios();
                        $actividades = array();
                        $idDepartamentosAccionesIglesias = $_POST["idDepartamentosAccionesIglesias"];
                        $sql2=('SELECT idActividadesSugerentesIglesia, idDepartamento, descripcion, idDepartamentosAccionesIglesias, titulo
                            FROM ActividadesSugerentesIglesia 
                            WHERE idDepartamentosAccionesIglesias = '.$idDepartamentosAccionesIglesias.'
                            order by idActividadesSugerentesIglesia asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["descripcion"] = ($row2["descripcion"]);
                                $row2["titulo"] = ($row2["titulo"]);
                                array_push($actividades, $row2);
                            }
                        }
                        echo '{ "success" : 1, "actividades" : '.json_encode($actividades).' }';
                        exit(0);
                    break;
                    case 'lista':    
                        checarSesionUsuarios();
                        $objetivos = array();
                        $sql2=('SELECT idObjetivosEspecificos, objetivo, motor
                            FROM ObjetivosEspecificos 
                            order by idObjetivosEspecificos asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["objetivo"] = ($row2["objetivo"]);
                                array_push($objetivos, $row2);
                            }
                        }
                        $departamentos = array();
                        $sql2=('SELECT idDepartamento, nombre
                            FROM Departamentos 
                            order by idDepartamento asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($departamentos, $row2);
                            }
                        }
                        $personas = array();
                        $sql2=('SELECT idUsuarioCampo, nombre
                            FROM UsuariosCampos 
                            WHERE idCampo = '.$_SESSION["idCampo"].'
                            order by idUsuarioCampo asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($personas, $row2);
                            }
                        }
                        echo '{ "success" : 1, "departamentos" : '.json_encode($departamentos).' , "personas" : '.json_encode($personas).', "objetivos" : '.json_encode($objetivos).'}';
                        exit(0);
                    break;
                    case 'guardaLinea':    
                        checarSesionUsuarios();
                        $idPeriodo = $_POST["idPeriodo"];
                        $idLinea = $_POST["idLinea"];
                        $meta = $_POST["meta"];
                        $alcanzado1 = $_POST["alcanzado1"];
                        $alcanzado2 = $_POST["alcanzado2"];
                        $alcanzado3 = $_POST["alcanzado3"];
                        $alcanzado4 = $_POST["alcanzado4"];
                        $idGrupo = $_SESSION["idGrupo"];
                        $ahora = time();
                        $banderaTrimestre1 = 147528000;
                        $banderaTrimestre2 = 1483228800;
                        $banderaTrimestre3 = 1491004800;
                        $banderaTrimestre4 = 1498867200;
                        //-1 es igual a not set todavia
                        $sql2=("SELECT idMeta, meta, alcanzado1, alcanzado2, alcanzado3, alcanzado4 FROM Metas WHERE idLinea = ".$idLinea." AND idGrupo = ".$idGrupo);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                if($row2["alcanzado1"]==-1 && $ahora > $banderaTrimestre1)
                                {
                                    $sql=("UPDATE Metas SET alcanzado1 =  ".$alcanzado1." WHERE idMeta = ".$row2["idMeta"]);
                                    if($query = mysqli_query($recordset->conn,$sql)){}
                                }
                                if($row2["alcanzado2"]==-1 && $ahora > $banderaTrimestre2)
                                {
                                    $sql=("UPDATE Metas SET alcanzado2 =  ".$alcanzado2." WHERE idMeta = ".$row2["idMeta"]);
                                    if($query = mysqli_query($recordset->conn,$sql)){}
                                }
                                if($row2["alcanzado3"]==-1 && $ahora > $banderaTrimestre3)
                                {
                                    $sql=("UPDATE Metas SET alcanzado3 =  ".$alcanzado3." WHERE idMeta = ".$row2["idMeta"]);
                                    if($query = mysqli_query($recordset->conn,$sql)){}
                                }
                                if($row2["alcanzado4"]==-1 && $ahora > $banderaTrimestre4)
                                {
                                    $sql=("UPDATE Metas SET alcanzado4 =  ".$alcanzado4." WHERE idMeta = ".$row2["idMeta"]);
                                    if($query = mysqli_query($recordset->conn,$sql)){}
                                }
                            }
                            else
                            {
                                if($meta>-1)
                                {
                                    $sql=("INSERT INTO Metas (idLinea, idPeriodo, idGrupo, meta, alcanzado1, alcanzado2, alcanzado3, alcanzado4) VALUES 
                                        (".$idLinea.",".$idPeriodo.",".$idGrupo.",".$meta.", -1, -1, -1, -1 )");
                                    if($query = mysqli_query($recordset->conn,$sql))
                                    {
                                        $idMeta = mysqli_insert_id($recordset->conn);
                                        if($ahora > $banderaTrimestre1)
                                        {
                                            $sql=("UPDATE Metas SET alcanzado1 =  ".$alcanzado1." WHERE idMeta = ".$idMeta);
                                            if($query = mysqli_query($recordset->conn,$sql)){}
                                        }
                                        if($ahora > $banderaTrimestre2)
                                        {
                                            $sql=("UPDATE Metas SET alcanzado2 =  ".$alcanzado2." WHERE idMeta = ".$idMeta);
                                            if($query = mysqli_query($recordset->conn,$sql)){}
                                        }
                                        if($ahora > $banderaTrimestre3)
                                        {
                                            $sql=("UPDATE Metas SET alcanzado3 =  ".$alcanzado3." WHERE idMeta = ".$idMeta);
                                            if($query = mysqli_query($recordset->conn,$sql)){}
                                        }
                                        if($ahora > $banderaTrimestre4)
                                        {
                                            $sql=("UPDATE Metas SET alcanzado4 =  ".$alcanzado4." WHERE idMeta = ".$idMeta);
                                            if($query = mysqli_query($recordset->conn,$sql)){}
                                        }
                                    }
                                }
                            }
                        }   
                        echo '{ "success" : 1 }';
                        exit();                     
                    break;
                }
        break;
        case 'asignaciones':
                switch($accion)
                {
                    case 'verUsuariosDepartamentos':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $personas = array();
                        $sql2=("SELECT uc.nombre as persona, d.nombre as departamento, dp.idDepartamentosUsuarios 
                        FROM DepartamentosUsuarios dp 
                        INNER JOIN Departamentos d on d.idDepartamento = dp.idDepartamento
                        INNER JOIN UsuariosCampos uc on uc.idUsuarioCampo = dp.idUsuarioCampo
                        WHERE uc.idCampo = ".$_SESSION["idCampo"]."
                            order by dp.idDepartamentosUsuarios asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["departamento"] = ($row2["departamento"]);
                                $row2["persona"] = ($row2["persona"]);
                                array_push($personas, $row2);
                            }
                            echo '{ "success" : 1, "personas" : '.json_encode($personas).'}';
                            exit(0);
                        }
                    break;
                    case 'agregarAsignacionPersonaDepartamento':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $idUsuarioCampo = intval($_POST['idUsuarioCampo']);
                        $idDepartamento = intval($_POST['idDepartamento']);
                        $sql3 = ("SELECT idDepartamentosUsuarios FROM DepartamentosUsuarios WHERE idDepartamento = ".$idDepartamento." AND idUsuarioCampo = ".$idUsuarioCampo."");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                echo '{ "success" : 2 }';//ya existe
                                exit(0);
                            }
                            else
                            {
                                $sql2=("SELECT insertDepartamentosUsuariosIdDepartamento (".$idDepartamento.", ".$idUsuarioCampo.")");
                                //$sql2=("INSERT INTO DepartamentosUsuarios (idDepartamento, idUsuarioCampo) VALUES (".$idDepartamento.", ".$idUsuarioCampo.")");
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                        }
                    break;
                }
        break;
        case 'menu':
                switch($accion)
                {
                    case 'cargaMenu':    
                        checarSesionUsuarios();
                        $menu = array();
                        $sql2=("SELECT idDepartamento, nombre FROM Departamentos order by idDepartamento desc");
                        if(isset($_SESSION["departamento"]))
                        {
                            if($_SESSION["departamento"]!=0)
                            {
                                $sql2=("SELECT idDepartamento, nombre FROM Departamentos WHERE idDepartamento = ".$_SESSION["departamento"]." order by idDepartamento desc");    
                            }
                        }
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($menu, $row2);
                            }
                            echo '{ "success" : 1, "menu" : '.json_encode($menu).'}';
                            exit(0);
                        }
                    break;
                }
        break;
        case 'distritos':
                switch($accion)
                {
                    case 'resumenAnualPastores':  
                        checarSesionUsuarios();
                        $year = $_POST['year'];
                        $idDistrito = "";
                        $first = true;
                        $sql3=("SELECT idDistrito
                                    FROM Distritos 
                                    WHERE idCampo = ".$_SESSION["idCampo"]." order by nombre asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                if($first)
                                {
                                    $first=false;
                                    $idDistrito = $row3["idDistrito"];
                                }
                                else
                                {
                                    $idDistrito = $idDistrito.",".$row3["idDistrito"];
                                }
                            }
                        }
                        $idUsuario = "";
                        $first = true;
                        $pastores = array();
                        $sql2=('SELECT DISTINCT idUsuario FROM InformePastoral WHERE idDistrito in ('.$idDistrito.') AND SUBSTRING(fecha,1,4) = "'.$year.'" order by idUsuario asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                array_push($pastores, $row2["idUsuario"]);
                                if($first)
                                {
                                    $first=false;
                                    $idUsuario = $row2["idUsuario"];
                                }
                                else
                                {
                                    $idUsuario = $idUsuario.",".$row2["idUsuario"];
                                }
                            }
                        }
                        //para cada pastor, obtengo su trabajo de informe y l pongo por resumen por bautsmos, visitacion , etc
                        $i=0;
                        $pastoresTabla = array();
                        for($i=0;$i<count($pastores);$i=$i+1)
                        {
                            $rowX = array();
                            $rowX["idUsuario"] = $pastores[$i];
                            $rowX["nombre"] = "";
                            $sql2=('SELECT nombre FROM UsuariosCampos WHERE idUsuarioCampo in ('.$pastores[$i].')');
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                {
                                    $rowX["nombre"] = ($row2["nombre"]);
                                }
                            }
                            $rowX["bautismos"] = array();
                            $rowX["bautismos"][0]=0;
                            $rowX["bautismos"][1]=0;
                            $rowX["bautismos"][2]=0;
                            $rowX["bautismos"][3]=0;
                            $rowX["bautismos"][4]=0;
                            $rowX["bautismos"][5]=0;
                            $rowX["bautismos"][6]=0;
                            $rowX["bautismos"][7]=0;
                            $rowX["bautismos"][8]=0;
                            $rowX["bautismos"][9]=0;
                            $rowX["bautismos"][10]=0;
                            $rowX["bautismos"][11]=0;
                            $rowX["visitacion"] = array();
                            $rowX["visitacion"][0]=0;
                            $rowX["visitacion"][1]=0;
                            $rowX["visitacion"][2]=0;
                            $rowX["visitacion"][3]=0;
                            $rowX["visitacion"][4]=0;
                            $rowX["visitacion"][5]=0;
                            $rowX["visitacion"][6]=0;
                            $rowX["visitacion"][7]=0;
                            $rowX["visitacion"][8]=0;
                            $rowX["visitacion"][9]=0;
                            $rowX["visitacion"][10]=0;
                            $rowX["visitacion"][11]=0;
                            $rowX["sermones"] = array();
                            $rowX["sermones"][0]=0;
                            $rowX["sermones"][1]=0;
                            $rowX["sermones"][2]=0;
                            $rowX["sermones"][3]=0;
                            $rowX["sermones"][4]=0;
                            $rowX["sermones"][5]=0;
                            $rowX["sermones"][6]=0;
                            $rowX["sermones"][7]=0;
                            $rowX["sermones"][8]=0;
                            $rowX["sermones"][9]=0;
                            $rowX["sermones"][10]=0;
                            $rowX["sermones"][11]=0;
                            $rowX["tesoreria"] = array();
                            $rowX["tesoreria"][0]="";
                            $rowX["tesoreria"][1]="";
                            $rowX["tesoreria"][2]="";
                            $rowX["tesoreria"][3]="";
                            $rowX["tesoreria"][4]="";
                            $rowX["tesoreria"][5]="";
                            $rowX["tesoreria"][6]="";
                            $rowX["tesoreria"][7]="";
                            $rowX["tesoreria"][8]="";
                            $rowX["tesoreria"][9]="";
                            $rowX["tesoreria"][10]="";
                            $rowX["tesoreria"][11]="";
                            $sql2=('SELECT idUsuario, fecha, visitas, juntas, sermones, iglesiaPredico, tesoreria, bautismos, paginas FROM InformePastoral WHERE idDistrito in ('.$idDistrito.') AND idUsuario in ('.$pastores[$i].') AND SUBSTRING(fecha,1,4) = "'.$year.'" order by fecha asc');
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                {
                                    $row2["iglesiaPredico"] = ($row2["iglesiaPredico"]);
                                    $row2["tesoreria"] = ($row2["tesoreria"]);
                                    $mes = intval(substr($row2["fecha"],5,2));
                                    $mes=$mes-1;
                                    $rowX["bautismos"][$mes]=$rowX["bautismos"][$mes]+ intval($row2["bautismos"]);
                                    $rowX["visitacion"][$mes]=$rowX["visitacion"][$mes]+ intval($row2["visitas"]);
                                    $rowX["sermones"][$mes]=$rowX["sermones"][$mes]+ intval($row2["sermones"]);
                                    if(trim($row2["tesoreria"])!="")
                                    {
                                        $rowX["tesoreria"][$mes]=$rowX["tesoreria"][$mes].$row2["tesoreria"]."<br>";    
                                    }
                                }
                            }
                            array_push($pastoresTabla, $rowX);
                        }
                        echo '{ "success" : "1", "pastores" : '.json_encode($pastoresTabla).'}';
                        exit(0);
                    break;
                    case 'nuevoOModificaBlancoPastoral':  
                        checarSesionUsuarios();
                        
                        $idDistrito = $_POST['idDistrito'];
                        $year = $_POST['year'];
                        $blanco = $_POST['blanco'];

                        if($blanco=="")
                        {
                            $blanco=0;
                        }
                        
                         
                        $sql = "";
                        $sql2=("SELECT idBlancosBautismales FROM BlancosBautismales WHERE idDistrito = ".$idDistrito." AND year = ".$year);
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $sql=("UPDATE BlancosBautismales SET blanco =  ".$blanco." WHERE idDistrito = ".$idDistrito." AND year = ".$year);
                            }
                            else
                            {
                                $sql=("INSERT INTO BlancosBautismales (idDistrito, year, blanco) VALUES (".$idDistrito.",".$year.",".$blanco.")");
                            }
                        }
                      //  echo $sql;
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : "1" }';
                            exit(0);
                        }
                    break;
                    case 'nuevoOModificaInformePastoralAbierto':  
                        checarSesionDistrito();  
                        
                        $idDistrito = $_SESSION['idDistrito'];
                        $idUsuario = $_SESSION['idUsuarioCampo'];
                        $fecha = $_POST['fecha'];


                        $observaciones = trim(($_POST['observaciones']));
                        $gema = trim(($_POST['gema']));
                        
                        $sql = "";
                        $sql2=("SELECT idInformePastoralAbierto FROM InformePastoralAbierto WHERE idDistrito = ".$idDistrito." AND idUsuario = ".$idUsuario." AND fecha = '".$fecha."'");
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $sql=("UPDATE InformePastoralAbierto SET observaciones = '".$observaciones."', gema = '".$gema."' WHERE idDistrito = ".$idDistrito." AND idUsuario = ".$idUsuario." AND fecha = '".$fecha."'");
                            }
                            else
                            {
                                $sql=("INSERT INTO InformePastoralAbierto (idDistrito, idUsuario, fecha, observaciones, gema) VALUES (".$idDistrito.",".$idUsuario.",'".$fecha."','".$observaciones."','".$gema."')");
                            }
                        }
                      //  echo $sql;
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : "1" }';
                            exit(0);
                        }
                    break;
                    case 'nuevoOModificaInformePastoral':  
                        checarSesionDistrito();  
                        
                        $idDistrito = $_SESSION['idDistrito'];
                        $idUsuario = $_SESSION['idUsuarioCampo'];
                        $fecha = $_POST['fecha'];

                        $visitas = $_POST['visitas'];
                        $juntas = $_POST['juntas'];
                        $sermones = $_POST['sermones'];
                        $bautismos = $_POST['bautismos'];
                        $paginas = $_POST['paginas'];
                        if($visitas=="")
                        {
                            $visitas=0;
                        }
                        if($juntas=="")
                        {
                            $juntas=0;
                        }
                        if($sermones=="")
                        {
                            $sermones=0;
                        }
                        if($bautismos=="")
                        {
                            $bautismos=0;
                        }
                        if($paginas=="")
                        {
                            $paginas=0;
                        }


                        $iglesiaPredico = trim(($_POST['iglesiaPredico']));
                        $tesoreria = trim(($_POST['tesoreria']));
                        
                        $sql = "";
                        $sql2=("SELECT idInformePastoral FROM InformePastoral WHERE idDistrito = ".$idDistrito." AND idUsuario = ".$idUsuario." AND fecha = '".$fecha."'");
                        //echo $sql2;
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $sql=("UPDATE InformePastoral SET visitas =  ".$visitas.", juntas = ".$juntas.", sermones = ".$sermones.", iglesiaPredico = '".$iglesiaPredico."', tesoreria = '".$tesoreria."', bautismos =  ".$bautismos.", paginas =  ".$paginas."  WHERE idDistrito = ".$idDistrito." AND idUsuario = ".$idUsuario." AND fecha = '".$fecha."'");
                            }
                            else
                            {
                                $sql=("INSERT INTO InformePastoral (idDistrito, idUsuario, fecha, visitas, juntas, sermones, iglesiaPredico, tesoreria, bautismos, paginas) VALUES (".$idDistrito.",".$idUsuario.",'".$fecha."',".$visitas.",".$juntas.",".$sermones.",'".$iglesiaPredico."','".$tesoreria."',".$bautismos.",".$paginas.")");
                            }
                        }
                      //  echo $sql;
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : "1" }';
                            exit(0);
                        }
                    break;
                     case 'getInfoBlanco':    
                        checarSesionUsuarios();
                        $idCampo = intval($_SESSION['idCampo']);
                        $year = $_POST["year"];
                        $data = array();
                      /*  $sql2=('SELECT d.idDistrito, d.nombre, IFNULL(b.year,0) as year, IFNULL(b.blanco,0) as blanco  FROM Distritos d
                            LEFT JOIN BlancosBautismales b on b.idDistrito = d.idDistrito
                         WHERE d.idCampo = '.$idCampo.' AND (b.year = '.$year.' OR b.idDistrito IS NULL) order by d.idDistrito asc');*/
                        $sql2=('SELECT d.idDistrito, d.nombre FROM Distritos d
                         WHERE d.idCampo = '.$idCampo.' order by d.idDistrito asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row = array();
                                $row["nombre"] = ($row2["nombre"]);
                                $row["idDistrito"] = $row2["idDistrito"];
                                $row["year"] = 0;
                                $row["blanco"] = 0;
                                $sql=('SELECT year, blanco FROM BlancosBautismales 
                                 WHERE idDistrito = '.$row2["idDistrito"].' AND year = '.$year);
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row3=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        $row["year"] = $row3["year"];
                                        $row["blanco"] = $row3["blanco"];
                                    }
                                }
                                array_push($data, $row);
                            }
                            echo '{ "success" : 1, "data" : '.json_encode($data).' }';exit(0);
                        }
                    break;
                    case 'getInfoResumenDistrito':
                        checarSesionUsuarios();
                        $year = $_POST["year"];
                        $idDistrito = $_POST["idDistrito"];
                        $idUsuario = $_POST["idUsuario"];
                        $data = array();
                        $i=1;
                        for($i=1;$i<=12;$i=$i+1)
                        {
                            $mesS = "".$i;
                            if($i<10)
                            {
                                $mesS="0".$i;
                            } 
                            $buscar = $year."-".$mesS;
                            $sql2=('SELECT IFNULL(SUM(bautismos),0) as bautismos, IFNULL(SUM(visitas),0) as visitas FROM InformePastoral WHERE idDistrito = '.$idDistrito.'  AND idUsuario in ('.$idUsuario.') AND SUBSTRING(fecha,1,7) = "'.$buscar.'" order by idUsuario asc, fecha asc');
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                {
                                    $bautismos = intval($row2["bautismos"]);
                                    $visitas = intval($row2["visitas"]);
                                    $row = array();
                                    $row["bautismos"] = $bautismos;
                                    $row["visitas"] = $visitas;
                                    $row["fecha"] = $buscar;
                                    $row["mes"] = $mesS;
                                    array_push($data, $row);
                                }
                            }
                        }
                        echo '{ "success" : 1, "data" : '.json_encode($data).', "idUsuario" : '.$idUsuario.' }';
                        exit(0);
                    break;
                    case 'getInfo':    
                        checarSesionUsuarios();
                        $idDistrito = 0;
                        if(isset($_SESSION['idDistrito']))
                        {
                            $idDistrito = intval($_SESSION['idDistrito']);    
                        }
                        $mes = intval($_POST["n"]);
                        $year = $_POST["year"];
                        $data = array();
                        $idUsuario = $_SESSION['idUsuarioCampo'];
                        $mes=$mes+1;
                        $mesS = "".$mes;
                        if($mes<10)
                        {
                            $mesS="0".$mes;
                        }
                        $buscar = $year."-".$mesS;
                        if(isset($_SESSION["departamento"]))
                        {
                            if($_SESSION["departamento"]==0)
                            {
                                $idDistrito = $_POST["idDistrito"];
                                $idUsuario = "";
                                $first = true;
                                $sql2=('SELECT DISTINCT idUsuario FROM InformePastoral WHERE idDistrito = '.$idDistrito.' AND SUBSTRING(fecha,1,7) = "'.$buscar.'" order by idUsuario asc');
                                //echo $sql2;
                                //exit();
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                    {
                                        if($first)
                                        {
                                            $first=false;
                                            $idUsuario = $row2["idUsuario"];
                                        }
                                        else
                                        {
                                            $idUsuario = $idUsuario.",".$row2["idUsuario"];
                                        }
                                    }
                                }
                            }
                        }
                        $personasArray = array();
                        $sql2=('SELECT idUsuarioCampo, nombre FROM UsuariosCampos WHERE idUsuarioCampo in ('.$idUsuario.')');



                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                $sql3=('SELECT gema, observaciones FROM InformePastoralAbierto WHERE idDistrito = '.$idDistrito.' AND idUsuario = '.$row2["idUsuarioCampo"].' AND fecha = "'.$buscar.'" order by idUsuario asc');
                                $row2["gema"] = "";
                                $row2["observaciones"] = "";
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $observaciones = ($row3["observaciones"]);
                                        $gema = ($row3["gema"]);
                                        $gema = trim(preg_replace('/\s+/', ' ', $gema));
                                        $observaciones = trim(preg_replace('/\s+/', ' ', $observaciones));
                                        $gema = str_replace('"', '\"', $gema);
                                        $observaciones = str_replace('"', '\"', $observaciones);
                                        $row2["gema"] = $gema;
                                        $row2["observaciones"] = $observaciones;

                                        //$row2["gema"] = "";
                                        //$row2["observaciones"] = "";
                                
                                    }
                                }
                                array_push($personasArray, $row2);
                            }
                        }

                        $observaciones = "";
                        $gema = "";
                        $sql2=('SELECT gema, observaciones FROM InformePastoralAbierto WHERE idDistrito = '.$idDistrito.' AND idUsuario in ('.$idUsuario.') AND fecha = "'.$buscar.'" order by idUsuario asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $observaciones = ($row2["observaciones"]);
                                $gema = ($row2["gema"]);
                                $gema = trim(preg_replace('/\s+/', ' ', $gema));
                                $observaciones = trim(preg_replace('/\s+/', ' ', $observaciones));

                                $gema = str_replace("\n", "", $gema);
                                $gema = str_replace("\n", "", $gema);
                                $gema = str_replace("\n", "", $gema);
                                $gema = str_replace("\n", "", $gema);
                                $gema = str_replace("\n", "", $gema);
                                $gema = str_replace("\n", "", $gema);

                                $gema = str_replace('"', '\"', $gema);
                                $gema = str_replace('"', '\"', $gema);
                                $gema = str_replace('"', '\"', $gema);
                                $gema = str_replace('"', '\"', $gema);
                                $gema = str_replace('"', '\"', $gema);
                                $gema = str_replace('"', '\"', $gema);
                                $gema = str_replace('"', '\"', $gema);



                                $observaciones = str_replace("\n", "", $observaciones);
                                $observaciones = str_replace("\n", "", $observaciones);
                                $observaciones = str_replace("\n", "", $observaciones);
                                $observaciones = str_replace("\n", "", $observaciones);
                                $observaciones = str_replace("\n", "", $observaciones);
                                $observaciones = str_replace("\n", "", $observaciones);

                                $observaciones = str_replace('"', '\"', $observaciones);
                                $observaciones = str_replace('"', '\"', $observaciones);
                                $observaciones = str_replace('"', '\"', $observaciones);
                                $observaciones = str_replace('"', '\"', $observaciones);
                                $observaciones = str_replace('"', '\"', $observaciones);
                                $observaciones = str_replace('"', '\"', $observaciones);
                                        
                              /*  $observaciones = $row2["observaciones"];
                                $gema = $row2["gema"];
                                $gema = str_replace('"', '\"', $gema);
                                $observaciones = str_replace('"', '\"', $observaciones);*/
                            }
                        }
                        $sql2=('SELECT idUsuario, fecha, visitas, juntas, sermones, iglesiaPredico, tesoreria, bautismos, paginas FROM InformePastoral WHERE idDistrito = '.$idDistrito.'  AND idUsuario in ('.$idUsuario.') AND SUBSTRING(fecha,1,7) = "'.$buscar.'" order by idUsuario asc, fecha asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["iglesiaPredico"] = ($row2["iglesiaPredico"]);
                                $row2["tesoreria"] = ($row2["tesoreria"]);
                                array_push($data, $row2);
                            }
                        }
                        $iglesias = array();
                        $sql2=('SELECT idGrupo, nombre FROM Grupos WHERE idDistrito = '.$idDistrito);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($iglesias, $row2);
                            }
                        }
                        $blanco = 0;
                        $sql2=('SELECT blanco FROM BlancosBautismales WHERE idDistrito = '.$idDistrito.' AND year = '.$year);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $blanco = $row2["blanco"];
                            }
                        }
                        $alcanzado = 0;
                        $sql2=('SELECT fecha, bautismos FROM InformePastoral WHERE idDistrito = '.$idDistrito.'  AND idUsuario in ('.$idUsuario.') AND SUBSTRING(fecha,1,4) = "'.$year.'" order by idUsuario asc, fecha asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $mesActual = intval(substr($row2["fecha"],5,2));
                                if($mesActual<=$mes)
                                {
                                    $alcanzado = $alcanzado + intval($row2["bautismos"]);
                                }
                            }
                        }
                        
                        $sql2=('SELECT nombre FROM Distritos WHERE idDistrito = '.$idDistrito);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                $row2["nombre"] = trim(preg_replace('/\s\s+/', ' ', $row2["nombre"]));
                                $gema="";
                                $observaciones="";
                                echo '{ "success" : 1, "gema" : "'.$gema.'", "observaciones" : "'.$observaciones.'", "alcanzado" : '.$alcanzado.', "blanco" : '.$blanco.', "nombre" : "'.$row2["nombre"].'", "personas" : '.json_encode($personasArray).', "iglesias" : '.json_encode($iglesias).', "data" : '.json_encode($data).' }';
                                exit(0);
                            }
                        }
                    break;
                    case 'eliminarDistrito':    
                        checarSesionUsuarios();
                        $idDistrito = intval($_POST['idDistrito']);
                        $sql2=('SELECT idGrupo FROM Grupos WHERE idDistrito = '.$idDistrito);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                               echo '{ "success" : -1 }';
                                exit(0);
                            }
                        }
                        $sql2=('DELETE FROM Distritos WHERE idDistrito = '.$idDistrito);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'cambiaIglesiaDeDistrito':    
                        checarSesionUsuarios();
                        $idGrupo = intval($_POST['idGrupo']);
                        $idDistrito = intval($_POST['idDistrito']);
                        $sql2=('UPDATE Grupos SET idDistrito = '.$idDistrito.' WHERE idGrupo = '.$idGrupo);
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'mandarCorreo':  
                        checarSesionUsuarios();
                        $mensaje = $_POST["mensaje"];
                        $aquien = $_POST["aquien"];
                        $titulo = $_POST["titulo"];
                        
                        $idGrupoDeCampos = '';
                        $first = true;
                        $campos = array();
                        $distritosCorreos = array();
                        $distritosNombres = array();
                        $camposCorreos = array();
                        $camposNombres = array();

                        $sql4=("SELECT  u.idUsuarioCampo, u.nombre, u.correo
                                            FROM DistritosUsuarios du 
                                            INNER JOIN UsuariosCampos u on u.idUsuarioCampo = du.idUsuarioCampo
                                            order by u.idUsuarioCampo asc");
                        if($query4 = mysqli_query($recordset->conn,$sql4))
                        {
                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                            {
                                array_push($distritosCorreos, $row4["correo"]);
                                array_push($distritosNombres, $row4["nombre"]);
                            }
                        }

                        $sql4=("SELECT  u.idUsuarioCampo, u.nombre, u.correo FROM DistritosUsuarios du RIGHT JOIN UsuariosCampos u on u.idUsuarioCampo = du.idUsuarioCampo WHERE du.idUsuarioCampo IS NULL order by u.idUsuarioCampo asc");
                        if($query4 = mysqli_query($recordset->conn,$sql4))
                        {
                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                            {
                                array_push($camposCorreos, $row4["correo"]);
                                array_push($camposNombres, $row4["nombre"]);
                            }
                        }

                        require 'PHPMailerAutoload.php';
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Debugoutput = 'html';
                        $mail->Host = 'smtp.gmail.com';                               
                        $mail->Port = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth = true;
                        $mail->Username = "sevenplus@adventistasumn.org";
                        $mail->Password = "dank_Gott1863";
                        $mail->setFrom('cearo@adventistasumn.org', 'AVISO PEST');
                        $mail->addReplyTo('cearo@adventistasumn.org', 'Dr. Cea');
                        $mail->addAddress("cearo@adventistasumn.org", 'Dr. Cea');
                        if(intval($aquien)==0){//admon y departamentales
                            $cuantos = count($camposCorreos);
                            for($i=0;$i<$cuantos;$i=$i+1){
                              $mail->addBCC($camposCorreos[$i], $camposNombres[$i]);
                            }  
                        }
                        if(intval($aquien)==1){//distritos
                            $cuantos = count($camposCorreos);
                            for($i=0;$i<$cuantos;$i=$i+1){
                              $mail->addBCC($distritosCorreos[$i], $distritosNombres[$i]);
                            }  
                        }
                        //foreach ($distritosCorreos as $key => $value) {}  
                        //$mail->addBCC('alonsopf@gmail.com', 'Persona');
                        //$mail->addBCC('alonsopf@hotmail.com', 'CCC');
                        
                        $mail->Subject = $titulo;
                        $mail->msgHTML($mensaje);
                        if (!$mail->send()) {
                           echo '{ "success" : -1 , "error" : '.$mail->ErrorInfo.'}';
                        } else {
                            echo '{ "success" : 1 }';
                        }
                        exit(0);
                    break;
                    case 'reporteDirectorio':  
                        checarSesionUsuarios();
                        $idGrupoDeCampos = '';
                        $first = true;
                        $campos = array();
                        $idCampo = $_SESSION["idCampo"];
                        $sqlZ=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE idCampo = ".$idCampo." order by idCampo asc");
                        if($idCampo==11)//UMN
                        {
                            $sqlZ=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE idCampo != 11 order by idCampo asc");
                        }
                        if($queryZ = mysqli_query($recordset->conn,$sqlZ))
                        {
                            while($rowZ=mysqli_fetch_array($queryZ,MYSQLI_ASSOC))
                            {
                                $idCampoEnTurno  = $rowZ["idCampo"];  
                                $rowParaCampo = array();
                                $rowZ["nombre"] = ($rowZ["nombre"]);
                                $rowParaCampo["nombre"] = $rowZ["nombre"];
                                $rowParaCampo["idCampo"] = $rowZ["idCampo"];
                                $rowParaCampo["distritos"] = array();
                                $idGrupoDeCampos = '';
                                $first = true;  
                                $sql3=("SELECT idDistrito, nombre
                                    FROM Distritos 
                                    WHERE idCampo = ".$idCampoEnTurno." order by nombre asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowParaDistrito = array();
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $rowParaDistrito["nombre"] = $row3["nombre"];
                                        $rowParaDistrito["idDistrito"] = $row3["idDistrito"];
                                        $rowParaDistrito["iglesias"] = array();
                                        $sql4=("SELECT  u.idUsuarioCampo, u.nombre, u.correo
                                            FROM DistritosUsuarios du 
                                            INNER JOIN UsuariosCampos u on u.idUsuarioCampo = du.idUsuarioCampo
                                            WHERE du.idDistrito = ".$row3["idDistrito"]." order by u.idUsuarioCampo asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                $rowParaGrupo = array();
                                                $row4["nombre"] = ($row4["nombre"]);
                                                $rowParaGrupo["nombre"] = $row4["nombre"];
                                                $rowParaGrupo["correo"] = $row4["correo"];
                                                $rowParaGrupo["idUsuarioCampo"] = $row4["idUsuarioCampo"];
                                                array_push($rowParaDistrito["iglesias"], $rowParaGrupo);
                                            }
                                        }
                                        array_push($rowParaCampo["distritos"], $rowParaDistrito);
                                    }
                                }
                                array_push($campos, $rowParaCampo);
                            }
                        }
                        echo '{ "success" : 1, "campos" : '.json_encode($campos).' }';
                        exit();
                    break;
                    case 'bajarVamosPorMas':  
                        checarSesionUsuarios();
                    break;
                    case 'reporteVamosPorMas':  
                       // checarSesionUsuarios();
                        $idGrupoDeCampos = '';
                        $first = true;
                        $campos = array();
                        $idCampo = $_SESSION["idCampo"];
                        $anio = $_POST["anio"];
                        /*$Ndistritos = 0;
                        $Ncampos = 0;
                        $NIglesias = 0;
                        $NLaicos = 0;*/
                        $sqlZ=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE idCampo = ".$idCampo." order by idCampo asc");
                        if($idCampo==11)//UMN
                        {
                            $sqlZ=("SELECT idCampo, nombre
                                    FROM Campos 
                                    WHERE idCampo != 11 order by idCampo asc");
                        }
                        if($queryZ = mysqli_query($recordset->conn,$sqlZ))
                        {
                            while($rowZ=mysqli_fetch_array($queryZ,MYSQLI_ASSOC))
                            {
                                $idCampoEnTurno  = $rowZ["idCampo"];  
                                $rowParaCampo = array();
                                $rowZ["nombre"] = ($rowZ["nombre"]);
                                $rowParaCampo["nombre"] = $rowZ["nombre"];
                                $rowParaCampo["idCampo"] = $rowZ["idCampo"];
                                $rowParaCampo["distritos"] = array();
                                $idGrupoDeCampos = '';
                                $first = true;  
                                $sql3=("SELECT idDistrito, nombre
                                    FROM Distritos 
                                    WHERE idCampo = ".$idCampoEnTurno." order by nombre asc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $rowParaDistrito = array();
                                        $row3["nombre"] = ($row3["nombre"]);
                                        $rowParaDistrito["nombre"] = $row3["nombre"];
                                        $rowParaDistrito["idDistrito"] = $row3["idDistrito"];
                                        $rowParaDistrito["iglesias"] = array();
                                        $sql4=("SELECT idGrupo, nombre, tipo
                                            FROM Grupos 
                                            WHERE idDistrito = ".$row3["idDistrito"]." order by idGrupo asc");
                                        if($query4 = mysqli_query($recordset->conn,$sql4))
                                        {
                                            while($row4=mysqli_fetch_array($query4,MYSQLI_ASSOC))
                                            {
                                                if($first)
                                                {
                                                    $first = false;
                                                    $idGrupoDeCampos = $row4["idGrupo"];
                                                }
                                                else
                                                {
                                                    $idGrupoDeCampos = $idGrupoDeCampos.",".$row4["idGrupo"];
                                                }
                                                $rowParaGrupo = array();
                                                $row4["nombre"] = ($row4["nombre"]);
                                                $rowParaGrupo["nombre"] = $row4["nombre"];
                                                $rowParaGrupo["tipo"] = $row4["tipo"];
                                                $rowParaGrupo["idGrupo"] = $row4["idGrupo"];
                                                $rowParaGrupo["laicos"] = array();
                                                $sql5=("SELECT idLaico, nombre, celular, correo, numero, idUsuario
                                                    FROM Laicos 
                                                    WHERE idGrupo = ".$row4["idGrupo"]." AND anio = ".$anio." order by idLaico asc");
                                                if($query5 = mysqli_query($recordset->conn,$sql5))
                                                {
                                                    while($row5=mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                                    {
                                                        $rowParaLaico = array();
                                                        $row5["nombre"] = ($row5["nombre"]);
                                                        $row5["celular"] = ($row5["celular"]);
                                                        $row5["correo"] = ($row5["correo"]);
                                                        $rowParaLaico["nombre"] = $row5["nombre"];
                                                        $rowParaLaico["celular"] = $row5["celular"];
                                                        $rowParaLaico["correo"] = $row5["correo"];
                                                        $rowParaLaico["numero"] = $row5["numero"];
                                                        $rowParaLaico["idUsuario"] = $row5["idUsuario"];
                                                        $rowParaLaico["idLaico"] = $row5["idLaico"];
                                                        array_push($rowParaGrupo["laicos"], $rowParaLaico);
                                                    }
                                                }
                                                array_push($rowParaDistrito["iglesias"], $rowParaGrupo);
                                            }
                                        }
                                        array_push($rowParaCampo["distritos"], $rowParaDistrito);
                                    }
                                }
                                array_push($campos, $rowParaCampo);
                            }
                        }
                        echo '{ "success" : 1, "campos" : '.json_encode($campos).' }';
                        exit();
                    break;
                    case 'nuevoOModificaVamosPorMas':  
                        checarSesionUsuarios();
                        $laico = (trim($_POST['laico']));
                        $celular = ($_POST['celular']);
                        $correo = ($_POST['correo']);
                        $idGrupo = intval($_POST['idGrupo']);
                        $idLaico = intval($_POST['idLaico']);
                        $anio = intval($_POST['anio']);
                        $numero = intval($_POST['numero']);
                        if($laico!="")
                        {
                            if($idLaico==0)
                            {
                                $sql=("INSERT INTO Laicos (anio, idGrupo, nombre, celular, correo, numero, idUsuario) VALUES (".$anio.",".$idGrupo.",'".$laico."','".$celular."','".$correo."',".$numero.",".$_SESSION["idUsuarioCampo"]." )");
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    echo '{ "success" : 1 }';
                                    exit(0);
                                }
                            }
                            else
                            {
                                $sql=("UPDATE Laicos SET nombre =  '".$laico."', celular = '".$celular."', correo = '".$correo."', idUsuario = ".$_SESSION["idUsuarioCampo"]." WHERE idLaico = ".$idLaico);
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    echo '{ "success" : 1 }';
                                    exit();
                                }
                            }    
                        }
                    break;
                    case 'dameIglesiasDelDistritoVamosPorMas':    
                        checarSesionUsuarios();
                        $idDistrito = -1;
                        if(isset($_POST["idDistrito"]))
                        {
                            $idDistrito = intval($_POST['idDistrito']);
                        }
                        else
                        {
                            if(isset($_SESSION["idDistrito"]))
                            {
                                $idDistrito = intval($_SESSION['idDistrito']);
                            }                            
                        }
                        $iglesias = array();
                        $idGrupoActual = 0;
                        $idGrupoAnterior = 0;
                        $first = true;
                        $guardaRow = array();
                        $sql3=("SELECT g.nombre, g.idGrupo, g.tipo, IFNULL(l.idLaico,0) as idLaico, IFNULL(l.nombre,'') as nombreLaico, IFNULL(l.correo,'') as correo, IFNULL(l.celular,'') as celular, IFNULL(l.numero,0) as numero, IFNULL( (SELECT count(lk.idGrupo) FROM Laicos lk WHERE lk.idGrupo = g.idGrupo GROUP BY lk.idGrupo ),0) as ver
                            FROM Grupos g 
                            LEFT JOIN Laicos l on l.idGrupo = g.idGrupo
                            WHERE g.idDistrito = ".$idDistrito."
                            order by g.tipo asc, g.nombre asc, l.numero asc");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $idGrupoActual = $row3["idGrupo"];
                                if($first)
                                {
                                    $first = false;
                                    $idGrupoAnterior = $row3["idGrupo"];
                                }
                                if($idGrupoActual!=$idGrupoAnterior)
                                {
                                    $guardaRow["numero"] = 2;
                                    $guardaRow["nombreLaico"] = '';
                                    $guardaRow["correo"] = '';
                                    $guardaRow["celular"] = '';
                                    //array_push($iglesias, $guardaRow);
                                }
                                $row3["nombre"] = ($row3["nombre"]);
                                $row3["nombreLaico"] = ($row3["nombreLaico"]);
                                $row3["correo"] = ($row3["correo"]);
                                $row3["celular"] = ($row3["celular"]);
                                $meteteDespues = false;
                                if(intval($row3["numero"])==0 && $row3["tipo"]==0)//no tiene nada!
                                {
                                    $row3["numero"]=1;    
                                    $meteteDespues = true;
                                }
                                if(intval($row3["numero"])==0 && $row3["tipo"]!=0)//no tiene nada!
                                {
                                    $row3["numero"]=1;    
                                    $meteteDespues = false;
                                }
                                if(intval($row3["numero"])==1 && $row3["tipo"]==0 && $row3["ver"]==1)//no tiene nada!
                                {

                                    $row3["numero"]=1;    
                                    $meteteDespues = true;
                                }
                                $guardaRow = $row3;
                                array_push($iglesias, $row3);
                                if($meteteDespues)//no tiene nada!
                                {
                                    $row4 = array();
                                    $row4["numero"]=2;
                                    $row4["nombre"] = $row3["nombre"];
                                    $row4["idGrupo"] = $row3["idGrupo"];
                                    $row4["tipo"] = $row3["tipo"];
                                    $row4["idLaico"] = 0;//$row3["idLaico"];
                                    $row4["nombreLaico"] = '';// $row3["nombreLaico"];
                                    $row4["correo"] = '';//$row3["correo"];
                                    $row4["celular"] = '';//$row3["celular"];
                                    array_push($iglesias, $row4);
                                }
                                $idGrupoAnterior = $row3["idGrupo"];
                            }
                            echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).' }';
                            exit(0);
                        }
                        
                        echo '{ "success" : 0 }';
                        exit(0);
                    break;
                    case 'dameIglesiasDelDistrito':    
                        checarSesionUsuarios();
                        $idDistrito = -1;
                        if(isset($_POST["idDistrito"]))
                        {
                            $idDistrito = intval($_POST['idDistrito']);
                        }
                        else
                        {
                            if(isset($_SESSION["idDistrito"]))
                            {
                                $idDistrito = intval($_SESSION['idDistrito']);
                            }                            
                        }
                        $iglesias = array();
                        $sql3=('SELECT g.nombre, g.idGrupo
                            FROM Grupos g 
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE g.idDistrito = '.$idDistrito.'
                            order by g.nombre asc');
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $row3["nombre"] = ($row3["nombre"]);
                                array_push($iglesias, $row3);
                            }
                            echo '{ "success" : 1, "iglesias" : '.json_encode($iglesias).' }';
                            exit(0);
                        }
                        
                        echo '{ "success" : 0 }';
                        exit(0);
                    break;
                    case 'dameDistritoDeLaIglesia':    
                        checarSesionUsuarios();
                        $idGrupo = intval($_POST['idGrupo']);
                        $sql2=('SELECT d.idDistrito, d.nombre
                            FROM Grupos g 
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE g.idGrupo = '.$idGrupo.'
                            order by g.nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                echo '{ "success" : 1, "nombre" : "'.$row2["nombre"].'" , "idDistrito" : '.$row2["idDistrito"].'}';
                                exit(0);
                            }
                        }
                        echo '{ "success" : 0 }';
                        exit(0);
                    break;
                    case 'verTodasLasIglesias':    
                        checarSesionUsuarios();
                        $iglesias = array();
                        $sql2=('SELECT g.idGrupo, g.nombre
                            FROM Grupos g 
                            INNER JOIN Distritos d on d.idDistrito = g.idDistrito
                            WHERE d.idCampo = '.$_SESSION["idCampo"].'
                            order by g.nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($iglesias, $row2);
                            }
                        }
                        $distritos = array();
                        $sql2=('SELECT idDistrito, nombre
                            FROM Distritos 
                            WHERE idCampo = '.$_SESSION["idCampo"].'
                            order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($distritos, $row2);
                            }
                        }
                        echo '{ "success" : 1, "distritos" : '.json_encode($distritos).' , "iglesias" : '.json_encode($iglesias).'}';
                        exit(0);
                    break;
                    case 'nuevoDistrito':    
                        checarSesionUsuarios();
                        $nombreDistrito = ($_POST["nombreDistrito"]);
                        $idDistrito = intval($_POST["idDistrito"]);
                        $claveAInsertar = '01';
                        $sql3 = ("SELECT clave 
                            FROM Distritos
                            WHERE idCampo = ".$_SESSION["idCampo"]." order by clave desc LIMIT 1");
                        if($query3 = mysqli_query($recordset->conn,$sql3))
                        {
                            if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                            {
                                $claveAInsertar = intval($row3["clave"]);
                                $claveAInsertar = $claveAInsertar + 1;
                                if($claveAInsertar<10)
                                {
                                    $claveAInsertar = '0'.$claveAInsertar;
                                }
                            }
                        }
                        
                        $sql2=("INSERT INTO Distritos (idCampo, nombre, clave) VALUES
                        (".$_SESSION["idCampo"].", '".$nombreDistrito."', '".$claveAInsertar."')");
                        if($idDistrito!=0)
                        {
                            $sql2=("UPDATE Distritos SET nombre = '".$nombreDistrito."' WHERE idDistrito = ".$idDistrito);
                        }
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            echo '{ "success" : 1 }';
                            exit(0);
                        }
                    break;
                    case 'nuevaAsignacionDistritoUsuario':    
                        checarSesionUsuarios();
                        $idDistrito = $_POST["idDistrito"];
                        $idUsuarioCampo = $_POST["idUsuarioCampo"];
                        $sql=("INSERT INTO DistritosUsuarios (idDistrito, idUsuarioCampo) VALUES 
                            (".$idDistrito.",".$idUsuarioCampo.")");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            $nombrePastor = '';
                            $correoPastor = '';
                            $sql2=("SELECT nombre, correo
                            FROM UsuariosCampos
                            WHERE idUsuarioCampo = ".$idUsuarioCampo."");
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                {
                                    $nombrePastor = ($row2["nombre"]);
                                    $correoPastor = $row2["correo"];
                                }
                            }
                            

                            $cadMensaje = '<h3>Estimado Pastor '.$nombrePastor.'</h3><br><p>Ha sido nombrado Pastor de las siguientes iglesias:</p><ul>';
                            $sql2=("SELECT d.idDistrito, d.nombre as distrito, d.clave as claveDistrito, g.nombre as iglesia, g.idGrupo, g.tipo, g.clave as claveIglesia, c.clave as claveCampo
                            FROM Distritos d
                            INNER JOIN Grupos g on d.idDistrito = g.idDistrito
                            INNER JOIN Campos c on c.idCampo = d.idCampo
                            WHERE d.idDistrito = ".$idDistrito."
                                order by g.idGrupo asc");
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                {

                                    $cadMensaje = $cadMensaje.'<li>'.($row2["iglesia"]).'   Clave: <b>'.$row2["claveCampo"].$row2["claveDistrito"].$row2["claveIglesia"].'</b></li>';
                                }
                                $cadMensaje = $cadMensaje.'</ul><p><a target="_blank" href="http://adventistasumn.org/transformame/">Si tiene alguna duda, favor de visitar la siguiente p&aacute;gina.</a></p><p>Dios lo siga bendiciendo.</p>';
                                require 'PHPMailerAutoload.php';
                                $mail = new PHPMailer();
                                $mail->isSMTP();
                                $mail->SMTPDebug = 0;
                                $mail->Debugoutput = 'html';
                                $mail->Host = 'smtp.gmail.com';                               
                                $mail->Port = 587;
                                $mail->SMTPSecure = 'tls';
                                $mail->SMTPAuth = true;
                                $mail->Username = "f.pecina@unav.edu.mx";
                                $mail->Password = "thanks_God1863";
                                $mail->setFrom('juntas@adventistasumn.org', 'Senor Transformame');
                                $mail->addReplyTo('f.pecina@unav.edu.mx', 'Soporte sistemas');
                                $mail->addAddress($correoPastor, 'Pastor');
                                $mail->addBCC('f.pecina@unav.edu.mx', 'CC');
                                $mail->addBCC($_SESSION["correo"], 'CCC');
                                $mail->Subject = 'Informacion para sistema de Plan Estrategico Senor Transformame';
                                $mail->msgHTML($cadMensaje);
                                if (!$mail->send()) {
                                   echo '{ "success" : -1 , "error" : '.$mail->ErrorInfo.'}';
                                } else {
                                    echo '{ "success" : 1 }';
                                }
                                exit(0);
                            }
                            echo '{ "success" : 2 }';
                            exit();
                        }
                    break;
                    case 'eliminaAsignacion':    
                        checarSesionUsuarios();
                        $idDistritosUsuarios = $_POST["idDistritosUsuarios"];
                        $sql=("SELECT deleteDistritosUsuariosIdDistritUser (".$idDistritosUsuarios.");");
                        //$sql=("DELETE FROM DistritosUsuarios WHERE idDistritosUsuarios = ".$idDistritosUsuarios);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 1 }';
                            exit();
                        }
                    break;
                    case 'verUsuariosDistritos':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $personas = array();
                        $sql2=("SELECT uc.nombre as persona, d.nombre as distrito, du.idDistritosUsuarios 
                        FROM DistritosUsuarios du
                        INNER JOIN Distritos d on d.idDistrito = du.idDistrito
                        INNER JOIN UsuariosCampos uc on uc.idUsuarioCampo = du.idUsuarioCampo
                        WHERE uc.idCampo = ".$_SESSION["idCampo"]."
                            order by du.idDistritosUsuarios asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["distrito"] = ($row2["distrito"]);
                                $row2["persona"] = ($row2["persona"]);
                                array_push($personas, $row2);
                            }
                            echo '{ "success" : 1, "personas" : '.json_encode($personas).'}';
                            exit(0);
                        }
                    break;
                    case 'listaIglesias':    
                        checarSesionUsuarios();
                        $distritos = array();
                        $sql2=('SELECT idGrupo, nombre
                            FROM Grupos 
                            WHERE idDistrito = '.$_POST["idDistrito"].'
                            order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($distritos, $row2);
                            }
                        }
                        echo '{ "success" : 1, "lista" : '.json_encode($distritos).' }';
                        exit(0);
                    break;
                     case 'listaDistritosPorCampo':    
                        checarSesionUsuarios();
                        $distritos = array();
                        $sql2=('SELECT idDistrito, nombre
                            FROM Distritos 
                            WHERE idCampo = '.$_POST["idCampo"].'
                            order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($distritos, $row2);
                            }
                        }
                        echo '{ "success" : 1, "lista" : '.json_encode($distritos).' }';
                        exit(0);
                    break;
                    case 'listaDistritos':    
                        checarSesionUsuarios();
                        $distritos = array();
                        $sql2=('SELECT idDistrito, nombre
                            FROM Distritos 
                            WHERE idCampo = '.$_SESSION["idCampo"].'
                            order by nombre asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($distritos, $row2);
                            }
                        }
                        $personas = array();
                        $sql2=('SELECT idUsuarioCampo, nombre
                            FROM UsuariosCampos 
                            WHERE idCampo = '.$_SESSION["idCampo"].'
                            order by idUsuarioCampo asc');
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($personas, $row2);
                            }
                        }
                        echo '{ "success" : 1, "distritos" : '.json_encode($distritos).' , "personas" : '.json_encode($personas).'}';
                        exit(0);
                    break;
                    case 'nuevoOModificaJuntas':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $titulo = ($_POST['titulo']);
                        $descripcion = ($_POST['descripcion']);
                        $activo = $_POST['activo'];
                        $idEvento = intval($_POST['idEvento']);
                        if($idEvento==0)
                        {
                            $sql=("INSERT INTO Eventos (titulo, descripcion, activo,idCampo) VALUES ('".$titulo."','".$descripcion."',".$activo.",".$_SESSION["idCampo"]." )");
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                echo '{ "success" : 1 }';
                                exit(0);
                            }
                        }
                        else
                        {
                            $sql=("UPDATE Eventos SET titulo =  '".$titulo."', descripcion = '".$descripcion."', activo = ".$activo." WHERE idEvento = ".$idEvento);
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                echo '{ "success" : 1 }';
                                exit();
                            }
                        }
                    break;
                    case 'verDistritos':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $distritos = array();
                        $sql2=("SELECT idDistrito, nombre, clave FROM Distritos WHERE idCampo = ".$_SESSION["idCampo"]." order by idDistrito asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($distritos, $row2);
                            }
                            echo '{ "success" : 1, "distritos" : '.json_encode($distritos).'}';
                            exit(0);
                        }
                    break;
                    case 'verIglesiasDelDistrito':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $distritosDeVerdad = array();
                        $sql2=("SELECT idDistrito, nombre FROM Distritos WHERE idCampo = ".$_SESSION["idCampo"]." order by nombre asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($distritosDeVerdad, $row2);
                            }
                        }
                        $distritos = array();
                        $sql2=("SELECT idGrupo, nombre, tipo, clave FROM Grupos WHERE idDistrito = ".$_POST["idDistrito"]." order by idGrupo asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($distritos, $row2);
                            }
                            echo '{ "success" : 1, "distritos" : '.json_encode($distritos).', "distritosDeVerdad" : '.json_encode($distritosDeVerdad).'}';
                            exit(0);
                        }
                    break;
                    case 'verJuntasInicio':    
                        checarSesionUsuarios();
                        $juntas = array();
                        $sql2=("SELECT idEvento, titulo, descripcion FROM Eventos WHERE activo = 1 AND idCampo in(".$_SESSION["idCampo"].",".$_SESSION["dependeDe"].") order by idEvento desc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["titulo"] = ($row2["titulo"]);
                                $row2["descripcion"] = ($row2["descripcion"]);
                                array_push($juntas, $row2);
                            }
                            echo '{ "success" : 1, "juntas" : '.json_encode($juntas).'}';
                            exit(0);
                        }
                    break;
                }
        break;
        case 'usuarios':
                switch($accion)
                {
                     case 'nuevoOModificaUsuarioMODIFICA':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $nombre = ($_POST['nombre']);
                        $correo = $_POST['correo'];
                        $idUsuarioCampo = $_POST['idUsuarioCampo'];
                         $sql=("SELECT updateUsuariosCamposNombre('".$nombre."', '".$correo."', ".$idUsuarioCampo.");");
                         //$sql=("UPDATE UsuariosCampos set nombre =  '".$nombre."' , correo = '".$correo."' WHERE  idUsuarioCampo = ".$idUsuarioCampo);
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            echo '{ "success" : 2 }';
                        }
                        exit(0);
                    break;
                    case 'nuevoOModificaUsuario':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $nombre = ($_POST['nombre']);
                        $correo = $_POST['correo'];
                        if(!isset($_POST["idUsuarioCampo"]))
                        {
                            $pass = randomPassword();
                            $passSHA1 = sha1(sha1($pass));
                            $sql2=("SELECT idUsuarioCampo FROM UsuariosCampos WHERE correo = '".$correo."'");
                            if($query2 = mysqli_query($recordset->conn,$sql2))
                            {
                                if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                {
                                    echo '{ "success" : -1 }';
                                    exit(0);
                                }
                            }
                            $sql=("SELECT insertUsuariosCamposNombre ('".$nombre."','".$correo."','".$passSHA1."',".$_SESSION["idCampo"].", -1 )");
                            //$sql=("INSERT INTO UsuariosCampos (nombre, correo, pass, idCampo, departamento) VALUES ('".$nombre."','".$correo."','".$passSHA1."',".$_SESSION["idCampo"].", -1 )");
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                //mandar correo con contraseña!
                               require 'PHPMailerAutoload.php';
                                $mail = new PHPMailer();
                                $mail->isSMTP();
                                $mail->SMTPDebug = 0;
                                $mail->Debugoutput = 'html';
                                $mail->Host = 'smtp.gmail.com';                               
                                $mail->Port = 587;
                                $mail->SMTPSecure = 'tls';
                                $mail->SMTPAuth = true;
                                $mail->Username = "f.pecina@unav.edu.mx";
                                $mail->Password = "thanks_God1863";
                                /*$mail->Username = "juntas@adventistasumn.org";
                                $mail->Password = "thanks_God7";*/
                                $mail->setFrom('juntas@adventistasumn.org', 'Senor Transformame');
                                $mail->addReplyTo('soporte@transformameumn.org', 'Soporte');
                                $mail->addAddress($correo, 'Usuario');
                                $mail->addBCC('f.pecina@unav.edu.mx', 'CC');
                                $mail->addBCC($_SESSION["correo"], 'CCC');
                                $mail->Subject = 'Usuario para el sistema de Plan Estrategico Senor Transformame';
                                $mail->msgHTML('<div>Tu usuario para el sistema es: '.$correo.', tu contrase&ntilde;a para <a href="http://transformameumn.org/" target="_blank"/>http://transformameumn.org/</a>  es: '.$pass."</div>");
                                if (!$mail->send()) {
                                   echo '{ "success" : -1 , "error" : '.$mail->ErrorInfo.'}';
                                } else {
                                    echo '{ "success" : 2 }';
                                }
                                exit(0);
                            }
                        }
                        else
                        {
                            /*$sql=("UPDATE Usuarios SET nombre =  '".$nombre."', correo = '".$correo."', idCampo = ".$idCampo." WHERE idUsuario = ".$idUsuario);
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                echo '{ "success" : 1 }';
                                exit();
                            }*/
                        }
                    break;
                    case 'cambiarDondeEstaElUsuario':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $idUsuarioCampo = $_POST["idUsuarioCampo"];
                        $sql2=("SELECT u.idUsuarioCampo, u.nombre, u.correo, c.nombre as campo, c.idCampo FROM UsuariosCampos u INNER JOIN Campos c on c.idCampo = u.idCampo WHERE u.idUsuarioCampo = ".$idUsuarioCampo."  order by u.idUsuarioCampo asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $distrito="";
                                $departamento="";
                                $sql=("SELECT d.nombre FROM DepartamentosUsuarios du
                                    INNER JOIN Departamentos d on d.idDepartamento = du.idDepartamento
                                    WHERE du.idUsuarioCampo = ".$idUsuarioCampo);
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        $departamento = ($row["nombre"]);
                                    }
                                }
                                $sql=("SELECT d.nombre FROM DistritosUsuarios du
                                    INNER JOIN Distritos d on d.idDistrito = du.idDistrito
                                    WHERE du.idUsuarioCampo = ".$idUsuarioCampo);
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        $distrito = ($row["nombre"]);
                                    }
                                }


                                $row2["campo"] = ($row2["campo"]);
                                $row2["nombre"] = ($row2["nombre"]);
                                if($distrito=="" && $departamento=="")
                                {
                                    $sql=("UPDATE UsuariosCampos SET idCampo = ".$_SESSION["idCampo"]." WHERE idUsuarioCampo = ".$idUsuarioCampo);
                                    if($query = mysqli_query($recordset->conn,$sql))
                                    {
                                        echo '{ "success" : 1 }';
                                        exit();
                                    }
                                }
                                else
                                {
                                    echo '{ "success" : -2 }';
                                        exit();
                                }
                            }
                        }
                        echo '{ "success" : -1 }';
                        exit(0);
                    break;
                    case 'verDondeEstaElUsuario':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $idUsuarioCampo = $_POST["idUsuarioCampo"];
                        $sql2=("SELECT u.idUsuarioCampo, u.nombre, u.correo, c.nombre as campo, c.idCampo FROM UsuariosCampos u INNER JOIN Campos c on c.idCampo = u.idCampo WHERE u.idUsuarioCampo = ".$idUsuarioCampo."  order by u.idUsuarioCampo asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $distrito="";
                                $departamento="";
                                $sql=("SELECT d.nombre FROM DepartamentosUsuarios du
                                    INNER JOIN Departamentos d on d.idDepartamento = du.idDepartamento
                                    WHERE du.idUsuarioCampo = ".$idUsuarioCampo);
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        $departamento = ($row["nombre"]);
                                    }
                                }
                                $sql=("SELECT d.nombre FROM DistritosUsuarios du
                                    INNER JOIN Distritos d on d.idDistrito = du.idDistrito
                                    WHERE du.idUsuarioCampo = ".$idUsuarioCampo);
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        $distrito = ($row["nombre"]);
                                    }
                                }


                                $row2["campo"] = ($row2["campo"]);
                                $row2["nombre"] = ($row2["nombre"]);
                                echo '{ "success" : 1, "campo" : "'.$row2["campo"].'", "distrito" : "'.$distrito.'", "departamento" : "'.$departamento.'" }';
                                exit(0);
                            }
                        }
                        echo '{ "success" : -1 }';
                        exit(0);
                    break;
                    case 'verUsuariosDeTodaLaUnion':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $usuarios = array();
                        $sql2=("SELECT u.idUsuarioCampo, u.nombre, u.correo, c.nombre as campo, c.idCampo FROM UsuariosCampos u INNER JOIN Campos c on c.idCampo = u.idCampo WHERE c.idCampo != ".$_SESSION["idCampo"]."  order by u.idUsuarioCampo asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["campo"] = ($row2["campo"]);
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($usuarios, $row2);
                            }
                            echo '{ "success" : 1, "usuarios" : '.json_encode($usuarios).'}';
                            exit(0);
                        }
                        echo '{ "success" : -1 }';
                        exit(0);
                    break;
                    case 'subeArchivosLegales':
                        checarSesionUsuarios();
                        $idUsuarioCampo = $_POST['idUsuarioCampo'];
                        $tipo = $_POST['tipo'];
                        $fileName = $_POST['nombreArchivo'];
                        $extension = $_POST['extension'];
                        //archivo
                        $timestamp = time();
                        $sql2=("INSERT INTO Documentos  (idUsuarioCampo, tipo, idCampo, archivo, timestamp) VALUES (".$idUsuarioCampo.", ".$tipo.", ".$_SESSION["idCampo"].", '', ".$timestamp.")");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            $idDocumentos = mysqli_insert_id($recordset->conn);
                            $nombreArchivo = $idDocumentos."-".$idUsuarioCampo."-".$timestamp.".".$extension;
                            move_uploaded_file($_FILES['archivo']['tmp_name'], 'archivos/' . $nombreArchivo);
                            $sql=("UPDATE Documentos SET archivo = '".$nombreArchivo."' WHERE idDocumentos = ".$idDocumentos);
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                echo '{ "success" : 1 }';
                                exit(0);
                            }
                        }
                    break;
                    case 'generaWORD':
                        // Include classes 
                        include_once('tbs_us/tbs_class.php'); // Load the TinyButStrong template engine 
                        include_once('docx/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin 

                        // prevent from a PHP configuration problem when using mktime() and date() 
                        if (version_compare(PHP_VERSION,'5.1.0')>=0) { 
                            if (ini_get('date.timezone')=='') { 
                                date_default_timezone_set('UTC'); 
                            } 
                        } 
                        $seccion = '';
                        $rep = '';
                        $sgar = '';
                        $sql2=("SELECT seccion, rep, sgar FROM Campos WHERE idCampo in (".$_SESSION["idCampo"].") ");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $seccion = ($row2["seccion"]);
                                $rep = ($row2["rep"]);
                                $sgar = $row2["sgar"];
                            }
                        }
                        $selected = $_GET["selected"];
                        $selected = str_replace('|',',',$selected);
                        $data = array(); 
                        $minAso = $_GET["minAso"];
                        $altaBaja = $_GET["altaBaja"];
                        $con = 1;
                        require 'PHPMailerAutoload.php';
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Debugoutput = 'html';
                        $mail->Host = 'smtp.gmail.com';                               
                        $mail->Port = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth = true;
                        $mail->Username = "f.pecina@unav.edu.mx";
                        $mail->Password = "thanks_God1863";
                        $checar = array();
                        $sql2=("SELECT UPPER(nombre) as nombre FROM UsuariosCampos WHERE idUsuarioCampo in (".$selected.") order by nombre asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $sql3=("SELECT archivo, timestamp FROM Documentos WHERE idUsuarioCampo in (".$selected.") AND tipo in (1,2,3) order by timestamp desc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        $mail->AddAttachment("archivos/".$row3["archivo"]);
                                    }
                                }

                                $row2["nombre"] = ($row2["nombre"]);
                                $arr = explode(' ',$row2["nombre"]);
                                $cuantos = count($arr);
                                $am = $arr[$cuantos-1];
                                $ap = $arr[$cuantos-2];
                                $nombre = '';
                                for($i=0;$i<$cuantos-2;$i=$i+1)
                                {
                                    if($i==0)
                                    {
                                        $nombre = $arr[$i];    
                                    }
                                    else
                                    {
                                        $nombre = $nombre." ".$arr[$i];
                                    }
                                }
                                $data[] = array('rank'=> $con, 'ap'=> $ap, 'am'=>$am , 'name'=>$nombre);
                                $con = $con + 1;
                            }
                       }

                        // Initialize the TBS instance 
                        $TBS = new clsTinyButStrong; // new instance of TBS 
                        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin 

                        // ------------------------------ 
                        // Prepare some data for the demo 
                        // ------------------------------ 

                        // Retrieve the user name to display 
                        $yourname = (isset($_POST['yourname'])) ? $_POST['yourname'] : ''; 
                        $yourname = trim(''.$yourname); 
                        if ($yourname=='') $yourname = "(no name)"; 

                        // A recordset for merging tables 

                       
                        $fecha = date('Y-m-d');

                        $anio = substr($fecha, 0, 4);
                        $mes = substr($fecha, 5, 2);
                        if($mes=="01"){$mes = "enero";}
                        if($mes=="02"){$mes = "febrero";}
                        if($mes=="03"){$mes = "marzo";}
                        if($mes=="04"){$mes = "abril";}
                        if($mes=="05"){$mes = "mayo";}
                        if($mes=="06"){$mes = "junio";}
                        if($mes=="07"){$mes = "julio";}
                        if($mes=="08"){$mes = "agosto";}
                        if($mes=="09"){$mes = "septiembre";}
                        if($mes=="10"){$mes = "octubre";}
                        if($mes=="11"){$mes = "noviembre";}
                        if($mes=="12"){$mes = "diciembre";}
                        $dia = substr($fecha, 8, 2);
                        // ----------------- 
                        // Load the template 
                        // ----------------- 

                        $template = 'formato.docx'; 
                        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document). 

                        // ---------------------- 
                        // Debug mode of the demo 
                        // ---------------------- 
                        /*
                        if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit. 
                        if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit. 
                        if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit. 
                        */
                        // -------------------------------------------- 
                        // Merging and other operations on the template 
                        // -------------------------------------------- 

                        // Merge data in the body of the document 
                        $TBS->MergeBlock('a,b', $data); 
                        //$TBS->MergeBlock('a', $data); 


                        // Delete comments 
                        $TBS->PlugIn(OPENTBS_DELETE_COMMENTS); 

                        // ----------------- 
                        // Output the result 
                        // ----------------- 

                        // Define the name of the output file 
                        $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : ''; 
                        //$output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template); 
                        $output_file_name_time = str_replace('.', '_'.time().$save_as.'.', $template); 
                        if ($save_as==='') { 
                            // Output the result as a downloadable file (only streaming, no data saved in the server) 

                            /*$mail->Username = "juntas@adventistasumn.org";
                            $mail->Password = "thanks_God7";*/
                            $mail->setFrom('juntas@adventistasumn.org', 'Legales UMN');
                            $TBS->Show(OPENTBS_FILE, $output_file_name_time);
                            $mail->AddAttachment($output_file_name_time);
                            $mail->addReplyTo('legalesyfiscalesumn@gmail.com', 'Secretaria UMN');
                            $mail->addAddress('legalesyfiscalesumn@gmail.com', 'Secretaria UMN');
                            $mail->addAddress('flumn@unav.edu.mx', 'Abraham J. Ramirez Castrejon');
                            $mail->addAddress('adraylegales@hotmail.com', 'Cesar Hernandez');
                            $mail->addBCC('f.pecina@unav.edu.mx', 'CC');
                            $mail->addBCC($_SESSION["correo"], 'CCC');
                            $mail->Subject = $altaBaja.' de '.$minAso.' '.$seccion.'  '.$fecha;
                            $mail->msgHTML('<div>Adjuntamos la '.$altaBaja.' de '.$minAso.' '.$seccion.'   al  '.$fecha.' </div>');
                            if (!$mail->send()) {
                               echo '{ "success" : -1 , "error" : '.$mail->ErrorInfo.'}';
                            } else {
                                header('Content-Type: application/csv');
                                header('Content-Disposition: attachment; filename='.$output_file_name_time);
                                header('Pragma: no-cache');
                                readfile($output_file_name_time);
                                //$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name_time);
                            }
                            exit(0);
                            
                             // Also merges all [onshow] automatic fields. 
                            // Be sure that no more output is done, otherwise the download file is corrupted with extra data. 
                            exit(); 
                        } else { 
                            // Output the result as a file on the server. 
                            $TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields. 
                            // The script can continue. 
                            exit("File [$output_file_name] has been created."); 
                        } 
                    break;
                    case 'verUsuariosLegales':    
                        checarSesionUsuarios();
                        $usuarios = array();
                        $sql2=("SELECT u.idUsuarioCampo, u.nombre, u.correo, u.idCampo FROM UsuariosCampos u  WHERE u.idCampo = ".$_SESSION["idCampo"]." order by u.nombre asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["nombre"] = ($row2["nombre"]);
                                $row2["documentos"] = array();
                                //1 - INE
                                //2 - CURP
                                //3 - Acta de nacimiento
                                //4 - Alta
                                //5 - Baja
                                $sql3=("SELECT idDocumentos, tipo, archivo, idCampo, timestamp FROM Documentos WHERE idUsuarioCampo = ".$row2["idUsuarioCampo"]." order by timestamp desc");
                                if($query3 = mysqli_query($recordset->conn,$sql3))
                                {
                                    while($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                    {
                                        if(intval($row3["tipo"])==1 || intval($row3["tipo"])==2 || intval($row3["tipo"])==3)
                                        {
                                            if(!array_key_exists($row3["tipo"], $row2["documentos"]))
                                            {
                                                $row2["documentos"][$row3["tipo"]] = $row3;
                                                //array_push($row2["documentos"], $row3);
                                            }
                                        }
                                        else
                                        {
                                            if(!array_key_exists($row3["tipo"], $row2["documentos"]) && intval($row3["idCampo"])==intval($_SESSION["idCampo"]))
                                            {
                                                $row2["documentos"][$row3["tipo"]] = $row3;
                                                //array_push($row2["documentos"], $row3);
                                            }
                                        }
                                    }
                                }
                                array_push($usuarios, $row2);
                            }
                            echo '{ "success" : 1, "usuarios" : '.json_encode($usuarios).'}';
                            exit(0);
                        }
                        echo '{ "success" : -1 }';
                        exit(0);
                    break;
                    case 'verUsuarios':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $usuarios = array();
                        $sql2=("SELECT u.idUsuarioCampo, u.nombre, u.correo, c.nombre as campo, c.idCampo FROM UsuariosCampos u INNER JOIN Campos c on c.idCampo = u.idCampo WHERE c.idCampo = ".$_SESSION["idCampo"]."  order by u.idUsuarioCampo asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["campo"] = ($row2["campo"]);
                                $row2["nombre"] = ($row2["nombre"]);
                                array_push($usuarios, $row2);
                            }
                            echo '{ "success" : 1, "usuarios" : '.json_encode($usuarios).'}';
                            exit(0);
                        }
                        echo '{ "success" : -1 }';
                        exit(0);
                    break;
                    case 'verCampos':    
                        checarSesionUsuarios();
                        checarPermisoAdministrador();
                        $campos = array();
                        $sql2=("SELECT idCampo, campo FROM Campos WHERE dependeDe = ".$_SESSION["idCampo"]." OR idCampo = ".$_SESSION["idCampo"]." order by idCampo asc");
                        if($query2 = mysqli_query($recordset->conn,$sql2))
                        {
                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                            {
                                $row2["campo"] = ($row2["campo"]);
                                array_push($campos, $row2);
                            }
                            echo '{ "success" : 1, "campos" : '.json_encode($campos).'}';
                            exit(0);
                        }
                    break;
                }
        break;
        case 'login':
                switch($accion)
                {
                    case 'access':

                        $ip = $_POST['ip'];
                        //hay que checar que la ip no aparezca mas de 5 veces en 5 minutos!
                        $codigo = '';
                        if(isset($_POST['codigo']))//codigo o correo!
                        {
                            $codigo = $_POST['codigo'];
                        }
                        $pass= '';
                        if(isset($_POST['pass']))
                        {
                            $pass = sha1($_POST['pass']);  
                            if(isset($_POST['correo']))//codigo o correo!
                            {
                                $codigo = $_POST['correo'];
                            }


                            if (strpos($_POST['correo'], '@') !== false) 
                            {//es un correo!
                                $sql=("SELECT uc.idCampo, uc.idUsuarioCampo, uc.nombre, uc.correo, uc.departamento, c.dependeDe, c.nombre as campoNombre FROM UsuariosCampos uc
                                    INNER JOIN Campos c on c.idCampo = uc.idCampo
                                    WHERE uc.correo = '".$codigo."' AND uc.pass = '".$pass."'");
                                //echo $sql;
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        if(isset($_SESSION["idGrupo"]))
                                        {
                                            unset($_SESSION['idGrupo']);    
                                        }
                                        if(isset($_SESSION["idDepartamento"]))
                                        {
                                            unset($_SESSION['idDepartamento']);    
                                        }
                                        if(isset($_SESSION["idDistrito"]))
                                        {
                                            unset($_SESSION['idDistrito']);    
                                        }
                                        if(isset($_SESSION["idDepartamento"]))
                                        {
                                            unset($_SESSION['idDepartamento']);    
                                        }
                                        if(isset($_SESSION["departamento"]))
                                        {
                                            unset($_SESSION['departamento']);    
                                        }
                                        $nombre = ($row["nombre"]);
                                        $tieneLegales = 0;
                                        $_SESSION['tieneLegales'] = 0;
                                        $tieneEvangelismo = 0;
                                        $_SESSION['tieneEvangelismo'] = 0;
                                        
                                        $_SESSION['idUsuarioCampo'] = $row["idUsuarioCampo"];
                                        $_SESSION['idCampo'] = $row["idCampo"];
                                        $_SESSION['idCampoNombre'] = $row["campoNombre"];
                                        $_SESSION['nombre'] = $nombre;
                                        $_SESSION['correo'] =$row["correo"];
                                        $_SESSION['departamento'] = $row["departamento"];
                                        if($row["dependeDe"]==0)//UMN
                                        {
                                            $_SESSION['tipo'] = 3;//el 3 significa union  
                                        }
                                        $_SESSION['dependeDe'] = $row["dependeDe"];
                                        //checar si es departamental o de distritoª
                                        $sql2=("SELECT idDepartamento FROM DepartamentosUsuarios WHERE idUsuarioCampo = ".$row["idUsuarioCampo"]);
                                        if($query2 = mysqli_query($recordset->conn,$sql2))
                                        {
                                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                            {
                                                $_SESSION["idDepartamento"] = $row2["idDepartamento"];
                                                if(intval($row2["idDepartamento"])==19)//administracion
                                                {
                                                    $_SESSION['departamento'] = 0;
                                                }
                                                if(intval($row2["idDepartamento"])==16)//legales
                                                {
                                                    $tieneLegales = 1;
                                                    $_SESSION['tieneLegales'] = 1;
                                                }
                                                if(intval($row2["idDepartamento"])==2 || intval($row2["idDepartamento"])==6)//evangelismo
                                                {
                                                    $tieneEvangelismo = 1;
                                                    $_SESSION['tieneEvangelismo'] = 1;
                                                }
                                                
                                            }
                                        }
                                        $sql2=("SELECT idDistrito FROM DistritosUsuarios WHERE idUsuarioCampo = ".$row["idUsuarioCampo"]);
                                        if($query2 = mysqli_query($recordset->conn,$sql2))
                                        {
                                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                            {
                                                $_SESSION["idDistrito"] = $row2["idDistrito"];
                                            }
                                        }
                                        $message = urlencode($nombre. " ha entrado al sistema");
                                        $test = file_get_contents("http://unionnorte.org/apiradio.php?servicio=notifications&accion=mandaNotificacionST&passphrase=asdwer&message=".$message);
/*
                                        $sql2=("SELECT token, tipo FROM tokens ORDER BY timestamp desc");
                                        if($query2 = mysqli_query($recordset->conn,$sql2))
                                        {
                                            $message = $nombre. " ha entrado al sistema";
                                            $passphrase = "asdwer";  
                                            $ctx = stream_context_create();
                                            stream_context_set_option($ctx, 'ssl', 'local_cert', 'swst_dev.pem');
                                            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                                                
                                            $fp = stream_socket_client(
                                                'ssl://gateway.sandbox.push.apple.com:2195', $err,
                                                $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                                            if (!$fp)
                                                exit("Failed to connect: $err $errstr" . PHP_EOL);
                                            //echo 'Connected to APNS' . PHP_EOL;                        
                                            while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                            {
                                                $deviceToken = $row2["token"];
                                                    // Create the payload body
                                                $basicBody['aps'] = array(
                                                  'alert' => $message,
                                                  'sound' => 'default',
                                                  'link_url' => "http://google.com",
                                                  );
                                                $customBody['custom_json'] = array(
                                                    'saleNumber' => "N09520",
                                                );
                                                $body = array_merge($basicBody, $customBody);
                                                // Encode the payload as JSON
                                                $payload = json_encode($body);
                                                // Build the binary notification
                                                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                                                // Send it to the server
                                                $result = fwrite($fp, $msg, strlen($msg));
                                            }
                                            // Close the connection to the server
                                            fclose($fp);
                                        }
*/
                                        $sql2=("SELECT clave FROM Campos WHERE idCampo = ".$row["idCampo"]);
                                        if($query2 = mysqli_query($recordset->conn,$sql2))
                                        {
                                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                            {
                                                $_SESSION['clave'] = $row2["clave"];
                                                header('Location: page.php');
                                                exit(0);
                                            }
                                            else
                                            {
                                                header('Location: page.php');
                                                exit(0);   
                                            }
                                        }
                                        else
                                        {
                                            header('Location: index.php?error=73');
                                            exit(0);
                                        }
                                    }
                                    else
                                    {
                                        header('Location: index.php?error=r23z');
                                        exit(0);
                                    }
                                }
                            }
                        }

                        if (strpos($_POST['codigo'], '@') !== false) 
                        {//es un correo!
                            $sql=("SELECT idCampo, nombre, correo departamento FROM UsuariosCampos WHERE correo = '".$codigo."'");
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                {
                                    header('Location: index.php?correo='.$codigo);
                                    exit(0);
                                }
                                else
                                {
                                    header('Location: index.php?error=r23');
                                    exit(0);
                                }
                            }
                        }
                        else
                        {

                        }
                        
                        if(strlen($codigo)==2)//es campo
                        {
                            if($pass=='')//va a poner la contraseña
                            {
                                $sql=("SELECT idCampo FROM Campos WHERE clave = '".$codigo ."'");
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        header('Location: index.php?c='.$row['idCampo']);
                                        exit(0);
                                    }
                                }
                            }
                            else
                            {
                                $sql=("SELECT idCampo, nombre, departamento FROM UsuariosCampos WHERE pass = '".$pass."'");
                                if($query = mysqli_query($recordset->conn,$sql))
                                {
                                    if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                    {
                                        $nombre = ($row["nombre"]);
                                        if(isset($_SESSION["idGrupo"]))
                                        {
                                            unset($_SESSION['idGrupo']);    
                                        }
                                        if(isset($_SESSION["idDepartamento"]))
                                        {
                                            unset($_SESSION['idDepartamento']);    
                                        }
                                        if(isset($_SESSION["departamento"]))
                                        {
                                            unset($_SESSION['departamento']);    
                                        }
                                        if(isset($_SESSION["idDistrito"]))
                                        {
                                            unset($_SESSION['idDistrito']);    
                                        }
                                        $_SESSION['idCampo'] = $row["idCampo"];
                                        $_SESSION['nombre'] = $nombre;
                                        $_SESSION['departamento'] = $row["departamento"];
                                        $_SESSION['idDepartamento'] = $row["departamento"];
                                       
                                        $sql2=("SELECT clave FROM Campos WHERE idCampo = ".$row["idCampo"]);
                                        if($query2 = mysqli_query($recordset->conn,$sql2))
                                        {
                                            if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                            {
                                                $_SESSION['clave'] = $row2["clave"];
                                                header('Location: page.php');
                                                exit(0);
                                            }
                                        }
                                        else
                                        {
                                            header('Location: index.php?error=23');
                                            exit(0);
                                        }
                                    }
                                    else
                                    {
                                        header('Location: index.php?error=23');
                                        exit(0);
                                    }
                                }
                            }
                        }

                        if(strlen($codigo)==8)//es iglesia!
                        {
                            $campo = substr($codigo,0,2);
                            $distrito = substr($codigo,2,2);
                            $iglesia = substr($codigo,4,4);
                            $sql=("SELECT idCampo, nombre FROM Campos WHERE clave = '".$campo."'");
                            if($query = mysqli_query($recordset->conn,$sql))
                            {
                                if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                {
                                    $nombreCampo = ($row["nombre"]);
                                    $sql2=("SELECT idDistrito, nombre FROM Distritos WHERE clave = '".$distrito."' AND idCampo = ".$row["idCampo"]);
                                    if($query2 = mysqli_query($recordset->conn,$sql2))
                                    {
                                        if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                        {
                                            $nombreDistrito = ($row2["nombre"]);
                                            $sql3=("SELECT idGrupo, nombre FROM Grupos WHERE clave = '".$iglesia."' AND idDistrito = ".$row2["idDistrito"]);
                                            if($query3 = mysqli_query($recordset->conn,$sql3))
                                            {
                                                if($row3=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                                                {
                                                    $nombre = ($row3["nombre"]);
                                                    $_SESSION['nombre'] = $nombre;
                                                    $_SESSION['nombreCampo'] = $nombreCampo;
                                                    $_SESSION['nombreDistrito'] = $nombreDistrito;
                                                    $_SESSION['clave'] = $codigo;
                                                    if(isset($_SESSION["idCampo"]))
                                                    {
                                                        unset($_SESSION['idCampo']);    
                                                    }
                                                    if(isset($_SESSION["dependeDe"]))
                                                    {
                                                        unset($_SESSION['dependeDe']);    
                                                    }
                                                    if(isset($_SESSION["idDistrito"]))
                                                    {
                                                        unset($_SESSION['idDistrito']);    
                                                    }
                                                    $_SESSION['idGrupo'] = $row3["idGrupo"];
                                                    header('Location: page.php');
                                                    exit(0);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                        $sql=("INSERT INTO log (timestamp, ip) VALUES (".time().",'".$ip."')");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            header('Location: index.php?error=1234567');
                            exit(0);
                        }

                        



                        $sql=("SELECT idUsuario, tipoDeUsuario, nombre, idCampo FROM Usuarios WHERE pass = '".$pass ."' and correo = '".$correo."' AND activo = 1");
                        if($query = mysqli_query($recordset->conn,$sql))
                        {
                            if($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                $idUsuario = $row['idUsuario'];
                                $nombre = ($row["nombre"]);
                                $tipoDeUsuario = $row["tipoDeUsuario"];
                                $_SESSION['idUsuario'] = $idUsuario;
                                $_SESSION['nombre'] = $nombre;
                                $_SESSION['correo'] = $correo;
                                $_SESSION['idCampo'] = $row["idCampo"];
                                $_SESSION['tipoDeUsuario'] = $tipoDeUsuario;

                                $sql2=("SELECT dependeDe FROM Campos WHERE idCampo = ".$row["idCampo"]);
                                if($query2 = mysqli_query($recordset->conn,$sql2))
                                {
                                    if($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                                    {
                                        $_SESSION['dependeDe'] = $row2["dependeDe"];
                                        header('Location: page.php');
                                        exit(0);
                                    }
                                }
                            }
                            else
                            {
                                header('Location: index.php?error=23');
                                exit(0);
                            }
                        }
                        else
                        {
                            header('Location: index.php?error=2');
                            exit(0);
                        }
                        
                    break;
                }
        break;
    }
    respuestaNegativa();
?>