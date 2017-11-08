# php-x-editable

Maybe the best X-Editable PHP plugin of the world

## Install

```
composer require diana/php-x-editable:"v0.01" -vvv
```


## Usage

```php
use Editable\Editable;
$editable = new Editable([
    'id'            => 12,
    'name'          => 'Zhang Sanfeng',
    'home'          => 'Wudang Mountains',
    'job'           => 'Boxing master',
    'created_at'    => date('Y-m-d H:i:s'),
], 'id', [], 'test.php?action=save');

$editable->select('job', null, [
      ['value' => 1, 'text' => 'KFC'],
      ['value' => 2, 'text' => 'Boxing master'],
      ['value' => 3, 'text' => 'Lan lingwang']
], 0);

echo $editable->render()->getBody();
```

![demo.png](https://i.loli.net/2017/11/08/5a02eda96db8b.png)


## Features and TODO

 - Features
     - text 
     - select 
     - tag

 - TODO
     - js/css assets local support.
     - datetime support
     - WYSIWYG support


## License

```
MIT
```

