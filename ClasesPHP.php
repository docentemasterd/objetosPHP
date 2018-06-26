<<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ejercicio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <p>
        <?php
            class Pelicula {

                //Variables de la clase
                private $titulo;
                private $año;
                private $director;
                private $alquilada;
                private $precio;
                private $fechadedevolucion;

                //Variable usada en funcion
                public $recargo;

                //Contructor de la clase
                function __construct($titulo='', $año= null , $director='', $alquilada='', $precio= null, $fechadevolucion=null){
                    $this->titulo = $titulo;
                    $this->año = $año;
                    $this->director = $director;
                    $this->alquilada = $alquilada;
                    $this->precio = $precio;
                    $this->fechadevolucion = $fechadevolucion;
                }

                //Asigna un valor a la variable $titulo
                function setTitulo($titulo){
                    $this->titulo = $titulo;
                }
                //Devuelve el valor de la variable $titulo
                function getTitulo(){
                    return $this->titulo;
                }

                //Asigna un valor a la variable $año
                function setAño($año){
                    $this->año = $año;
                }

                //Devuelve el valor de la variable $año
                function getAño(){
                    return $this->año;
                }

                //Asigna un valor a la variable $director
                function setDirector($director){
                    $this->director = $director;
                }

                //Devuelve el valor de la variable $director
                function getDirector(){
                    return $this->director;
                }

                //Asigna un valor a la variable $precio
                function setPrecio($precio){
                    $this->precio = $precio;
                }

                //Devuelve el valor de la variable $precio
                function getPrecio(){
                    return $this->precio;
                }

                //Asigna un valor a la variable $alquilada
                function setAlquilada($alquilada){
                    //Se comprueba si el valor es correcto
                    if(comprobarAlquilar() == true){
                        //correcto, asigna el valor a la variable $alquilada
                        $this->alquilada = $alquilada;
                    }
                    else
                        //Mensaje de error
                        return 'No admitino valor, solo puede ser "Si" o "No"';
                }

                //Devuelve el valor de la variable $alquilada
                function getAlquilada(){
                    return $this->alquilada;
                }

                //Comprueba si el valor $alquilada es el pasado correctamente
                function comprobarAlquiler($alquilada){
                    if($alquilada == 'Si' || $alquilada == 'No')
                        return true;
                    else
                        return false;
                }

                //Asigna un valor a la variable $fechadevolucion
                function setFechaDevolucion($fechadevolucion){
                    $this->fechadedevolucion = $fechadevolucion;
                }

                //Devuelve el valor de la variable $fechadevolucion
                function getFechaDevolucion(){
                    return $this->fechadevolucion;
                }

                //Compara las fechas de devolucion
                function comprobarFecha($fechadevolucion){
                    //Variable con la fecha actual
                    $fechaactual = time();
                    //Se cambia el formato de la hora actual
                    $fechaactual = date('Y.m.d', $fechaactual);
                    //Se cambia el formato de la fecha de devolucion
                    $fechadevolucion = date('Y.m.d',  $fechadevolucion);
                    //Se cambia el sistema de fechas de gregoriano a juliano, para saber la diferencia de días que hay entre dos fechas
                    function compararFechas($fechadevolucion, $fechaactual){
                        $valoresPrimera = explode ("/", $fechadevolucion);   
                        $valoresSegunda = explode ("/", $fechaactual); 
                        $diaPrimera    = $valoresPrimera[0];  
                        $mesPrimera  = $valoresPrimera[1];  
                        $anyoPrimera   = $valoresPrimera[2]; 
                        $diaSegunda   = $valoresSegunda[0];  
                        $mesSegunda = $valoresSegunda[1];  
                        $anyoSegunda  = $valoresSegunda[2];
                        $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
                        $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     
                        if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
                            // "La fecha ".$primera." no es válida";
                            return 'La fecha de devolucion  no es valida';
                        }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
                            // "La fecha ".$segunda." no es válida";
                            return 'La fecha actual no es valida';
                        }else{
                            //Se sacan los dias de diferencia
                            $dias =  $diasPrimeraJuliano - $diasSegundaJuliano;
                            return 'La fechas son correctas';
                        }
                    }
                    //Sacar recargo
                    if($dias == 0){
                        $recargo = 0;
                    }
                    else{
                        $recargo = $dias*1.2;
                    }
                }    
            }//Fin clase

            //Creación de objetos prueba con las variables
            $pelicula1 = new Pelicula('Prueba', 1940,'Carla', 'Si', 2.99,'10/03/2018');
            $pelicula2 = new Pelicula('Prueba2', 1960,'Carla', 'No', 3.98,'11/05/2018');
            $pelicula3 = new Pelicula('Prueba3', 1985,'Carla', 'Si', 5.95,'20/10/2018');
            
            //Muestra los resultados de los objetos creados
            echo 'El título de la película es,'.$pelicula1->getTitulo().', publicada en el año,'.$apelicula1->getAño().', su director es,' .$pelicula1->getDirector(). ', con precio,' .$pelicula1->getPrecio(). ', estado de alquiler:'.$pelicula1->getAlquilada(). ',pago por recargo:' .$pelicula1->$recargo. ' euros, pago por días retrasados.<br/>';

            echo 'El título de la película es,'.$pelicula2->getTitulo().', publicada en el año,'.$apelicula2->getAño().', su director es,' .$pelicula2->getDirector(). ', con precio,' .$pelicula2->getPrecio(). ', estado de alquiler:'.$pelicula2->getAlquilada(). ',pago por recargo:' .$pelicula2->$recargo. ', pago por días retrasados.<br/>';

            echo 'El título de la película es,'.$pelicula3->getTitulo().', publicada en el año,'.$apelicula3->getAño().', su director es,' .$pelicula3->getDirector(). ', con precio,' .$pelicula3->getPrecio(). ', estado de alquiler:'.$pelicula3->getAlquilada(). ',pago por recargo:' .$pelicula3->$recargo. ', pago por días retrasados.<br/>';
        ?>
        </p>
    </body>
</html>