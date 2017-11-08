# php-x-editable

可能是史上最好用的X-Editable PHP插件了

## 安装

```
composer require diana/php-x-editable:"v0.01" -vvv
```


## 使用

```php
use Editable\Editable;
$editable = new Editable([
    'id'            => 12,
    'name'          => '张君宝',
    'home'          => '武当山',
    'job'           => '1',
    'created_at'    => date('Y-m-d H:i:s'),
], 'id', [], 'test.php?action=save'); // 第一个参数是需要编辑的数据，第二个参数是主键的名称，第三个参数是保护参数，第四个参数是AJAX的URL

$editable->select('job', null, [
      ['value' => 1, 'text' => '一代弱鸡'],
      ['value' => 2, 'text' => '一代宗师'],
      ['value' => 3, 'text' => '一代刺客']
], 0); // 特殊声明一下job这个字段要用select框来选择

echo $editable->render()->getBody(); // PSR-7，所以要用getBody来获取HTML
```

完整的DEMO例子请见 https://github.com/xiaohuilam/php-x-editable/blob/master/test/Editable.php

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
     - 保存的自动化、
     - 多行编辑
     - 二次异步加载（针对select和typeahead）
     - 文件上传和预览支持


## 授权

```
MIT
```

 链接 [Github](https://github.com/xiaohuilam/php-x-editable)
