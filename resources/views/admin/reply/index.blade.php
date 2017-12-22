@extends('admin.layout')
@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">自动回复 <button class="btn btn-success btn-sm add-new">添加规则</button></h2>
    </div>

    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#keyword-reply" aria-controls="keyword-reply" role="tab" data-toggle="tab">关键词自动回复</a></li>
      <li role="presentation"><a href="#subscribe-reply" aria-controls="subscribe-reply" role="tab" data-toggle="tab">被关注时回复</a></li>
      <li role="presentation"><a href="#default-reply" aria-controls="default-reply" role="tab" data-toggle="tab">无匹配时回复</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content well">
      <div role="tabpanel" class="tab-pane active" id="keyword-reply">
        <div class="rule-container">
          <div class="panel panel-default rule-item" data-id="2" data-name="abd" data-trigger-type="contain" data-trigger-keywords="sss" data-text="ssss" data-url="">
              <div class="panel-heading">规则1 <div class="pull-right"><a href="javascript:;" class="edit-rule"><i class="ion-ios-compose-outline icon-md"></i></a> <a href="javascript:;" class="delete-rule"><i class="ion-ios-trash-outline icon-md"></i></a></div></div>
              <div class="panel-body">
                  <div class="keywords">关键词：股票</div>
                  <div class="replys">回复：xxxx</div>
              </div>
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">规则1</div>
              <div class="panel-body">
                  <div class="keywords">关键词：股票</div>
                  <div class="replys">回复：xxxx</div>
              </div>
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">规则1</div>
              <div class="panel-body">
                  <div class="keywords">关键词：股票</div>
                  <div class="replys">回复：xxxx</div>
              </div>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="subscribe-reply">
        <div class="subscribe-response-container"></div>
      </div>
      <div role="tabpanel" class="tab-pane" id="default-reply">
        <div class="default-response-container"></div>
      </div>
    </div>
</div>

<script type="text/plain" class="form-template">
  <div class="form-container">
      <div class="panel panel-default">
          <div class="panel-heading">添加规则</div>
          <div class="panel-body">
          <form class="form-horizontal form-create">
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">规则名称</label>
                  <div class="col-lg-6">
                    <input type="text" name="name" class="form-control" id="inputEmail" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">类型</label>
                  <div class="col-lg-6">
                    <div class="radio">
                      <label>
                        <input type="radio" name="trigger_type" id="optionsRadios1" value="contain" checked="">
                        包含
                      </label>
                      <label>
                        <input type="radio" name="trigger_type" id="optionsRadios2" value="equal">
                        等于
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">关键词</label>
                  <div class="col-lg-6">
                    <input type="text" name="trigger_keywords" class="form-control" id="inputEmail" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-8 col-lg-offset-2">
                      <div class="response-media-picker">

                      </div>
                  </div>
                 </div>
                  <hr>
                <div class="form-group">
                  <div class="col-lg-6 col-lg-offset-2">
                    <input type="hidden" name="id" value="">
                    <button class="btn btn-default form-cancel">取消</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                  </div>
                </div>
            </form>
            </div>
      </div>
  </div>
</script>
@stop

@section('js')
<script>
    require(['pages/reply'])
</script>
@stop