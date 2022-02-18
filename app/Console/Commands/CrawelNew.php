<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Link;

class CrawelNew extends Command
{
    public function getUrls($url = '')
    {
        $urlweb= Link::find(1);
        $url_asli= $urlweb->url_asli;

        $urls = [];
        $urls2 = [];

        if($url != ''){
            try {
            $baseUrl = $url;
            $prefix = 'https';
            if (strpos($baseUrl, 'ttps://') === false){
                $prefix = 'http';
            }
            $client = new Client();
            $response = $client->request('GET', $url);
            $html = $response->getBody();
            //Getting the exact url without http or https
            $url = str_replace('http://www.', '',$url);
            $url = str_replace('https://www.', '',$url);
            $url = str_replace('http://', '',$url);
            $url = str_replace('https://', '',$url);
            //Parsing the url for getting host information
            $parse = parse_url('https://'.$url);
            //Parsing the html of the base url
            $dom = new \DOMDocument();
            @$dom->loadHTML($html);
            // grab all the on the page
            $xpath = new \DOMXPath($dom);
            //finding the a tag
            $hrefs = $xpath->evaluate("/html/body//a");
            //Loop to display all the links
            $length = $hrefs->length;
            //Converting URLs to add the www prefix to host to a common array
            $baseUrl = str_replace('http://'.$parse['host'], 'http://www.'.$parse['host'],$baseUrl);
            $baseUrl = str_replace('https://'.$parse['host'], 'https://www.'.$parse['host'],$baseUrl);
            $urls = [$baseUrl];
            $allUrls = [$baseUrl];
            for ($i = 0; $i < $length; $i++) {
               
                    $href = $hrefs->item($i);
                    $url = $href->getAttribute('href');
                    $url = str_replace('http://'.$parse['host'], 'http://www.'.$parse['host'],$url);
                    $url = str_replace('https://'.$parse['host'], 'https://www.'.$parse['host'],$url);
                    //Replacing the / at the end of any url if present
                    if(substr($url, -1, 1) == '/'){
                        $url = substr_replace($url, "", -1);
                    }
                    array_push($allUrls, $url);
              
              
            }

            //Looping for filtering the URLs into a distinct array
            foreach($allUrls as $url){
                //Limiting the number of urls on the site
                if(count($urls) >= 300){
                    break;
                }
                //Filter the null links and images
                if(strpos($url, '#') === false)
                {
                    //Filtering the links with host
                    if(strpos($url, 'https://'.$parse['host']) !== false || strpos($url, 'https://www.'.$parse['host']) !== false){
                        //Replacing the / at the end of any url if present
                        if(substr($url, -1, 1) == '/'){
                            $url = substr_replace($url, "", -1);
                        }
                        //Checking if the link is already preset in the final array
                        $urlSuffix = str_replace('http://www.', '',$url);
                        $urlSuffix = str_replace('https://www.', '',$urlSuffix);
                        $urlSuffix = str_replace('http://', '',$urlSuffix);
                        $urlSuffix = str_replace('https://', '',$urlSuffix);

                        if($urlSuffix != $parse['host']){
                            array_push($urls, $url);
                            array_push($urls2, str_replace($url_asli,"",$url));
                        }
                    }
                    //Filtering the links without host
                    if(strpos($url, $parse['host']) === false){
                        if(substr($url, 0, 1) == '/'){
                            //Replacing the / at the end of any url if present
                            if(substr($url, -1, 1) == '/'){
                                $url = substr_replace($url, "", -1);
                            }
                            $newUrl = 'http://www.'.$parse['host'].$url;
                            $secondUrl = 'https://www.'.$parse['host'].$url;
                            if($url != $parse['host']){
                                //Checking if the link is already preset in the final array and the common array
                                if(!in_array($secondUrl, $urls) && !in_array($secondUrl, $allUrls) && !in_array($newUrl, $allUrls)) {
                                    if ($prefix == 'https') {
                                        $newUrl = $secondUrl;
                                    }
                                    array_push($urls, $newUrl);
                                    array_push($urls2, str_replace($url_asli,"",$newUrl));
                                }
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        }

        array_unshift($urls2,"/");
        $data[0]=$urls;
        $data[1]=$urls2;

        return $data;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawel:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {

        $new = Link::where('crawel_status',0)
        ->where('status',1) 
        ->where("url_asli", "like", "%news%")
        ->get();
        

        $this->info('jumlah url ='.$new->count());

        foreach($new  as $item){
                
                $oke= $this->getUrls($item->url_asli);

                $link = new Link;
                for ($i=0; $i <count($oke[0]) ; $i++) {
                    try {
                        if($oke[0][$i]!="https://www.maxpreps.com/list/schedules_scores_redirect.aspx?gendersport=boys,baseball"){
                            $link = new Link;
                            $link->url_asli=$oke[0][$i];
                            $link->url=$oke[1][$i];
                            $link->save();
                        }
                    } catch (\Throwable $th) {
                        // echo $th;
                    }

                }

                $link->where('url_asli', $item->url_asli)
            ->update(['crawel_status' => 1]);

                $this->info("succsees crawel id =".$item->id);
                $this->info("succsees url =".$item->url_asli);
            }

            $this->info("succsees crawel");

        return 200;
    }
}
