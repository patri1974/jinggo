<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SEO;
use App\Models\Link;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SitemapImport;
use App\Models\Sitemap;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data()
    {
        $link = Sitemap::first();
        // $link = Link::where('status_generate', 0)
        // ->where("url_asli", "like", "%https://www.maxpreps.com/list/schedules_scores_redirect.aspx?gendersport=boys,baseball%")
        // ->where("status", 1)
        // ->limit(100)->first();

        // $link->status=0;
        // $link->crawel_status=1;
        // $link->status_generate=1;
        // $link->update();

        dd($link);
    }
    public function index()
    {
        $seo = SEO::first();
        return view('home')->with('seo',$seo);
    }
    public function create(Request $request)
    {
        $seo = new SEO;
        $seo->site_name='123';
        $seo->save();
        
        $seo = SEO::find(1);
        // $seo = new SEO;
        $seo->site_name=$request->site_name;
        $seo->description=$request->description;
        $seo->type=$request->type;
        $seo->head=$request->head;
        $seo->iklan=$request->iklan;
        $seo->script=$request->script;
        $seo->css=$request->css;
        $seo->iklan_popup=$request->iklan;
        $seo->save();
        
        if($request->hasFile('file_import')){
            Excel::import(new SitemapImport, $request->file_import);
        }

        return back();
    }
    public function store(Request $request)
    {
       
    }
}
