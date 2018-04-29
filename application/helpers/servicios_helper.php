<?php

function servicios_translate($services)
{	
	$servicios = array(
				'Información',
                'Cafetín',
                'Teléfono',
                'Estacionamiento',
                'Baño',
                'Tienda',
                'WIFI',
                'Ascensor',
                'Escaleras',
                'Cine',
                'Multimedia',
                'Primeros Auxilios',
                'Silla de Ruedas',
                'Biblioteca'	
            );

	$ser_arr = explode(",", $services);

	$i = 0;
	$out = '';
	for ($i=0; $i < 14; $i++) { 

		if ($ser_arr[$i] == 1) {
			$out .= $servicios[$i] . ' ';
		}
	}
	
	return $out;
}