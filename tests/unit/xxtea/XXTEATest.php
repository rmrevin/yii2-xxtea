<?php
/**
 * XXTEATest.php
 * @author Revin Roman http://phptime.ru
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

        $source_big_data = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';

        $hash = $this
            ->XXTEA()
            ->encrypt($source_big_data);
        $this->assertNotEmpty($hash);

        $data = $this
            ->XXTEA()
            ->decrypt($hash);
        $this->assertEquals($source_big_data, $data);

        $this->assertEmpty($this->XXTEA()->encrypt(''));
        $this->assertEmpty($this->XXTEA()->decrypt(''));
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

    public function testConfigureKeyEmptyExceptions()
    {
        $this->setExpectedException(
            'yii\base\InvalidConfigException',
            'rmrevin\yii\xxtea\Component::key must be configured with a secret key.'
        );
        \Yii::createObject(
            [
                'class' => '\rmrevin\yii\xxtea\Component',
            ]
        );
    }

    public function testSetKeyTooLongExceptions()
    {
        $this->setExpectedException(
            'yii\base\InvalidParamException',
            'rmrevin\yii\xxtea\CryptXXTEA::setKey() - The secret key cannot be more than 16 characters.'
        );
        $this
            ->XXTEA()
            ->crypt()
            ->setKey(str_repeat('a', 17));
    }

    public function testSetKeyNullExceptions()
    {
        $this->setExpectedException(
            'yii\base\InvalidParamException',
            'rmrevin\yii\xxtea\CryptXXTEA::setKey() - The secret key must be a string.'
        );
        $this->XXTEA()->crypt()->setKey(null);
    }

    public function testSetKeyEmptyExceptions()
    {
        $this->setExpectedException(
            'yii\base\InvalidParamException',
            'rmrevin\yii\xxtea\CryptXXTEA::setKey() - The secret key cannot be empty.'
        );
        $this->XXTEA()->crypt()->setKey('');
    }

    public function testEmptyEncodeDataExceptions()
    {
        $this->setExpectedException(
            'yii\base\InvalidParamException',
            'rmrevin\yii\xxtea\CryptXXTEA::encrypt() - The plain text must be a string.'
        );
        $this->XXTEA()->encrypt([]);
    }

    public function testEmptyDecodeDataExceptions()
    {
        $this->setExpectedException(
            'yii\base\InvalidParamException',
            'rmrevin\yii\xxtea\CryptXXTEA::decrypt() - The cipher text must be a string.'
        );
        $this->XXTEA()->decrypt([]);
    }

    /**
     * @return Component
     */
    private function XXTEA()
    {
        return \Yii::$app->get('xxtea');
    }
}