@extends('admin.layout')

@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">@if(isset($account)) 编辑公众号 @else 添加公众号 @endif</h2>
    </div>
    <div class="well bs-component">
        @form(['url' => isset($account)? admin_url('account/update/'.$account->id): admin_url('account/create'), 'method' => 'post', 'class' => 'form-horizontal'])
        @col_input('text','name',$errors,'*公众号名称',isset($account) ? $account->name : old('name'), ['placeholder' => '例如：微易'])
        @col_input('text','original_id',$errors,'*公众号原始Id',isset($account) ? $account->original_id : old('original_id'),['placeholder' => '请认真填写，错了不能修改。例如gh_gks84hksi90o'])
        @col_input('text','wechat_account',$errors,'*微信号',isset($account) ? $account->wechat_account : old('wechat_account') ,['placeholder' => '例如：viease'])
        @col_input('text','app_id',$errors,'AppID（公众号）',isset($account) ? $account->app_id : old('app_id'),['placeholder' => '用于自定义菜单等高级功能'])
        @col_input('text','app_secret',$errors,'AppSecret ',isset($account) ? $account->app_secret : old('app_secret'),['placeholder' => '用于自定义菜单等高级功能'])
        @col_select('account_type', [1 => '订阅号', 2 => '服务号'], $errors, '微信号类型 ', isset($account) ? $account->account_type : old('account_type'),['placeholder' => '认证服务号是指每年向微信官方交300元认证费的公众号'])
        @col_submit('提交')
        @endform
    </div>
</div>
@endsection