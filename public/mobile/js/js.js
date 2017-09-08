function alert1(text)
{
    _html = alertHtmlOne(text);
    $("body").append(_html);
   $('#iosDialog2').css('opacity',1);
   $('#iosDialog2').css('display','block');

}
function clickBtnClose() {
    $("#dialogs").remove();
}


function alertHtmlOne(text)
{
    var _html = '<div id="dialogs"><div class="js_dialog" id="iosDialog2" style="opacity: 0; display: none;"><div class="weui-mask"></div><div class="weui-dialog"><div class="weui-dialog__bd">'+text+'</div><div class="weui-dialog__ft"><a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary" onclick="return clickBtnClose();">知道了</a></div></div></div></div>';
    return _html;
}

