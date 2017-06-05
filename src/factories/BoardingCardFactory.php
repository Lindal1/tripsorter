<?php
namespace lindal1\tripsorter\factories;

use lindal1\tripsorter\cards\DefaultBoardingCard;
use lindal1\tripsorter\factories\FormatterFactory;
use lindal1\tripsorter\interfaces\IBoardingCard;

class BoardingCardFactory
{

    /**
     * $params['class']         defined class which need to use for BoardingCard
     * $params['attributes']    attributes for boarding cards
     * $params['formatter']     is params for FormatterFactory
     *
     * @param array $params
     * @return IBoardingCard
     */
    public static function build(array $params): IBoardingCard
    {
        $className = $params['class'] ?? DefaultBoardingCard::class;
        $boardingCard = new $className($params['attributes'] ?? []);
        if (isset($params['formatter'])) {
            $boardingCard->setFormatter(FormatterFactory::build($boardingCard, $params['formatter']));
        }
        return $boardingCard;
    }

}