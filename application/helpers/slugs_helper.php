<?php

    /**
     * Verifica si el slug que se va a crear está disponible.
     *
     * @param string $string, cadena de caracteres que corresponde al titulo del elemento.
     * @param object $model, modelo al que pertenece el elemento
     * @param string $museos, su valor puede ser '_museos' o '', dependiendo cual tabla se quiere mostrar.
    */
    
    function valid_slug ($string, $model, $museos = '')
    {
        $string = substr(url_title(quitar_acentos($string), 'dash', true), 0, 95);
        $string_com = url_title(quitar_acentos($string), 'dash', true);

        if (strlen($string) < strlen($string_com)){
            $string = eliminar_hasta($string);
        }

        $i = 1;
        $extra = '';

        while ($model->check_slug($string . $extra, $museos)) {
            $extra = '-' . $i;
            $i++;
        }

        return $string . $extra;
    }

    /**
     * Carga masivamente todos los slugs  de una tabla (modelo).
     *
     * @param object $model, modelo al que pertenece el elemento
    */

    function slugs_massive ($model)
    {
        $data = $model->get(null, null, null, null, '_museos', false);

        foreach ($data as $key => $value) {

            $string = substr(url_title(quitar_acentos($value['title']), 'dash', true), 0, 95);
            $string_com = url_title(quitar_acentos($value['title']), 'dash', true);

            if (strlen($string) < strlen($string_com)){
                $string = eliminar_hasta($string);
            }

            $i = 1;
            $extra = '';

            while ($model->check_slug($string . $extra, '_museos')) {
                $extra = '-' . $i;
                $i++;
            }

            $model->set_slug($value['news_id'], $string . $extra, '_museos');
        }
        return;
    }

    function quitar_acentos ($str)
    {
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $out = strtr( $str, $unwanted_array );

        return $out;
    }

    /**
     * Elimina caracteres hasta que encuentre un guión. Esto con la finalidad de crear un 
     * slug coherente.
     *
     * @param string $str, cadena de caracteres.
    */

    function eliminar_hasta ($str)
    {
        $i = strlen($str) - 1;

        do {

            if ($str[$i] == '-')
            {
                break;
            }
            $str = substr($str, 0, -1);
            $i--;
        } while ( $i >= 0 );

        return substr($str, 0, -1);
    }