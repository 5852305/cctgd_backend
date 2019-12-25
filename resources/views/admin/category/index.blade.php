@extends('admin.layout2.default')
@section('content')
    <fieldset class="layui-elem-field layuimini-search">
        <legend>搜索信息</legend>
        <div style="margin: 10px 10px 10px 10px">
            <form class="layui-form layui-form-pane" action="">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">用户姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">用户性别</label>
                        <div class="layui-input-inline">
                            <input type="text" name="sex" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">用户城市</label>
                        <div class="layui-input-inline">
                            <input type="text" name="city" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">用户职业</label>
                        <div class="layui-input-inline">
                            <input type="text" name="classify" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <a class="layui-btn" lay-submit="" lay-filter="data-search-btn">搜索</a>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>

    <script type="text/html" id="toolbar">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" lay-event="add">添加分类</button>
            <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="del">删除</button>
        </div>
    </script>
    <table class="layui-hide" id="table" lay-filter="table"></table>
    <script type="text/html" id="table-bar">
        <a class="layui-btn layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
    </script>

    <script type="text/html" id="add">

        <form class="layui-form" lay-filter="form" >
            <div class="layui-form-item">
                <label class="layui-form-label">选择分类</label>
                <div class="layui-input-block">
                    <select name="parent_id" id="parent_id">
                        <option value="0">父级分类</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">分类名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">上传封面</label>
                <div class="layui-input-inline">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="cover-upload">上传封面</button>
                        <div class="layui-upload-list">
                            <input type="hidden" id="cover" name="pic" lay-verify="pic" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                            <img class="layui-upload-img" id="preview" style="width: 92px; height: 92px; margin: 0 10px 10px 0;">
                            <p id="cover-text"></p>
                        </div>
                    </div>
                </div>
                <div class="layui-input-inline">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="cover-upload2">上传副封面</button>
                        <div class="layui-upload-list">
                            <input type="hidden" id="cover2" name="head_pic" lay-verify="headPic" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                            <img class="layui-upload-img" id="preview2" style="width: 92px; height: 92px; margin: 0 10px 10px 0;">
                            <p id="cover-text2"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入描述" class="layui-textarea" name="detail" lay-verify="required"></textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <input type="hidden"  name="id" value=""  autocomplete="off" class="layui-input">
                    <button class="layui-btn" style="display:none"  lay-submit="" id="submit" lay-filter="submit">立即提交</button>
                </div>
            </div>
        </form>
    </script>
@endsection
@section("js")
    <script src="{{ asset("cctgd/category.js") }}?v=123" charset="utf-8"></script>
 @endsection
