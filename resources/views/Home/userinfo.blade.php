@extends('Common.member')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <ul class="list-group " style="margin-top: 10%">
            <li class="list-group-item clearfix">
                <span class="pull-left">郵箱：@{{ username }}</span>
                <button type="button" class="btn btn-warning pull-right btn-sm" data-toggle="modal" data-target="#myModal">修改</button>
            </li>
            <li class="list-group-item clearfix">
                <span class="pull-left">密碼：******</span>
                <button type="button" class="btn btn-warning pull-right btn-sm" data-toggle="modal" data-target="#myModalPasswd">修改</button></li>
            <li class="list-group-item text-warning">
                注意：請使用您正確的郵箱，我們的最新網址以及密碼修改都將通過郵箱進行！
            </li>
        </ul>
    </div>
@stop
@section('model')
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改郵箱</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" v-model="email" id="inputEmail3" placeholder="Email">
                                <p class="help-block">请输入您最新的邮箱账号</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" v-model="passwd" id="inputPassword3" placeholder="Password">
                                <p class="help-block">请输入您账户的密码</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click="upEmail">确认</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalPasswd" tabindex="-1" role="dialog" aria-labelledby="myModalLabelPwd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabelPwd">修改密码</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">最新密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" v-model="newpwd" id="inputEmail2" placeholder="请输入您最新的密码">
                                <p class="help-block">请输入您最新的密码</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">旧密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" v-model="passwd" id="inputPassword2" placeholder="请输入您原来的密码">
                                <p class="help-block">请输入您原来的密码</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click="upPawd" >确认</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
<script>
    new Vue({
        el : '#vueapp',
        data:{
            username:"",
            passwd:"",
            email:"",
            newpwd:"",
            token:""
        },
        created:function () {
            var _self = this;

            $.getJSON('/api/getUserInfo',function (data) {
                if (data.status == 'success') {
                    _self.username = data.data.username;
                }else{
                    window.location.href = '/';
                }
            });
            _self.token = $('meta[name="csrf-token"]').attr('content');

        },
        methods:{
            upEmail:function () {
                if (this.email == '') {
                    this.alert1('邮箱不能为空');
                }
                else if (this.emailCheck(this.email) == false) {
                    this.alert1('请输入正确的邮箱');
                }
                else if (this.passwd == '') {
                    this.alert1('密码不能为空');
                }
                else{
                    var _self = this;
                    $.post("/api/getUpEmail", { email: _self.email, passwd: _self.passwd,'_token':_self.token },function(data){
                              _self.alert1(data.message);
                              _self.passwd = "";
                              if (data.status == 'success') {
                                  _self.username = _self.email;
                                  _self.email = "";
                                  $("#myModal").modal('hide');
                              }

                     },'json');
                }
            },
            upPawd:function () {
                var _self = this;
                if (_self.newpwd == '') {
                    _self.alert1('新密码不能为空');
                }
                else if (_self.passwd == ''){
                    _self.alert1('请输入密码确认');
                }
                else{
                    $.post("/api/getUpPwd", { newpwd: _self.newpwd, passwd: _self.passwd,'_token':_self.token },function(data){
                            _self.alert1(data.message);
                            _self.passwd = "";
                            if (data.status == 'success') {
                                $("#myModalPasswd").modal('hide');
                                _self.newpwd = "";
                            }
                     },'json');
                }
            },
            alert1:function (text) {
                layer.alert(text, {
                    skin: 'layui-layer-lan'
                    ,closeBtn: 0
                    ,anim: 0 //动画类型
                });
            },
            emailCheck :function(email){
                var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
                if (!myreg.test(email)) {
                    return false;
                }else{
                    return true;
                }
            }
        }
    });
</script>
@stop