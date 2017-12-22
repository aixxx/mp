/**
 * js 分页组件
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery'], function(){
    function Pager($selector, $options){
        var $template = '<div class="viease-pager CLASSES">\
                            <div class="viease-pager-inner">\
                                <a href="#" class="btn viease-pager-btn-prev"><i class="ion-arrow-left-b"></i></a>\
                                <span class="info viease-pager-current-page">CURRENT_PAGE</span><span class="info">/</span><span class="info viease-pager-total-page">TOTAL_PAGE</span>\
                                <a href="#" class="btn viease-pager-btn-next"><i class="ion-arrow-right-b"></i></a>\
                                <input type="number" class="viease-pager-to-page form-control inline-block">\
                                <a href="#" class="btn viease-pager-btn-goto">跳转</a>\
                            </div>\
                        </div>';

        var $pager = {
            option: {
                container: undefined,
                total: 1,
                current:1,
                classes: undefined,
                onChange: function(page){
                    console.log(page);
                }
            },

            display: function($option){
                if ($option.total <= 1) {
                    return $pager.hide();
                } else {
                    $pager.show();
                }
                $pager.option = $.extend(true, $pager.option, $option);
                $pager.render();
                console.log($pager.option.current, $pager.option.total);
            },

            hide: function(){
                $pager.option.container.find('.viease-pager').hide();
            },

            show: function(){
                $pager.option.container.find('.viease-pager').show();
            },

            /**
             * 渲染当前分页数据
             */
            render: function(){
                var $option = $pager.option;
                var $container = $option.container;

                $pager.create();

                if ($option.current == 1){
                    $container.find('.viease-pager-btn-prev').hide();
                } else {
                    $container.find('.viease-pager-btn-prev').show();
                }

                if ($option.current == $option.total) {
                    $container.find('.viease-pager-btn-next').hide();
                } else {
                    $container.find('.viease-pager-btn-next').show();
                }

                $container.find(' .viease-pager-current-page').text($option.current);
                $container.find(' .viease-pager-total-page').text($option.total);
            },

            /**
             * 创建 DOM
             */
            create: function(){
                var $option = $pager.option;
                var $container = $option.container;

                if ($container.find('.viease-pager').length) {
                    return;
                }

                var $new = $template.replace('CURRENT_PAGE', $option.current || 1)
                                    .replace('CLASSES', $option.classes)
                                    .replace('TOTAL_PAGE', $option.total || 1);

                $container.append($new);

                $pager.listen($container);
            },

            listen: function($container){
                $container.find('a').on('click', function(e){
                    e.preventDefault();
                });

                // 上一页
                $container.on('click', '.viease-pager-btn-prev', function() {
                    var $current = $pager.option.current;

                    if ($current - 1 <= 0){
                        return;
                    }

                    $pager.option.current--;
                    $pager.render();
                    $pager.option.onChange($current - 1);
                });

                // 下一页
                $container.on('click', '.viease-pager-btn-next', function () {
                    var $current = $pager.option.current;

                    if ($current + 1 > $pager.option.total){
                        return;
                    }

                    $pager.option.current++;
                    $pager.render();
                    $pager.option.onChange($current + 1);
                });

                // 跳转
                $container.on('click', '.viease-pager-btn-goto', function() {
                    var $page = parseInt($container.find('.viease-pager-to-page').val()) || $pager.current();

                    if ($page > $pager.option.total || $page < 1 || $page  == $pager.current()){
                        return;
                    }
                    $pager.option.current = $page;
                    $pager.render();
                    $pager.option.onChange($page);
                });
            },

            /**
             * 获取上一页
             *
             * @return {Int}
             */
            prev: function(){
                var $current = $pager.option.current;

                return $current - 1 < 0 ? $current : $current - 1;
            },

            /**
             * 获取下一页
             *
             * @return {Int}
             */
            next: function(){
                var $current = $pager.option.current;

                return $current + 1 > $pager.option.total ? $current : $current + 1;
            },

            /**
             * 获取当前页
             *
             * @param {String} $container
             *
             * @return {Int}
             */
            current: function(){
                return parseInt($pager.option.container.find('.viease-pager-current-page').text()) || 1;
            }
        }

        $pager.option = $.extend(true, $pager.option, $options || {});
        $pager.option.container = $($selector);

        return $pager;
    }

    return Pager;
});
