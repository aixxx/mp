/**
 * 应用初始化文件
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define([
    'jquery',
    'relocator',
    'underscore',
    'bootstrap',
    'magnificPopup',
    'selectpicker',
    'sweetalertUtil'
    ],
function ($, _) {
    $(function(){

        // 检查div内是否为空
        $.fn.ifEmpty = function(cb){
            var _this = this;
            setInterval(function(){
                _this.each(function(index, el) {
                    var el = $(el);
                    if(!el.html().length || !el.html().replace(new RegExp('[\s\n\r\t ]+', 'g'), '').length){
                        return cb(el);
                    }
                });
            }, 50);
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 需要ajax加载的框里放上占位符
        $('.ajax-loading').each(function(){
            var target = $(this);
            target.html('<div class="loader-wrapper"><div class="plus-loader"></div></div>');
            setTimeout(function(){
                target.find('.loader-wrapper').remove();
            }, 5000);
        });

        //初始化bootstrap tools
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]',
            container: "body"
            }),
            $("body").popover({
            selector: '[data-toggle="popover"]',
            container: "body"
        });

        // select 美化
        $('select:not(.origin)').selectpicker({
            style: 'btn-transparent',
            size: 4,
        }).on('change', function(){
            $(this).selectpicker({
                style: 'btn-transparent',
                size: 4,
            });
        });

        // 图片弹窗
        $('.popup-layer').magnificPopup({delegate: 'a.popup', type:'image'});

        // tabs
        $('.nav-tabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show');
        });

        // 滚动条
        $(window).scroll(function(event) {
            if($(window).scrollTop() >= 400){
                return $('.back-to-top').stop().fadeIn();
            }

            $('.back-to-top').stop().fadeOut();
        });

        // .popover自动关闭
        $(document).on('click', '.popover *', function(event){
            event.stopPropagation();
        });
        $(document).on('click', function(event){
            event.stopPropagation();
            setTimeout(function(){ $('.popover').popover('hide'); }, 1000);
        });

        // 顶部菜单点击切换左侧菜单
        $(document).on('click', '.top-nav > ul.navbar-main > li > a', function (e) {
            var $this = $(e.target);
            var $group = $this.data('group');
            $this.parent().addClass('active').siblings().removeClass('active');
            showMenu($group);
        });
        $('.top-nav > ul > li > a:first').trigger('click');

        // 左侧菜单点击
        $(document).on('click', '#sidebar-nav a', function (e) {
            var $this = $(e.target), $active;
            $this.is('a') || ($this = $this.closest('a'));

            // 折叠同伴
            // $active = $this.parent().siblings(".active");
            // $active && $active.toggleClass('active').find('> ul:visible').slideUp(200);

            if ($this.parent().hasClass('active')) {
                $this.next().slideUp(200);
                $this.find('span i').addClass('ion-ios-arrow-right').removeClass('ion-ios-arrow-down');
            } else {
                $this.next().slideDown(200);
                $this.find('span i').addClass('ion-ios-arrow-down').removeClass('ion-ios-arrow-right');
            }
            $this.parent().toggleClass('active');

            $this.next().is('ul') && e.preventDefault();

            var currentUrl = window.location.origin + window.location.pathname;
        });

        // switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            new Switchery(html, { size: html.getAttribute('data-size') || 'default' });
        });
    });
});

String.prototype.limit = function(length, suffix){
    var suffix = suffix || '...';

    if(this.length > length){
        return this.substring(0, length) + suffix;
    }

    return this;
};

/**
 * 展示左菜单
 */
function showMenu(group) {
    $("#sidebar-nav > ul").hide();
    $(".nav-group-" + group).show();

    $('#sidebar-nav a').each(function(){
        var href = $(this).attr('href').replace(' ', '');

        if (href.length > 0 && window.location.href.indexOf(href) >= 0) {
            $('#sidebar-nav a').removeClass('active');

            return $(this).addClass('active');
        };
    });
}