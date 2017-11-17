<?php
namespace Editable;

use Editable\Integrates\EditableResponse;
use Editable\Integrates\EditableException;
use AvpLab\PhpHtmlBuilder;

class Editable implements Interfaces\EditableInterface{
    /**
     * @var array 已声明使用的类型, 用于加载JS
     */
    protected $existed_dom_type = [];

    /**
     * @var array 上面已声明的各种第三方库
     */
    protected $vendor_assets = [
        'xeditable'     => [
            'css'   => [
                'https://cdn.jsdelivr.net/gh/twbs/bootstrap@3.3.5/dist/css/bootstrap.min.css',
                'https://cdn.jsdelivr.net/gh/vitalets/x-editable@1.5.1/dist/bootstrap3-editable/css/bootstrap-editable.min.css',
            ],
            'js'    => [
                'https://cdn.jsdelivr.net/npm/jquery@1.12.1/dist/jquery.min.js',
                'https://cdn.jsdelivr.net/gh/twbs/bootstrap@3.3.5/dist/js/bootstrap.min.js',
                'https://cdn.jsdelivr.net/gh/vitalets/x-editable@1.5.1/dist/bootstrap3-editable/js/bootstrap-editable.min.js',
            ],
        ],
        'text'          => ['css' => [], 'js' => []],
        'select'        => ['css' => [], 'js' => []],
        'checklist'     => ['css' => [], 'js' => []],
        'textarea'      => ['css' => [], 'js' => []],
        'date'          => [
            'css' => [], 
            'js' => [
                'https://cdn.jsdelivr.net/gh/moment/moment@2.19.1/min/moment.min.js',
            ]
        ],
        'datetime'      => [
            'css' => [], 
            'js' => [
                'https://cdn.jsdelivr.net/gh/moment/moment@2.19.1/min/moment.min.js',
            ]
        ],
        'typeaheadjs'     => [
            'css'   => [
                'https://cdn.jsdelivr.net/gh/vitalets/x-editable@1.5.1/dist/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.min.css',
            ],
            'js'    => [
                'https://cdn.jsdelivr.net/gh/vitalets/x-editable@1.5.1/dist/inputs-ext/typeaheadjs/lib/typeahead.min.js',
                'https://cdn.jsdelivr.net/gh/vitalets/x-editable@1.5.1/dist/inputs-ext/typeaheadjs/typeaheadjs.min.js'
            ],
        ],
        'tag'           => [
            'css'   => [
                'https://cdn.jsdelivr.net/gh/xiaohuilam/x-editable@9.8.1/assets/select2/select2.min.css',
                'https://cdn.jsdelivr.net/gh/xiaohuilam/x-editable@9.8.1/assets/select2/select2-bootstrap.min.css',
            ],
            'js'    => [
                'https://cdn.jsdelivr.net/gh/xiaohuilam/x-editable@9.8.1/assets/select2/select2.min.js',
            ],
        ],
        'wysiwyg'       => [
            'css'   => [
                'https://cdn.jsdelivr.net/gh/xiaohuilam/x-editable@9.8.1/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.3/bootstrap-wysihtml5-0.0.3.min.css',
            ],
            'js'    => [
                'https://cdn.jsdelivr.net/gh/xiaohuilam/x-editable@9.8.1/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.3/wysihtml5-0.3.0.min.js',
                'https://cdn.jsdelivr.net/gh/xiaohuilam/x-editable@9.8.1/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.3/bootstrap-wysihtml5-0.0.3.min.js',
                'https://cdn.jsdelivr.net/gh/xiaohuilam/x-editable@9.8.1/assets/x-editable/inputs-ext/wysihtml5/wysihtml5-0.0.3.min.js',
            ],
        ]
    ];

    /**
     * @var array 所有数据 [$type, $key, $value, $options, $index]
     */
    protected $data = [];

    protected $row;
    protected $pk;
    protected $hidden;
    protected $ajax;

    /**
     * @var PhpHtmlBuilder   HTML构造器
     */
    protected $builder;

    /**
     * @var int
     */
    protected $uuid;

    /**
     * @param  array|ArrayAccess    $row    数据库中的一行数据
     * @param  string               $pk     主键名称
     * @param  array                $hidden 保护字段
     * @param  string               $ajax   AJAX保存URL
     */
    public function __construct($row = null, $pk = "id", $hidden = [], $ajax = '')
    {
        if(!$row)
            throw new EditableException(null, EditableException::NO_DATA);

        $this->row      = $row;
        $this->pk       = isset($this->row[$pk]) ? $this->row[$pk] : null;
        $this->hidden   = array_flip($hidden);
        $this->ajax     = $ajax;

        $this->hidden[$pk]   = 1;

        if(class_exists('\Editable\Assets\LocalAssets'))
            $this->vendor_assets = \Editable\Assets\LocalAssets::instance()->getVendorAssetsRoutingUrl();

        foreach($this->row as $key => $value)
            $this->input($key, $value);
    }
    

    /**
     * 登记输入框
     *
     * @param  string $type 类型
     * @param  string $key
     * @return self
     */
    public function registerComponent($type, $key, $value = null, $options = [], $index = null)
    {
        $this->data[$key] = func_get_args();
        $this->existed_dom_type[$type] = 1;
        return $this;
    }
    
    /**
     * 保护一个字段不可编辑
     *
     * @param  string $key 字段
     * @return self
     */
    public function protect($key)
    {
        if(is_array($key))
            foreach($key as $each) {
                $this->protect($each);
            }

        else
            $this->hidden[$key] = 1;

        return $this;
    }

    /**
     * 输入框
     *
     * @param  string $key   字段
     * @param  string $value 值
     * @return self
     */
    public function input($key, $value)
    {
        return $this->text($key, $value);
    }
    public function text($key, $value)
    {
        return $this->registerComponent(__FUNCTION__, $key, $value);
    }

    /**
     * 文本框
     *
     * @param  string $key   字段
     * @param  string $value 值
     * @return self
     */
    public function textarea($key, $value)
    {
        return $this->registerComponent(__FUNCTION__, $key, $value);
    }

    /**
     * 单选框
     *
     * @param  string $key     字段
     * @param  string $value   值
     * @param  mixed  $options 可供选择的项
     * @param  int    $index   当前值的索引 与$value必填1个
     * @return self
     */
    public function select($key, $value = null, $options = [], $index = null)
    {
        return $this->registerComponent(__FUNCTION__, $key, $value, $options, $index);
    }

    /**
     * 复选框
     *
     * @param  string       $key        字段
     * @param  string|array $value      值 如1,2,3或者[1,2,3]
     * @param  mixed        $options    可供选择的项
     * @return self
     */
    public function checklist($key, $value = null, $options)
    {
        return $this->registerComponent(__FUNCTION__, $key, $value, $options);
    }
    

    /**
     * 日期
     *
     * @param  string $key     字段
     * @param  string $value   值 yyyy/mm/dd dd/mm/yyyy 两种格式 /可用-替代
     * @return self
     */
    public function date($key, $value = null)
    {
        return $this->registerComponent(__FUNCTION__, $key, $value);
    }

    /**
     * 日期时间
     *
     * @param  string $key     字段
     * @param  string $value   值 "yyyy/mm/dd HH:ii::ss" "dd/mm/yyyy HH:ii:ss" 两种格式 "/"可用"-"替代
     * @return self
     */
    public function datetime($key, $value = null)
    {
        return $this->registerComponent(__FUNCTION__, $key, $value);
    }

    /**
     * 匹配框
     *
     * @param  string $key     字段
     * @param  string $value   值
     * @param  mixed  $options 可供选择的项
     * @return self
     */
    public function typeaheadjs($key, $value = null, $options = [])
    {
        return $this->registerComponent(__FUNCTION__, $key, $value, $options);
    }

    public function typeahead($key, $value = null, $options = [])
    {
        return $this->typeaheadjs($key, $value, $options);
    }

    /**
     * 标签
     *
     * @param  string        $key     字段
     * @param  array|string  $value   已存在的tag ['tag1', 'tag2']或'tag1,tag2'
     * @param  array         $options 可供选择的项 ['tag1', 'tag2']
     * @return self
     */
    public function tag($key, $value = null, array $options = [])
    {
        return $this->registerComponent(__FUNCTION__, $key, $value, $options);
    }

    /**
     * 所见即所得编辑器
     *
     * @param  string   $key     字段
     * @param  string   $value   值
     * @return self
     */
    public function wysiwyg($key, $value = null)
    {
        return $this->registerComponent(__FUNCTION__, $key, $value);
    }

    /**
     * 控件遍历方法
     * @param   array          $each     each in $this->data
     * @return  self
     */
    protected function __every_element($each)
    {

        $type   = $each[0];
        $key    = $each[1];
        if($each[2] === null && isset($this->row[$key]) && $this->row[$key] != null) {
            $each[2] = $this->row[$key];
        }
        $value  = $each[2];
        $show_name = ucfirst(preg_replace_callback('/(_([a-zA-Z0-9]))/', function($a) {
            if(isset($a[2])) return ' '.strtoupper($a[2]);
            return $a;
        }, $key));
        $title  = 'Type the '.$show_name;
        $show_type = $type;

        $show_value = $value;
        if($type == 'select') {
            $show_value = '';
            if(is_array($each[3])) {
                foreach($each[3] as $option) {
                    $option_value = isset($option['value']) ? $option['value']: null;
                    if($value == $option_value) {
                        $show_value = $option['text'];
                        break;
                    }
                }
            } else if(is_string($each[3])) {

            }
        }else if($type == 'typeaheadjs') {
            $show_value = '';
            foreach($each[3] as $option) {
                $option_value = isset($option['value']) ? $option['value']: null;
                if($value == $option_value) {
                    $show_value = $option['text'] . ' (' . $value . ') ';
                    break;
                }
            }
        }else if($type == 'wysiwyg') {
            $show_type = 'wysihtml5';
        }else if($type == 'tag') {
            $show_type = 'select2';
        }


        $this->builder->tr();
        /**/$this->builder->td($show_name)->end();
        /**/$this->builder->td();
        /**//**/$this->builder->a($show_value)
        /**//**//**/->setDataName($key)
        /**//**//**/->setDataPk($this->pk)
        /**//**//**/->setDataUrl($this->ajax)
        /**//**//**/->setDataTitle($title)
        /**//**//**/->setDataType($show_type)
        /**//**//**/->setDataValue($value)
        /**//**//**/->setDataPlacement('bottom');
        /**//**//**/if(!isset($this->hidden[$key])) {
        /**//**//**//**/$this->builder->setClass('editable-link');
        /**//**//**/}
        /**//**//**/if($type == 'select' || $type == 'tag' || $type == 'checklist') {
        /**//**//**//**/$this->builder->setDataSource(is_string($each[3])?$each[3]:json_encode($each[3]));
        /**//**//**/}else if($type == 'typeaheadjs') {
        /**//**//**//**/$this->builder->setDataTypeahead( # @todo: template
        /**//**//**//**//**/json_encode([
        /**//**//**//**//**/'name' => $key,
        /**//**//**//**//**/'local' => $each[3],
        /**//**//**//**//**/])
        /**//**//**//**/);
        /**//**//**/}else if($type == 'date') {
        /**//**//**//**/$this->builder->setDataType('combodate')
        /**//**//**//**//**//**/->setDataTemplate('YYYY/MM/DD')
        /**//**//**//**//**//**/->setDataFormat('YYYY-MM-DD')
        /**//**//**//**//**//**/->setDataViewformat('YYYY-MM-DD');
        /**//**//**/}else if($type == 'datetime') {
        /**//**//**//**/$this->builder->setDataType('combodate')
        /**//**//**//**//**//**/->setDataTemplate('YYYY/MM/DD HH:mm:ss')
        /**//**//**//**//**//**/->setDataFormat('YYYY-MM-DD HH:mm:ss')
        /**//**//**//**//**//**/->setDataViewformat('YYYY-MM-DD HH:mm:ss');
        /**//**//**/}
        /**//**/$this->builder->end();
        /**/$this->builder->end();
        $this->builder->end();

        return $this;
    }

    /**
     * 尾部JS
     * 
     * @return int
     */
    public function __script()
    {
        $this->builder->script(<<<JAVASCRIPT
            $.fn.combodate.defaults.maxYear = (new Date).getFullYear();
            $.fn.combodate.defaults.minuteStep = 1;

            $("#table-wrapper-$this->uuid .editable-link").each(function(){
                var self = this;
                $(self).editable({
                    typeahead: (function(a){
                        try{
                            if(!$(self).attr('data-typeahead')) return;
                            opt = $.parseJSON($(self).attr('data-typeahead')) ? $.extend($(self).data('typeahead'), {
                                template: function(item) {
                                    if('undefined' == typeof item.tokens) return item.value;
                                    return item.tokens + ' (' + item.value + ') ';
                                }
                            }) : null;
                            return opt;
                        }catch(e){console.error(e)}
                    })(self),
                    display: (function(self){
                        if($(self).data('type') == 'combodate') {
                            return null;
                        }
                        if($(self).attr('data-typeahead') && $.parseJSON($(self).attr('data-typeahead'))) {
                            return null;
                        }
                        return function(arg_value, options) {
                            if('object' == typeof arg_value && 'undefined' !== typeof arg_value.length && arg_value.constructor.name == 'Array') {
                            }else{
                                arg_value = [arg_value];
                            }


                            var shown = '';
                            for(var i = 0; i < arg_value.length; i++){
                                var value = arg_value[i];
                                if(!options || 'undefined' == typeof options || 'object' !== typeof options || 'undefined' == typeof options.length) {
                                    shown += value;
                                    if(i <arg_value.length - 1)shown += ",\\r\\n";
                                    continue;
                                }

                                var elem = $.grep(options, function(o){return o.value == value;});
                                if('undefined' != typeof elem && 'undefined' != typeof elem.length && elem.length) {
                                    shown += elem[0].text; 
                                    if(i <arg_value.length - 1)shown += ",\\r\\n";
                                } else {   
                                }
                            }
                            $(self).empty();
                            return $(self).html(shown);
                        };
                    })(self),
                    select2: (function(self){
                        if($(self).data('type') != 'select2') return null;
                        return {
                            tags: $(self).data('source'),
                            tokenSeparators: [",", " "]
                        };
                    })(self)
                });
                if($(self).attr('data-typeahead') && $.parseJSON($(self).attr('data-typeahead'))) {
                    $(self).on('save', function(e, params){
                        return e;
                        try{
                            if('undefined' == typeof params.submitValue || !params.submitValue || 0==params.submitValue.length) {
                                return;
                            }
                            if($.parseJSON($(self).attr('data-typeahead'))){
                                var local = $(self).data('typeahead').local;
                                for(i in local) {
                                    var item = local[i];
                                    if(item.value == params.submitValue) {
                                        setTimeout(function(){ $(self).text(item.tokens + ' (' + item.value + ') '); }, 100);
                                        break;
                                    }
                                }
                            }
                        }catch(e){console.error(e)}
                    });
                }
            });
JAVASCRIPT
)->setType('application/javascript')->end();
        return $this;
    }


    /**
     * 渲染模板
     *
     * @param  bool $and_destroy 考虑到常驻进程的框架 保留此选项 默认均销毁
     * @return EditableResponse
     */
    public function render($and_destroy = true)
    {
        $this->builder = new PhpHtmlBuilder();
        $this->uuid = mt_rand(1000000, 99999999);
        $this->builder->div()->setClass('table-wrapper')->setId('table-wrapper-'.$this->uuid);
        /**/$this->builder->link()->setRel('stylesheet')->setHref($this->vendor_assets['xeditable']['css'][0])->end();
        /**/$this->builder->link()->setRel('stylesheet')->setHref($this->vendor_assets['xeditable']['css'][1])->end();
        foreach($this->existed_dom_type as $dom_type => $one) {
            foreach($this->vendor_assets[$dom_type]['css'] as $css) {
        /**/$this->builder->link()->setRel('stylesheet')->setHref($css)->end();
            }
        }
        /**/$this->builder->table()->setClass('table table-bordered table-striped');
        /**//**/$this->builder->thead();
        /**//**//**/$this->builder->tr();
        /**//**//**//**/$this->builder->th('Name')->setWidth("35%")->end();
        /**//**//**//**/$this->builder->th('Value')->setWidth("65%")->end();
        /**//**//**/$this->builder->end();
        /**//**/$this->builder->end();
        /**//**/$this->builder->tbody();

        foreach($this->data as $component) {
            $this->__every_element($component);
        }

        /**//**/$this->builder->end();
        /**/$this->builder->end();

        /**/$this->builder->script()->setType('application/javascript')->setSrc($this->vendor_assets['xeditable']['js'][0])->end();
        /**/$this->builder->script()->setType('application/javascript')->setSrc($this->vendor_assets['xeditable']['js'][1])->end();
        /**/$this->builder->script()->setType('application/javascript')->setSrc($this->vendor_assets['xeditable']['js'][2])->end();

        foreach($this->existed_dom_type as $dom_type => $one) {
            foreach($this->vendor_assets[$dom_type]['js'] as $js) {
        /**/$this->builder->script()->setType('application/javascript')->setSrc($js)->end();
            }
        }
        $this->__script();
        $this->builder->end();

        $html = (string) $this->builder;

        $response = new EditableResponse(200, $html);

        if($and_destroy){
            $this->existed_dom_type = [];
            $this->data = [];
            $this->builder = null;
        }
        return $response;
    }
}