<?php

namespace lindal1\tripsorter\cards;

use lindal1\tripsorter\errors\BoardingCardValidationException;
use lindal1\tripsorter\factories\FormatterFactory;
use lindal1\tripsorter\interfaces\IFormatter;
use lindal1\tripsorter\interfaces\IBoardingCard;

class DefaultBoardingCard implements IBoardingCard
{
    const START_POINT_PARAM = 'from';
    const END_POINT_PARAM = 'to';

    protected $attributes = [];
    protected $formatter;

    /**
     * AbstractBoardingCard constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->validate();
    }

    /**
     * @inheritdoc
     */
    public function getStartPoint(): string
    {
        return $this->getAttribute(self::START_POINT_PARAM);
    }

    /**
     * @inheritdoc
     */
    public function getEndPoint(): string
    {
        return $this->getAttribute(self::END_POINT_PARAM);
    }

    /**
     * @inheritdoc
     */
    public function render(): string
    {
        return $this->getFormatter()->render();
    }

    /**
     * @inheritdoc
     */
    public function setAttribute(string $name, string $value): IBoardingCard
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAttribute(string $name): string
    {
        return $this->attributes[$name];
    }

    /**
     * @inheritdoc
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param IFormatter $formatter
     * @return DefaultBoardingCard
     */
    public function setFormatter(IFormatter $formatter): DefaultBoardingCard
    {
        $this->formatter = $formatter;
        return $this;
    }

    /**
     * @return IFormatter
     */
    public function getFormatter(): IFormatter
    {
        if (!$this->formatter) {
            $this->formatter = $this->getDefaultFormatter();
        }
        return $this->formatter;
    }

    /**
     * @return IFormatter
     */
    protected function getDefaultFormatter(): IFormatter
    {
        return FormatterFactory::build($this);
    }

    /**
     * @return bool
     * @throws BoardingCardValidationException
     */
    protected function validate()
    {
        if (!$this->getStartPoint() || !$this->getEndPoint()) {
            throw new BoardingCardValidationException;
        }
        return true;
    }

}