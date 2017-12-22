/**
 * 菜单本地存储数据仓库
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'util', 'store'], function($, Util, Store){
    var $default = {
        name:'',
        parent:'',
        id: '',
        hasChild: false,
        content: {

        }
    };

    var $menu = {
        put: function ($id, $attributes) {
            var $menus = Store.get('menus') || {};
            $menus[$id] = $.extend(true, $default, $attributes);
            Store.set('menus', $menus);
        },

        get: function ($id) {
            var $menus = Store.get('menus') || {};

            return $menus[$id] || {};
        },

        update: function ($id, $attributes) {
            var $menus = Store.get('menus') || {};

            $menus[$id] = $.extend(true, $menus[$id], $attributes || {});

            Store.set('menus', $menus);
        },

        delete: function ($id) {
            var $menus = Store.get('menus') || {};

            delete $menus[$id];

            Store.set('menus', $menus);
        },

        all: function() {
            var $menus = Store.get('menus') || {};

            return $menus;
        },

        clean: function () {
            Store.set('menus', {});
        }
    };

    return $menu;
});