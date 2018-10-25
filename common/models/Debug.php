<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 18.10.2018
 * Time: 17:35
 */

namespace common\models;


class Debug {
	
	public static function getPrint($text) {
		echo "<pre>";
			print_r($text);
		echo "</pre>";
		die();
	}
}