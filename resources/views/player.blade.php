@extends('layouts.app4')

@section("title"){{str_replace('MaxPreps', $seo->site_name, $data['title'])}}@endsection
@section("script")
    <script>
        $(".cbss-video-player").remove();
        $(".article_embeded_image").addClass("img-fluid");
        $(".article_embeded_image").removeClass("article_embeded_image");
        $(function() {
        var o = $('img').attr('original');
        $('img').attr('src', o);
        });
        var images=null
        images = $('img[ondragstart="return false;"]').attr('src');
        if(images!=null){
            $("img[id='img-aa']").attr("src", images);
            $("meta[property='og:image']").attr("content", images);
            $("img[id='img-aa']").addClass("img-fluid");
        }
    </script>
@endsection
{{-- @section('iklan')
    <div class="outer-div">
        <a href="//look.opskln.com/offer?prod=21&ref=5184914" target="_blank">
            <div class="inner-div" >
                <div class="inner-div2" >
                    <div class="inner-div3">
                        <div class="bannerku" style="border: 1px white solid;background-color: black;text-align: center;">
                            <button onclick="link()" target="_black" style="text-align: right">X Close</button>
                            <br>
                            <div class="h5">
                                YOU MUST CREATE A FREE ACCOUNT IN ORDER TO WATCH LIVE STREAM
                            </div>
                            <img class="bannerku" id="img-aa" src="{{url('aaa.png')}}" alt="benner">
                            <div  style=";position: absolute;bottom: 0%;background-color: rgba(0, 0, 0, 0.5)" class="bannerku2" >
                                
                                <br>
                                JOIN THE NETWORK OF SATISFIED MEMBERS AND TRY THIS SERVICE FOR FREE. FILL OUT THE SIGNUP FORM AND START STREAMING INSTANTLY.
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a> 
    </div>
<script>
    function link(){
        window.open('{{url($data->first()->url)}}')
    }
    var clik=0;
    $(document).ready(function () {
        $('.outer-div').css("position", "fixed");
        $('.outer-div a').click(function (e) { 
                console.log(1);
                clik++;
            if(clik==2){
                $('.outer-div').hide();
            }
            timer();
        });
    });
    $('.outer-div').hide();
    function timer(){
                    console.log(2);
        setTimeout(function(){ 
            clik=0;
            $('.outer-div').show();
        }, 30000);
    }
    setTimeout(function(){ 
            clik=0;
            $('.outer-div').show();
        }, 5000);
</script>
@endsection --}}

@section("style")
    <style>
        .outer-div {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 100%;
            z-index: 13;
        }

        .inner-div {
            margin: 0 auto;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
        }
        .inner-div2 {
            padding-top: 10%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 60%;
        }

        a{
            color: white;
        }
        a:hover{
            color: white;
            text-decoration: none;
            text-shadow: 2px 2px 4px white;

        }
        .h1{
            font-size: 2.5rem;
            font-weight: bolder;
        }
        .h2{
            font-size: 2.0rem;
            font-weight: bolder;
        }
        .h3{
            font-size: 1.5rem;
            font-weight: bolder;
        }
        .h4{
            font-size: 1.0rem;
            font-weight: bolder;
        }
        .h5{
            font-size: 1.3rem;
            font-weight: bolder;
        }
        .bannerku{
            width: 700px;
            height: auto;
        }
        .bannerku2{
            width: 700px;
            height: auto;
        }
        @media only screen and (max-width: 600px) {
            .inner-div2 {
            padding-top: 50%;
        }
            .bannerku{
                width: 250px;
                height: auto;
            }
            .bannerku2{
                display: none;
            }
            .inner-div22 {
                padding-top: 10%;
                padding: 41px;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            .h1{
            font-size: 1.5rem;
            font-weight: bolder;
        }
        .h2{
            font-size: 1.3rem;
            font-weight: bolder;
        }
        .h3{
            font-size: 1.1rem;
            font-weight: bolder;
        }
        .h4{
            font-size: 0.8rem;
            font-weight: bolder;
        }
        .h5{
            font-size: 0.8rem;
            font-weight: bolder;
        }
        }
        .school-names > a {
            position: relative;
            display: inline-block;
            width: 50%;
            padding: 0 10px;
            box-sizing: border-box;
            font-size: 20px;
            line-height: 36px;
            color: #fff;
            text-align: center;
            white-space: nowrap;
        }
        .contest-content, .contest-content p {
            font-family: 'Siro', Helvetica, Arial, sans-serif;
            font-size: 1.33333rem;
        }
        .team-details {
            width: 50%;
            padding: 66px 10px 0;
            display: inline-block;
            vertical-align: top;
            text-align: center;
            box-sizing: border-box;
        }
        .team-details .mascot-image {
            position: absolute;
            /* right: 10px; */
            width: 60px;
            height: 60px;
            font-size: 60px;
            line-height: 50px;
            margin-left: -45px;
            margin-top: -60px;
        }
        .mascot-image {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            box-sizing: border-box;
            border-radius: 100px;
            border-width: 3px;
            border-style: solid;
            border-color: white;
        }
      
        .school-names{
            background: darkorange;
        }
        video {
        width: 100%;
        height: auto;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div style="border: white solid 2px; padding-bottom: 20px;">
                {!! $data['containt']!!}
            </div>

        </div>
        <div class="col-md-8" style="padding: 30px">
            <div class="bold">
                {!!$data['contestdescription']!!}
            </div>
            <div class="bold">
                @isset($data['contesttournament'])
                    
                {!!$data['contesttournament']!!}
                @endisset
            </div>
        </div>
        <div class="col-md-12">

            <a href="{{@$seo->iklan}}" >
                        <video poster="{{url('live2.png')}}" id="player" style="border: 2px solid white; padding: 1px" playsinline controls>
                            <source src="" type="video/mp4">
                            <source src="" type="video/webm">
                        
                            <! — Captions are optional →
                        </video>
                        <video src="{{url('live2.png')}}" width="640px" height="380px" autoplay/>
                  
            </a>
        </div>
        
            <div class="col-md-12">
                @foreach ($data['table'] as $item)   
                <div class="table-responsive">
                    <table class="table table-striped table-dark" style="text-align: center">
                        {!!$item!!}
                    </table>
                </div> 
                @endforeach
            </div>
    </div>
</div>
@endsection
