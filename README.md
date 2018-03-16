# taka-converter

Covert numeric taka to Bangla Word.

## Installation

```
composer require ratulcse10/taka-converter dev-master
```
## Example
```
<?php

include('vendor/autoload.php');

echo (new Ratul\TakaConverter\TakaConverter(152465))->convert();
// এক লক্ষ বায়ান্ন হাজার চার শত পঁয়ষট্টি মাত্র

?>
```
