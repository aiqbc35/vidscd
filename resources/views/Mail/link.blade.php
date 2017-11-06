
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">.email{border:1px #7b71cb solid;border-radius:4px;font-family:"微软雅黑";}
    .email .content{width:445px;margin:60px auto;text-align:center;}
    .email .content h2{font-size:16px;color:#333;font-weight:100;margin-bottom:30px;text-align:left;}
    .email .content span{color:#0068b7;border-bottom:1px #0068b7 solid;margin:0 5px;}
    .email .content p{color:#333;font-size:14px;line-height:26px;margin-bottom:60px;text-align:left;text-indent: 2rem;}
    .email .content a{width:300px;height:40px;line-height:40px;text-align:center;background-color:#7b71cb;color:#fff;font-size:14px;display:inline-block;text-decoration:none;letter-spacing:2px;border-radius:4px;margin:0 auto;}
    .addres{font-size:16px;color:#333;font-weight:100;text-align: right;padding-right: 100px;margin-bottom:30px;}
    .note{margin-bottom:30px;font-size:16px;color:red;font-weight:100;text-align: center;}
</style>
<div class="email">
    <div class="content">
        <h2>尊敬的会员您好：</h2>
        <p>很抱歉的通知您，我们的域名因为不可抗拒的原因在某些地区无法访问，为此我们启用了最新的域名：{{ $link }},欢迎您的再次访问。</p>
        <a href="{{ $link }}">点击前往</a></div>
    <div class="addres">
        <p>Godsky在线视频敬上</p>
        <p>{{ $date }}</p>
    </div>
    <div class="note">
        <p>备注：请勿回复本邮件，如需联系本站，请发送邮件至：support@godsky.org</p>
    </div>
</div>';