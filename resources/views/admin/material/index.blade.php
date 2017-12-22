@extends('admin.layout')

@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">素材管理</h2>
    </div>
    <ul class="nav nav-tabs min-with-md">
        <li role="presentation" class="active">
            <a href="#image">图片</a>
        </li>
        <li role="presentation">
            <a href="#video">视频</a>
        </li>
        <li role="presentation">
            <a href="#voice">音频</a>
        </li>
        <li role="presentation">
            <a href="#article">图文</a>
        </li>
    </ul>
    <div class="well">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="image">
                <div class="panel panel-default">
                    <div class="panel-heading with-md-button">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title">图片库 <small>共 <span class="count">0</span> 张图片</small></h3>
                            </div>
                            <div class="col-md-6">
                                <button class="pull-right btn btn-success upload-image"><i class="ion-plus"></i> 上传图片</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body popup-layer empty-listener row images-container ajax-loading"></div>
                    <div class="pagination-bar"></div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="video">
                <div class="panel panel-default">
                    <div class="panel-heading with-md-button">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title">视频库 <small>共 <span class="count">0</span> 个视频</small></h3>
                            </div>
                            <div class="col-md-6">
                                <button class="pull-right btn btn-success"><i class="ion-plus"></i> 上传视频</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body popup-layer empty-listener row videos-container media-list-thumbs ajax-loading"></div>
                    <div class="pagination-bar"></div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="voice">
                <div class="panel panel-default">
                    <div class="panel-heading with-md-button">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title">音频库 <small>共 <span class="count">0</span> 条音频</small></h3>
                            </div>
                            <div class="col-md-6">
                                <button class="pull-right btn btn-success"><i class="ion-plus"></i> 上传音频</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body popup-layer empty-listener row voices-container media-list-thumbs ajax-loading"></div>
                    <div class="pagination-bar"></div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="article">
                <div class="panel panel-default">
                    <div class="panel-heading with-md-button">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title">图文库 <small>共 <span class="count">0</span> 篇文章</small></h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ admin_url('material/new-article') }}" class="pull-right btn btn-success"><i class="ion-plus"></i> 创建图文</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body popup-layer empty-listener row articles-container ajax-loading"></div>
                    <div class="pagination-bar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/template" id="no-content-template">
    <div class="blankslate spacious">
        <h3><i class="ion-ios-information"></i> 无内容</h3>
        <p>您可以点击右上角按钮来添加内容</p>
    </div>
</script>
<script type="text/template" id="image-item-template">
    <div class="col-xs-6 col-sm-3 media-card">
        <a href="<%= source_url %>" target="_blank" class="popup">
          <img src="<%= source_url %>" alt="" class="img-responsive">
        </a>
    </div>
</script>
<script type="text/template" id="video-item-template">
    <div class="col-xs-6 col-sm-3 media-card">
        <a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
            <span class="placeholder bg-video"></span>
            <h2>北京中关村大街理想国际大厦</h2>
            <span class="icon ion-ios-play"></span>
            <!-- <span class="duration">03:15</span>-->
        </a>
    </div>
</script>
<script type="text/template" id="voice-item-template">
    <div class="col-xs-6 col-sm-3 media-card">
        <a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
            <span class="placeholder bg-vioce"></span>
            <span class="icon ion-ios-volume-high"></span>
            <!-- <span class="duration">03:15</span>-->
        </a>
    </div>
</script>
<script type="text/template" id="article-item-template">
    <div class="col-xs-6 col-sm-3 media-card">
        <a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
            <span class="placeholder bg-vioce"></span>
            <span class="icon ion-ios-volume-high"></span>
            <!-- <span class="duration">03:15</span>-->
        </a>
    </div>
</script>
@stop

@section('js')
<script>
    require(['pages/material']);
</script>
@stop