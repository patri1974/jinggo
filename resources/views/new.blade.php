@extends('layouts.app2')

@section("title")
News High School Sport Today - {{$seo->site_name}}
@endsection
@section("script")
    <script>
        $(".cbss-video-player").remove();
        $(".article_embeded_image").addClass("img-fluid");
        $(".article_embeded_image").removeClass("article_embeded_image");
        $(function() {
        var o = $('img').attr('original');
        $('img').attr('src', o);
        });
    </script>
    
@endsection
{{-- @section('iklan')
    <div class="outer-div">
        <a href="{{@seo->iklan}}" target="_blank">
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
        .page-link{
            padding: 7px;
        }
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center list-group" style="text-align: justify">
        <div class="col-md-12">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="search" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-md-12">
            <h1 class="h1">
                @if (@isset($_GET['search'])) {{($_GET['search'])}} - @elseif(@isset($search)) {{($search)}}@endif News High School Sport Today - {{$seo->site_name}}</h1>
            <hr class="bg-white">
        </div>
        @php
                    $aaa=0;
                @endphp
        @foreach ($data as $key=> $item)
            <div class="col-md-12 list-group-item text-dark border border-white border-top-0 border-left-0 border-right-0">
                <a href="{{url($item->url)}}">{{str_replace("MaxPreps",@$seo->site_name,@$item->kategori)}}</a>
                
                
                @foreach (json_decode($item->containt) as $key => $item2)
                    <script>
                        $(document).ready(function () {
                            $(".cbss-video-player").remove();
                            $(".article_embeded_image").addClass("img-fluid");
                            $(".article_embeded_image").removeClass("article_embeded_image");
                            $(function() {
                            var o = $('img').attr('original');
                            $('img').attr('src', o);
                            });
                            var images=null
                            images = $("img[id='img{{$aaa}}']").attr('src');
                            console.log(images);
                            if(images!=null){
                                $("img[id='aaaa{{$aaa}}']").attr("src", images);
                            }
                        });
                       
                        
                    </script>
                    
                    <div class="row">
                        <div class="col-4">
                            <img class="img-fluid" src="{{url('live.png')}}" id="aaaa{{$aaa}}" alt="{{$item2->title}}">
                        </div>
                        <div class="col-8">
                            <div style="text-align: justify;max-height: 200px;overflow: hidden;">
                                @php
                                    $item2->body=str_replace("/news/article.aspx","",@$item2->body);
                                    $item2->body=str_replace('oncontextmenu="showProtectedImageMessage(); return false;"','id="img'.$aaa++.'"',@$item2->body);

                                @endphp 
                                    {!!str_replace("https://www.maxpreps.com/",url()->current(),@$item2->body)!!}
                              
                            </div>
                            <div class="text-right">
                                <a class="btn btn-sm btn-info" href="{{url($item->name)}}"> More ...</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        @endforeach
        <br>
        <div class="row ">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {!! $data->links() !!}
                </div>
            </div>

        </div>
        
    </div>
</div>
@endsection
