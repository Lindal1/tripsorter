<?php

namespace lindal1\tripsorter;

use lindal1\tripsorter\errors\BrokenTripException;
use lindal1\tripsorter\errors\CycleTripException;
use lindal1\tripsorter\interfaces\IBoardingCard;
use lindal1\tripsorter\interfaces\ISorter;

class Sorter implements ISorter
{

    protected $items = [];
    protected $separator = '<br>';

    /**
     * @inheritdoc
     */
    public function addItem(IBoardingCard $card): ISorter
    {
        $this->items[] = $card;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @throws BrokenTripException
     * @inheritdoc
     */
    public function sort(): ISorter
    {
        if (!$this->items) {
            return $this;
        }
        $startPoints = [];
        $endPoints = [];
        $sortedItems = [];
        foreach ($this->items as $key => $item) {
            $startPoints[$key] = $item->getStartPoint();
            $endPoints[$key] = $item->getEndPoint();
        }
        $firstItem = $this->findFirstPoint($startPoints, $endPoints);
        $sortedItems[] = $firstItem;
        $endPoint = $firstItem->getEndPoint();
        while ($nextPoint = $this->findNextPoint($endPoint, $startPoints)) {
            $endPoint = $nextPoint->getEndPoint();
            $sortedItems[] = $nextPoint;
        }

        if (count($sortedItems) != count($this->items)) {
            throw new BrokenTripException();
        }

        $this->items = $sortedItems;
        return $this;
    }

    /**
     * @param array $startPoints
     * @param array $endPoints
     * @return IBoardingCard
     * @throws CycleTripException
     */
    private function findFirstPoint(array $startPoints, array $endPoints)
    {
        foreach ($startPoints as $key => $startPoint) {
            $isFirst = true;
            foreach ($endPoints as $endPoint) {
                if ($this->isPointsEquals($startPoint, $endPoint)) {
                    $isFirst = false;
                    continue;
                }
            }
            if ($isFirst) {
                return $this->items[$key];
            }
        }
        throw new CycleTripException();
    }

    /**
     * @param string $endPoint
     * @param array $startPoints
     * @return IBoardingCard|null
     */
    private function findNextPoint(string $endPoint, array $startPoints)
    {
        foreach ($startPoints as $key => $startPoint) {
            if ($this->isPointsEquals($startPoint, $endPoint)) {
                return $this->items[$key];
            }
        }
        return null;
    }

    /**
     * We can rewrite this method If we want to compare points differently
     * @param $point1
     * @param $point2
     * @return bool
     */
    protected function isPointsEquals($point1, $point2): bool
    {
        return $point1 == $point2;
    }

    /**
     * @inheritdoc
     */
    public function render(): string
    {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = $item->render();
        }
        return implode($this->separator, $result);
    }

    /**
     * @inheritdoc
     */
    public function setSeparator(string $separator): ISorter
    {
        $this->separator = $separator;
        return $this;
    }
}