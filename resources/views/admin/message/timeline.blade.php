@extends('admin.layout')

@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">实时消息</h2>
    </div>
    <div class="well">
        <div class="panel panel-default message-item">
            <div class="panel-body">
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="fan-avatar fan-avatar-small media-object img-responsive" src="https://ss3.baidu.com/-fo3dSag_xI4khGko9WTAnF6hhy/super/whfpf%3D425%2C260%2C50/sign=fad7293a3c292df59796ff55da0c6852/8644ebf81a4c510fb7c00e0f6659252dd42aa59b.jpg" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                  <div class="media-heading row"><div class="col-md-6"><a href="">顺风顺水</a></div><div class="col-md-4">昨天 12:30</div><div class="col-md-2 text-right"><a href="javascript:;" class="reply-btn"><i class="ion-ios-undo"></i> 回复</a></div></div>
                    客户太少怎么办？, 产品卖不出去？你的客户不够多？公众号关注太少？NO！NO！NO！您来找我试试？找客户、招商、推广这些都不是事。3天抢光你竞争对手的客户！详情关注“广州微客来”公众号：wkl020
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="reply-editor" class="hide">
    <div class="reply-editor">
        <div class="editor-wrapper"></div>
        <div class="button-bar">
            <button class="btn btn-success submit-reply">发送</button>
            <button class="btn btn-light collapse-editor">收起</button>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    require(['pages/message.timeline']);
</script>
@stop