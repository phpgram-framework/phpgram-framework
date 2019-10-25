<?php
/**
 * phpgram project
 *
 * This File is part of the phpgram Framework
 *
 * Web: https://gitlab.com/grammm/php-gram/phpgram-framework
 *
 * @license https://gitlab.com/grammm/php-gram/phpgram/blob/master/LICENSE
 *
 * @author Jörn Heinemann <joernheinemann@gmx.de>
 */

/**
 * Allgemeine Funktionen die keine Klasse brauchen
 */


if(!function_exists('debug_page')){
	/**
	 * Macht einen var_dumb mit <pre></pre> bzw ein print_r von daten
	 *
	 * @param $data
	 * @param bool $vd
	 */
	function debug_page($data,$vd=false){
		echo "<pre>";
		if($vd){
			var_dump($data);
		}else{
			print_r($data);
		}
		echo "</pre>";
	}
}

if(!function_exists('echoExep')){
	/**
	 * Gibt eine Exception aus
	 * @param $e
	 */
	function echoExep($e){
		echo "<pre>";
		echo $e;
		echo "</pre>";
	}
}