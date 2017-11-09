<?php
namespace Editable\Test;

class Editable{
    public static function test() {
        $editable = new \Editable\Editable(
            [
                'id'            => 12,
                'name'          => '张君宝',
                'home'          => 1,
                'job'           => 2,
                'about'         => 'Father of the dragon, stormborn, unburn.',
                'created_at'    => date('Y-m-d H:i:s'),
            ], 
            'id', 
            ['id', 'created_at'], 
            'test.php?action=save'
        );

        $editable->typeahead('home', null, [
              ['value' => '1', 'tokens' => '武当山'],
              ['value' => '2', 'tokens' => '华山'],
              ['value' => '3', 'tokens' => '峨眉山']
        ], 0);

        $editable->select('job', null, [
              ['value' => 1, 'text' => '一代弱鸡'],
              ['value' => 2, 'text' => '一代宗师'],
              ['value' => 3, 'text' => '一代刺客']
        ], 0);

        $editable->wysiwyg('about');
        $editable->datetime('created_at');

        echo $editable->render()->getBody();
    }
}