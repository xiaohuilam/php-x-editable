# php-x-editable

Maybe the best X-Editable PHP plugin of the world

## Install

```
composer require diana/php-x-editable -vvv
```


## Usage

```php
<?php
$editable = new \Editable\Editable(
    [
        'id'            => 12,
        'name'          => '张君宝',
        'home'          => '武当山',
        'prefer'        => 'php,html',
        'gender'        => 1,
        'job'           => 2,
        'about'         => 'Throne of the seven kingdoms,<br/> <i>Father of the dragon</i>, <b>stormborn</b>, <u>unburn</u>.',
        'created_at'    => date('Y-m-d H:i:s'),
    ], 
    'id', 
    [], 
    'test.php?action=save'
);

$editable->typeahead('home', null, [
    '武当山',
    '华山',
    '峨眉山',
    '井冈山',
], 0);

$editable->checklist('job', null, [
    ['value' => 1, 'text' => '一代弱鸡'],
    ['value' => 2, 'text' => '一代宗师'],
    ['value' => 3, 'text' => '一代刺客']
], 0);

$editable->select('gender', null, [
    ['value' => 0, 'text' => '未知'],
    ['value' => 1, 'text' => '男'],
    ['value' => 2, 'text' => '女'],
], 0);

$editable->tag('prefer', null, ['css', 'js', 'google']);

$editable->wysiwyg('about');
$editable->datetime('created_at');
echo $editable->render()->getBody();
```

To get full demo here: https://github.com/xiaohuilam/php-x-editable/blob/dev/example/Editable.php

![1.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5a73db.png)
![2.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5cc6a1.png)
![3.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5cf328.png)
![5.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5e86fd.png)
![4.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5f2f18.png)
![6.png](https://ooo.0o0.ooo/2017/11/09/5a042ab6068d1.png)
![7.png](https://ooo.0o0.ooo/2017/11/09/5a042ab610250.png)


## Features and TODO

 - Features
     - text 
     - select 
     - tag
     - datetime
     - wysiwyg
     - assets self host 
        - Want to store javascript and style files own host?
        - first of all run `composer require vendor/diana/php-x-editable-assets`
        - and then run `composer run-script post-autoload-dump -d vendor/diana/php-x-editable-assets`

 - TODO
     - Auto saver          re-use your data reading code, avoid code again.
     - Multiple rows       multiple rows data editing
     - Async source        select/typeahead's ajax remote source support
     - File upload         x-editable is not support file uploading natively, until us.



## License

```
MIT
```

