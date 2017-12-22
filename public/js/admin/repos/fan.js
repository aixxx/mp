/**
 * 粉丝数据仓库
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'util'], function($, Util){

    /**
     * 粉丝仓库
     *
     * @author overtrue <anzhengchao@gmail.com>
     *
     * @type {Object}
     */
    var $fan = {
        /**
         * 获取粉丝列表
         *
         * @param {Int}      $groupId
         * @param {[type]}   $sortBy
         * @param {[type]}   $page
         * @param {Function} $callback
         * @param {Function} $searchName
         */
        getFans: function ($groupId, $sortBy, $callback, $page,$searchName) {
            var $request = {
                group_id: $groupId || 0,
                sort_by: $sortBy || 'id',
                page: $page || window.__page + 1 || 1,
                search_name:$searchName||''
            };

            Util.request('GET', 'fan/lists', $request, $callback);
        },

        /**
         * 修改粉丝备注
         *
         * @param {Int}      $fanId
         * @param {String}   $remark
         * @param {Function} $callback
         */
        setRemark: function ($fanId, $remark, $callback) {
            var $request = {
                remark: $remark
            };

            Util.request('PATCH', 'fan/remark/' + $fanId, $request, $callback);
        },

        /**
         * 移动粉丝（一个或者多个）到分组
         *
         * @param {Int}      $fanId
         * @param {Int}      $groupId
         * @param {Function} $callback
         */
        setFanGroupId: function ($fanId, $groupId, $callback) {
            var $request = {
                fan_id: $fanId,
                group_id: $groupId
            };

            Util.request('PATCH', 'fan/set-group', $request, $callback);
        },

        /**
         * 获取分组列表
         *
         * @param {String}   $sortBy
         * @param {Int}      $page
         * @param {Function} $callback
         */
        getGroups: function ($sortBy, $callback, $page) {
            var $request = {
                sort_by: $sortBy || null,
                page: $page || window.__page + 1 || 1,
            };

            Util.request('GET', 'fan-group/lists', $request, $callback);
        },

        /**
         * 创建分组
         *
         * @param {String}   $title
         * @param {Function} $callback
         */
        createGroup: function ($title, $callback) {
            var $request = {
                title: $title
            };

            Util.request('POST', 'fan-group/store', $request, $callback);
        },

        /**
         * 修改分组
         *
         * @param {Int}      $id
         * @param {String}   $title
         * @param {Function} $callback
         */
        updateGroup: function ($id, $title, $callback) {
            var $request = {
                title: $title
            };

            Util.request('PATCH', 'fan-group/update/' + $id, $request, $callback);
        },
    };

    return $fan;
});