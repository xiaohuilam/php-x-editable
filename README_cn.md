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


## 功能进度

|功能 |描述 |状态 |
|--|--|--|
|text | |已完结|
|select | |已完结|
|tags | |已完结|
|datetime| |已完结|
|wysiwyg| |已完结|
|静态资源本地托管 | [To see in the introduce](https://github.com/xiaohuilam/php-x-editable/blob/master/README_cn.md#install)|已完结|
|后端自动保存| 就是你不用写保存的代码，因为你在读取时候已经写了所必要的信息 |跳票中|
|多行编辑|一次编辑多行数据，考虑和datatables插件做支持 |跳票中|
|二次异步加载 |select和typeahead的下拉数据，做AJAX加载的支持 |跳票中|
|文件上传 |x-editable是不支持上传文件的，我打算支持他|跳票中|
|追加额外的POST参数|如CSRF_TOKEN|跳票中|


## 特别鸣谢

 - x-editable: https://github.com/vitalets/x-editable
 - bootstrap: https://github.com/twbs/bootstrap/releases/tag/v3.3.7
 - php-html-builder: https://github.com/avplab/php-html-builder


## 授权

```
MIT
```
