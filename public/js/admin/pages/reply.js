define(['jquery', 'underscore', 'util', 'admin/response-picker', 'repos/auto-reply'], function ($, _, Util, ResponsePicker, Reply) {

    var $form = $('.form-template').html();

    Reply.getRules(function($resp){
        console.log($resp);
    });

    new ResponsePicker('.subscribe-response-container');
    new ResponsePicker('.default-response-container');

    $(document).on('click', '.btn.add-new', function(){
        if ($('.rule-container .form-create').length) {return;};
        $('.rule-container').prepend($form);
        new ResponsePicker('.rule-container .response-media-picker');
    });

    // 保存添加
    $(document).on('submit', '.form-create', function(event){
        event.preventDefault();

        var $rule = Util.parseForm($('.form-create'));

        console.log($rule);
        // 保存
    });

    // 取消表单
    $(document).on('click', '.form-cancel', function(event){
        event.preventDefault();
        var $currentForm = $(this).closest('.form-container');

        $currentForm.slideDown(200, function() {
            if ($currentForm.find('[name=id]').val()) {
                $(this).prev().slideDown(200);
            }
            $(this).remove();
        });
    });

    // 点击更新
    $(document).on('click', '.edit-rule', function(){
        var $ruleItem = $(this).closest('.rule-item');
        var $data = $ruleItem.data();
        var $editForm = $($form);

        $ruleItem.hide();

        for($name in $data){
            $editForm.find('[name='+$name+']').val($data[$name]);
        }

        $ruleItem.after($editForm);

        new ResponsePicker($editForm.find('.response-media-picker'), $ruleItem.data.content || {});
    });
});