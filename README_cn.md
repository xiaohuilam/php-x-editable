# php-x-editable

可能是史上最好用的X-Editable PHP插件了

## 安装

```
composer require diana/php-x-editable -vvv
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
