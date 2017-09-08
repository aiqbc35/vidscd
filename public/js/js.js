$("div").ajaxStart(function(){
    layer.msg('加载中', {
        icon: 16
        ,shade: 0.01
    });
});
$("div").ajaxStop(function(){
    layer.closeAll('loading');
});
$("#signup").click(function(event){
    signUpShow();
});
$("#signin").click(function(event){
    signInShow();
});

function signUpShow()
{
    $(".modal-title").text('註冊');
    $(".help-block").show();
    $("#putBtnUser").data('mode','reg');
    $("#myModal").modal('show');
}
function signInShow()
{
    $(".modal-title").text('登陸');
    $(".help-block").hide();
    $("#putBtnUser").data('mode','login');
    $("#myModal").modal('show');
}
function GetRequest() {
    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }

    return theRequest;
}
