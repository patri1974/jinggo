<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use GuzzleHttp\Client as Claint2;
use App\Models\Link;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\URL;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Symfony\Component\DomCrawler\Crawler;

class DonwloadPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
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
    protected $signature = 'donwload:page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Success';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    private $containts_page = array();
    private $related_links = array();

    public $url_asli = "";
    public $title = "Home";

    public function handle()
    {

        $client = new Client();
        $url = Link::find(1);
        $this->url_asli = $url->url_asli;

        $link = Link::where('status_generate', 0)
            ->where("url_asli", "like", "%news%")
            ->where("status", 1)
            ->where("status_generate", 0)
            ->limit(100)->get();

        foreach ($link as $key => $value) {

            $this->info($value->url_asli);

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
                $this->info("Success donwload img");
            } catch (\Throwable $th) {
                $this->info("donwload img fail");
            }

            try {
                $url = $value->url_asli;
                $page = $client->request('GET', $url);


                $page->filter('title')->each(function ($item) {
                    $this->info("start get title");
                    $this->title = $item->text();
                    $this->info("success get title");
                });


                // link side
                if ($page->filter('.related-links li')->count() > 0) {
                    try {
                        $this->info("start related links");
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
                        $this->info("related-links success");
                    } catch (\Throwable $th) {
                        $this->info($th);
                        $this->info("related-links fail");
                        $this->related_links = null;
                    }
                }


                // link articles


                if ($page->filter('ul.articles li')->count() > 0) {
                    try {
                        $page->filter('.articles ul li')->each(function ($item) {
                            // donwload to
                            $this->info("List Articel Start");
                            try {
                                $url = $item->filter('img')->attr("data-lazy-image");
                                $contents = file_get_contents($url);
                                $name = strtotime(now()) . '-' . substr($url, strrpos($url, '/') + 1);
                                $path = Storage::disk('public')->put('img/' . $name, $contents);
                                $this->containts_page[$item->filter('h3 a')->text()]["img"] = $path;
                                $this->containts_page[$item->filter('h3 a')->text()]["p"] = $item->filter('p')->html();
                                $this->containts_page[$item->filter('h3 a')->text()]["link"] = str_replace($this->url_asli, "", $item->filter('a')->attr('href'));
                                $this->containts_page[$item->filter('h3 a')->text()]["date"] = date('Y-F-d');
                                $this->info("oke");
                            } catch (\Throwable $th) {
                                $this->info("fail list articel");
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
                        $this->info("Success list articel");
                    } catch (\Throwable $th) {
                        $this->info("List articel fail");
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
                        $body = str_replace($this->url_asli, '', $page->filter('.article_body')->html());
                        $body = str_replace("//maxpreps.cbsistatic.com", '' . "/img/static", $body);

                        $this->containts_page[$page->filter('.article-headline')->text()]["body"] = str_replace("https://dw3jhbqsbya58.cloudfront.net", '' . "/storage/img", $body);
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
                        $this->info("Success content-center");
                    } catch (\Throwable $th) {
                        // $this->info($th);
                        $this->containts_page = null;
                        $this->info("fail content-center");
                    }
                }


                $url = Link::find($value->id);
                $url->status_generate = 1;
                $url->save();
            } catch (\Throwable $th) {
                $this->info($th);
            }
        }
    }
}
