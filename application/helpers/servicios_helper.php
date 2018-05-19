<?php

    /**
     * Traduce el string de servicios de la tabla establecimientos en su nombre de 
     * servicio correspondiente.
     *
     * @param string $services, cadena de caracteres con los servicios codificados.
    */

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

    /**
     * Construye el string para el campo servicios que se va a almacenar en la tabla de 
     * establecimientos.
     *
     * @param objeto $post, objeto proveniente del post en la creación/edición de 
     * establecimientos.
    */

    function servicios_form_post($post)
    {

        $string = '';

        for ($i=1; $i < 15; $i++) { 
            if (array_key_exists('ser_' . $i, $post)) {
                $string .= '1,';
            } else {
                $string .= '0,';
            }
        }

        return substr($string, 0, -1);
    }

    /*  */

    /**
     * Traduce el string de servicios de la tabla establecimientos en checked o vacio para la 
     * página de edición.
     *
     * @param string $services, cadena codificada de servicios.
    */

    function servicios_translate_edit($services)
    {
        $ser_arr = explode(",", $services);
        $arr = array();

        for ($i=0; $i < 14; $i++) { 
            array_push($arr, ($ser_arr[$i] == '1' ? 'checked' : '' ));
        }

        return $arr;
    }