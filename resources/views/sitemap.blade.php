<?xml version="1.0" encoding="UTF-8"?> <?xml-stylesheet type="text/xsl" href="/main-sitemap.xsl"?>


<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"

xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"

xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

   @foreach ($data as $item)
        <sitemap>
            <loc>{{$url}}/sitemap/{{$item->kategori}}-site.xml</loc>
            <lastmod>{{ date("Y-m-d\TH:m:s+00:00") }}</lastmod>
        </sitemap>
    @endforeach

</sitemapindex>



