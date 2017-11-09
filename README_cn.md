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

 - TODO
     - js/css assets local support.
     - datetime support
     - WYSIWYG support
     - 保存的自动化、
     - 多行编辑
     - 二次异步加载（针对select和typeahead）
     - 文件上传和预览支持


## 授权

```
MIT
```

 链接 [Github](https://github.com/xiaohuilam/php-x-editable)
