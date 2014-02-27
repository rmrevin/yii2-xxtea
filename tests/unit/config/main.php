<?php
/**
 * main.php
 * @author Roman Revin
 * @link http://phptime.ru
 */

use rmrevin\yii\xxtea\Component;

return [
	'id' => 'testapp',
	'basePath' => realpath(__DIR__ . '/..'),
	'components' => [
		'xxtea' => [
			'class' => Component::className(),
			'base64_encode' => true
		]
	]
];