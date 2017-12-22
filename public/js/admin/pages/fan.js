/**
 * 粉丝管理页 js
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'underscore', 'pager', 'util','validator', 'repos/fan', 'admin/common'], function ($, _, Pager, Util, Validator,$fan) {
    $(function(){
        var $emptyContentTemplate = _.template($('#no-content-template').html());
        var $fanTemplate    = _.template($('#fan-template').html());
        var $groupTemplate   = _.template($('#group-template').html());
        var $popoverTemplate = _.template($('#fan-popover-template').html());
        var $fanContainer   = $('.fans-list');
        var $groupContainer  = $('.group-list');
        var $__groupId = 0;
        var $__page = 1;
        var $__sortBy = $('[name="sort_by"]').val();

         // 当无内容时显示“无内容”提示
        $fanContainer.ifEmpty(function($el){
            $el.html($emptyContentTemplate()).addClass('no-content');;
        });

        // 分页
        var $pager = new Pager('.pagination-bar', {
                classes: 'border-top',
                onChange: function($page){
                    loadFans($__groupId, $__sortBy, $page);
                }
            });

        // 加载用户列表
        function loadFans($groupId, $sortBy, $page,$searchName) {
            $__sortBy = $sortBy = $sortBy || $__sortBy;
            $__page = $page = $page || $__page;

            $fan.getFans($groupId, $sortBy, function($fans){
                $fanContainer.html($fanTemplate({fans:$fans}));
                $pager.display({
                        total: window.last_response.last_page,
                        current: window.last_response.current_page,
                    });
            }, $page,$searchName);
        }

        // 加载组列表
        function loadGroups($sortBy, $page) {
            $fan.getGroups($sortBy, function($groups){
                // 加入 “全部分组”
                var totalfans = _.reduce($groups, function(sum, group){return sum + group.fan_count;}, 0);

                $groups.unshift({id:0, title: "全部用户", fan_count:totalfans});

                $groupContainer.html($groupTemplate({groups:$groups}));
            }, $page);
        }

        loadFans($__groupId); // 第一次加载全部用户
        loadGroups(); // 第一次加载全部组

        // 修改排序方式
        $(document).on('change', '[name="sort_by"]', function(){
            loadFans($__groupId, $(this).val(), $__page);
        });

        // 分组切换
        $(document).on('click', '.group-list > a', function(){
            $__groupId = $(this).data('group_id');
            loadFans($__groupId, $__sortBy);
            $(this).addClass('active').siblings('a').removeClass('active');
        });

        // 浮层
        $(document).on('mouseenter', '.fan-item', function(){
            var $data = $(this).data();
                $data['html'] = true;

            if (!$data['content']) {
                var content = $($popoverTemplate($data));
                content.find('select').val($data.group_id).change()
                                        .find('[value="'+$data.group_id+'"]')
                                        .attr('selected', true)
                                        .siblings().attr('selected', false);
                $(this).data('content', content);
            };

            $(this).popover($(this).data());
            $('.popover').popover('hide');
            $(this).popover('show');
        });

        // 按名字搜索
        $(document).on('click', '#search-by-name-btn', function(){
            loadFans($__groupId, $__sortBy, $__page,$('#search-name').val());
        });
        $('#search-name').bind('keypress',function(event){
            if(event.keyCode == "13")
            {
                loadFans($__groupId, $__sortBy, $__page,$('#search-name').val());
                return false;
            }
        });

        // 新建分组
        $(document).on('submit', '#new-group', function(){
            var $params = Util.parseForm($('#new-group'));

            var $validator = Validator.make($params, {group_name:"required|min:1"}, {group_name:"名称"});
            if ($validator.fails()) {
                Util.formError($('#new-group'), $validator.messages());
                return false;
            };

            $fan.createGroup($params.group_name, function($group){
                $groupContainer.append($groupTemplate({groups: [$group]}));
                success('分组创建成功！');
                $('#new-group-modal').modal('hide').find('form').get(0).reset();
            }, function(err){
                if (err.status == 422) {
                    return Util.formError($('#new-group'), err.responseJSON);
                };
            });

            return false;
        });
    });
});