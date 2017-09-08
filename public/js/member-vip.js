new Vue({
    el : "#vueapp",
    data : {
        codetype : 0,
        code : ""
    },
    methods:{
        shopCode:function () {
            var shopurl18 = 'http://yunfaka.com/product/873C4AE51DDCB4B6';
            var shopurl28 = 'http://yunfaka.com/product/3AD16CFC5F994EE4';
            var shopurl58 = 'http://yunfaka.com/product/BC0D975FA63E5ED1';
            var shopurl78 = 'http://yunfaka.com/product/4C3905FD3614ABD3';
            var redche = '';
            switch (this.codetype){
                case '18':
                    redche = shopurl18;
                    break;
                case '28':
                    redche = shopurl28;
                    break;
                case '58':
                    redche = shopurl58;
                    break;
                case '70':
                    redche = shopurl78;
                    break;
            }
            window.open(redche);
        },
        actionCode:function () {
            token = $('meta[name="csrf-token"]').attr('content');
            var _self = this;
            if (this.code == '') {
                this.alert1('激活码不能为空');
            }else {
                $.post("/api/getActionCode", { code: _self.code, '_token': token },function(data){
                    if (data.status == 'success') {
                        _self.alert2(data.message);
                    }else{
                        _self.alert1(data.message);
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
        alert2:function(text) {
            layer.alert(text, {
                skin: 'layui-layer-lan' //样式类名
                ,closeBtn: 0
            }, function(){
                window.location.href = '/member/';
            });
        }
    }
});