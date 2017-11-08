<?php
namespace Editable\Integrates;

class EditableException extends \Exception{
    const NO_DATA = -1;

    static $messages = [
        self::NO_DATA => '你必须传递一条数据'
    ];

    public function __construct($message = null, $code, $previous = null)
    {
        if($message === null)
            $message = self::$messages[$code];

        call_user_func_array([parent::class, __FUNCTION__], func_get_args());
    }
    
}