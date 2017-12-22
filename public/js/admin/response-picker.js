define(['jquery', 'underscore', 'util', 'WeChatEditor', 'admin/media-picker', 'repos/material'],
function ($, _, Util, WeChatEditor, MediaPicker, Material) {
    var $defaults = {
        current: null,
        onChanged: function($item){
            console.log('picked', $item);
        },
    };

    var $tabs = [
                {type:"text",title:"文字",icon:"ion-ios-information-outline"},
                {type:"url",title:"网址",icon:"ion-ios-monitor"},
                {type:"image",title:"图片",icon:"ion-ios-photos-outline"},
                {type:"video",title:"视频",icon:"ion-ios-videocam-outline"},
                {type:"voice",title:"声音",icon:"ion-ios-volume-high"},
                {type:"article",title:"图文",icon:"ion-ios-paper-outline"}
            ];

    /**
     * ResponsePicker
     *
     * @param {String} $container
     * @param {Object} $options
     */
    function ResponsePicker ($container, $options) {
        // if (!(this instanceof ResponsePicker)) return new ResponsePicker($element, $options);

        this.options = $.extend(true, $defaults, $options);
        this.container = $($container);
        this.tabs = $tabs;
        this.current = this.options.current;
        this.unique_id = (new Date).getTime();
        this.selector = '.response-picker-'+this.unique_id;
        this.init();

        var $type = (this.options.current && typeof this.options.current['type'] != undefined) ? this.options.current['type'] : 'text';

        this.container.find('.tab-link[data-type='+ $type +']').trigger('click');

        if (this.current) {
            this.getCurrentTab().data(this.current);
            this.saveForm(this.current);
        };
    }

    ResponsePicker.prototype.init = function () {
        this.createPicker();
        this.addListeners();

        this.container.find('.tab-link:first').trigger('click');
    }

    /**
     * 创建选择器控件
     */
    ResponsePicker.prototype.createPicker = function () {
        this.container.html('');
        this.container.addClass(this.selector.substr(1));
        this.container.append(this.getTabLinks());
        this.container.append(this.getTabContents());
    }

    ResponsePicker.prototype.getTabLinks = function(){
        var $template = _.template('<li role="presentation"><a href="#<%= type %>-tab-content-'+this.unique_id+'" data-type="<%= type %>" aria-controls="<%= type %>-tab-content-'+this.unique_id+'" role="tab" class="tab-link" data-toggle="tab"><i class="<%= icon %>"></i> <%= title %> </a></li>');

        var $links = $('<ul class="nav nav-tabs" role="tablist"></ul>');

        var $items = '';

        _.each(this.tabs, function($item) {
            $items += $template($item);
        });

        $links.append($items);

        return $links;
    };

    ResponsePicker.prototype.getTabContents = function () {
        var $form = $('<div class="response-media-picker-content"></div>');

        var $tabContent = $form.append('<div class="tab-content"></div>').find('.tab-content');
        var $template = _.template('<div role="tabpanel" class="tab-pane" id="<%= tab.type %>-tab-content-'+this.unique_id+'"><%= content %></div>');
        var $items = '';
        var $picker = this;

        _.each(this.tabs, function($item) {
            $items += $template({tab: $item, content: $picker.getTypeTabContent($item.type)});
        });

        $tabContent.append($items);

        return $form;
    }

    ResponsePicker.prototype.getTypeTabContent = function ($type) {
        var $form;
        var $tabTemplate = _.template('<div class="panel panel-default md-top">'
                                        + '<div class="panel-body text-center">'
                                            + '<div class="result-container" style="display:none"></div>'
                                            + '<div class="preview-container" style="display:none"></div>'
                                            + '<div class="form-container"><%= form %></div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<button type="button" class="btn btn-success response-picker-form-btn">保存</button>');

        switch($type){
            case 'text':
                $form = '<div class="message-editor"></div>';
                break;
            case 'url':
                $form = '<div class="well row">'
                        + '<label class="col-md-3 control-label">目标网址：</label>'
                        + '<div class="col-md-9">'
                            + '<input type="text" name="url" value="" class="form-control" placeholder="http://viease.com">'
                        + '</div>'
                    + '</div>';
                break;
            case 'image':
            case 'video':
            case 'voice':
            case 'article':
            default:
                $form = '<div class="btns">'
                            + '<a href="javascript:;" class="btn btn-success '+ $type +'-picker"><i class="ion-plus"></i> 从媒体库选择</a>'
                        + '</div>';
                break;
        }

        return $tabTemplate({form: $form});
    }

    ResponsePicker.prototype.addListeners = function () {
        var $picker = this;
        var $form = this.container.find('.tab-content');

        new WeChatEditor(this.container.find('.message-editor'), {textarea: 'text'});

        new MediaPicker(this.container.find('.image-picker'), {type: 'image', onSelected: function($item){
            $picker.preview($item);
        }});
        new MediaPicker(this.container.find('.video-picker'), {type: 'video', onSelected: function($item){
            $picker.preview($item);
        }});
        new MediaPicker(this.container.find('.voice-picker'), {type: 'voice', onSelected: function($item){
            $picker.preview($item);
        }});
        new MediaPicker(this.container.find('.article-picker'), {type: 'article', onSelected: function($item){
            $picker.preview($item);
        }});

        $form.find('[name=text]').on('change', function(){
            $picker.preview({text: $(this).val()});
        });

        $form.find('[name=url]').on('change', function(){
            $picker.preview({url: $(this).val()});
        });

        // 编辑/保存
        $(this.selector).on('click', '.tab-pane.active .response-picker-form-btn', function(event){
            console.log($(this));
            if ($(this).hasClass('btn-success')) {
                $picker.saveForm();
            } else {
                $picker.showForm($picker.getCurrentTab().data('form'));
            }
        });

        // $($picker.container).on('show.bs.tab', this.container.find('ul.nav-tabs a'), function(){
        // });
    }

    ResponsePicker.prototype.getCurrentTab = function () {
        return this.container.find('.tab-pane.active');
    }

    ResponsePicker.prototype.preview = function ($data) {
        var $tab = this.getCurrentTab();
        var $form = this.container.find('.tab-content');

        $data.type = this.container.find('.nav-tabs .active .tab-link').data('type');

        $tab.data('form', $data);

        $data.media_id && $form.find('[name=media_id]').val($data.media_id);

        this.getPreviewItem($data, function($html){
            $tab.find('.preview-container').html($html).slideDown();
        });
    }

    ResponsePicker.prototype.getPreviewItem = function ($data, $callback) {
        var $mediaPreviewItem = _.template('<div class="media-preview"><%= item %></div>');

        function dataToPreview ($item) {
            switch($data.type){
                case 'text':
                    $html = $item.text;
                    break;
                case 'url':
                    $html = $item.url;
                    break;
                case 'image':
                    $html = '<img src="'+$item.source_url+'">';
                    break;
                case 'video':
                    $html = '<a href="">'+$item.title+'</a>';
                    break;
                case 'voice':
                    $html = '<a href="">'+$item.source_url+'</a>';
                    break;
                case 'article':
                    $html = '<a href="'+$item.source_url+'" >' + $item.title + '</a>';
                    break;
            }

            return $mediaPreviewItem({item:$html});
        }

        if ($data.type != 'text' && $data.type != 'url' && typeof $data.source_url == undefined) {
            Material.getByMediaId($data.media_id, function($item) {
                return $callback(dataToPreview($item));
            });
        } else {
            return $callback(dataToPreview($data));
        }
    }

    ResponsePicker.prototype.showForm = function ($data) {
        if (!$data) {
            return;
        };

        var $tab = $('.tab-pane#'+$data.type+'-tab-content-'+this.unique_id);
        var $previewContainer = $tab.find('.preview-container');

        $tab.find('.result-container').slideUp();
        $tab.find('.form-container').slideDown();


        switch($data.type){
            case 'text':
                $tab.find('.wechat-editor-content').html($data.text);
                break;
            case 'url':
                $tab.find('[name=url]').val($data.url);
                break;
            case 'image':
            case 'video':
            case 'voice':
            case 'article':
            default:
                $tab.find('.media_id').val($data.media_id);
                break;
        }

        this.getPreviewItem($data, function($html) {
            $previewContainer.html($html).slideDown();
        });

        this.container.find('.tab-pane.active .response-picker-form-btn').addClass('btn-success').removeClass('btn-default').text('保存');
    }

    ResponsePicker.prototype.saveForm = function ($temp) {
        var $tab = this.getCurrentTab();
        var $data = $temp || $tab.data('form');

        var $resultContainer = $tab.find('.result-container');

        if (!$data || typeof $data.type == undefined) { return error('请选择内容'); };

        switch($data.type){
            case 'text':
                if (!$data.text.length) {
                    return error('请填写文字内容！');
                };
                $content = $tab.find('.wechat-editor-content').html();
                break;
            case 'url':
                if (!$data.url.length || $data.url.indexOf('http://') !== 0) {
                    return error('请正确填写网址！');
                };
                break;
            case 'image':
            case 'video':
            case 'voice':
            case 'article':
                if (!$data.media_id.length) {
                    return error('请选择内容！');
                };
                break;
            default:
                break;
        }

        $tab.data($data);

        this.current = $data;

        this.onChange($data);

        this.getPreviewItem($data, function($html){
            $resultContainer.html($html).slideDown();
        });

        $tab.find('.form-container, .preview-container').slideUp();

        this.container.find('.tab-pane:not(.active) input').val('');
        this.container.find('.tab-pane:not(.active) .preview-container, .tab-pane:not(.active) .result-container').html('').hide();
        this.container.find('.tab-pane:not(.active) .wechat-editor-content').html('');

        this.container.find('.tab-pane.active .response-picker-form-btn').removeClass('btn-success').addClass('btn-default').text('编辑');
    }

    ResponsePicker.prototype.onChange = function ($result) {
        this.options.onChanged($result);
    }

    return ResponsePicker;
});