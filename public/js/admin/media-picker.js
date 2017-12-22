define(['jquery', 'underscore', 'repos/material', 'pager', 'util', 'admin/common'], function ($, _, Material, Pager, Util) {
    var $defaults = {
        type: 'image',
        onSelected: function($item){
            console.log('picked', $item);
        },
    };

    function MediaPicker ($element, $options) {
        if (!($element instanceof $)) {return console.log('element mustbe instanceof jQuery.');};

        if (!(this instanceof MediaPicker)) return new MediaPicker($element, $options);

        this.options = $options || {};

        for (var i in $defaults) {
          if (this.options[i] == null) {
            this.options[i] = $defaults[i];
          }
        }

        this.element = $element;
        this.pickerId = 'media-'+this.options.type+'-picker-'+(new Date).getTime();
        this.selector = '#' + this.pickerId;

        this.init();
    }

    /**
     * 初始化
     */
    MediaPicker.prototype.init = function() {
        this.createModal();
        this.addListener();
        this.createPager();
    }

    /**
     * 创建 Modal
     */
    MediaPicker.prototype.createModal = function () {
        var $size = '';

        if (this.options.type == 'image' || this.options.type == 'video') {
            $size = 'modal-lg';
        }

        console.log($(this.selector).lentgh);
        if ($(this.selector).lentgh) {return;};

        $('body').append('<div class="modal" id="'+this.pickerId+'">'
                            + '<div class="modal-dialog '+$size+'">'
                                + '<div class="modal-content">'
                                    + '<div class="modal-header">'
                                      + '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'
                                      + '<h4 class="modal-title">素材选择</h4>'
                                    + '</div>'
                                    + '<div class="modal-body" style="overflow-y:scroll">'
                                    + '</div>'
                                    + '<div class="pagination-bar"></div>'
                                    + '<div class="modal-footer">'
                                      + '<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>'
                                      + '<button type="button" class="btn btn-primary pick-media-confirm-btn">确认</button>'
                                    + '</div>'
                                + '</div>'
                            + '</div>'
                        + '</div>');
        $(this.selector).modal('hide');
    }


    /**
     * 添加事件监听
     */
    MediaPicker.prototype.addListener = function () {
        var picker = this;

        $(this.element).on('click', function(){
            event.preventDefault();
            picker.load(picker.options.type, 1, function(){
                $(picker.selector).modal('show');
            });
        });

        $(this.selector).on('click', '.media-item', function(){
            event.preventDefault();
            $(this).addClass('selected').siblings().removeClass('selected');
        });

        $(this.selector).on('click', '.pick-media-confirm-btn', function(){
            event.preventDefault();
            var $selected = $(picker.selector).find('.media-item.selected').data();

            picker.options.onSelected($selected);

            $(picker.selector).modal('hide');
        });
    }

    /**
     * 创建分页器
     */
    MediaPicker.prototype.createPager = function () {
        var picker = this;
        this.pager = new Pager(this.selector + ' .pagination-bar', {
                                classes: 'border-top',
                                onChange: function($page){
                                    picker.load(picker.options.type, $page);
                                }
                            })
    }

    /**
     * 加载素材
     *
     * @return {String} type
     * @param {Int} $page
     */
    MediaPicker.prototype.load = function($type, $page, $callback){
        var $request = {
            type: $type,
            page: $page,
        };
        var picker = this;

        Material.lists($request, function($items){
            var $template = picker.getTemplate($type);
            var $rootContainer = $(picker.selector).find('.modal-body');
            var $container = $(picker.getContainer($type));

            $rootContainer.html($container);

            _.each($items, function($item) {
                var $html = $template($item);
                $container.append($($html).data($item));
            });

            picker.pager.display({
                total: window.last_response.last_page,
                current: window.last_response.current_page,
            });

            typeof $callback == 'function' && $callback();

            $('.media-card img').relocate('.media-card');
        });
    };

    /**
     * 获取素材模板
     *
     * @param {String} $type
     *
     * @return {Template}
     */
    MediaPicker.prototype.getTemplate = function ($type) {
        switch($type){
            case 'image':
                $template = '<div class="col-xs-6 col-sm-3 media-card media-item">'
                                + '<a href="javascript:;" target="_blank" class="picker">'
                                  + '<img src="<%= source_url %>" alt="" class="img-responsive">'
                                + '<span class="selected-item"><i class="ion-ios-checkmark"></i></span>'
                                + '</a>'
                            + '</div>';
                break;
            case 'video':
                $template = '<div class="col-xs-6 col-sm-3 media-card media-item">'
                                + '<a href="#" title="<%= title %>">'
                                    + '<span class="placeholder bg-video"></span>'
                                    + '<h2><%= title %></h2>'
                                    + '<span class="icon ion-ios-play video-play"></span>'
                                    + '<!-- <span class="duration">03:15</span>-->'
                                + '<span class="selected-item"><i class="ion-ios-checkmark"></i></span>'
                                + '</a>'
                            + '</div>';

                break;
            case 'voice':
                $template = '<div class="list-group-item media-item">'
                                    + '<span class="title"><%= title %></span>'
                                    + '<a href="javascript:;" class="pull-right"><span class="icon ion-android-volume-up icon-md music-play"></span></a>'
                                    + '<span class="selected-item"></span>'
                            + '</div>';
                break;
            case 'article':
                $template = '<div class="list-group-item media-item">'
                                + '<span class="title"><%= title %></span>'
                                + '<span class="selected-item"></span>'
                            +'</div>';
                break;
        }

        return _.template($template);
    }

    /**
     * 返回媒体容器
     *
     * @param {String} $type
     *
     * @return {String}
     */
    MediaPicker.prototype.getContainer = function ($type) {
        var $container;

        switch($type){
            case 'image':
            case 'video':
                $container = '<div></div>'
                break;
            default:
                $container = '<div class="list-group"></div>'
                break;
        }

        return $container;
    }

    return MediaPicker;
});