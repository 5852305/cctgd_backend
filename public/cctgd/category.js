layui.use(['form', 'table','upload'], function () {
    var $ = layui.jquery,
        form = layui.form,
        table = layui.table,
        upload = layui.upload;
    table.render({
        elem: '#'+CLASS+'-table',
        url: api.category.list,
        cols: [[
            {type: "checkbox", width: 50, fixed: "left"},
            {field: 'id', width: 80, title: 'ID', sort: true},
            {field: 'name',  title: '分类名', sort: true,edit: 'text',},
            {field: 'pic',  title: '封面',templet:function (res) {
                    return `<img src="/storage/${res.pic}">`;
            }},
            {field: 'head_pic',  title: '副封面',templet:function (res) {
                    return `<img src="/storage/${res.head_pic}">`;
                }},
            {field: 'created_at', title: '添加时间', sort: true},
            {field: 'updated_at',  title: '更新时间', sort: true},
            {title: '操作', templet: '#'+CLASS+'-table-bar', fixed: "right", align: "center"}
        ]],
        limits: [10, 15, 20, 25, 50, 100],
        limit: 15,
        page: true
        ,parseData: function(res){ //将原始数据解析成 table 组件所规定的数据
        return {
            "code": res.code, //解析接口状态
            "msg": res.msg, //解析提示文本
            "count": res.data.total, //解析数据长度
            "data": res.data.data //解析数据列表
        };
    }
    });

    // 监听搜索操作
    form.on('submit(data-search-btn)', function (data) {
        var result = JSON.stringify(data.field);
        layer.alert(result, {
            title: '最终的搜索信息'
        });

        //执行搜索重载
        table.reload(CLASS+'-table', {
            page: {
                curr: 1
            }
            , where: {
                searchParams: result
            }
        }, 'data');

        return false;
    });

    //自定义验证规则
    form.verify({
        pic: function(value){
            if(value == ""){
                return '请上传封面';
            }
        },
        headPic: function(value){
            if(value == ""){
                return '请上传副封面';
            }
        }
    });




    // 监听添加操作
    $(".data-add-btn").on("click", function () {
        add_edit();
    });
    form.on("submit("+CLASS+"-submit)",function (data) {
        console.log(data.field);
       $.post(api.category.create,data.field,function (res) {
           console.log(res);
           if(res.code == 0){
               layer.msg(res.msg,{icon:1});
               table.reload(CLASS+'-table')
               layer.closeAll();
           }else{
               layer.msg(res.msg,{icon:2});
           }
       })
        return false;
    });
    function add_edit(data= null){
        var btn = data  == null ? '确认添加' : "确定修改"
        var title =data  == null ? '添加分类' : "编辑-"+data.name;
        layer.open({
            type: 1,
            id:CLASS+"-add-layer"
            ,title: title
            ,area: ['900px', '750px']
            ,shade: [0.8, '#393D49']
            ,anim: 1
            ,maxmin: true
            ,btnAlign:"c"
            ,content: $("#"+CLASS+"-add").html()
            ,btn: [btn, '取消']
            ,yes: function(index,layero){
                var submitID=CLASS+"-submit"
                 ,submit =layero.find("#"+submitID)
                 submit.click();
                // layer.close(index);
            }
            ,btn2: function(index){
                layer.close(index);
            } ,success: function(layero){
                layer.ready(function(){
                    form.render();
                    //封面上传
                    var uploadInst = upload.render({
                        elem: '#'+CLASS+'-cover-upload'
                        ,url: api.upload.image
                        ,exts: 'jpg|png|jpeg'
                        ,field:"image"
                        ,before: function(obj){
                            //预读本地文件示例，不支持ie8
                            obj.preview(function(index, file, result){
                                $('#'+CLASS+'-preview').attr('src', result); //图片链接（base64）
                            });
                        }
                        ,done: function(res){
                            //如果上传失败
                            if(res.code > 0){
                                return layer.msg('上传失败');
                            }
                            layer.msg('封面上传成功');
                            $('#'+CLASS+'-cover').val(res.data.url)
                            //上传成功
                        }
                        ,error: function(){
                            //演示失败状态，并实现重传demo-reload
                            var demoText = $('#'+CLASS+'-cover-text');
                            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs '+CLASS+'-cover-reload">重试</a>');
                            demoText.find('.'+CLASS+'-cover-reload').on('click', function(){
                                uploadInst.upload();
                            });
                        }
                    });

                    var uploadInst2 = upload.render({
                        elem: '#'+CLASS+'-cover-upload2'
                        ,url: api.upload.image
                        ,exts: 'jpg|png|jpeg'
                        ,field:"image"
                        ,before: function(obj){
                            //预读本地文件示例，不支持ie8
                            obj.preview(function(index, file, result){
                                $('#'+CLASS+'-preview2').attr('src', result); //图片链接（base64）
                            });
                        }
                        ,done: function(res){
                            //如果上传失败
                            if(res.code > 0){
                                return layer.msg('上传失败');
                            }
                            //上传成功
                            layer.msg('副封面上传成功');
                            $('#'+CLASS+'-cover2').val(res.data.url)
                        }
                        ,error: function(){
                            //演示失败状态，并实现重传demo-reload
                            var demoText = $('#'+CLASS+'-cover-text2');
                            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs '+CLASS+'-cover-reload2">重试</a>');
                            demoText.find('.'+CLASS+'-cover-reload2').on('click', function(){
                                uploadInst2.upload();
                            });
                        }
                    });
                });
            }
        });
    }

    // 监听删除操作
    $(".data-delete-btn").on("click", function () {
        var checkStatus = table.checkStatus('currentTableId')
            , data = checkStatus.data;
        layer.alert(JSON.stringify(data));
    });

    //监听表格复选框选择
    table.on('checkbox(currentTableFilter)', function (obj) {
        console.log(obj)
    });

    table.on('tool(currentTableFilter)', function (obj) {
        var data = obj.data;
        if (obj.event === 'edit') {
            layer.alert('编辑行：<br>' + JSON.stringify(data))
        } else if (obj.event === 'delete') {
            layer.confirm('真的删除行么', function (index) {
                obj.del();
                layer.close(index);
            });
        }
    });

});
