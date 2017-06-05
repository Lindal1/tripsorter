# Trip Sorter

For install add in your composer.json
```
"lindal1/tripsorter": "dev-master"
```
and in 'repository block'
```
{
    "type": "git",
    "url": "git@github.com:Lindal1/tripsorter.git"
}
```

If you want run test locally exec
```
git clone https://github.com/Lindal1/tripsorter.git
cd tripsorter
composer install
php test.php
```

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