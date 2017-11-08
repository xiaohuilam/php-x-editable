<?php
namespace Editable\Test;

class Editable{
    public static function test() {
        $editable = new \Editable\Editable([
            'id'            => 12,
            'name'          => '张君宝',
            'home'          => '武当山',
            'job'           => 2,
            'created_at'    => date('Y-m-d H:i:s'),
        ], 'id', [], 'test.php?action=save');

        $editable->typeahead('home', null, [
              ['value' => 1, 'tokens' => '一代弱鸡'],
              ['value' => 2, 'tokens' => '一代宗师'],
              ['value' => 3, 'tokens' => '一代刺客']
        ], 0);

        $editable->select('job', null, [
              ['value' => 1, 'text' => '一代弱鸡'],
              ['value' => 2, 'text' => '一代宗师'],
              ['value' => 3, 'text' => '一代刺客']
        ], 0);

        echo $editable->render()->getBody();
    }
}