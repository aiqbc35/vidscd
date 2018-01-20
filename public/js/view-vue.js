new Vue({
    el : '#vueapp',
    data:{
        email:"",
        passwd:"",
        list:[],
        imglink:"",
        title:""
    },
    created:function () {
        var _self = this;
        var id = _self.GetRequest();

        if (id == '') {
            _self.alert2('请选择视频');
        }
        else{
            $.getJSON('/api/getvideo',{id:id},function (data) {
                if (data.status == 'success') {
                    _self.imglink = data.imglink;
                    _self.list = data.randvideo;
                    _self.title = data.video.title;
                }else{
                    if (data.code == 404) {
                        _self.alert2(data.message);
                    }
                    else if(data.code == 101){
                        _self.alert1(data.message);
                        signInShow();
                    } else if (data.code == 102){
                        _self.alert3(data.message);
                    }
                    else{
                        _self.alert1(data.message);
                    }
                }
            })
        }
    },
    methods:{
        GetRequest:function() {
            var url = location.search; //获取url中"?"符后的字串
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1);
                strs = str.split("&");
                for(var i = 0; i < strs.length; i ++) {
                    theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
                }
            }

            return theRequest.id;
        },
        subTextString:function (data) {
            var regChines = new RegExp("[\\u4E00-\\u9FFF]+","g");
            var number = 12;
            if (regChines.test(data)) {
                number = 7
            }
            return data.substring(0,number);
        },
        reloadline:function (data) {
            var _self = this;
            $.getJSON('/api/getvideoLink',{line:data},function (e) {
                if (e.status == 'error') {
                    _self.alert1(e.msg);
                }else{
                    window.location.reload();
                }
            })
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
                        $.post("/api/reg", { email: this.email, passwd: this.passwd,'_token':token,type:'pc' },function(data){
                            if (data.status == 'success') {
                                window.location.href = '/member/'
                            }else{
                                _self.alert1(data.message);
                            }
                        },'json');
                    }else{
                        $.post("/api/login", { email: this.email, passwd: this.passwd,'_token':token,type:'pc' },function(data){
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
        alert2:function(text) {
            layer.alert(text, {
                skin: 'layui-layer-lan' //样式类名
                ,closeBtn: 0
            }, function(){
                window.location.href = '/';
            });
        },
        alert3:function(text) {
            layer.alert(text, {
                skin: 'layui-layer-lan' //样式类名
                ,closeBtn: 0
            }, function(){
                window.location.href = '/member/vip';
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