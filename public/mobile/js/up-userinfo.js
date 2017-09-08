new Vue({
    el:"#vueapp",
    data:{
        email:"",
        passwd:"",
        newpwd:"",
    },
    created:function(){
        var _self = this;
        $.getJSON('/api/getUserInfo',function (data) {
            if (data.status == 'success') {
                _self.email = data.data.username;
            }else{
                window.location.href = "/mobile/index";
            }
        })
    },
    methods:{
        putUpdate:function () {
            var _self = this;
            token = $('meta[name="csrf-token"]').attr('content');

            if (_self.email == '') {
                alert1('邮箱不能为空');
            }
            else if (_self.passwd == ''){
                alert1('密码不能为空');
            }
            else{

                $.post("/api/getUpUserinfo", { email: _self.email, passwd: _self.passwd,newpwd:_self.newpwd,'_token':token },function(data){
                    alert1(data.message);
                    if (data.status == 'success') {
                        window.location.reload();
                    }
                });
            }
        }
    }
});