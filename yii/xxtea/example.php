<?php
/**
 * example.php
 * @author: Revin Roman <xgismox@gmail.com>
 */

/** @var yii\xxtea\XXTEA $XXTEA */
$XXTEA = Yii::createObject([
	'class' => 'yii\xxtea\XXTEA',
	'key' => \yii\helpers\Security::getSecretKey('XXTEA-secret-key'),
	'base64_encode' => true
]);

// encrypt string
$hash = $XXTEA->encrypt('very important data');

// decrypt string
$data = $XXTEA->decrypt($hash);