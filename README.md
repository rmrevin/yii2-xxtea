Extension for yii2 encryption algorithm "XXTEA"
==========

Installation
------------
In `composer.json`:
```
{
    "require": {
        "rmrevin/yii2-xxtea": "1.2.0"
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
$XXTEA = \Yii::$app->get('xxtea');

$hash = $XXTEA->encrypt('data to encrypting');

$data = $XXTEA->decrypt($hash);
```

![external](http://www.quetzal.ru/i/new_logo.png)
![external_part](//www.quetzal.ru/i/new_logo.png)
![local](i/new_logo.png)
