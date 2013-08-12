<?php
/**
 * XXTEA.php
 * @author: Revin Roman <xgismox@gmail.com>
 */

namespace yii\xxtea;

use yii\base\Component;

/**
 * Class XXTEA
 * @package yii\xxtea
 */
class XXTEA extends Component
{

	/** @var string unique secret key encryption. */
	public $key = null;

	/** @var bool receive whether to encode the hash algorithm "base64" (for data transfer). */
	public $base64_encode = false;

	/** @var \Crypt_XXTEA object */
	private $_crypt = null;

	/**
	 * Method initialize
	 */
	public function init()
	{
		parent::init();

		if (!class_exists('Crypt_XXTEA')) {
			require(__DIR__ . '/Crypt_XXTEA.php');
		}

		if (empty($this->key)) {
			throw new XXTEAException('Secret key is undefined.');
		}

		$this->_crypt = new \Crypt_XXTEA();
		$this->crypt()->setKey($this->key);
	}

	/**
	 * Method returns Crypt_XXTEA object
	 * @return \Crypt_XXTEA
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