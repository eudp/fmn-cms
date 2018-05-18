<?php

    /**
     * Traduce el string de museos de las tablas de los elementos de los museos a sus nombres.
     *
     * @param string $museums, proviene de las tablas de los elementos de los museos.
     * @param bool $arr, indica falso si solo se quiere traducir un string que posee un solo 
     * codigo, o verdadero si el string posee varios códigos.
    */

	function domain_museum($museums, $arr = false)
	{
		$domain = array(
					1  => 'MUSEOS',
	                2  => 'GAN',
	                3  => 'MBA',
	                4  => 'MAC',
	                5  => 'MUCI',
	                6  => 'MEDI',
	                7  => 'MUSARQ',
	                8  => 'MAM',
	                9  => 'MUVA',
	                10 => 'MUCA',
	                11 => 'MUBARQ',
	                12 => 'MUCOR',
	                13 => 'MULLA',
	                14 => 'MUNAP',
	                15 => 'MAO',
	                18 => 'CNCRP',
	            );

		if (!$arr){
			return $domain[$museums];
		} else {

			$mus_arr = explode(",", $museums);

			$i = 0;
			$len = count($mus_arr);
			$out = '';
			foreach ($mus_arr as $key => $value) {

				if ($i == $len - 1) {
					$out .= $domain[$value];
				} else {
					$out .= $domain[$value] . '-';
				}
				$i++;
			}

			return $out;
		}
	}