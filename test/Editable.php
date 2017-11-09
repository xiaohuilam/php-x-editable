<?php
namespace Editable\Test;

class Editable{
    public static function test() {
        $editable = new \Editable\Editable(
          [
            'id'            => 12,
            'name'          => '张君宝',
            'home'          => '武当山',
            'prefer'        => 'php,html',
            'job'           => 2,
            'about'         => 'Father of the dragon, stormborn, unburn.',
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

        $editable->tag('prefer', null, ['css', 'js', 'google']);

        $editable->wysiwyg('about');
        $editable->datetime('created_at');

        return $editable->render()->getBody();
    }
}