@extends('layouts.home-page-app')

@section("title"){{@str_replace('MaxPreps',$seo->site_name,@$data->first()->kategori)}}@endsection
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
@section('iklan')
    <div class="outer-div">
        <a href="{{@$seo->iklan}}" target="_blank">
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
        window.open('{{url($sitemap->first()->loc)}}')
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
@endsection

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
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="h1">{{str_replace("MaxPreps",@$seo->site_name,@$data->first()->kategori)}}</h1>
            <hr class="bg-white">
        </div>
        @foreach ($data as $key=> $item)
        @if ($item->type=="Articles")
            <div class="col-md-9">

                @foreach (json_decode($item->containt) as $key => $item2)
                <div style="text-align: justify">
                    <h2 class="h2">
                        {{$item2->title}}
                    </h2>
                    <h3 class="h3">
                         {{$item2->title2}}
                    </h3 >
                    <div class="alert alert-sm alert-light text-bold">
                        {{$item2->date}}
                    </div>
                    <div class="articel">
                        @php
                            $item2->body=str_replace("/news/article.aspx","",@$item2->body);
                        @endphp 
                        {!!str_replace("https://www.maxpreps.com/",url()->current(),@$item2->body)!!}
                    </div>
                </div>
                @endforeach
            </div>
        @endif
        @if ($item->type=="related-links")
            <div class="col-md-3">

                <ul class="list-group" style="text-align: justify">
                    @foreach (json_decode($item->containt) as $key => $item2)
                        <li class="list-group-item text-dark border border-white border-top-0 border-left-0 border-right-0">
                            <a href="{{url($item2->url)}}">{{$item2->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($item->type=="List Articles")
            <div class="col-md-3">
                <ul class="list-group" style="text-align: justify">
                    <?php
                   
                        try {
                   ?>
                    @foreach (@json_decode($item->containt) as $key => $item2)
                    <li class="list-group-item text-dark border border-white border-top-0 border-left-0 border-right-0">
                        <a href="{{url($item2->url)}}">{{$item2->title}}</a>
                    </li>
                    @endforeach
                    <?php
                    
                     } catch (\Throwable $th) {
                        
                    }
                    ?>
                    
                </ul>
            </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
