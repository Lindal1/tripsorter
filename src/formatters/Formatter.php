<?php

namespace lindal1\tripsorter\formatters;

use lindal1\tripsorter\interfaces\IBoardingCard;
use lindal1\tripsorter\interfaces\IFormatter;

class Formatter implements IFormatter
{

    const ATTRIBUTE_PLACEHOLDER = '{name}';
    const VALUE_PLACEHOLDER = '{value}';

    protected $order = [];
    protected $separator = ', ';
    protected $templates = [];
    protected $emptyTemplates = [];
    protected $defaultTemplate = '{name}: {value}';
    protected $boardingCard;

    /**
     * @inheritdoc
     */
    public function __construct(IBoardingCard $boardingCard)
    {
        $this->boardingCard = $boardingCard;
    }

    /**
     * @inheritdoc
     */
    public function render(): string
    {
        $text = [];
        foreach ($this->getSortedAttributes() as $attribute => $value) {
            $text[] = $this->renderAttribute($attribute, $value, $this->getAttributeTemplate($attribute));
        }
        return implode($this->separator, $text);
    }

    /**
     * @return array
     */
    protected function getSortedAttributes(): array
    {
        $sorted = [];
        $attributes = $this->boardingCard->getAttributes();
        foreach ($this->order as $name) {
            $sorted[$name] = $attributes[$name];
            unset($attributes[$name]);
        }
        $sorted = array_merge($sorted, $attributes);
        return $sorted;
    }

    /**
     * @param $attribute
     * @return string
     */
    protected function getAttributeTemplate($attribute): string
    {
        return isset($this->templates[$attribute]) ? $this->templates[$attribute] : $this->defaultTemplate;
    }

    /**
     * @param $attribute
     * @param $value
     * @return string
     */
    protected function renderAttribute($attribute, $value): string
    {
        return str_replace([self::ATTRIBUTE_PLACEHOLDER, self::VALUE_PLACEHOLDER], [$attribute, $value], $this->getTemplate($attribute));
    }

    /**
     * @inheritdoc
     */
    public function setTemplate(string $attribute, string $template): IFormatter
    {
        $this->templates[$attribute] = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTemplate(string $attribute): string
    {
        return $this->templates[$attribute] ?? $this->defaultTemplate;
    }

    /**
     * @inheritdoc
     */
    public function setOrder(array $order): IFormatter
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setSeparator(string $separator): IFormatter
    {
        $this->separator = $separator;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setEmptyTemplate(string $attribute, string $template): IFormatter
    {
        $this->emptyTemplates[$attribute] = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setDefaultTemplate(string $template): IFormatter
    {
        $this->defaultTemplate = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmptyTemplate(string $attribute): string
    {
        return $this->emptyTemplates[$attribute] ?? '';
    }

    /**
     * @return IBoardingCard
     */
    public function getBoardingCard(): IBoardingCard
    {
        return $this->boardingCard;
    }
}