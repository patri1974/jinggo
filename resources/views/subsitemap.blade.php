<?xml version='1.0' encoding='UTF-8'?><?xml-stylesheet type="text/xsl" href="/main-sitemap.xsl"?>

<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"

         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"

         xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach ($data as $post)
        <url>
            <loc>{{$url}}/page/{{ $post->loc }}</loc>
            <lastmod>{{ date("Y-m-d\TH:m:s+00:00") }}</lastmod>
            <changefreq>{{$post->changefreq}}</changefreq>
            <priority>{{$post->priority}}</priority>
        </url>
    @endforeach
</urlset>

