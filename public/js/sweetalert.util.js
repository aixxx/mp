/**
 * 基于 Sweetalert 的弹窗组件
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['sweetalert'], function (swal) {
    var defaultTimer = 2000;

    var $functions = {
        /**
         * 成功消息
         *
         * @param {String} title
         * @param {String} message
         * @param {Integer} timer
         *
         * @return {boolean}
         */
        success: function(title, message, timer) {
                    return swal({
                            title: title,
                            text: message,
                            type: "success",
                            html: true,
                            timer: timer || defaultTimer
                        });
        },

        /**
         * 普通消息
         *
         * @param {String} title
         * @param {String} message
         * @param {Integer} timer
         *
         * @return {boolean}
         */
        info: function(title, message, timer) {
            return swal({
                    title: title,
                    text: message,
                    type: "info",
                    html: true,
                    timer: timer || defaultTimer
                });
        },

        /**
         * 失败消息
         *
         * @param {String} title
         * @param {String} message
         * @param {Integer} timer
         *
         * @return {boolean}
         */
        error: function(title, message, timer) {
            return swal({
                    title: title,
                    text: message,
                    type: "error",
                    html: true,
                    timer: timer || defaultTimer
                });
        },

        /**
         * 警告消息
         *
         * @param {String}   title
         * @param {String}   message
         * @param {Function} callback
         * @param {String}   confirmButtonText
         * @param {Boolean}  closeOnConfirm
         * @param {Boolean}  showCancelButton
         *
         * @return {Boolean}
         */
        warning: function(title, message, callback, confirmButtonText, closeOnConfirm, showCancelButton) {
            return swal({
                title: title,
                text: message,
                type: "warning",
                showCancelButton: showCancelButton,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: confirmButtonText || 'OK，没问题！',
                closeOnConfirm: closeOnConfirm,
                html: true
            }, callback);
        },

        /**
         * 自动关闭
         *
         * @param {String}  title
         * @param {String}  message
         * @param {Integer} timer
         *
         * @return {boolean}
         */
        flush: function(title, message, timer) {
            return swal({   title: title,   text: message,   timer: timer || 2000 });
        },

        alert: function(string){
            swal('' + string);
        },

        confirm: function(title){
            window.__last_btn = $(window.event.target);
                swal({
                    title: title,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: '确认',
                    cancelButtonText: '取消'
                }, function() {
                    if (window.event) {
                        var btn = window.__last_btn;
                        window.location.href=btn.attr('href');
                    };
                });

                return false;
        }
    };

    window.success = $functions.success;
    window.error   = $functions.error;
    window.alert   = $functions.alert;
    window.warning = $functions.warning;
    window.info    = $functions.info;
    window.flush   = $functions.flush;
    window.confirm = $functions.confirm;

    return $functions;
});