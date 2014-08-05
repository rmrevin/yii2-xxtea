<?php
/**
 * main.php
 * @author Roman Revin
 * @link http://phptime.ru
 */

use rmrevin\yii\xxtea\Component;
use yii\helpers\StringHelper;

return [
    'id' => 'testapp',
    'basePath' => realpath(__DIR__ . '/..'),
    'components' => [
        'xxtea' => [
            'class' => Component::className(),
            'base64_encode' => true,
            'key' => StringHelper::truncate(sha1('ver secret test key'), 16, null, 'utf8'),
        ],
    ]
];