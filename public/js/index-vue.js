new Vue({
    el : '#vueapp',
    data : {
        banner : [],
        notice : [],
        free : [],
        vip : [],
        links : [],
        imglink : "",
        email:"",
        passwd:""
    },
    created:function () {
        var _self = this;
        $.getJSON('/api/getHome',{'limit':12},function(data){
            _self.banner = data.data.banner;
            _self.notice = data.data.notice;
            _self.free = data.data.free;
            _self.vip = data.data.vip;
            _self.links = data.data.links;
            _self.imglink = data.data.imgLink;
        });
    },
    methods:{
        subTextString:function (data) {
            var regChines = new RegExp("[\\u4E00-\\u9FFF]+","g");
            var number = 12;
            if (regChines.test(data)) {
                number = 7
            }
            return data.substring(0,number);
        },
        createUser:function () {
            if (this.email == '') {
                this.alert1('郵箱不能為空！');
            }
            else if (this.passwd == '') {
                this.alert1('密碼不能為空');
            }
            else if (!this.emailCheck(this.email)) {
                this.alert1('請輸入合法的郵箱！');
            }else{
                token = $('meta[name="csrf-token"]').attr('content');
                apiType = $("#putBtnUser").data('mode');

                var _self = this;
                if (token == '') {
                    _self.alert1('页面已过时，请刷新后访问');
                }else {
                    if (apiType == 'reg') {
                        $.post("api/reg", { email: this.email, passwd: this.passwd,'_token':token,type:'pc' },function(data){
                            if (data.status == 'success') {
                                window.location.href = '/member/'
                            }else{
                                _self.alert1(data.message);
                            }
                        },'json');
                    }else{
                        $.post("api/login", { email: this.email, passwd: this.passwd,'_token':token,type:'pc' },function(data){
                            if (data.status == 'success') {
                                window.location.href = '/member/'
                            }else{
                                _self.alert1(data.message);
                            }
                        },'json');
                    }

                }

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