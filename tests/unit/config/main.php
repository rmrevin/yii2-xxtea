<?php
/**
 * main.php
 * @author Roman Revin
 * @link http://phptime.ru
 */

return [
	'id' => 'testapp',
	'basePath' => realpath(__DIR__ . '/..'),
	'components' => [
		'xxtea' => [
			'class' => 'yii\xxtea\XXTEA',
			'key' => 'XXTEA-secret-key',
			'base64_encode' => true
		]
	]
];