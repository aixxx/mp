@extends('admin.layout')
@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">粉丝管理</h2>
    </div>
    <div class="well row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                    <div class="col-md-4"><span class="line-height-sm">全部粉丝</span></div>
                    <form action="" class="col-md-8 form-inline">
                        <div class="pull-right">
                            <div class="form-group">
                                <select name="sort_by" class="form-control input-sm">
                                    <option value="subscribed_at">关注时间</option>
                                    <option value="liveness">活跃度</option>
                                    <option value="last_online_at">最后发言时间</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" id="search-name" placeholder="用户昵称">
                                    <span class="input-group-btn">
                                        <button id="search-by-name-btn" class="btn btn-default btn-sm" type="button"><i class="ion-ios-search-strong"></i></button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="fans-list clearfix ajax-loading">
                </div>
                <div class="pagination-bar"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">分组 <a href="#new-group-modal" data-toggle="modal" data-target="#new-group-modal" class="pull-right"><i class="ion-android-add icon-md"></i></a></div>
                <div class="list-group group-list ajax-loading">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="new-group-modal">
    <form id="new-group" action="" method="post" class="form-horizontal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">添加分组</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="group-name" class="col-md-3 control-label">分组名称：</label>
                    <div class="col-md-6">
                        <input type="text" id="group-name" name="group_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <button type="submit" class="btn btn-primary submit-group">确认</button>
            </div>
          </div>
        </div>
    </form>
</div>

<script type="text/template" id="no-content-template">
    <div class="blankslate spacious">
        <h3><i class="ion-ios-information"></i> 无用户</h3>
    </div>
</script>

<script id="group-template" type="text/template">
    <% _.each(groups, function(group) { %>
    <a href="javascript:;" data-id="<%= group.id %>" data-group_id="<%= group.group_id %>" class="list-group-item">
      <span class="badge"><%= group.fan_count %></span> <%= group.title %>
    </a>
    <% }); %>
</script>

<script id="fan-template" type="text/template">
    <% _.each(fans, function(fan) { %>
    <div class="col-md-4 col-sm-6 fan-item" data-nickname="<%= fan.nickname %>" data-location="<%= fan.location %>" data-remark="<%= fan.remark %>" data-group-id="<%= fan.group_id %>" data-signature="<%= fan.signature %>">
        <div class="media">
            <div class="media-left">
                <a href="javascript:;">
                    <img src="<%= fan.avatar %>" alt="" class="fan-avatar fan-avatar-small media-object img-responsive">
                </a>
            </div>
            <div class="media-body">
                <div class="fan-nickname"><%= fan.nickname.limit(7) %></div>
                <div class="text-muted"><%= fan.location %></div>
            </div>
        </div>
    </div>
    <% }); %>
</script>

<script id="fan-popover-template" type="text/template">
    <table>
        <tr>
            <td colspan="2"><span class="nickname"><%= nickname %></span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="remark"><%= remark %></span> <a href="javascript:;"><i class="ion-ios-compose-outline icon-md"></i></a></td>
        </tr>

        <tr>
            <td class="popover-table-label">地区：</td>
            <td class="location"> <%= location %> </td>
        </tr>
        <tr>
            <td class="popover-table-label">分组：</td>
            <td>
                <select name="group" class="origin form-control" id="">
                    <option value="0">分组0</option>
                    <option value="1">分组1</option>
                    <option value="2">分组2</option>
                    <option value="3">分组3</option>
                    <option value="4">分组4</option>
                    <option value="5">分组5</option>
                    <option value="6">分组6</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="popover-table-label">签名：</td>
            <td class="signature"> <%= signature %></td>
        </tr>
    </table>
</script>
@stop

@section('js')
<script>
    require(['pages/fan']);
</script>
@stop