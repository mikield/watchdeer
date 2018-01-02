<?php

use Phinx\Seed\AbstractSeed;
include __DIR__.'/../Colors.php'; # Console log pretty debug
use Sunra\PhpSimple\HtmlDomParser;

class GallerySeeder extends AbstractSeed
{

    public function run()
    {
        $page = "http://www.watchthedeer.com/";
        $dom = HtmlDomParser::file_get_html($page . "photos");
        $html = $dom->find('ul');
        echo Colors::fg_color('bold_blue', "Started parser...\n");
        for ($count = 0; $count <= 20;$count++) {
            $gallery = $html[0]->find('li a', $count);

            $title = $gallery->innertext;
            $title = str_replace('/\s+/', '', $title);
            $title = preg_replace('/\([^)]*\)/', ' ', $title);

            $url = $page . str_replace("../", "", $gallery->attr['href']); //str_replace('../', $string);

            if (strpos($url, '.aspx') === false)
                continue;
            if(strpos($url, '%20') === false)
                $url = str_replace(' ', '%20', $url);

            $galleries = array(
                'title' => $title,
                'url' => str_replace("viewer.aspx", "", $url),
            );
            $this->table('galleries')->insert($galleries)->save();
            $galleryId = $this->adapter->getConnection()->lastInsertId();
            echo Colors::fg_color('green', "Gallery found and saved!\n");
            echo Colors::fg_color('blue', "Started parsing images...\n");
            // parse images from current gallery
            $gallery_dom = HtmlDomParser::file_get_html($url);
            $gallery_html = $gallery_dom->find('script')[0]->innertext;
            $pattern = '/\'([^\';]+)\'/';
            preg_match_all($pattern, $gallery_html, $output);
            // make arrays from parsed images
            $images = array();
            foreach ($output[1] as $image) {
                $images[]= array(
                    'name' => $image,
                    'gallery_id' => $galleryId
                );
            }
            $this->table('images')->insert($images)->save();
            echo Colors::fg_color('green', "Images parsed and saved!\n");
        }
        echo Colors::fg_color('bold_green', "All done! \n");
    }
}
