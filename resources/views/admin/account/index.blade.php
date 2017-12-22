@extends('admin.layout')

@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">
            公众号列表
            <div class="pull-right">
                <button onclick="location.href='{{admin_url('account/create')}}'" class="btn btn-success" data-toggle="tooltip" data-placement="top" data-original-title="新增公众号">新增公众号</button>
            </div>
        </h2>
    </div>
    <div class="well bs-component">
        <table class="table table-wechat">
            <thead class="thead">
                <tr>
                    <td>公众号名称</td>
                    <td>微信号</td>
                    <td>类型</td>
                    <td>添加时间</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody class="tbody">
                @if($accounts->count())
                    @foreach($accounts as $account)
                <tr>
                    <td>{{$account->name}}</td>
                    <td>{{$account->wechat_account}}</td>
                    <td>@if($account->account_type ==1) 订阅号 @else 服务号 @endif</td>
                    <td>{{$account->created_at->format('Y-m-d H:i:s')}}</td>
                    <td>
                        <a href="{{ admin_url('account/change-account/'.$account->id)}}" class="btn btn-success btn-xs">功能管理</a>
                        <a href="{{ admin_url('account/update/'.$account->id)}}" class="btn btn-default btn-xs">编辑</a>
                        <a href="#api_{{$account->id}}" class="btn btn-mint btn-xs" data-toggle="modal">接口</a>
                        <a href="{{ admin_url('account/destroy/'.$account->
                            id) }}" class="btn btn-danger btn-xs" onclick="return confirm('删除后无法恢复,确定要删除吗')">删除
                        </a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">
                        <span class="empty_tips">
                            暂无公众号，点击
                            <a href="{{ admin_url('account/create') }}" >添加公众号</a>
                        </span>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@if($accounts->count())
    @foreach($accounts as $account)
        <div class="modal" id="api_{{$account->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title"><strong><i class="ion-ios-checkmark-outline text-primary"></i> 请复制此处token和url到公众平台绑定</strong></h4>
                </div>
                <div class="modal-body panel-body">
                    <p><strong>Url:</strong>&nbsp;&nbsp;&nbsp;{{ make_api_url($account->tag)}}</p>
                    <p><strong>Token:</strong>&nbsp;&nbsp;&nbsp;{{ $account->token}}</p>
                    <p><strong>EncodingAESKey:</strong>&nbsp;&nbsp;&nbsp;{{ $account->aes_key}}</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-mint" data-dismiss="modal">确定</button>
                </div>
              </div>
            </div>
        </div>
    @endforeach
@endif
@stop

@section('js')
<script>
</script>
@stop