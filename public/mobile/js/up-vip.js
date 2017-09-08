new Vue({
    el : "#vueapp",
    data:{
        code:"",
        codetype:""
    },
    methods:{
        upvip:function () {
            token = $('meta[name="csrf-token"]').attr('content');
            var _self = this;
            if (this.code == '') {
                alert1('激活码不能为空');
            }else {
                $.post("/api/getActionCode", { code: _self.code, '_token': token },function(data){
                    alert1(data.message);
                    if (data.status == 'success') {
                        window.location.href = '/mobile/index'
                    }

                },'json');
            }
        },
        shopcode:function () {
            if (this.codetype == '') {
                alert1('请选择激活码类型');
            }else{

                window.location.href = this.codetype;
            }
        }
    }
});