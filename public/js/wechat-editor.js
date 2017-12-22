define(['jquery', 'underscore', 'emotions'], function ($, _, Emotions) {
    var $defaults = {
        textarea: 'content'
    };

    /**
     * WeChat 编辑器
     *
     * @param {Object} $element
     * @param {Object} $options
     */
    function WeChatEditor ($element, $options) {
        $element = $($element);

        if (!(this instanceof WeChatEditor)) return new WeChatEditor($element, $options);

        this.options = $options || {};

        for (var i in $defaults) {
          if (this.options[i] == null) {
            this.options[i] = $defaults[i];
          }
        }

        this.element = $element;

        this.init();
    }

    /**
     * 初始化
     */
    WeChatEditor.prototype.init = function() {
        this.createEditor();
        this.initEmotions();
    }

    WeChatEditor.prototype.createEditor = function() {
        this.element.append('<div class="wechat-editor"></div>');
        this.createContentBox();
        this.createToolbar();
        this.addCountListener();
        this.element.find('.wechat-editor .wechat-editor-content').focus();
    }

    WeChatEditor.prototype.createContentBox = function() {
        this.element.find('.wechat-editor').append('<div class="wechat-editor-content" contenteditable="true"></div><textarea style="display:none" name="'+ this.options.textarea+ '"></textarea>');
    }

    WeChatEditor.prototype.createToolbar = function() {
        this.element.find('.wechat-editor').append('<div class="wechat-editor-tool-bar">'
                                + '<div class="row">'
                                    + '<div class="col-md-6">'
                                       + '<div class="icon-bar"><a href="javascript:;" class="emotion-btn" title="emotions"><i class="ion-android-happy"></i></a></div>'
                                    + '</div>'
                                    + '<div class="col-md-6">'
                                        + '<div class="tips text-right">还可以输入 <em class="text-counter">130</em> 字</div>'
                                    + '</div>'
                                + '</div>'
                            + '</div>');
    }

    WeChatEditor.prototype.initEmotions = function() {
        var $editorWrapper = this;
        var $editor = this.element.find('.wechat-editor .wechat-editor-content');

        $(document).on('click', '.icon-bar .emotion-btn', function() {
            $editor.focus();

            if (!$(this).find('.emotions').length) {
                $editorWrapper.createEmotionsPicker();
            };

            $editorWrapper.showEmotionsPicker($(this));
        });
    }

    WeChatEditor.prototype.createEmotionsPicker = function() {
        if ($('.emotions').length) {return;};
        var $emotions = $('<div class="emotions"><ul></ul></div>');
        var $emotionsList = $emotions.find('ul');
        var $editor = this.element.find('.wechat-editor .wechat-editor-content');

        Emotions.forEach(function($emotion){
            $emotionsList.append('<li><a href="javascript:;"><img src="'+$emotion.src+'" data-title="'+$emotion.title+'"/></a></li>');
        });

        $('body').append($emotions);

        this.addEmotionListener();
    }

    WeChatEditor.prototype.addCountListener = function () {
        var self = this;
        $(document).on("DOMCharacterDataModified input DOMSubtreeModified", '.wechat-editor-content', function() {
            var $editor = $(this);
            var $coutViewer = $editor.siblings('.wechat-editor-tool-bar').find('.text-counter');
            var $emotions = $editor.find('img');
            var $emotionsLenth = 0;

            // 表情长度
            $emotions.each(function(index, $el) {
                $emotionsLenth += $(this).attr('data-title').length + 1;
            });

            $coutViewer.html(140 - ($editor.text().length + $emotionsLenth));

            self.syncContent($editor);
        });
    }

    WeChatEditor.prototype.textToEmotion = function ($text) {
        // for ($i in Emotions) {
        //     $text = $text.replace(new RegExp('/'+Emotions[$i].title, 'g'), '<img src="'+Emotions[$i].src+'" data-title="'+Emotions[$i].title+'" />');
        // }

        return $text;
    }

    WeChatEditor.prototype.addEmotionListener = function(){
        var $editor = $(this).closest('.wechat-editor-tool-bar').siblings('.wechat-editor-content');

        $(document).on('click', '.emotions ul li a', function(){
            var $img = $($(this).html());

            $editor.focus();

            if (window.getSelection) {
                var $sel = window.getSelection();

                if ($sel.rangeCount) {
                    var range = $sel.getRangeAt(0);
                    var selectedText = range.toString();
                    range.deleteContents();
                    var newNode = $img.get(0);
                    range.insertNode(newNode);
                    //move the cursor
                    range.setStartAfter(newNode);
                    range.setEndAfter(newNode);
                    $sel.removeAllRanges();
                    $sel.addRange(range);
                }
            } else {
                alert('浏览器不支持：window.getSelection()');
            }
        });

        $(document).on('click', function() {
            $('div.emotions').hide();
        }).on('click', '.emotions, .icon-bar .emotion-btn', function(event){
            event.stopPropagation();
        });
    }

    WeChatEditor.prototype.showEmotionsPicker = function($btn) {
        var $css = {
            position: 'absolute',
            top: $btn.offset().top + $btn.height(),
            left: $btn.offset().left - 4,
            display:'none'
        };

        $('.emotions').css($css).show();
    }

    WeChatEditor.prototype.syncContent = function($editor) {
        var $content = $('<div>' + $editor.html() + '</div>');
        var $textarea = $editor.siblings('textarea:first');

        $content.find('img').each(function(index, el) {
            $(this).replaceWith('/' + $(this).attr('data-title'));
        });

        $content.find('div').each(function(index, el) {
            $(this).replaceWith("\n" + $(this).text());
        });;

        $content.find('br').replaceWith("\n");

        $textarea.text($content.text()).trigger('change');
    }

    return WeChatEditor;
});