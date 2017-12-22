/**
 * 新建图片页面
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'uploader', 'util', 'repos/article-store', 'admin/common'], function ($, Uploader, Util, Article) {
    $(function(){
        var $ue = UE.getEditor('container');
        var $form = $('.article-form');
        var $previewItemTemplate = _.template($('#preview-item-template').html());
        var $firstItem = $('.article-preview-item.first');

        //检查是否显示添加按钮
        function performAddBtn () {
            var $addBtnBox = $('.add-new-item').closest('.article-preview-item');

            if ($('.articles-preview-container .article-preview-item').length -1 >= 8) {
                $addBtnBox.slideUp(100);
            } else {
                $addBtnBox.slideDown(100);
            }
        }

        // 根据属性渲染 form
        function renderForm ($attributes) {
            console.log($attributes);
            // 必须从表单字段开始遍历
            var $keys = Util.parseForm($form);

            for ($attribute in $keys) {
                $form.find('[name='+$attribute+']').val($attributes[$attribute]);
            }

            if ($attributes['content']) {
                $ue.addListener("ready", function () {
                    // editor准备好之后才可以使用
                    $ue.setContent($attributes['content']);
                });
            };

            previewItem($attributes);
        }

        // 渲染预览框
        function previewItem ($attributes) {
            var $item = $('.article-preview-item.active');

            $item.find('.attr-title').html($attributes['title'] || '标题');
        }

        // 保存form
        function saveForm () {
            var $id = $('.article-preview-item.active').prop('id');
            var $attributes = Util.parseForm($($form));

            $attributes.content = $ue.getContent();
            Article.put($id, $attributes);

            previewItem($attributes);
        }

        $form.on('keyup', saveForm);
        $ue.addListener('keyup', saveForm);

        // 添加项目
        $('.articles-preview-container').on('click', '.add-new-item', function(){
            var $parentItem = $(this).closest('.article-preview-item');
            var $item = $($previewItemTemplate({item:{}})).prop('id', (new Date).getTime());

            $parentItem.before($item);

            performAddBtn();
        });

        // 编辑项目
        $('.articles-preview-container').on('click', 'a.edit', function(){
            var $item = $(this).closest('.article-preview-item');

            if ($item.hasClass('active')) { return; };

            var $article = Article.get($item.prop('id'));

            $item.addClass('active').siblings().removeClass('active');

            renderForm($article);
        });

        // 删除项目
        $('.articles-preview-container').on('click', 'a.delete', function(){
            var $item = $(this).closest('.article-preview-item');

            Article.delete($item.prop('id'));

            $item.slideUp(200, function(){
                $(this).remove();

                performAddBtn();
            });
        });

        var $articles = Article.all();

        for($id in $articles){
            if ($id == 'article-first') {continue;};

            $firstItem.after($($previewItemTemplate({item: $articles[$id]})).prop('id', $id));
        }

        // 初始化
        $firstItem.find('a.edit').click();
    });
});