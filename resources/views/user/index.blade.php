@extends('common.layout')

@section('content')
    <fieldset class="table-search-fieldset">
        <legend>搜索用户信息</legend>
        <div style="margin: 10px 10px 10px 10px">
            <form class="layui-form layui-form-pane" action="">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">任意搜索</label>
                        <div class="layui-input-inline">
                            <input type="text" name="keyword" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <button type="submit" class="layui-btn" lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>

    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加</button>
            <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除</button>
        </div>
    </script>

    <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

    <script type="text/html" id="currentTableBar">
        <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
    </script>
@stop

@section('js')
    <script>
        layui.use(['form', 'table'], function () {
            var $ = layui.jquery,
                form = layui.form,
                table = layui.table;

            table.render({
                elem: '#currentTableId',
                url: '{{route('getuser')}}',
                toolbar: '#toolbarDemo',
                initSort: {
                    field: 'username' //排序字段，对应 cols 设定的各字段名
                    ,type: 'asc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
                },
                cols: [[
                    // {type: "checkbox", width: 50},
                    {type: "numbers", width: 80, title: '序号', sort: true},
                    {field: 'username', title: '用户名', sort: true},
                    {field: 'name', title: '昵称', sort: true},
                    // {field: 'sex', width: 80, title: '性别', sort: true},
                    // {field: 'city', width: 80, title: '城市'},
                    // {field: 'sign', title: '签名', minWidth: 150},
                    // {field: 'experience', width: 80, title: '积分', sort: true},
                    // {field: 'score', width: 80, title: '评分', sort: true},
                    // {field: 'classify', width: 80, title: '职业'},
                    // {field: 'wealth', width: 135, title: '财富', sort: true},
                    {title: '操作', minWidth: 150, toolbar: '#currentTableBar', align: "center"}
                ]],
                limits: [10, 15, 20, 25, 50, 100],
                limit: 15,
                page: true,
                skin: 'line'
            });

            // 监听搜索操作
            form.on('submit(data-search-btn)', function (data) {
                //执行搜索重载
                table.reload('currentTableId', {
                    page: {
                        curr: 1
                    }
                    , where: data.field
                }, 'data');

                return false;
            });

            /**
             * toolbar监听事件
             */
            table.on('toolbar(currentTableFilter)', function (obj) {
                if (obj.event === 'add') {  // 监听添加操作
                    var index = layer.open({
                        title: '添加用户',
                        type: 2,
                        shade: 0.2,
                        maxmin: true,
                        shadeClose: true,
                        area: ['100%', '100%'],
                        content: '../page/table/add.html',
                    });
                    $(window).on("resize", function () {
                        layer.full(index);
                    });
                } else if (obj.event === 'delete') {  // 监听删除操作
                    var checkStatus = table.checkStatus('currentTableId')
                        , data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                }
            });

            //监听表格复选框选择
            table.on('checkbox(currentTableFilter)', function (obj) {
                console.log(obj)
            });

            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                if (obj.event === 'edit') {

                    var index = layer.open({
                        title: '编辑用户',
                        type: 2,
                        shade: 0.2,
                        maxmin: true,
                        shadeClose: true,
                        area: ['100%', '100%'],
                        content: '../page/table/edit.html',
                    });
                    $(window).on("resize", function () {
                        layer.full(index);
                    });
                    return false;
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        obj.del();
                        layer.close(index);
                    });
                }
            });

        });
    </script>
@stop
