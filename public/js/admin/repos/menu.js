/**
 * 菜单数据仓库
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'util'], function($, Util){

    /**
     * 菜单仓库
     *
     * @author overtrue <anzhengchao@gmail.com>
     *
     * @type {Object}
     */
    var $menu = {
        /**
         * 获取菜单列表
         *
         * @param {Function} $callback
         */
        getMenus: function ($callback) {
            Util.request('GET', 'menu/lists', {}, $callback);
        },

        /**
         * 创建菜单
         *
         * @param {Object}   $request
         * @param {Function} $callback
         */
        createMenu: function ($request, $callback) {
            Util.request('POST', 'menu/store', $request, $callback);
        },

        /**
         * 更新菜单
         *
         * @param {[type]}   $menuId
         * @param {Object}   $request
         * @param {Function} $callback
         */
        updateMenu: function ($menuId, $request, $callback) {
            Util.request('PATCH', 'menu/update/' + $menuId, $request, $callback);
        },

        /**
         * 删除菜单
         *
         * @param {Int}     $menuId
         * @param {Function} $callback
         */
        deleteMenu: function ($menuId, $callback) {
            Util.request('DELETE', 'menu/delete/' + $menuId, $callback);
        },

        /**
         * 提交菜单到微信服务器
         *
         * @param {Object}   $menus
         * @param {Function} $callback
         */
        submitMenu: function ($menus, $callback) {
            console.log($menus);
            var $request = {
                menus: $menus
            };
            Util.request('POST', 'menu/store', $request, $callback);
        }
    };

    return $menu;

});