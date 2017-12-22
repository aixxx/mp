/**
 * 自动回复数据仓库
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'util'], function($, Util){

    /**
     * 自动回复仓库
     *
     * @author overtrue <anzhengchao@gmail.com>
     *
     * @type {Object}
     */
    var $autoReply = {
        /**
         * 列出规则列表
         *
         * @param {Function} $callback
         * @param {Int}      $page
         */
        getRules: function($callback, $page){
            var $request = {
                page: $page || window.__page + 1 || 1
            };

            Util.request('GET', 'reply/lists', $request, $callback);
        },

        /**
         * 创建规则
         *
         * @param {Object}   $request
         * @param {Function} $callback
         */
        create: function ($request, $callback) {
            Util.request('POST', 'reply/store', $request, $callback);
        },

        /**
         * 更新规则
         *
         * @param {Int}      $id
         * @param {Object}   $request
         * @param {Function} $callback
         */
        update: function ($id, $request, $callback) {
            Util.request('POST', 'reply/update/'+$id, $request, $callback);
        },

        /**
         * 删除规则
         *
         * @param {Int}      $id
         * @param {Function} $callback
         */
        delete: function ($id, $callback) {
            Util.request('DELETE', 'reply/delete/'+$id, $request, $callback);
        },
    };

    return $autoReply;
});