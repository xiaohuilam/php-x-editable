<?php
namespace Editable\Test;

class Editable{
    public static function test() {
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

        echo $editable->render()->getBody();
    }
}