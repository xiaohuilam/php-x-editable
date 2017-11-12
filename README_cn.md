# php-x-editable

可能是史上最好用的X-Editable PHP插件了

## 安装

```
composer require diana/php-x-editable -vvv
```

在安装完成后，javascript和css是引用jsdelivr的URL来载入的。
如果您的项目是内网，或者因为其他限制需要本地托管的，请执行下面的命令即可托管在本地。

```
composer require diana/php-x-editable-assets -vvv
composer run-script post-autoload-dump -d vendor/diana/php-x-editable-assets
```

其中，第二个命令是发布CSS/JS到项目的WEB目录的。针对laravel(lumen)和thinphp5框架，会发布到public目录。
其他情况默认发布到根目录。
如果框架不满足上面情况，需要手工执行
```
cp -R ./vendor/diana/php-x-editable-assets/assets/ 你项目的WEB根目录/
```


## 使用

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

完整的DEMO例子请见 https://github.com/xiaohuilam/php-x-editable/blob/dev/example/Editable.php

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
     - 静态资源本地托管
        - 想本地存放JS和CSS文件?
        - 先运行`composer require vendor/diana/php-x-editable-assets`
        - 再运行`composer run-script post-autoload-dump -d vendor/diana/php-x-editable-assets`

 - TODO
     - 保存的自动化         就是你不用写保存的代码，因为你在读取时候已经写了所必要的信息
     - 多行编辑             一次编辑多行数据，考虑和datatables插件做支持
     - 二次异步加载         select和typeahead的下拉数据，做AJAX加载的支持
     - 文件上传和预览支持    x-editable是不支持上传文件的，我打算支持他


## 授权

```
MIT
```
