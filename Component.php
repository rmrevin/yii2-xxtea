<?php
/**
 * Component.php
 * @author Revin Roman
 * @link http://phptime.ru
 */

namespace rmrevin\yii\xxtea;

use yii\helpers\Security;

/**
 * Class Component
 * @package rmrevin\yii\xxtea
 */
class Component extends \yii\base\Component
{

	/** @var string unique secret key encryption. */
	public $key = null;

	/** @var bool receive whether to encode the hash algorithm "base64" (for data transfer). */
	public $base64_encode = false;

	/** @var CryptXXTEA object */
	private $_crypt = null;

	/**
	 * Method initialize
	 */
	public function init()
	{
		parent::init();

		if (empty($this->key)) {
			$this->key = Security::getSecretKey('XXTEA-secret-key', 16);
		}

		$this->_crypt = new CryptXXTEA();
		$this->crypt()->setKey($this->key);
	}

	/**
	 * Method returns Crypt_XXTEA object
	 * @return CryptXXTEA
	 */
	public function crypt() { return $this->_crypt; }

	/**
	 * @param string $string data encryption
	 * @return string
	 */
	public function encrypt($string)
	{
		$hash = $this->crypt()->encrypt($string);

		return (bool)$this->base64_encode === true ? base64_encode($hash) : $hash;
	}

	/**
	 * @param string $hash hash for decryption
	 * @return string
	 */
	public function decrypt($hash)
	{
		if ((bool)$this->base64_encode === true && is_string($hash)) {
			$hash = base64_decode($hash);
		}

		return $this->crypt()->decrypt($hash);
	}
}