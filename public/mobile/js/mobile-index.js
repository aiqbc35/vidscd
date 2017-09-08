new Vue({
    el : '#vueapp',
    data:{
        imglink:"",
        banner:[],
        free:[],
        vip:[]
    },
    created:function () {
        var _self = this;
        $.getJSON('/api/getMobile',{'limit':4},function(data){
            _self.banner = data.data.banner;
            _self.free = data.data.free;
            _self.vip = data.data.vip;
            _self.imglink = data.data.imgLink;

            _html = _self.createBannerHtml(data.data.banner,data.data.imgLink);
            $("#picList").html(_html);
            _self.initBanner();

            _html = _self.createHtmlVideo(data.data.free,data.data.imgLink);
            $("#free").html(_html);

            _html = _self.createHtmlVideo(data.data.vip,data.data.imgLink);
            $("#vip").html(_html);

        });

    },
    methods:{
        initBanner:function () {
            photoSlide({
                wrap: document.getElementById('picBox'),
                loop: true,
                autoPlay: true,
                autoTime: 4000,
                pagination: true
            });
        },
        subTextString:function (data) {
            var regChines = new RegExp("[\\u4E00-\\u9FFF]+","g");
            var number = 12;
            if (regChines.test(data)) {
                number = 7
            }
            return data.substring(0,number);
        },
        createBannerHtml:function (data,img) {
            var _html = "";
            $.each(data,function(item,index){
                claa = '';
                if (item == 0) {
                    claa = 'reg';
                }
                _html += '<li class="'+ claa +'"><a href="/mobile/v?id='+  index.vid +'"><img src="' + img + index.img + '" /></a></li>';
            });
            return _html;
        },
        createHtmlVideo:function (data,img) {
            var start = '<div class="weui-flex margin-bottom-10">';
            var stop = '</div>';
            var rethtml = '';
            var _self = this;

            $.each(data,function(i,item)
            {
                i++;
                _html = '<div class="weui-flex__item index-list-left-right-padding"><div class="weui-form-preview index-list-box"><a href="/mobile/v?id='+item.vid+'"><div class="weui-form-preview__bd index-video-list"><img src="'+ img + item.img +'" alt="" class="index-list-img"><p class="box-title">'+  _self.subTextString(item.title)+'</p></div></a><div class="weui-form-preview__ft border-top-none line-height-28 font-size-3"><a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:"><i class="fa fa-cloud-upload margin-right-3" aria-hidden="true"></i>'+ item.addtime +'</a><a class="weui-form-preview__btn weui-form-preview__btn_default border-left-none" href="javascript:"><i class="fa fa-play-circle margin-right-3" aria-hidden="true"></i>'+ item.scan +'</a></div></div></div>';

                if (!(i%2)) {
                    rethtml += _html + stop;
                }else{
                    rethtml += start + _html;
                }

            });

            return rethtml;
        }
    }
});