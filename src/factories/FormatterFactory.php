<?php

namespace lindal1\tripsorter\factories;


use lindal1\tripsorter\formatters\Formatter;
use lindal1\tripsorter\interfaces\IBoardingCard;
use lindal1\tripsorter\interfaces\IFormatter;

class FormatterFactory
{
    /**
     * $params['class']             defined class which need to use for initialization BoardingCard
     * $params['templates']         is templates for attributes, for example: ['from' => 'Take bus in {value}']
     * $params['emptyTemplates']    is templates for empty attributes, for example: ['seat' => 'sit on any seat']
     * $params['defaultTemplate']   is default template attributes which doesn't have template, for example: '{name}: {value}'
     * $params['separator']         is separator between attributes text
     * $params['order']             is order for attributes, for example: ['from', 'to', 'seat', 'gate']
     *
     * @param IBoardingCard $boardingCard
     * @param array $params
     * @return IFormatter
     */
    public static function build(IBoardingCard $boardingCard, array $params = []): IFormatter
    {
        $className = $params['class'] ?? Formatter::class;
        $formatter = new $className($boardingCard);
        /** @var IFormatter $formatter */
        if (isset($params['templates']) && is_array($params['templates'])) {
            $formatter->setTemplates($params['templates']);
        }
        if (isset($params['emptyTemplates']) && is_array($params['emptyTemplates'])) {
            $formatter->setEmptyTemplates($params['emptyTemplates']);
        }
        if (isset($params['order']) && is_array($params['order'])) {
            $formatter->setOrder($params['order']);
        }
        if (isset($params['defaultTemplate'])) {
            $formatter->setDefaultTemplate($params['defaultTemplate']);
        }
        if (isset($params['separator'])) {
            $formatter->setSeparator($params['separator']);
        }

        return $formatter;
    }

}