<?php
namespace lindal1\tripsorter\interfaces;

interface IBoardingCard
{

    /**
     * @return string
     */
    public function getStartPoint(): string;

    /**
     * @return string
     */
    public function getEndPoint(): string;

    /**
     * @return string
     */
    public function render(): string;

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @param string $name
     * @return string
     */
    public function getAttribute(string $name): string;

    /**
     * @param string $name
     * @param string $value
     * @return IBoardingCard
     */
    public function setAttribute(string $name, string $value): IBoardingCard;

}