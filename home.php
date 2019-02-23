<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
        <div id="ana-div" style="width:640px;height:264px;">

            <video id="my-video" data-setup='{ "aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }'    class="video-js" controls preload="auto" style="width:100%;height:100%;" poster="MY_VIDEO_POSTER.jpg" data-setup="{}">
                <source id="video" src="MY_VIDEO.mp4" type='video/mp4'>
                <source src="MY_VIDEO.webm" type='video/webm'>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
                <button type="button" class="vjs-fullscreen-control vjs-control vjs-button" >
                    <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                    <span class="vjs-control-text" aria-live="polite">Fullscreen</span>
                </button>
            </video>
        </div>
        <style>
            #reklami{
                opacity:1;
                border:1px solid white;
                width:140px;
                height: 40px;
                line-height: 40px;
                text-align: center;
                color:white;
                background-color:black;
                display: block;
                position: absolute;
                right:5px;
                bottom:33px;
                cursor:pointer;

            }
            #reklami:hover{
                opacity: 0.5;
            }

            #banner-reklam{
                opacity:1;
                border:1px solid white;
                margin-left: 5px;
                width:600px;
                height:50px;
                line-height: 40px;
                text-align: center;
                color:white;
                background-color:red;
                display: block;
                position: absolute;
                right:20px;
                bottom:33px;
                cursor:pointer;
            }
            #banner-reklam:hover{
                opacity: 1;
            }#resim{
                height: 100%;
                width: 100%;
                         }
            #closeicon{
                height: 15px;
                width: 15px;
                margin-left: 93%;
                margin-top: 182px;
                position: absolute;
            }
        </style>
<script>
    $(document).ready(function () {
        var banner_reklam_adresi="https://www.google.com";
        var reklamadi="c.mp4";//reklam vieosunun klasördeki ismi- uzantısıyla beraber-
        var banner_adi="banner%20reklam.jpg";//reklam video değilde banner olacaksa, bannerın klasördeki adı -uzantı-
        var videoadi=$('#video').attr('src');
        var sayac=0;
        var kac_saniyede_bir=10;//kaç saniye aralık ile veri tabanına izlenme süresinin ekleneceği
        var degisken1;//zamanlama
        var ilkmi=0;
        var sayi=0;
        var reklam_var_mi=true;
        var reklam_baslama_suresi=1;//reklamın videodan kaç saniye sonra başlayacağı-reklamı geç dedikten sonra en baştan başladığı için tekrar bakılacak
        var reklam_gecme_suresi=2;//reklamı geç tuşunun, reklam başladıktan kaç saniye sonra görüneceği
        var reklam_video_mu=true;
        var reklam_opacity=1.0;
        function reklami_kapat(){//function ilk başta aktif değil , içerideki kodlar hazırda beklemiyor ama "reklamı geç" butonunu gösterdikten sonra bu fonksiyonu birkere çalıştırdık ve bu sayede içerideki kodlar sürekli hazırda bekleyecek
            $("#reklami").click(function () {
                document.getElementById('reklami').style.display = 'none';
                $('.vjs-tech').attr('src', videoadi);
                $("source").attr('src', videoadi);
                var sinif=($("#my-video").attr("class"));
                var dizi=sinif.split(' ');
                if (!dizi.includes("vjs-has-started")){
                    $(".vjs-big-play-button").mouseup
                }else{
                    $(".vjs-big-play-button").click();
                    $(".vjs-control-bar").show();
                    sure_arttir()
                }
            });
        }
        function sure_arttir() {
            var dizi=verileri_getir();
            if(dizi.includes("vjs-ended")){//video sona geldiğinde
                clearInterval(degisken1);//zamanlayıcıyı durdur
                degisken1=null;//zamanlayıcıyı null yap
            }
            sayac++;
            if(reklam_var_mi) {
                if (sayac == reklam_baslama_suresi && ilkmi == 0) {
                    if(reklam_video_mu) {
                        ilkmi++;
                        gizle();
                    }else{
                        var y = '<div id="banner-reklam"></div>';
                        var z='<a target="_blank" href="' + banner_reklam_adresi + '"><img  id="resim" src="'+banner_adi+'"></a>';
                        var w='<a><img id="closeicon" src="close_icon.png"></a>';
                        $('#my-video').append(y);
                        $('#banner-reklam').append(z);
                        $('#my-video').append(w);
                        $("#banner-reklam").css("display", "block");
                        reklam_gizle();
                        ilkmi++;
                    }
                }
                $(document).ready(function () {
                    $("#banner-reklam").click( function () {
                        $("#banner-reklam").hide();
                    })
                    $("#closeicon").click( function () {
                        $("#banner-reklam").hide();
                    })
                    var sinif=($("#my-video").attr("class"));
                    var dizi=sinif.split(' ');
                    var e=($("#my-video_html5_api").attr("src"));
                    if (dizi.includes("vjs-ended")){
                        document.getElementById('reklami').style.display = 'none';
                        $(".vjs-big-play-button").click();
                        if(e==reklamadi){
                            $('.vjs-tech').attr('src', videoadi);
                            $("source").attr('src', videoadi);//fazlalık var
                            $(".vjs-control-bar").show();
                            $(".vjs-big-play-button").click();
                            video_baslat_durdur(1);
                        }else{
                            $("#my-video_html5_api").click();
                            $("#my-video_html5_api").click();
                        }
                    }
                });
                $(document).ready(function(){
                    $("#banner-reklam").mouseenter(function(){
                        $("#banner-reklam").css("opacity", 1.0);
                    });
                    $("#banner-reklam").mouseleave(function(){
                        reklam_gizle();
                        reklam_opacity=1;
                    });
                });
                if (sayac == reklam_baslama_suresi+reklam_gecme_suresi && ilkmi == 1) {
                    if(reklam_video_mu) {
                        var x = '<div id="reklami"><p>Reklamları Geç</p></div>'
                        $('#my-video').append(x);
                        $("#reklami").css("display", "block");
                        reklami_kapat();
                    }
                }
            }
            function reklam_gizle() {
                    if(reklam_opacity>0.4) {
                        reklam_opacity = (reklam_opacity) - 0.2;
                        $('#banner-reklam').css("opacity", reklam_opacity);
                    }
            }
            console.log(sayac);//saniyede bir sayıyor
            if(sayac>3){
                reklam_gizle();
            }
            if(sayac%kac_saniyede_bir==0 || dizi.includes("vjs-ended")){//her istenilen zamanda bir ya da sona geldiğinde
                //VERİ TABANI İŞLEMLERİ
                console.log("veritabanına eklendi");
                //ajax kodları
            }
        }
        function video_baslat_durdur(durum){
            if (durum) {
                if(!degisken1){//değişkenin değeri null değilse
                    degisken1= setInterval(sure_arttir, 1000);
                }
            }else{
                clearInterval(degisken1);
                degisken1=null;
            }
        }
        var dizi=verileri_getir();
        if(sayi==0){
            sayi++;
            $(".vjs-big-play-button").click();
            video_baslat_durdur(1);
        }
        $(".vjs-play-control").mouseup(function(event) {//play butonu fare tıklama
            if(event.which!=1)return false;
            var dizi=verileri_getir();
            video_baslat_durdur(dizi.includes("vjs-paused"));
        });
        $(".vjs-play-control").keyup(function(event) {//play butonu boşluk tuşlama
            if(event.keyCode==32){
                var dizi=verileri_getir();
                video_baslat_durdur(dizi.includes("vjs-paused"));
            }
        });
        $(".vjs-big-play-button").mouseup(function(event) {//başlangıç büyük play butonu
            if(event.which!=1)return false;
            var dizi=verileri_getir();
            video_baslat_durdur(dizi.includes("vjs-paused"));
        });
            $(".vjs-poster").mouseup(function(event) {//ana sayfa ortaya tıklama
            if(event.which!=1)return false;
            if($(".vjs-poster").prop("tagName").toLowerCase()=="div"){
                var dizi=verileri_getir();
                video_baslat_durdur(dizi.includes("vjs-paused"));
            }
        });
        $(".vjs-tech").mouseup(function(event) {//video başladıktan sonra ortaya tıklama
            if(event.which!=1)return false;
            var dizi=verileri_getir();
            video_baslat_durdur(!dizi.includes("vjs-paused"));
        });
        function verileri_getir(){
            var sinif=($("#my-video").attr("class"));
            var dizi=sinif.split(" ");
            return dizi;
        }
        function gizle() {
            $('.vjs-tech').attr('src', reklamadi);
            $("source").attr('src', reklamadi);
            gizle2();
        }
        function gizle2() {
            var sinif=($("#my-video").attr("class"));
            var dizi=sinif.split(' ');
            if (!dizi.includes("vjs-has-started")){
                $(".vjs-big-play-button").mouseup
            }else{
                var e=($("#my-video_html5_api").attr("src"));
                if(e==reklamadi){
                    $(".vjs-control-bar").hide();
                }
                $(".vjs-big-play-button").click();
                sayac--;
                sure_arttir();
            }
        }
    });
</script>
<script src="https://vjs.zencdn.net/7.1.0/video.js"></script>
</body>
</html>