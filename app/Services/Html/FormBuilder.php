<?php

namespace App\Services\Html;

/**
 * form 构建类.
 */
class FormBuilder extends \Illuminate\Html\FormBuilder
{
    /**
     * demo.
     */
    public function demo()
    {
        echo '<h1>haha</h1>';
    }

    /**
     * 带有col布局的input （后台使用）.
     *
     * @param string $type    类型
     * @param string $name    表单name
     * @param Errors $errors  错误对象
     * @param string $label   label
     * @param mixed  $value   默认值
     * @param array  $options 其他附属参数
     */
    public function colInput($type, $name, $errors, $label = '', $value = '', $options = [])
    {
        $attributes = array_merge(['class' => 'form-control'], $options);

        $hasError = $errors->has($name) ? 'has-error' : '';

        $label = $label ? $this->label($name, $label, ['class' => 'col-sm-2 control-label']) : '';

        $string = '<div class ="form-group '.$hasError.'">';

        $string .= $label;

        $string .= '<div class="col-sm-6">';

        $string .= call_user_func_array(['Form', $type], ($type == 'password') ? [$name, $attributes] : [$name, $value, $attributes]);

        $string .= $errors->first($name, '<small class="help-block">:message</small>');

        $string .= '</div></div>';

        return $string;
    }

    /**
     * 带有col布局的select （后台使用）.
     *
     * @param string $name    表单name
     * @param array  $list    值列表 （值 => 标签）
     * @param Errors $errors  错误对象
     * @param string $label   label
     * @param mixed  $value   默认值
     * @param array  $options 其他附属参数
     */
    public function colSelect($name, $list = array(), $errors, $label = '', $selected = null, $options = [])
    {
        $attributes = array_merge(['class' => 'form-control'], $options);

        $hasError = $errors->has($name) ? 'has-error' : '';

        $label = $label ? $this->label($name, $label, ['class' => 'col-sm-2 control-label']) : '';

        $string = '<div class ="form-group '.$hasError.'">';

        $string .= $label;

        $string .= '<div class="col-sm-6">';

        $string .= call_user_func_array(['Form', 'select'], [$name, $list, $selected, $attributes]);

        $string .= $errors->first($name, '<small class="help-block">:message</small>');

        $string .= '</div></div>';

        return $string;
    }

    public function colSubmit($name)
    {
        return '<div class="form-group">
            <div class="col-lg-8 col-lg-offset-2">'.
                $this->submit('提交', ['class' => 'btn btn-success'])
            .'</div>
        </div>';
    }
}
