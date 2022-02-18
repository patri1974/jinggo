<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Link;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\URL as URL2;
use Spatie\Sitemap\Tags\Url;



class Sitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:new';

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
        $data = Link::select('links.url')
            ->join("pages", "pages.link_id", "=", "links.id")
            ->where('pages.containt', '!=', null)
            ->limit(10)
            ->get();

        $site = SitemapGenerator::create(URL2::current())
            ->getSitemap();
        foreach ($data as $item) {
            $url = $_SERVER['HTTP_HOST'] . $item->url;
            $this->info($url);
            $site->add(Url::create($url)->setPriority(0.5));
        }

        $site->writeToFile(public_path('sitemap.xml'));
    }
}
