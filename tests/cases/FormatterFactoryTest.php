<?php
use lindal1\tripsorter\cards\DefaultBoardingCard;
use lindal1\tripsorter\factories\FormatterFactory;
use lindal1\tripsorter\formatters\Formatter;
use lindal1\tripsorter\tests\framework\TestCase;

/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 05.06.17
 * Time: 23:23
 */
class FormatterFactoryTest extends TestCase
{
    public function testBuild()
    {
        $card = new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B',
            'custom field' => 'something',
            'another custom field' => ''
        ]);
        $formatter = FormatterFactory::build($card, [
            'templates' => [
                'from' => 'Going from {value}',
                'custom field' => 'I don`t know what is {value}'
            ],
            'defaultTemplate' => '{name} - {value}',
            'emptyTemplates' => [
                'another custom field' => 'it`s empty'
            ],
            'order' => [
                'from',
                'to',
                'another custom field',
                'custom field'
            ],
            'separator' => '; '
        ]);
        $this->assertTrue($formatter instanceof Formatter);
        $this->assertEqual([$formatter->render(), 'Going from Point A; to - Point B; it`s empty; I don`t know what is something']);
    }
}