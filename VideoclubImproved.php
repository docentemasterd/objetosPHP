<!DOCTYPE html>
<html lang="es">
<head>
	<title>Ejemplo POO</title>
</head>
<body>
<?php
	class peliculas{ //Clase película con sus atributos correspondientes
		private $titulo;
		private $anno;
		private $director;
		private $alquilada;
		private $precio;
		private $fecha_devolucion;
		
		public function peliculas($Titulo, $Anno, $Director, $Alquilada, $Precio, $FechaDevolucion){ //Constructor de la clase
			$this->titulo = $Titulo;
			$this->anno = $Anno;
			$this->director = $Director;
			$this->alquilada = $Alquilada;
			$this->precio = $Precio;
			$this->fecha_devolucion = $FechaDevolucion;
		}
		// Método que devuelve el nombre de la película
		public function leerPelicula() {
			return $this->titulo;
		}
		// Método  que devuelve el año y el director de la película
		public function leerAnnoDirector() {
			return $this->anno.', '.$this->director;
		}
		// Método que devuelve el precio de la película
		public function leerPrecio() {
			return $this->precio;
		}
		// Método que devuelve si la película está alquilada o no (si/no)
		public function leerAlquilada() {
			return $this->alquilada;
		}
		// Método que devuelve la fecha en que debe devolverse la película
		public function leerFechaDevolucion() {
			return $this->fecha_devolucion;
		}
		// Método que calcula y muestra cuanto es el recargo de una película que no se ha devuelto a tiempo
		public function recargoDevolucion(){
			if ($this->fecha_devolucion != '') { //se verifica si existe una fecha de devolución para evaluar si hay recargo
		        $fecha1 = new DateTime($this->fecha_devolucion);
		        $fecha2 = new DateTime(date ("Y-m-d", time()));
		         /* Si la fecha de hoy es superior a la de la devolución se calcula el recargo */
		        if ($fecha2 > $fecha1) {
		        	$dias_dif = $fecha1->diff($fecha2);
		        	echo "Esta película tiene un recargo por atraso en la devolución de: ".$dias_dif->days*1.2."<br/>";
		        }
	        }
		}
		// Método que busca y muestra la información de una palícula que se consulta por título
		public function buscarTitulo(){
			global $encontro; // variable utilizada para mandar mensaje si la película no se encuentra en el VídeoClub
			if ($this->titulo==($_POST['ftitulo'])) {
				echo "<br/>";
				echo "Título: ".$this->titulo."<br/>";
				echo "Año: ".$this->anno."<br/>";
				echo "Director: ".$this->director."<br/>";
				echo "Alquilada: ".$this->alquilada."<br/>";
				echo "Precio: ".$this->precio."<br/>";
				echo "Fecha de devolución: ".$this->fecha_devolucion."<br/>";
				$this->recargoDevolucion(); // Verifica si hay recargo
				$encontro=1;
			}
		}
		// Método que busca y muestra la información de una palícula que se consulta por año y Director
		public function buscarAnnoDirector(){
			global $encontro; // variable utilizada para mandar mensaje si la película no se encuentra en el VídeoClub
			if ($this->anno==($_POST['fanno']) && $this->director==($_POST['fdirector'])) {
				echo "<br/>";
				echo "Título: ".$this->titulo."<br/>";
				echo "Año: ".$this->anno."<br/>";
				echo "Director: ".$this->director."<br/>";
				echo "Alquilada: ".$this->alquilada."<br/>";
				echo "Precio: ".$this->precio."<br/>";
				echo "Fecha de devolución: ".$this->fecha_devolucion."<br/>";
				$this->recargoDevolucion(); // Verifica si hay recargo
				$encontro=1;
			}
		}
	}
	// Se contruyen las películas, del VídeoClub, con sus datos
	$pelicula01 = new peliculas('Todo sobre mi madre', 1999, 'Pedro Almodóvar', 'si', 5.25, '2017-09-10');
	$pelicula02 = new peliculas('La niña de tus ojos', 1998, 'Fernando Trueba', 'si', 5.55, '2017-09-05');
	$pelicula03 = new peliculas('Mar adentro', 2004, 'Alejandro Almedábar', 'no', 3.75, '');
	$pelicula04 = new peliculas('Cría cuervos', 1976, 'Carlos Saura', 'no', 4.25, '');
	$pelicula05 = new peliculas('Carmen', 1983, 'Carlos Saura', 'si', 4.85, '2017-09-20');
	$pelicula06 = new peliculas('Calle 54', 2000, 'Fernando Trueba', 'si', 6.35, '2017-09-02');
	$pelicula07 = new peliculas('Carmen', 2003, 'Vicente Aranda', 'si', 5.25, '2017-09-12');
	$pelicula08 = new peliculas('La película falsa', 2000, 'Fernando Trueba', 'no', 2.15, '');
    
    // Vector para recorrer las películas para satisfacer las consultas (por Título y por Año/Director)
    $vectorPeliculas = array($pelicula01, $pelicula02, $pelicula03, $pelicula04, $pelicula05, $pelicula06,$pelicula07, $pelicula08);
?>
<!-- Formulario para consultar por Título o por Año/Director una película -->
<form action="ejercicioFeedback.php" method="post">
	<h2>VídeoClub <i>Las mejores pelis</i></h2>
	Título: <input type="text" size="42px" name="ftitulo" />
	<input type="submit" value="Consultar por título" name="tipoconsulta"><br/><br/>
	Año:  <input type="text" maxlength="4" size="4px" name="fanno" />
	Director: <input type="text" size="26px" name="fdirector" />
	<input type="submit" value="Consultar por año y Director" name="tipoconsulta"><br />
	<h3>-------------------------------------------------------</h3>
	<br/><br/>
</form>
<?php
	// Switch que recorrerá las películas y buscará por Título o por Año/Director según se haya seleccionado
    switch (@$_POST['tipoconsulta']) {
      case 'Consultar por título':
      	$encontro=0;
      	for ($i=0; $i < 8; $i++) { // Busca si hay una película con ese título en el VídeoClub
      		$vectorPeliculas[$i]->buscarTitulo();
      	}
      	if ($encontro == 0) { // Mensaje si no existe la película en el VídeoClub
				echo "<br/> Lo sentimos, no tenemos una película con ese Título <br/>";
		}
        break;
      case 'Consultar por año y Director':
      $encontro=0;
      for ($i=0; $i < 8; $i++) { // Busca si hay una película con ese año/Director en el VídeoClub
      		$vectorPeliculas[$i]->buscarAnnoDirector();
      	}
      	if ($encontro == 0) { // Mensaje si no existe la película en el VídeoClub
				echo "<br/> Lo sentimos, no tenemos una película de ese Año/Director <br/>";
		}
        break;
      default:
        break;
    }
?>
</body>
</html>