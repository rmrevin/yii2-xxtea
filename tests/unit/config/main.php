<?php
/**
 * main.php
 * @author: Roman Revin <xgismox@gmail.com>
 * @date  : 08.06.2013
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