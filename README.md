# php-x-editable

Maybe the best X-Editable PHP plugin of the world. 如果你是中文用户，也许看[中文文档](README_cn.md)能更快上手。


---
[![travis-ci.svg](https://api.travis-ci.org/xiaohuilam/php-x-editable.svg?branch=master)](https://travis-ci.org/xiaohuilam/php-x-editable) [![download-count.svg](https://img.shields.io/packagist/dt/diana/php-x-editable.svg)](https://packagist.org/packages/diana/php-x-editable) [![open-issue.png](https://img.shields.io/github/issues/xiaohuilam/php-x-editable.svg)](https://github.com/xiaohuilam/php-x-editable/issues) [![open-pull-request.png](https://img.shields.io/github/issues-pr/xiaohuilam/php-x-editable.svg)](https://github.com/xiaohuilam/php-x-editable/pulls) [![last-commit.png](https://img.shields.io/github/last-commit/xiaohuilam/php-x-editable.svg)](https://github.com/xiaohuilam/php-x-editable/commits) [![contributors.png](https://img.shields.io/github/contributors/xiaohuilam/php-x-editabl.svg)](https://github.com/xiaohuilam/php-x-editable/graphs/contributors)


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


#### Input[Text]
![1.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5a73db.png)

#### Typeahead
![2.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5cc6a1.png)

#### Tag
![3.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5cf328.png)

#### Checklist
![5.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5e86fd.png)

#### Select
![4.png](https://ooo.0o0.ooo/2017/11/09/5a042ab5f2f18.png)

#### Wysiwyg(所见即所得)
![6.png](https://ooo.0o0.ooo/2017/11/09/5a042ab6068d1.png)

#### Datetime(日期时间)
![7.png](https://ooo.0o0.ooo/2017/11/09/5a042ab610250.png)



## Features and TODO

|Feature |Description |Status |
|--|--|--|
|text | |Finished|
|select | |Finished|
|tags | |Finished|
|datetime| |Finished|
|wysiwyg| |Finished|
| assets self host | [To see in the introduce](https://github.com/xiaohuilam/php-x-editable#install)|Finished|
|Auto save| re-use your data reading code, avoid code again. | Awaiting |
|Multiple rows|multiple rows data editing | Awaiting|
|Async source |select/typeahead's ajax remote source support| Awaiting|
|File upload |x-editable is not support file uploading natively, until us| Awaiting|
|Post extra param|other params like csrf_token|Awaiting|

## Credits & thanks

 - x-editable: https://github.com/vitalets/x-editable
 - bootstrap: https://github.com/twbs/bootstrap/releases/tag/v3.3.7
 - php-html-builder: https://github.com/avplab/php-html-builder

## License

```
MIT
```


## Donation

There's no donation accepted.
But you can support me when you shopping checkout with `Alipay wallet`  APP.
Before checkout, scan the QR code, you can get a small amount disacount, and me, will receive a bonus.
![zfb.jpg](https://i.loli.net/2017/11/16/5a0d3d6f957bc.jpg)
