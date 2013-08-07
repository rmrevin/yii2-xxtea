<?php
/**
 * XXTEA.php
 * @author: Revin Roman <xgismox@gmail.com>
 */

namespace yii\xxtea;

use yii\base\Component;

class XXTEA extends Component
{

	public $key;

	public $base64_encode = false;

	/** @var Crypt_XXTEA */
	private $_crtypter = null;

	public function init()
	{
		parent::init();

		$this->_crtypter = new Crypt_XXTEA();
		$this->_crtypter->setKey($this->key);
	}

	public function encrypt($string)
	{
		$hash = $this->_crtypter->encrypt($string);

		return (bool)$this->base64_encode === true ? base64_encode($hash) : $hash;
	}

	public function decrypt($hash)
	{
		if ((bool)$this->base64_encode === true) {
			$hash = base64_decode($hash);
		}

		return $this->_crtypter->decrypt($hash);
	}
}