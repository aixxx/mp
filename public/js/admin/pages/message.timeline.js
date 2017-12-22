/**
 * 实时消息页面
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'repos/message', 'WeChatEditor', 'util', 'admin/common'], function ($, Message, WeChatEditor, Util) {
    $(function(){
        new WeChatEditor($('.editor-wrapper'));

        var $replyEditor = $('#reply-editor').html();

        $(document).on('click', '.media-heading a.reply-btn', function(){
            var $body = $(this).closest('.media-body');
            var $editor = $body.find('.reply-editor');
            if ($editor.length) {
                return $editor.show();
            };

            $body.append($replyEditor).find('.wechat-editor-content').focus();
        });

        $(document).on('click', '.reply-editor .collapse-editor', function(){
            $('.reply-editor').hide();
        });
    });
});