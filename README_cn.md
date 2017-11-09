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
echo $editable->render()->getBody(); // PSR-7，所以要用getBody来获取HTML
```

完整的DEMO例子请见 https://github.com/xiaohuilam/php-x-editable/blob/master/test/Editable.php

![demo_basic.png](https://i.loli.net/2017/11/08/5a02eda96db8b.png)
![demo_typeahead.png](https://i.loli.net/2017/11/08/5a030b7c4b6ad.png)


## Features and TODO

 - Features
     - text 
     - select 
     - tag
     - datetime
     - wysiwyg

 - TODO
     - jscss本地存储       目前用的是JSDelivr，我计划是开个新包，比如diana/local-x-editable-assets
     - 保存的自动化         就是你不用写保存的代码，因为你在读取时候已经写了所必要的信息
     - 多行编辑             一次编辑多行数据，考虑和datatables插件做支持
     - 二次异步加载         select和typeahead的下拉数据，做AJAX加载的支持
     - 文件上传和预览支持    x-editable是不支持上传文件的，我打算支持他


## 授权

```
MIT
```
