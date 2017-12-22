@extends('admin.layout')

@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">{{ $global->current_account->name }}</h2>
    </div>
    <div class="well bs-component">
        其他需要展示的通知消息 图表数据等
    </div>
</div>
@stop