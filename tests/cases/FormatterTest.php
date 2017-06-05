<?php
use lindal1\tripsorter\cards\DefaultBoardingCard;
use lindal1\tripsorter\formatters\Formatter;
use lindal1\tripsorter\interfaces\IFormatter;
use lindal1\tripsorter\tests\framework\TestCase;

class FormatterTest extends TestCase
{

    private function getFormatter(): IFormatter
    {
        $card = new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B'
        ]);
        return new Formatter($card);
    }

    public function testRender()
    {
        $this->assertEqual([$this->getFormatter()->render(), 'from: Point A, to: Point B']);
    }

    public function testSetSeparator()
    {
        $formatter = $this->getFormatter();
        $formatter->setSeparator('; ');
        $this->assertEqual([$formatter->render(), 'from: Point A; to: Point B']);
    }

    public function testSetTemplate()
    {
        $formatter = $this->getFormatter();
        $formatter->setTemplate('from', 'Take bus in {value}');
        $formatter->setTemplate('to', 'drive to {value}');
        $this->assertEqual([$formatter->render(), 'Take bus in Point A, drive to Point B']);
    }

    public function testSetOrder()
    {
        $formatter = $this->getFormatter();
        $formatter->getBoardingCard()->setAttribute('seat', '#32');
        $formatter->setOrder([
            'seat',
            'to'
        ]);
        $this->assertEqual([$formatter->render(), 'seat: #32, to: Point B, from: Point A']);
    }

    public function testSetEmptyTemplate()
    {
        $formatter = $this->getFormatter()
            ->setEmptyTemplate('some attribute', 'some attribute is empty');
        $formatter->getBoardingCard()->setAttribute('some attribute', '');
        $this->assertEqual(['from: Point A, to: Point B, some attribute is empty', $formatter->render()]);
    }

}