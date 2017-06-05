<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 31.05.17
 * Time: 13:54
 */

namespace lindal1\tripsorter\interfaces;


interface IFormatter
{

    /**
     * IFormatter constructor.
     * @param IBoardingCard $boardingCard
     */
    public function __construct(IBoardingCard $boardingCard);

    /**
     * @return string
     */
    public function render(): string;

    /**
     * @param string $attribute
     * @param string $template
     * @return IFormatter
     */
    public function setTemplate(string $attribute, string $template): IFormatter;

    /**
     * @param string $attribute
     * @return string
     */
    public function getTemplate(string $attribute): string;

    /**
     * @param array $order
     * @return IFormatter
     */
    public function setOrder(array $order): IFormatter;

    /**
     * @param string $separator
     * @return IFormatter
     */
    public function setSeparator(string $separator): IFormatter;

    /**
     * @param string $attribute
     * @param string $template
     * @return IFormatter
     */
    public function setEmptyTemplate(string $attribute, string $template): IFormatter;

    /**
     * @param string $attribute
     * @return string
     */
    public function getEmptyTemplate(string $attribute): string;

    /**
     * @param string $template
     * @return IFormatter
     */
    public function setDefaultTemplate(string $template): IFormatter;

    /**
     * @return IBoardingCard
     */
    public function getBoardingCard(): IBoardingCard;

}