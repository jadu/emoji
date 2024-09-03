<?php

namespace Jadu\Emoji;

use Jadu\Emoji\Index\CompiledIndex;

class EmojiTest extends \PHPUnit_Framework_TestCase
{
    public $emoji;

    public function setUp()
    {
        $this->emoji = new Emoji(new CompiledIndex());
    }

    public function testEmojiReplacesUnicodeEmojiWithImage()
    {
        $replacedString = $this->emoji->replaceEmojiWithImages('I ❤ Emoji');
        $this->assertSame('I <img alt=":heart:" class="emoji" src="https://cdn.jsdelivr.net/gh/jdecked/twemoji/assets/svg/2764.svg"> Emoji', $replacedString);
    }

    public function testEmojiReplacesNamedEmojiWithImage()
    {
        $replacedString = $this->emoji->replaceEmojiWithImages('Merry Christmas :santa:');
        $this->assertSame('Merry Christmas <img alt=":santa:" class="emoji" src="https://cdn.jsdelivr.net/gh/jdecked/twemoji/assets/svg/1f385.svg">', $replacedString);
    }

    public function testReplaceNamedWithUnicode()
    {
        $replacedString = $this->emoji->replaceNamedWithUnicode('I :heart: Emoji');

        $this->assertSame('I ❤ Emoji', $replacedString);
    }

    public function testReplaceUnicodeWithNamed()
    {
        $replacedString = $this->emoji->replaceUnicodeWithNamed('I ❤ Emoji');

        $this->assertSame('I :heart: Emoji', $replacedString);
    }

    public function testCountEmojiWithoutAnyEmoji()
    {
        $this->assertSame(0, $this->emoji->countEmoji('This does not contain any emoji'));
    }

    public function testCountEmojiWithEmoji()
    {
        $this->assertSame(3, $this->emoji->countEmoji('Three emoji for you! ❤❤ :smile:'));
    }
}
