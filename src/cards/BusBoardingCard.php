<?php

namespace lindal1\tripsorter\cards;


use lindal1\tripsorter\errors\BoardingCardValidationException;
use lindal1\tripsorter\factories\FormatterFactory;
use lindal1\tripsorter\interfaces\IFormatter;

class BusBoardingCard extends DefaultBoardingCard
{

    /**
     * @inheritdoc
     */
    protected function validate()
    {
        parent::validate();
        if (!isset($this->attributes['bus number'])) {
            throw new BoardingCardValidationException();
        }
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultFormatter(): IFormatter
    {
        return FormatterFactory::build($this, [
            'templates' => [
                'from' => 'Take bus on {value}',
                'to' => 'drive to {value}',
                'bus number' => 'your bus #{value}'
            ]
        ]);
    }
}