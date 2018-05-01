<?php

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