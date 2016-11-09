<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>客户列表</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="http://cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="http://cdn.datatables.net/responsive/1.0.7/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://cdn.bootcss.com/startbootstrap-sb-admin-2/3.3.7+1/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            客户列表
        </div>
        <!-- /.panel-heading -->
        {{assign var="userType" value=session('user.usrType')}}
        <div class="panel-body">
            {{if $userType == 1}}
            <a class="btn btn-primary btn-block" id="btnAddCustomer">添加客户</a>
            {{/if}}
            <br/>
            <table width="100%" class="table table-striped table-bordered table-hover" id="customerList">
                <thead>
                <tr>
                    <th>客户编号</th>
                    <th>客户姓名</th>
                    <th>性别</th>
                    <th>联系地址</th>
                    <th>联系电话</th>
                    {{if $userType == 1}}
                    <th>操作</th>
                    {{/if}}
                </tr>
                </thead>
                <tbody>
                {{nocache}}
                {{foreach $customerList as $v}}
                {{assign var="clientID" value=$v['c_id']}}
                <tr>
                    <td>{{$v['c_id']}}</td>
                    <td>{{$v['c_name']}}</td>
                    <td class="center">
                        {{if $v['gender'] eq 'male'}}
                        男
                        {{elseif $v['gender'] eq 'female'}}
                        女
                        {{/if}}
                    </td>
                    <td>{{$v['c_address']}}</td>
                    <td class="center">{{$v['phone']}}</td>
                    {{if $userType == 1}}
                    <td class="center">
                        <a class="btn btn-primary btn-xs" href='{{U("Admin/Iframe/CustomerInfo?ID=$clientID")}}'>编辑</a>
                        &nbsp;&nbsp;
                        <button class="btn btn-danger btn-xs btnClDelete" value="{{$v['c_id']}}">删除</button>
                    </td>
                    {{/if}}
                </tr>
                {{/foreach}}
                {{/nocache}}
                </tbody>
            </table>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->

    {{if $userType == 1}}
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="addCustomerWindow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel2">添加客户</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>客户姓名</label>
                        <input class="form-control" type="text" id="clName" name="clName" placeholder="输入客户姓名">
                    </div>
                    <div class="form-group">
                        <label>性别</label>
                        <select class="form-control" id="clGender" name="clGender">
                            <option value="male">男</option>
                            <option value="female">女</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>联系地址</label>
                        <input class="form-control" type="text" id="clAddr" name="clAddr" placeholder="输入联系地址">
                    </div>
                    <div class="form-group">
                        <label>联系电话</label>
                        <input class="form-control" type="text" id="clPhone" name="clPhone" placeholder="输入联系电话">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-success" id="btnToAddCustomer">确定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="alertDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <div class="modal-body">确定要删除该客户吗？</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmDelCl">确定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <div class="modal fade" id="alertHint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel1">提示</h4>
                </div>
                <div class="modal-body" id="alertHintContent"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" id="btnReload">确定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    {{/if}}
</div>
<!-- /.container -->

<!-- jQuery -->
<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="http://cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="http://cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="http://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>

<script>
    $(function () {
        $('#customerList').DataTable({
            responsive: true,
            sPaginationType : "full_numbers",
            oLanguage : {
                sLengthMenu: "每页显示 _MENU_ 条记录",
                sInfo: "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
                sInfoEmpty: "没有数据",
                sInfoFiltered: "(从 _MAX_ 条数据中检索)",
                sZeroRecords: "没有检索到数据",
                sSearch: "名称:",
                oPaginate: {
                    sFirst: "首页",
                    sPrevious: "前一页",
                    sNext: "后一页",
                    sLast: "尾页"
                }
            }
        });

        {{if $userType == 1}}

        var delClID = "";//待确认删除的客户的ID

        $("#btnAddCustomer").click(function () {
            $("#addCustomerWindow").modal({
                backdrop: false
            });
        });
        $("#btnToAddCustomer").click(function () {
            $("#addCustomerWindow").modal('hide');
            var clName = $("#clName").val();
            var clGender = $("#clGender").val();
            var clAddr = $("#clAddr").val();
            var clPhone = $("#clPhone").val();
            if (clName != "" && clGender!="" && clAddr!="" && clPhone!="") {
                $.ajax({
                    url: "{{U('Admin/Customer/add')}}",
                    type:'post',
                    data:{
                        clName:clName,
                        clGender:clGender,
                        clAddr:clAddr,
                        clPhone:clPhone
                    },
                    success: function (data) {
                        if (data == 'true') {
                            $("#alertHintContent").empty().append("添加成功！");
                            $("#alertHint").modal({
                                backdrop: false
                            });
                        } else if (data == 'false') {
                            $("#alertHintContent").empty().append("添加失败！");
                            $("#alertHint").modal({
                                backdrop: false
                            });
                        }
                    }
                })
            }
        });

        $(".btnClDelete").click(function () {
            delClID = $(this).attr('value');
            $("#alertDelete").modal({
                backdrop: false
            });
        });
        $("#btnConfirmDelCl").click(function () {
            $("#alertDelete").modal('hide');
            if (delClID != "") {
                $.ajax({
                    url: "{{U('Admin/Customer/delete')}}",
                    data:{C_ID:delClID},
                    type:'post',
                    success: function (data) {
                        if (data == 'true') {
                            $("#alertHintContent").empty().append("删除成功！");
                            $("#alertHint").modal({
                                backdrop: false
                            });
                        } else if (data == 'false') {
                            $("#alertHintContent").empty().append("删除失败！");
                            $("#alertHint").modal({
                                backdrop: false
                            });
                        }
                    }
                })
            }
        });
        $("#btnReload").click(function () {
            location.reload();
        });
        {{/if}}
    });
</script>
</body>

</html>
