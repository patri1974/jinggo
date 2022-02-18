<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use GuzzleHttp\Client as HostHTTP;
use Goutte\Client;
use App\Models\Link;
use App\Models\Page;
use App\Models\Sitemap;
use App\Models\SEO;
use Illuminate\Console\Command;
use GuzzleHttp\Client as Claint2;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\URL;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Symfony\Component\DomCrawler\Crawler;


class WebviewController extends Controller
{

    private $result = array();

    private $containts_page = array();
    private $related_links = array();

    public $url_asli = "";
    public $title = "Home";

    public function index($url = "")
    {
        $link = Link::join("pages", "pages.link_id", "=", "links.id")
            ->where("kategori", $url)
            ->get();

        $sitemap =  Sitemap::select('loc')
            ->inRandomOrder()
            ->limit(1)
            ->get();

        return view('scraper')
            ->with('sitemap', $sitemap)
            ->with('data', $link);
    }

    public function policy()
    {
        $seo = SEO::first();

        return view('policy')
            ->with('seo', $seo);
    }
    public function dmca()
    {
        $seo = SEO::first();
        return view('dmca')
            ->with('seo', $seo);
    }
    public function contact()
    {
        $seo = SEO::first();
        return view('contact')
            ->with('seo', $seo);
    }

    public function schedule()
    {
        $seo = SEO::first();


        return view('schedule')
            ->with('seo', $seo);
    }

    public function games()
    {
        $url = str_replace('http://' . $_SERVER['HTTP_HOST'], "https://www.maxpreps.com", url()->full());
        $data = $this->detail($url);

        $seo = SEO::first();

        return view('player')
            ->with('seo', $seo)
            ->with('data', $data);
    }

    public function post_schedule(Request $request)
    {
        $request->date = date_create($request->date);
        $date = date_format($request->date, 'n/d/Y');
        $link = "https://www.maxpreps.com/list/schedules_scores.aspx?date=" . $date . "&gendersport=" . $request->sport . "&state=" . $request->state;
        $data = $this->img($link);

        $seo = SEO::first();

        return view('schedule')
            ->with('seo', $seo)
            ->with('data', $data)
            ->with('link', $link)
            ->with('request', $request->date);
    }


    public function detail($url = '')
    {

        $client = new Client();

        $page = $client->request('GET', $url);

        $page->filter('title')->each(function ($item) {
            $this->result['title'] = $item->text();
        });

        try {
            $page->filter('table')->each(function ($item, $index) {
                $this->result['table'][$index] = $item->html();
            });
            $this->result['containt'] = $page->filter('.content')->html();
            $this->result['contestdescription'] = $page->filter('.contest-description')->html();

            $this->result['contesttournament'] = $page->filter('.contest-tournament')->text();
        } catch (\Throwable $th) {
            // $this->related_links = null;
        }
        return $this->result;
    }

    public function img($url = '')
    {
        $client = new Client();

        $page = $client->request('GET', $url);


        $page->filter('title')->each(function ($item) {
            $this->title = $item->text();
        });

        try {
            $page->filter('ul li.c')->each(function ($item) {
                $this->result[str_replace('https://www.maxpreps.com', "", $item->filter('a.c-c')->attr('href'))]["url"] = str_replace('https://www.maxpreps.com', "", $item->filter('a.c-c')->attr('href'));
                $this->result[str_replace('https://www.maxpreps.com', "", $item->filter('a.c-c')->attr('href'))]["div"] = str_replace('https://www.maxpreps.com', "", $item->filter('div.details')->html());
                $a = str_replace('https://www.maxpreps.com', "", $item->filter('a.c-c')->attr('href'));

                // dd($item->filter('div > a > ul > li')->each());
                $item->filter('div > a > ul > li')->each(function ($item2, $index) use ($a) {
                    try {
                        $this->result[$a]["ul"][$index]['score'] =  $item2->filter('.score')->text();
                    } catch (\Throwable $th) {
                        $this->result[$a]["ul"][$index]['score'] =  $item2->filter('.record')->text();
                    }

                    $this->result[$a]["ul"][$index]['name'] =  $item2->filter('.name')->text();


                    try {
                        $url_img = str_replace("https://dw3jhbqsbya58.cloudfront.net", "", $item2->filter('.image')->attr('data-lazy-image'));
                        $url_img = strtok($url_img, '?');
                        $contents = file_get_contents($item2->filter('.image')->attr('data-lazy-image'));
                        Storage::disk('public')->put('/img' . $url_img, $contents);
                        $this->result[$a]["ul"][$index]['image'] =  'storage/img' . $url_img;
                    } catch (\Throwable $th) {
                        // $this->info("fail-".$item);
                    }
                });
            });
        } catch (\Throwable $th) {
            // $this->related_links = null;
        }
        return $this->result;
    }



    public function new()
    {

        $data = Link::join("pages", "pages.link_id", "=", "links.id")
            ->where('containt', '!=', '[]')
            ->where('containt', '!=', 'null')
            ->where('containt', '!=', null)
            ->where('type', '=', 'Articles')
            ->orderBy('links.id', 'DESC')
            ->paginate(5);

        $seo = SEO::first();


        return view('new')
            ->with('seo', $seo)
            ->with('data', $data);
    }


    public function home()
    {
        $link = Link::select('links.url')
            ->join("pages", "pages.link_id", "=", "links.id")
            ->where('pages.containt', '!=', null)
            ->inRandomOrder()
            ->limit(1)
            ->get();
        $link = Link::join("pages", "pages.link_id", "=", "links.id")
            ->where("url", $link->first()->url)
            ->get();

        $sitemap =  Sitemap::select('loc')
            ->inRandomOrder()
            ->limit(1)
            ->get();

        $seo = SEO::first();

        return view('home-page')
            ->with('seo', $seo)
            ->with('sitemap', $sitemap)
            ->with('data', $link);
    }

    public function news($url = "")
    {


        $urlku = url()->full();
        $url = str_replace('http://' . $_SERVER['HTTP_HOST'], "", @$urlku);


        $link = Link::join("pages", "pages.link_id", "=", "links.id")
            ->where("links.url_asli", '=', "https://www.maxpreps.com/" . $url)
            ->limit(1)->first();


        if ($link == null) {

            $url_asliku = $this->donwload_page($url);
            $this->donwload_articel($url_asliku);

            $link = Link::join("pages", "pages.link_id", "=", "links.id")
                ->where("links.url_asli", '=', "https://www.maxpreps.com/" . $url)
                ->get();
        }

        $link = Link::join("pages", "pages.link_id", "=", "links.id")
            ->where("links.url_asli", '=', "https://www.maxpreps.com/" . $url)
            ->get();
        $sitemap =  Sitemap::select('loc')
            ->inRandomOrder()
            ->limit(1)
            ->get();

        $seo = SEO::first();
        return view('scraper')
            ->with('sitemap', $sitemap)
            ->with('seo', $seo)
            ->with('data', $link);
    }


    // jika masih belum di donwload maka langusng donwload dari sumber dulu

    public function donwload_page($url = null)
    {

        $url_asli = "";
        try {
            $link = new Link;
            $link->url_asli = "https://www.maxpreps.com/" . $url;
            $link->url = $url;
            $link->save();
            $url_asli = $link->url_asli;
        } catch (\Throwable $th) {

            return "https://www.maxpreps.com" . $url;
        }

        return $url_asli;
    }

    public function sitemap()
    {

        $data = Sitemap::select('kategori')
            ->groupBy('kategori')
            ->get();

        return response()->view('sitemap', [
            'data' => $data,
            'url' => 'http://' . $_SERVER['HTTP_HOST']
        ])->header('Content-Type', 'text/xml');
    }
    public function subsitemap($url = '', $url2 = '')
    {
        $url = str_replace("-site.xml", '', $url);

        $data = Sitemap::where('kategori', $url)
            ->get();
        // dd($data);

        return response()->view('subsitemap', [
            'data' => $data,
            'url' => 'http://' . $_SERVER['HTTP_HOST']
        ])->header('Content-Type', 'text/xml');
    }
    // donwload img
    public function page($url = "", $url2 = "")
    {

        $url = str_replace("-", " ", @$url);
        $data = Link::join("pages", "pages.link_id", "=", "links.id")
            ->where('containt', '!=', '[]')
            ->where('containt', '!=', 'null')
            ->where('containt', '!=', null)
            ->where('type', '=', 'Articles')
            ->where('containt', 'like', '%' . $url . '%')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        if (count($data) <= 0) {
            $data =
                Link::join("pages", "pages.link_id", "=", "links.id")
                ->where('containt', '!=', '[]')
                ->where('containt', '!=', 'null')
                ->where('containt', '!=', null)
                ->where('type', '=', 'Articles')
                ->inRandomOrder()
                ->paginate(5);
        }
        $seo = SEO::first();


        if (isset($_GET['search'])) {
            return view('new')
                ->with('seo', $seo)
                ->with('search', $_GET['search'])
                ->with('data', $data);
        }

        return view('new')
            ->with('search', $url)
            ->with('seo', $seo)
            ->with('data', $data);
    }
    public function bing($url = "", $url2 = "")
    {

        $url = str_replace("-", " ", @$url2);
        $data = Link::join("pages", "pages.link_id", "=", "links.id")
            ->where('containt', '!=', '[]')
            ->where('containt', '!=', 'null')
            ->where('containt', '!=', null)
            ->where('type', '=', 'Articles')
            ->where('containt', 'like', '%' . $url . '%')
            ->orderBy('links.id', 'DESC')
            ->paginate(5);

        if (count($data) <= 0) {
            $data =
                Link::join("pages", "pages.link_id", "=", "links.id")
                ->where('containt', '!=', '[]')
                ->where('containt', '!=', 'null')
                ->where('containt', '!=', null)
                ->where('type', '=', 'Articles')
                ->inRandomOrder()
                ->paginate(5);
        }

        $seo = SEO::first();

        if (isset($_GET['search'])) {
            return view('new')
                ->with('seo', $seo)
                ->with('search', $_GET['search'])
                ->with('data', $data);
        }
        return view('new')
            ->with('seo', $seo)
            ->with('data', $data);
    }

    public function getUrls($url = '')
    {
        $the_site = $url;
        $the_tag = "img"; #
        $the_class = "images";

        $html = file_get_contents($the_site);
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        $images = $xpath->query('//img/@src');
        $img = array();
        foreach ($images as $image) {
            $img[] = $image->nodeValue;
        }

        $images = $xpath->query('//img/@data-lazy-image');
        foreach ($images as $image) {
            $img[] = $image->nodeValue;
        }

        return $img;
    }




    // donwload articel
    public function donwload_articel($url_asliku = "")
    {

        $client = new Client();
        $this->url_asli = $url_asliku;

        $link = Link::where('status_generate', 0)
            // ->where("url_asli", "like", "%news%")
            ->where("url_asli", '=', $url_asliku)
            ->where("status", 1)
            ->where("status", 1)
            ->limit(1)->get();

        foreach ($link as $key => $value) {

            try {
                $aa = $this->getUrls($value->url_asli);
                // dd($aa);

                foreach ($aa as $item) {
                    try {

                        $item1 = str_replace("https://dw3jhbqsbya58.cloudfront.net", "", $item);
                        $item2 = str_replace("//maxpreps.cbsistatic.com", "/static", $item1);
                        // donwload to storage
                        $contents = file_get_contents($item);
                        Storage::disk('public')->put('/img' . $item2, $contents);
                    } catch (\Throwable $th) {
                        // $this->info("fail-".$item);
                    }
                }
            } catch (\Throwable $th) {
            }

            try {
                $url = $value->url_asli;
                $page = $client->request('GET', $url);


                $page->filter('title')->each(function ($item) {
                    $this->title = $item->text();
                });


                // link side
                if ($page->filter('.related-links li')->count() > 0) {
                    try {
                        $page->filter('.related-links li')->each(function ($item) {
                            $this->related_links[$item->filter('a')->text()]["title"] = $item->filter('a')->text();
                            $this->related_links[$item->filter('a')->text()]["url"] = str_replace($this->url_asli, "", $item->filter('a')->attr('href'));
                        });
                        // dd($this->related_links);

                        $page_save = new Page;
                        $page_save->link_id  = $value->id;
                        $page_save->name  = $value->url;
                        $page_save->type  = "related-links";
                        $page_save->containt =  json_encode($this->related_links);
                        $page_save->kategori = $this->title;
                        $page_save->save();
                        $this->related_links = null;
                    } catch (\Throwable $th) {
                        $this->related_links = null;
                    }
                }


                // link articles


                if ($page->filter('ul.articles li')->count() > 0) {
                    try {
                        $page->filter('.articles ul li')->each(function ($item) {
                            // donwload to
                            try {
                                $url = $item->filter('img')->attr("data-lazy-image");
                                $contents = file_get_contents($url);
                                $name = strtotime(now()) . '-' . substr($url, strrpos($url, '/') + 1);
                                $path = Storage::disk('public')->put('img/' . $name, $contents);
                                $this->containts_page[$item->filter('h3 a')->text()]["img"] = $path;
                                $this->containts_page[$item->filter('h3 a')->text()]["p"] = $item->filter('p')->html();
                                $this->containts_page[$item->filter('h3 a')->text()]["link"] = str_replace($this->url_asli, "", $item->filter('a')->attr('href'));
                                $this->containts_page[$item->filter('h3 a')->text()]["date"] = date('Y-F-d');
                            } catch (\Throwable $th) {

                                // dd($item->filter('img')->html());
                                //throw $th;
                            }
                        });

                        $page_save = new Page;
                        $page_save->link_id  = $value->id;
                        $page_save->name  = $value->url;
                        $page_save->type  = "List Articles";
                        $page_save->containt = json_encode($this->containts_page);

                        $page_save->kategori = $this->title;
                        $page_save->save();

                        $this->containts_page = null;
                    } catch (\Throwable $th) {
                        $this->containts_page = null;
                    }
                }

                // dd($page->filter('.article-headline')->text());

                // body articel


                // $data=$page->filter(".article_body")->html();

                if ($page->filter('div .content-center')->count() > 0) {

                    try {


                        $this->containts_page[$page->filter('.article-headline')->text()]["title"] = $page->filter('.article-headline')->text();

                        $this->containts_page[$page->filter('.article-headline')->text()]["title2"] = $page->filter('.article-subheadline')->text();
                        $body = str_replace($this->url_asli, URL::current(), $page->filter('.article_body')->html());
                        $body = str_replace("//maxpreps.cbsistatic.com", "/img/static", $body);

                        $this->containts_page[$page->filter('.article-headline')->text()]["body"] = str_replace("https://dw3jhbqsbya58.cloudfront.net", "/storage/img", $body);
                        $this->containts_page[$page->filter('.article-headline')->text()]["date"] = date('Y-F-d');

                        // dd($this->containts_page);
                        $page_save = new Page;
                        $page_save->link_id  = $value->id;
                        $page_save->name  = $value->url;
                        $page_save->type  = "Articles";
                        $page_save->containt = json_encode($this->containts_page);
                        $page_save->kategori = $this->title;
                        $page_save->save();
                        $this->containts_page = null;
                    } catch (\Throwable $th) {
                        $this->containts_page = null;
                    }
                }


                $url = Link::find($value->id);
                $url->status_generate = 1;
                $url->save();
            } catch (\Throwable $th) {
            }
        }
    }
}
