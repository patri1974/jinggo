@extends('layouts.app3')

@section("title")
Schedule High School Sport Today - {{$seo->site_name}}
@endsection
@section("script")
    <script src="schadule.js"></script>
    
@endsection
@section('iklan')
    
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


#horz-list ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
  text-align: center;
}

#horz-list ul li {
  display: inline;
}

#horz-list ul li a {
  text-decoration: none;
  padding: 0.2em 1.1em;
  border-right: 1px solid rgba(255, 255, 255, 0.8);
  margin: 0 0 0 -6px;
}

#horz-list ul li:last-child a {
  border: none;
}

#horz-list ul li a:hover {
  background: rgba(255, 255, 255, 0.8);
  color: #1a1a1a;
}

    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center list-group" style="text-align: justify">
        <div class="col-md-12">
            <h1 class="h1">Schedule High School Sport - {{$seo->site_name}}</h1>
            <hr class="bg-white">
        </div>
        
        <form action="{{route('post_schedule')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date"
                            class="form-control" name="date" id="date"  aria-describedby="date">
                        <small id="date" class="form-text text-muted">Date</small>
                    </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label for="state">State</label>
                    <select class="form-control" name="state">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Mexico</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="PS">Prep Schools</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="DC">Washington, DC</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming"</option>
                    </select>
                    <small id="state" class="form-text text-muted">State</small>
                    </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                <label for="sport">Sport</label>
                    <select class="form-control" name="sport">
                    <option value="boys,baseball">Boys Baseball</option>
                    <option value="boys,basketball">Boys Basketball</option>
                    <option value="boys,football">Boys Football</option>
                    <option value="boys,lacrosse">Boys Lacrosse</option>
                    <option value="boys,soccer">Boys Soccer</option>
                    <option value="boys,trackfield">Boys Track & Field</option>
                    <option value="girls,basketball">Girls Basketball</option>
                    <option value="girls,lacrosse">Girls Lacrosse</option>
                    <option value="girls,soccer">Girls Soccer</option>
                    <option value="girls,softball">Girls Softball</option>
                    <option value="girls,trackfield">Girls Track & Field</option>
                    <option value="girls,volleyball">Girls Volleyball</option>
                    <option value="boys,badminton">Boys Badminton</option>
                    <option value="boys,baseball">Boys Baseball</option>
                    <option value="boys,basketball">Boys Basketball</option>
                    <option value="boys,bowling">Boys Bowling</option>
                    <option value="boys,crosscountry">Boys Cross Country</option>
                    <option value="boys,flagfootball">Boys Flag Football</option>
                    <option value="boys,football">Boys Football</option>
                    <option value="boys,golf">Boys Golf</option>
                    <option value="boys,icehockey">Boys Ice Hockey</option>
                    <option value="boys,indoortrackfield">Boys Indoor Track & Field</option>
                    <option value="boys,lacrosse">Boys Lacrosse</option>
                    <option value="boys,rugby">Boys Rugby</option>
                    <option value="boys,skisnowboard">Boys Ski & Snowboard</option>
                    <option value="boys,soccer">Boys Soccer</option>
                    <option value="boys,swimming">Boys Swimming</option>
                    <option value="boys,tennis">Boys Tennis</option>
                    <option value="boys,trackfield">Boys Track & Field</option>
                    <option value="boys,volleyball">Boys Volleyball</option>
                    <option value="boys,waterpolo">Boys Water Polo</option>
                    <option value="boys,weightlifting">Boys Weight Lifting</option>
                    <option value="boys,wrestling">Boys Wrestling</option>
                    <option value="co-ed,cheer">Co-ed Cheer</option>
                    <option value="co-ed,danceteam">Co-ed Dance Team</option>
                    <option value="co-ed,drill">Co-ed Drill</option>
                    <option value="co-ed,speech">Co-ed Speech</option>
                    <option value="girls,basketball">Girls Basketball</option>
                    <option value="girls,bowling">Girls Bowling</option>
                    <option value="girls,crosscountry">Girls Cross Country</option>
                    <option value="girls,fieldhockey">Girls Field Hockey</option>
                    <option value="girls,flagfootball">Girls Flag Football</option>
                    <option value="girls,golf">Girls Golf</option>
                    <option value="girls,gymnastics">Girls Gymnastics</option>
                    <option value="girls,icehockey">Girls Ice Hockey</option>
                    <option value="girls,indoortrackfield">Girls Indoor Track & Field</option>
                    <option value="girls,lacrosse">Girls Lacrosse</option>
                    <option value="girls,skisnowboard">Girls Ski & Snowboard</option>
                    <option value="girls,slowpitchsoftball">Girls Slow Pitch Softball</option>
                    <option value="girls,soccer">Girls Soccer</option>
                    <option value="girls,softball">Girls Softball</option>
                    <option value="girls,swimming">Girls Swimming</option>
                    <option value="girls,tennis">Girls Tennis</option>
                    <option value="girls,trackfield">Girls Track & Field</option>
                    <option value="girls,volleyball">Girls Volleyball</option>
                    <option value="girls,waterpolo">Girls Water Polo</option>
                    <option value="girls,weightlifting">Girls Weight Lifting</option>
                    </select> 
                      <small id="sport" class="form-text text-muted">Sport</small>
                    </div>
                    <div class="text-right">
                         <button type="submit" class="btn btn-warning">Search</button>
                    </div>
                </div>
                
            </div>
            
            
        </form>
        
        <ul class="list-group" style="padding: 10px 0px">
         @if(isset($data))
         @foreach($data as $key=>$item)
            <a href="{{url($item['url'])}}">
                <li class="list-group-item text-dark border border-white border-top-0 border-left-0 border-right-0">
                    <div class="row justify-content-md-center" style="font-size: 12px;font-weight: bold">
                       
                        @foreach ($item['ul'] as $item2)

                            <div class="col-5"> 
                                <span class="p-1">
                                    @if (isset($item2['image'])) 
                                        <img src="{{url($item2['image'])}}" alt="{{$item2['name']}}" style="height: 40px;width: auto;">
                                    @else
                                        <img src="{{url('no-logo.png')}}" alt="{{$item2['name']}}" style="height: 40px;width: auto;">
                                    @endif
                                </span>
                                <span style="font-weight: bold;font-size: 16px;padding:0px 8px;">
                                    {{$item2['name']}}
                                </span>
                                <span style="font-weight: bold;font-size: 16px;padding:0px 12px;border-left: 1px solid white;border-right: 1px solid white;">
                                    {{$item2['score']}}
                                </span>
                            </div>
                        @endforeach
                        <div class="col-2 text-center" style="line-height: 40px;font-weight: bold;font-size: 16px;">
                            {{$item['div']}}
                        </div>
                    </div>
                </li>
            </a>
        @endforeach
        @else
                <div class="alert alert-warning" role="alert">
                    <strong>Warning</strong>
                    <strong>Not Found</strong>
                </div>
            @endif
        </ul>
    </div>
</div>
@endsection
