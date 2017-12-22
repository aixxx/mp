@extends('admin.layout')
@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">菜单管理 <div class="pull-right"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="启用或停用菜单">停用</button></div></h2>
    </div>
    <div class="well row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">自定义菜单 <a href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="创建一个菜单" class="add-menu-item pull-right"><i class="ion-android-add icon-md" ></i></a></div>
                <div class="list-group">
                    <div class="menus no-menus resizeable"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">自定义菜单</div>
                <div class="panel-body response-content">
                    <div class="blankslate spacious">你可以从左边创建一个菜单并设置响应内容。</div>
                </div>
            </div>
        </div>
        <div class="buttons col-md-12 text-center">
            <hr>
            <button class="btn btn-success submit-menu">提交</button>
            <button class="btn btn-default">重置</button>
        </div>
    </div>
</div>

<!--End-->
<script type="text/template" id="no-menus-content-template">
    <div class="blankslate spacious">
        <p>尚未配置菜单</p>
        <div><a href="javascript:;" class="add-menu-item">点此立即创建</a></div>
    </div>
</script>
<script type="text/template" id="menu-item-template">
    <div class="list-group-item menu-item" id="<%= menu.id %>" data-parent-id="<%= menu.parent %>">
        <div class="menu-item-heading">
            <span class="menu-item-name"><%= menu.name %></span>
            <div class="actions pull-right">
                <a href="javascript:;" class="edit" title=""><i class="ion-ios-compose-outline"></i></a>
                <a href="javascript:;" class="add-sub" ><i class="ion-ios-plus-empty"></i></a>
                <a href="javascript:;" class="trash" ><i class="ion-ios-trash-outline"></i></a>
            </div>
        </div>
        <div class="list-group sub-buttons no-menus"></div>
    </div>
</script>
<script type="text/template" id="menu-item-form-template">
    <div class="list-group-item menu-item">
        <form action="" method="post" accept-charset="utf-8" class="menu-item-form">
            <div class="form-group">
                <input type="text" name="name" placeholder="" class="form-control" value="<% if (typeof name != 'undefined') { %><%= name %><% } %>">
            </div>
            <input type="hidden" name="id" value="<% if (typeof id != 'undefined') { %><%= id %><% } %>">
            <input type="hidden" name="parent" value="<% if (typeof parent != 'undefined') { %><%= parent %><% } %>">
            <button type="submit" class="btn btn-xs btn-success">保存</button>
            <button type="button" class="btn btn-xs btn-danger cancel-do">取消</button>
        </form>
    </div>
</script>

@stop

@section('js')
<script>
require(['pages/menu']);
</script>
@stop
