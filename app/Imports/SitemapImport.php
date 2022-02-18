<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Sitemap;

class SitemapImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
                $data = new  Sitemap;
                $data->loc = str_replace(" ", "-", $row[0]);
                $data->lastmod = $row[1];
                $data->changefreq = $row[2];
                $data->priority = $row[3];
                $data->kategori = $row[4];
                $data->save();
               
        }
    }
}
