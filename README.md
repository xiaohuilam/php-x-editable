# php-x-editable

Maybe the best X-Editable PHP plugin of the world

## Install

```
composer require diana/php-x-editable:"v0.01" -vvv
```


## Usage

```php
<?php
$editable = new \Editable\Editable(
    [
        'id'            => 12,
        'name'          => '张君宝',
        'home'          => '武当山',
        'job'           => 2,
        'created_at'    => date('Y-m-d H:i:s'),
    ], 
    'id', 
    ['id', 'created_at'], 
    'test.php?action=save'
);
$editable->typeahead('home', null, [
      ['value' => '武当山', 'tokens' => '武当山'],
      ['value' => '华山', 'tokens' => '华山'],
      ['value' => '峨眉山', 'tokens' => '峨眉山']
], 0);
$editable->select('job', null, [
      ['value' => 1, 'text' => '一代弱鸡'],
      ['value' => 2, 'text' => '一代宗师'],
      ['value' => 3, 'text' => '一代刺客']
], 0);
echo $editable->render()->getBody();
```

To get full demo here: https://github.com/xiaohuilam/php-x-editable/blob/master/test/Editable.php

![demo_basic.png](https://i.loli.net/2017/11/08/5a02eda96db8b.png)
![demo_typeahead.png](https://i.loli.net/2017/11/08/5a030b7c4b6ad.png)


## Features and TODO

 - Features
     - text 
     - select 
     - tag

 - TODO
     - js/css assets local support.
     - datetime support
     - WYSIWYG support
     - PHP Saver
     - Multiple line
     - Async sencondary ajax request source support for select and typeahead
     - File uplaod and preview


## License

```
MIT
```

