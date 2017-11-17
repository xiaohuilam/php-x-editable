<?php
namespace Editable\Example;

class Editable{
    public static function test() {
        $editable = new \Editable\Editable(
            [
                'id'            => 12,
                'name'          => '张君宝',
                'home'          => '武当山',
                'prefer'        => 'php,html',
                'gender'        => 1,
                'marriage'      => 3,
                'job'           => 2,
                'about'         => 'Throne of the seven kingdoms,<br/> <i>Father of the dragon</i>, <b>stormborn</b>, <u>unburn</u>.',
                'created_at'    => date('Y-m-d H:i:s'),
            ], 
            'id', 
            [], 
            'demo.php?action=save'
        );

        $editable->typeahead('home', null, [
            '武当山',
            '华山',
            '峨眉山',
            '井冈山',
        ]);

        $editable->checklist('job', null, [
            ['value' => 1, 'text' => '一代弱鸡'],
            ['value' => 2, 'text' => '一代宗师'],
            ['value' => 3, 'text' => '一代刺客']
        ]);

        $editable->select('gender', null, [
            ['value' => 0, 'text' => '未知'],
            ['value' => 1, 'text' => '男'],
            ['value' => 2, 'text' => '女'],
        ], 0);

        $editable->tag('prefer', null, ['css', 'js', 'google']);

        $editable->wysiwyg('about');
        $editable->datetime('created_at');

        $editable->select('marriage', null, '/demo.php?action=marriage', 0);

        return $editable->render()->getBody();
    }
}