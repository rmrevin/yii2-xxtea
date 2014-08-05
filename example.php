<?php
/**
 * example.php
 * @author Revin Roman http://phptime.ru
 */

use yii\helpers\StringHelper;

/** @var rmrevin\yii\xxtea\Component $XXTEA */
$XXTEA = Yii::createObject(
    [
        'class' => 'rmrevin\yii\xxtea\Component',
        'base64_encode' => true,
        'key' => '16 letters key..',
    ]
);

// encrypt string
$hash = $XXTEA->encrypt('very important data');

// decrypt string
$data = $XXTEA->decrypt($hash);