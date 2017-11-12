# php-x-editable

Maybe the best X-Editable PHP plugin of the world

## Install

```
composer require diana/php-x-editable -vvv
```

After installed, javascript and css is using jsdelivr.
But if, your project is local web using, or orther limitation to hosted assets locally,
please run the command bellow:

```
composer require diana/php-x-editable-assets -vvv
composer run-script post-autoload-dump -d vendor/diana/php-x-editable-assets
```

The secondary line, is publishing css/js to web directory of your project. it will detect laravel(lumen)
and thinkphp5 framework, to publish to `public/` directory.
ortherwise, defaultly, it will deploy css/js to web root dir itself.

If indeed, please run

```
cp -R ./vendor/diana/php-x-editable-assets/assets/ SPECIFIC_PROJECT_FULLPATH/
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

<img alt="1.png" src="https://ooo.0o0.ooo/2017/11/09/5a042ab5a73db.png" style="width: 440px; height: auto; border: 1px dotted #aaa;">
<img alt="2.png" src="https://ooo.0o0.ooo/2017/11/09/5a042ab5cc6a1.png" style="width: 440px; height: auto; border: 1px dotted #aaa;">
<img alt="3.png" src="https://ooo.0o0.ooo/2017/11/09/5a042ab5cf328.png" style="width: 440px; height: auto; border: 1px dotted #aaa;">
<img alt="5.png" src="https://ooo.0o0.ooo/2017/11/09/5a042ab5e86fd.png" style="width: 440px; height: auto; border: 1px dotted #aaa;">
<img alt="4.png" src="https://ooo.0o0.ooo/2017/11/09/5a042ab5f2f18.png" style="width: 440px; height: auto; border: 1px dotted #aaa;">
<img alt="6.png" src="https://ooo.0o0.ooo/2017/11/09/5a042ab6068d1.png" style="width: 440px; height: auto; border: 1px dotted #aaa;">
<img alt="7.png" src="https://ooo.0o0.ooo/2017/11/09/5a042ab610250.png" style="width: 440px; height: auto; border: 1px dotted #aaa;">


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

