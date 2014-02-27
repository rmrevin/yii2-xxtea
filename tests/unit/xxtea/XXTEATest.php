<?php
/**
 * XXTEATest.php
 * @author Revin Roman
 * @link http://phptime.ru
 */

namespace rmrevin\yii\xxtea\tests\unit\xxtea;

use rmrevin\yii\xxtea\Component;
use rmrevin\yii\xxtea\tests\unit\TestCase;

class XXTEATest extends TestCase
{

	public function testMain()
	{
		$this->assertInstanceOf('rmrevin\yii\xxtea\CryptXXTEA', $this->XXTEA()->crypt());

		$source_data = 'very important data';

		$hash = $this
			->XXTEA()
			->encrypt($source_data);
		$this->assertNotEmpty($hash);

		$data = $this
			->XXTEA()
			->decrypt($hash);
		$this->assertEquals($source_data, $data);

		$this->assertEmpty($this->XXTEA()->encrypt(''));
		$this->assertEmpty($this->XXTEA()->decrypt(''));
	}

	/**
	 * @return Component
	 */
	private function XXTEA()
	{
		return \Yii::$app->getComponent('xxtea');
	}

	public function testTooShortKeyExceptions()
	{
		$this->XXTEA()
			->crypt()
			->setKey('a');
		$key = $this
			->XXTEA()
			->crypt()
			->getKey();
		$this->assertEquals(count($key), 4);
		$this->assertNotEmpty($key[0]);
		$this->assertEmpty($key[1]);
		$this->assertEmpty($key[2]);
		$this->assertEmpty($key[3]);
	}

	public function testTooLongKeyExceptions()
	{
		$this->setExpectedException('rmrevin\yii\xxtea\XXTEAException', 'The secret key cannot be more than 16 characters.');
		$this
			->XXTEA()
			->crypt()
			->setKey(str_repeat('a', 17));
	}

	public function testNullKeyExceptions()
	{
		$this->setExpectedException('rmrevin\yii\xxtea\XXTEAException', 'The secret key must be a string.');
		$this->XXTEA()->crypt()->setKey(null);
	}

	public function testEmptyKeyExceptions()
	{
		$this->setExpectedException('rmrevin\yii\xxtea\XXTEAException', 'The secret key cannot be empty.');
		$this->XXTEA()->crypt()->setKey('');
	}

	public function testEmptyEncodeDataExceptions()
	{
		$this->setExpectedException('rmrevin\yii\xxtea\XXTEAException', 'The plain text must be a string.');
		$this->XXTEA()->encrypt([]);
	}

	public function testEmptyDecodeDataExceptions()
	{
		$this->setExpectedException('rmrevin\yii\xxtea\XXTEAException', 'The cipher text must be a string.');
		$this->XXTEA()->decrypt([]);
	}
}