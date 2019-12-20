
<script src="{{ asset("js/app.js") }}" charset="utf-8"></script>
<script src="{{ asset("lib/layui-v2.5.4/layui.js?v=1.0.4") }}" charset="utf-8"></script>
<script src="{{ asset("js/lay-config.js?v=1.0.4") }}" charset="utf-8"></script>
<script>
    layui.use(['element', 'layer', 'layuimini'], function () {
        var $ = layui.jquery,
            element = layui.element,
            layer = layui.layer;

        layuimini.init('{{ url("/api/init") }}');

        $('.login-out').on("click", function () {
            layer.msg('退出登录成功', function () {
                window.location = '/page/login-1.html';
            });
        });
    });
</script>
