Extension for yii2 encryption algorithm "XXTEA"
==========

Installation
------------
In `composer.json`:
```
{
    "require": {
        "rmrevin/yii2-xxtea": "1.1.*"
    }
}
```

configuration
-------------
`/protected/config/main.php`
```php
<?
return array(
  // ...
	'components' => array(
		// ...
		'xxtea' => array(
			'class' => 'rmrevin\yii\xxtea\Component',
			'key' => 'qwertyuiopasdfgh', // 16 letters
			'base64_encode' => true,
		),
	),
	// ...
);
```

Usage
-----
```php
<?
// ...
$XXTEA = Yii::$app->getComponent('xxtea');

$hash = $XXTEA->encrypt('data to encrypting');

$data = $XXTEA->decrypt($hash);
```
