new Vue({
    el : '#vueapp',
    data : {
        list:[],
        imglink : "",
        email:"",
        passwd:"",
        limit:0,
        total:0,
        page:0,
        pagetotal:0
    },
    created:function () {
        var _self = this;
        this.getRequest();
        $.getJSON('/api/getVideoList',{'limit':this.limit,'type':1},function(data){
            if (data.status == 'success') {
                _self.list = data.data.list;
                _self.imglink = data.data.imgLink;
                _self.limit = parseInt(data.data.limit);
                _self.page = parseInt(data.data.page);
                _self.total = parseInt(data.data.total);

                pageTotal = Math.ceil(_self.total / _self.page);
                _self.pagetotal =  pageTotal - 1;

            }else{
                this.alert1(data.message);
            }
        });
    },
    computed:{
        nextpage:function () {
            var _html = '';
            if (this.limit == this.pagetotal) {
                _html = 'javascript:;';
            }else{
                _html = "/list/vip?limit=" + (this.limit + 1);
            }
            return _html;
        },
        uppage:function () {

            var _href = '';

            if (this.limit == 0) {
                _href = 'javascript:;';
            }else{
                _href = "/list/vip?limit=" + (this.limit - 1);
            }
            return _href;
        }
    },
    methods:{
        getRequest : function(){

            var _self = this;
            var url = location.search; //获取url中"?"符后的字串
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1);
                strs = str.split("&");
                for(var i = 0; i < strs.length; i ++) {
                    theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
                }
            }
            pagelimit = theRequest.limit ? theRequest.limit : 0;
            _self.limit = parseInt(pagelimit);
            return theRequest.limit;
        },

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
            }
            else{
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