new Vue({
    el : "#vueapp",
    data:{
        email:"",
        passwd:""
    },
    created:function(){

    },
    methods:{
        loginUser:function () {
            var _self=this;
            token = $('meta[name="csrf-token"]').attr('content');
            if (token == '') {
                alert1('页面已失效，请刷新后尝试');
            }
            else if(_self.email == ''){
                alert1('邮箱不能为空');
            }
            else if (_self.emailCheck(_self.email) == false){
                alert1('请输入合法的邮件地址');
            }
            else if(_self.passwd == ''){
                alert1('密码不能为空');
            }
            else{
                $.post("/api/login", { email: _self.email, passwd: _self.passwd,'_token':token,'type':'mobile' },function(data){
                    if (data.status == 'success') {
                        window.location.href = '/mobile/member';
                    }else{
                        alert1(data.message);
                    }
                },'json');
            }
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