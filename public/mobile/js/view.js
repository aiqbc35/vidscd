$(function () {
    id = getRequest();

    if (id > 0) {

        $.getJSON('/api/getvideo',{id:id},function (data) {

            if (data.status == 'success') {
                _html = createHtmlVideo(data.randvideo, data.imglink);
                $("#vip").html(_html);
            }
            else if (data.code == 101){
                alert1(data.message);
                window.location.href = '/mobile/login';
            }
            else if (data.code == 102){
                alert1(data.message);
                window.location.href = '/mobile/member/upvip';
            }else{
                alert1(data.message);
            }

        })

    }else{
        alert1('请选择视频');
        window.location.href = '/mobile/index';
    }
})

function createHtmlVideo(data, img) {
    var start = '<div class="weui-flex margin-bottom-10">';
    var stop = '</div>';
    var rethtml = '';
    var _self = this;

    $.each(data, function (i, item) {
        i++;
        _html = '<div class="weui-flex__item index-list-left-right-padding"><div class="weui-form-preview index-list-box"><a href="/mobile/v?id=' + item.vid + '"><div class="weui-form-preview__bd index-video-list"><img src="' + img + item.img + '" alt="" class="index-list-img"><p class="box-title">' + subTextString(item.title) + '</p></div></a><div class="weui-form-preview__ft border-top-none line-height-28 font-size-3"><a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:"><i class="fa fa-cloud-upload margin-right-3" aria-hidden="true"></i>' + item.addtime + '</a><a class="weui-form-preview__btn weui-form-preview__btn_default border-left-none" href="javascript:"><i class="fa fa-play-circle margin-right-3" aria-hidden="true"></i>' + item.scan + '</a></div></div></div>';

        if (!(i % 2)) {
            rethtml += _html + stop;
        } else {
            rethtml += start + _html;
        }

    });

    return rethtml;
}

function subTextString(data) {
    var regChines = new RegExp("[\\u4E00-\\u9FFF]+", "g");
    var number = 12;
    if (regChines.test(data)) {
        number = 7
    }
    return data.substring(0, number);
}

function getRequest() {
    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
        }
    }

    return theRequest.id;
}