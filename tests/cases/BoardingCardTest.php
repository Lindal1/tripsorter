<?php
use lindal1\tripsorter\cards\DefaultBoardingCard;
use lindal1\tripsorter\interfaces\IBoardingCard;
use lindal1\tripsorter\tests\framework\TestCase;

class BoardingCardTest extends TestCase
{

    public function testGetStartPoint()
    {
        $this->assertEqual(['Point A', $this->getCard()->getStartPoint()]);
    }

    public function testGetEndPoint()
    {
        $this->assertEqual(['Point B', $this->getCard()->getEndPoint()]);
    }

    public function testRender()
    {
        $this->assertTrue(is_string($this->getCard()->render()));
    }

    private function getCard(): IBoardingCard
    {
        return new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B'
        ]);
    }

}