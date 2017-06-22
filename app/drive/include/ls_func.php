<?php
function tipo_archivo($archivo,$camino) {

	if (is_dir($camino."/".$archivo)) {
	return 1; // Directory
	}
	else{
	return 2; // File
	}
}
function tamanio_archivo($archivo, $camino){
	return filesize($camino."/".$archivo);
}

function logentradas($cadena)
{
$fecha = getdate();

$cadena =  $fecha["hours"] . ":" . $fecha["minutes"] .  " - ".$fecha["month"] . " " . $fecha["mday"] . "," . " " . $fecha["year"]. "	" . $cadena;
$cadena = $cadena . "	" . getenv("QUERY_STRING") ;
$filename = "log.txt";
   if (!$handle = fopen($filename, 'a')) {
         print "No es posible abrir el archivo ($filename)";
         exit;
   }
$somecontent = $cadena."\n";
if(is_writable($filename)){
   if (!fwrite($handle, $somecontent)) {
       print "No es posible escribir el archivo: ($filename)";
       exit;
   }
} else {
   chmod ($filename , 0777) or die ("Se presento un problema al tratar de escribir el archivo, probablemente no tiene permisos o el archivo esta ocupado");
   echo "Por favor Recargue la Pagina";
}


}

// Manejo de restricciones de Acceso

if ($Tipo != 0)
{
	// Para comprobar por nombre de cliente
	$dire = gethostbyaddr(getenv("REMOTE_ADDR"));
	// si se desea checar por ip solo usar el getenv
	$dires= explode(".",$dire);
	$Listaip = explode(",",$Listado);
	$encontro = 0;
	for ($i = 0;count($dires) > $i; $i++)
	{
		for ($t=0; count($Listaip) > $t; $t++)
		{
			//if ($dires[$i] == $Listaip[$t])
			if (strcasecmp($dires[$i],$Listaip[$t]) == 0)
				$encontro = 1;
				
		}
	}
	
	$mensaje = $dire . "<b>Acceso Denegado</b> <br> El acceso a la aplicacion fue denegado. <br> Contacte al Administrador de la Aplicacion.";

	if ($Tipo == 1 && $encontro == 0)
	{
		echo $mensaje;
		exit();
	}
	if ($Tipo == 2 && $encontro == 1)
	{
		echo $mensaje;
		exit();
	}
	logentradas($dire);

}


function setUpperPath($path){
	$lista = explode('/',$path);
	$path = "";
	for ($i = 1;(count($lista)-1) > $i; $i++)
	{
		if (count($lista) > 2 )
			$path = $path ."/". $lista[$i];
		else
			$path = $path . $lista[$i];
	}
	return $path;
}
?>