<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 04.06.17
 * Time: 4:18
 */

namespace lindal1\tripsorter\interfaces;


interface ISorter
{

    /**
     * Add new item
     * @param IBoardingCard $card
     * @return ISorter
     */
    public function addItem(IBoardingCard $card): ISorter;

    /**
     * Return added items
     * @return array
     */
    public function getItems(): array;

    /**
     * Sort added items
     * @return ISorter
     */
    public function sort(): ISorter;

    /**
     * Render travel list
     * @return string
     */
    public function render(): string;

    /**
     * Set separator between boarding cards when rendering
     * @param string $separator
     * @return ISorter
     */
    public function setSeparator(string $separator): ISorter;

}