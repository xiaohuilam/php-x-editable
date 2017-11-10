<?php
namespace Editable\Tests;

use PHPUnit\Framework\TestCase;
use Editable\Editable;
use Editable\Integrates\EditableResponse;

class EditableBasicTest extends TestCase{
    /**
     * @var Editable
     */
    protected $editable;
    
    public function __construct()
    {
        $this->editable = new Editable(
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
        call_user_func_array([parent::class, '__construct'], func_get_args());
    }

    public function testTypeahead()
    {
        $this->assertSame(
            $this->editable, 
            $this->editable->typeahead('home', null, [
                '武当山', '华山', '峨眉山', '井冈山', ], 0)
        );
    }
    
    public function testChecklist()
    {
        $this->assertSame(
            $this->editable, 
            $this->editable->checklist('job', null, [
                    ['value' => 1, 'text' => '一代弱鸡'],
                    ['value' => 2, 'text' => '一代宗师'],
                    ['value' => 3, 'text' => '一代刺客']
                ], 0)
        );
    }

    public function testSelect()
    {
        $this->assertSame(
            $this->editable, 
            $this->editable->select('gender', null, [
                    ['value' => 0, 'text' => '未知'],
                    ['value' => 1, 'text' => '男'],
                    ['value' => 2, 'text' => '女'],
                ], 0)
        );
    }

    public function testTag()
    {
        $this->assertSame($this->editable, $this->editable->tag('prefer', null, ['css', 'js', 'google']) );
    }

    public function testWysiwyg()
    {
        $this->assertSame($this->editable, $this->editable->wysiwyg('about') );
    }

    public function testDatetime()
    {
        $this->assertSame($this->editable, $this->editable->datetime('created_at') );
    }

    public function testRender()
    {
        $this->assertInstanceOf(EditableResponse::class, $this->editable->render());
    }
}