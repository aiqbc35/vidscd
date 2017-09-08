new Vue({
    el : '#vueapp',
    data:{
        username:"",
        isvip:false,
        vipdate:"",
        logindate:""
    },
    created:function () {
        var _self = this;

        $.getJSON('/api/getUserInfo',function (data) {
            if (data.status == 'success') {
                _self.username = data.data.username;
                _self.isvip = data.data.vip;
                _self.vipdate = data.data.viptime;
                _self.logindate = data.data.logintime;
            }else{
                window.location.href = '/';
            }
        });
    }
});