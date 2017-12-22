/**
 * 素材数据仓库
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'util'], function($, Util){

    /**
     * 素材仓库
     *
     * @author overtrue <anzhengchao@gmail.com>
     *
     * @type {Object}
     */
    var $material = {
        /**
         * 获取资源数量汇总
         *
         * @param {Function} $callback
         */
        summary: function($callback){
            Util.request('GET', 'material/summary',{}, $callback);
        },

        /**
         * 获取素材列表
         *
         * @param {Object}   $request
         * @param {Function} $callback
         */
        lists: function($request, $callback){
            $request['page'] = $request['page'] || (window.__page || 0) + 1;
            Util.request('GET', 'material/lists', $request, $callback);
        },

        /**
         * 获取图片素材列表
         *
         * @param {Function} $callback
         */
        getImages: function($callback, $page){
            var $request = {
                type: 'image',
                page: $page,
            };

            Repo.material.lists($request, $callback);
        },

        /**
         * 获取视频素材列表
         *
         * @param {Function} $callback
         */
        getVideos: function($callback, $page){
            var $request = {
                type: 'video',
                page: $page,
            };

            Repo.material.lists($request, $callback);
        },

        /**
         * 获取声音素材列表
         *
         * @param {Function} $callback
         */
        getVoices: function($callback, $page){
            var $request = {
                type: 'voice',
                page: $page,
            };

            Repo.material.lists($request, $callback);
        },

        /**
         * 获取图文素材列表
         *
         * @param {Function} $callback
         */
        getArticles: function($callback, $page){
            var $request = {
                type: 'article',
                page: $page,
            };

            Repo.material.lists($request, $callback);
        },

        /**
         * 获取素材
         *
         * @param {Int}      $mediaId
         * @param {Function} $callback
         */
        getByMediaId: function($mediaId, $callback){
            var $request = {
                media_id: $mediaId
            };

            Util.request('GET', 'material/show', $request, $callback);
        },

        /**
         * 删除素材
         *
         * @param {Int}      $id
         * @param {Function} $callback
         */
        delete: function($id, $callback){
            var $request = {
                id: $id
            };

            Util.request('DELETE', 'material/delete', $request, $callback);
        }
    };

    return $material;
});