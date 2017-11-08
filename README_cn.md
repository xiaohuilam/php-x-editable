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
], 'id', [], 'test.php?action=save');

$editable->select('job', null, [
      ['value' => 1, 'text' => '一代弱鸡'],
      ['value' => 2, 'text' => '一代宗师'],
      ['value' => 3, 'text' => '一代刺客']
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


## 授权

```
MIT
```

