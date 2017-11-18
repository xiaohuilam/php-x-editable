<?php
namespace Editable\Interfaces;

interface EditableInterface {

    /**
     * 登记输入框
     *
     * @param  string $type 类型
     * @param  string $key
     * @return self
     */
    public function registerComponent($type, $key, $value = null, $options = [], $index = null);

    /**
     * 渲染模板
     *
     * @param  bool $and_destroy 考虑到常驻进程的框架 保留此选项 默认均销毁
     * @return \Editable\Integrates\EditableResponse
     */
    public function render($and_destroy = true);

}