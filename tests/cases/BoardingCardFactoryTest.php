<?php

use lindal1\tripsorter\cards\BusBoardingCard;
use lindal1\tripsorter\cards\DefaultBoardingCard;
use lindal1\tripsorter\factories\BoardingCardFactory;
use lindal1\tripsorter\tests\framework\TestCase;

class BoardingCardFactoryTest extends TestCase
{
    public function testBuildDefaultBoardingCard()
    {
        $attributes = [
            'from' => 'Point A',
            'to' => 'Point B',
            'custom field' => 'something',
            'another custom field' => ''
        ];
        $card = BoardingCardFactory::build([
            'attributes' => $attributes
        ]);

        $this->assertTrue($card instanceof DefaultBoardingCard);
        $this->assertEqual([$card->getAttributes(), $attributes]);
    }

    public function testBuildBusCard()
    {
        $card = BoardingCardFactory::build([
            'class' => BusBoardingCard::class,
            'attributes' => [
                'from' => 'Point A',
                'to' => 'Point B',
                'bus number' => '321'
            ]
        ]);

        $this->assertTrue($card instanceof BusBoardingCard);
    }
}