<?php

/**
 * Se usa para preseleccionar una opción en un dropdown
 * 
 * @param  mixed  $valor1 valor a comparar
 * @param  mixed  $valor2 valor a comparar
 * @return string         resultado de comparación
 */

if (! function_exists('validar_seleccion')) {
	function validar_seleccion($valor1, $valor2)
	{
		return ($valor1 == $valor2) ? 'selected' : '';
	}
}