# Trip Sorter
Create boarding card example:
```
$card = BoardingCardFactory::build([
  'attributes'=>[
    'from'=>'Point A',
    'to'=>'Point B'
  ]
]);
```

Sorting cards example:
```
$sorter = new Sorter();
echo $sorter->addItem($card1)
  ->addItem($card2)
  ->addItem($card3)
  ->addItem($card4)
  ->sort()
  ->render();

```

See tests if you want know how it works.