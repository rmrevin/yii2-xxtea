<?php
/**
 * example.php
 * @author Revin Roman
 * @link http://phptime.ru
 */

/** @var rmrevin\yii\xxtea\Component $XXTEA */
$XXTEA = Yii::createObject([
	'class' => 'rmrevin\yii\xxtea\Component',
	'base64_encode' => true
]);

// encrypt string
$hash = $XXTEA->encrypt('very important data');

// decrypt string
$data = $XXTEA->decrypt($hash);