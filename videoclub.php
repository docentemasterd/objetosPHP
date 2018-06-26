<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/videoclub.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script>
	function actualizarPrecio(objeto) {
	var precio = 2;
	var precioBase = parseFloat(document.getElementById("selector2").value);
	precio += precioBase;
	document.getElementById("cargar1").innerHTML = precio;
}
	</script>
	</head>
	<body>
	
	<?php

	/* Clase que representa a un cliente en el dominio del problema */
class Cliente
{
	private $nombre;
	private $productosAlquilados;

	public function __construct($nombre)
	{
		$this->nombre=$nombre;
		$this->productosAlquilados=array();
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getProductosAlquilados()
	{
		return $this->productosAlquilados;
	}

	public function alquilarProducto($producto)
	{
		$this->productosAlquilados[]=$producto;
		return true;
	}
}

abstract class Producto
{
    protected $nombre;
    protected $precio;

    public function getNombre()
    {
       return $this->nombre;
    }

    abstract public function getPrecio();
}

class Pelicula extends Producto
{

	private $ano;
	private $director;
	private $alquiler;
	private $fecha_devolucion;

	public function __construct($nombre,$ano,$director,$alquiler,$fecha_devolucion)
	{
		$this->nombre = $nombre;
		$this->precio = 2;
		$this->ano = $ano;
		$this->director = $director;
		$this->alquiler = $alquiler;
		$this->fecha_devolucion = $fecha_devolucion;
	}

    public function getPrecio()
	{
	   return $this->precio;
	}

	public function getAno()
	{
	   return $this->ano;
	}

	public function getDirector()
	{
	   return $this->director;
	}
	public function getAlquiler()
	{
	   return $this->alquiler;
	}
	public function getFecha_devolucion()
	{
	   return $this->fecha_devolucion;
	}
}

class Cd extends Producto
{

	private $duracion;
	private $genero;

	public function __construct($nombre,$duracion,$genero)
	{
		$this->nombre = $nombre;
		$this->precio = 1;
		$this->genero = $genero;
		$this->duracion = $duracion;
	}

    public function getPrecio()
	{
	   return $this->precio;
	}

	public function getDuracion()
	{
	   return $this->duracion;
	}

	public function getGenero()
	{
	   return $this->Genero;
	}
}

class Juego extends Producto
{

	private $plataforma;
	private $genero;

	public function __construct($nombre,$plataforma,$genero)
	{
		$this->nombre = $nombre;
		$this->precio = 3;
		$this->idioma = $idioma;
		$this->duracion = $duracion;
	}

    public function getPrecio()
	{
	   return $this->precio;
	}

	public function getPlataforma()
	{
	   return $this->plataforma;
	}

	public function getGenero()
	{
	   return $this->Genero;
	}
}

class Videoclub
{

	private $nombre;
	private $productos;
	private $clientes;

	public function __construct($nombre)
	{
		$this->nombre=$nombre;
		$this->productos=array();
		$this->clientes=array();
	}

	public function addProducto($producto)
	{
		$this->productos[]=$producto;
	}

	public function getProductos()
	{
		return $this->productos;
	}

	public function addCliente($cliente)
	{
		$this->clientes[]=$cliente;
	}

	public function getClientes()
	{
		return $this->clientes;
	}

	public function alquilar($cliente,$producto)
	{
		$cliente->alquilarProducto($producto);
	}

}

//Creamos un videoclub
$videoclub= new Videoclub('VideoMax');

//Creamos un nuevo cliente de nombre Francisco
$cliente=new Cliente('Francisco');

$cliente2=new Cliente('Dani');

$cliente3=new Cliente('Anna');

//Creamos una nueva pelicula
$pelicula = new Pelicula('Harry Potter','2001','J. K. Rowling','no', '3 Dias');
$pelicula2 = new Pelicula('Toy Story','1998','Pixar','no', '3 Dias');
$pelicula3 = new Pelicula('Matrix','1997','Wachowski Bros.','no', '3 Dias');

//Registramos el cliente y el producto en el videoclub
$videoclub->addCliente($cliente);
$videoclub->addCliente($cliente2);
$videoclub->addCliente($cliente3);
$videoclub->addProducto($pelicula);
$videoclub->addProducto($pelicula2);
$videoclub->addProducto($pelicula3);

//El cliente alquila la pelicula
$videoclub->alquilar($cliente, $pelicula);
$videoclub->alquilar($cliente2, $pelicula2);
$videoclub->alquilar($cliente3, $pelicula3);
//Obtenemos la lista de clientes registrados
$clientes = $videoclub->getClientes();

//Imprimimos la lista de clientes registrados
echo '<p id="lista">Lista de Clientes:</p> <select id="selector">';
foreach($clientes as $cliente)
{
	echo '<option value='.$cliente->getNombre().'>'.$cliente->getNombre().'<br />';
}
echo '</select>';
//Obtenemos la lista de productos registrados
$productos = $videoclub->getProductos();
echo '
	<p id="productos">Lista de Productos:</p>
	<table id="tabla"><tr>
	<th>Pelicula</th><th>Alquiler</th><th>A&ntilde;o</th><th>Director</th><th>Alquilada</th><th>Devolucion</th></tr>';
	
foreach($productos as $producto)
{	
	echo '<tr><td>'.$producto->getNombre().'</td>';
	echo '<td><input type="button" name="alquilar" value="SOLICITAR" onclick="actualizarPrecio(); alquilar();" id="boton" /></td>';
	echo '<td>'.$producto->getAno().'</td>';
	echo '<td>'.$producto->getDirector().'</td>';
	echo '<td>'.$producto->getAlquiler().'</td>';
	echo '<td>'.$producto->getFecha_devolucion().'</td></tr>';
	
}
	echo '</table>';
	echo '<p id="precio">PRECIO: 2$ c/U</p><br/>';
	echo '<p id="recarga">Recarga por retraso en dias</p><select id="selector2" onchange="actualizarPrecio()">';
	echo '<option value="0">seleccionar</option><option type="number" value="1.2">1</option><option value="2.4">2</option><option value="3.6">+3 dias</option></select><br/><br/>';
	echo '<div id="cargar1"></div>';
	echo '<p id="dolar">$</p>';
	?>
	
	</body>
	
</html>