<?php

use lindal1\tripsorter\cards\DefaultBoardingCard;
use lindal1\tripsorter\errors\BrokenTripException;
use lindal1\tripsorter\errors\CycleTripException;
use lindal1\tripsorter\Sorter;
use lindal1\tripsorter\tests\framework\TestCase;

class SorterTest extends TestCase
{

    private function getSorter()
    {
        return new Sorter();
    }

    public function testAddItem()
    {
        $sorter = $this->getSorter();
        $this->assertEqal([count($sorter->getItems()), 0]);
        $sorter->addItem(new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B'
        ]));
        $this->assertEqal([count($sorter->getItems()), 1]);
    }

    public function testGetItems()
    {
        $sorter = $this->getSorter();
        $sorter->addItem(new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B'
        ]));
        $this->asserTrue(is_array($sorter->getItems()));
        $this->assertEqal([count($sorter->getItems()), 1]);
    }

    public function testSort()
    {
        $card1 = new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B'
        ]);
        $card2 = new DefaultBoardingCard([
            'from' => 'Point C',
            'to' => 'Point D'
        ]);
        $card3 = new DefaultBoardingCard([
            'from' => 'Point B',
            'to' => 'Point C'
        ]);

        $items = $this->getSorter()
            ->addItem($card1)
            ->addItem($card2)
            ->addItem($card3)
            ->sort()
            ->getItems();
        $this->assertEqual([$items[0]->getStartPoint(), $card1->getStartPoint()]);
        $this->assertEqual([$items[1]->getStartPoint(), $card3->getStartPoint()]);
        $this->assertEqual([$items[2]->getStartPoint(), $card2->getStartPoint()]);
    }

    public function testCycleTrip()
    {
        $card1 = new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B'
        ]);
        $card2 = new DefaultBoardingCard([
            'from' => 'Point C',
            'to' => 'Point A'
        ]);
        $card3 = new DefaultBoardingCard([
            'from' => 'Point B',
            'to' => 'Point C'
        ]);

        try {
            $this->getSorter()
                ->addItem($card1)
                ->addItem($card2)
                ->addItem($card3)
                ->sort()
                ->getItems();
            $this->assertTrue(false);
        } catch (CycleTripException $e) {
            $this->assertTrue(true);
        }
    }

    public function testBrokenTrip()
    {
        $card1 = new DefaultBoardingCard([
            'from' => 'Point A',
            'to' => 'Point B'
        ]);
        $card2 = new DefaultBoardingCard([
            'from' => 'Point E',
            'to' => 'Point D'
        ]);
        $card3 = new DefaultBoardingCard([
            'from' => 'Point B',
            'to' => 'Point C'
        ]);

        try {
            $this->getSorter()
                ->addItem($card1)
                ->addItem($card2)
                ->addItem($card3)
                ->sort()
                ->getItems();
            $this->assertTrue(false);
        } catch (BrokenTripException $e) {
            $this->assertTrue(true);
        }
    }

}