@extends('admin.layout')
@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">公众账号管理</h2>
        <div class="navbar nav-tab">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#home" data-toggle="tab" aria-expanded="true">首页</a>
                </li>
                <li class="">
                    <a href="#profile" data-toggle="tab" aria-expanded="false">账户</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="well bs-component">
        <form class="form-horizontal">
            <fieldset>
                <legend>描述</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">邮箱</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">密码</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox">复选框</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">文本域</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="textArea"></textarea>
                        <span class="help-block">这是一行帮助文字，如果这一行说明文字太长的话，超出的部分会自动换行。</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">单选按钮</label>
                    <div class="col-lg-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">选项一</label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">选项二</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">switchery</label>
                    <div class="col-lg-10">
                        <div class="checkbox">
                            <input type="checkbox" name="optionsRadios" id="optionsRadios1" value="option1" checked=""  class="js-switch"> 选项一
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="optionsRadios" id="optionsRadios2" value="option2"  class="js-switch" checked> 选项二
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="optionsRadios" id="optionsRadios2" value="option2"  class="js-switch" data-size="small" checked> 小号的
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="optionsRadios" id="optionsRadios2" value="option2"  class="js-switch" data-size="large" checked> 大号的
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">下拉选择</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="select">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        <br>
                        <select multiple="" class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">提示消息</label>
                    <div class="col-lg-10">
                        <a href="javascript:alert('好帅！');" class="btn btn-info">alert('好帅！');</a>
                        <a href="javascript:success('成功！');" class="btn btn-success">success('成功！');</a>
                        <a href="javascript:error('失败！');" class="btn btn-danger">error('失败！');</a>
                        <a href="javascript:warning('请安全操作');" class="btn btn-warning">warning('请安全操作');</a>
                        <a href="javascript:confirm('确认删除么？');" class="btn btn-default">confirm('确认删除么？');</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button class="btn btn-default">取消</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection