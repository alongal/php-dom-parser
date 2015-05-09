<?php
require_once "vendor/simplehtmldom/simple_html_dom.php";
require_once "app/classes/AdClass.php";
require_once "app/classes/AdClassValidator.php";
require_once "app/classes/AdClassScreener.php";

class Main {

//    public function run()
//    {
//        $ads1 = $this->getRecentAdsFromSite("http://www.gumtree.com.au/s-pets/vic/c18433l3008844?price-type=free");
//        $ads1 = $this->screenKeywordsForAds($ads1, ['cat', 'kitten', 'kitty']);
//
//        $ads2 = $this->getRecentAdsFromSite("http://www.gumtree.com.au/s-livestock/vic/c18457l3008844?price-type=free");
//        $ads2 = $this->screenKeywordsForAds($ads2, ['cat', 'kitten', 'kitty']);
//
//        echo json_encode(array_merge($ads1, $ads2));
//    }

    public function run()
    {
        // 1. Get all the uri to search from
        $uris = FileManager::loadUris();

        // 2. Get list of keywords to search
        $keywords = FileManager::loadKeywords();

        // 3. Get list of words to filter
        $filters = FileManager::loadFilters();

        // 4. Get list of previous search
        $previousAds = FileManager::loadPreviousSearch();
    }

    /**
     * Download a website abd turn it to a DOM object
     *
     * @param $url
     * @return bool|simple_html_dom
     */
    function downloadWebsite($url)
    {
        // Create DOM from URL or file
        $html = file_get_html($url);

        return $html;
    }

    /**
     * Get the most recent ads in the dom
     *
     * @param $dom
     * @return mixed
     */
    function getMostRecentAdds($dom)
    {
        return $dom->find('ul[id=srchrslt-adtable]', 0);
    }

    /**
     * Download a gumtree website and extract all the adds into an array of adds
     *
     * @param $url
     * @return ads
     */
    function getRecentAdsFromSite($url)
    {
        // Download the website
        $dom = $this->downloadWebsite($url);

        // Get the most recent ads as a dom object
        $domAds = $this->getMostRecentAdds($dom);

        // For each li element in the domAds, create an ad class
        $array = array();
        foreach($domAds->find('li') as $domAd) {
            $anAd = AdClass::Factory($domAd);
            if ($anAd != null) {
                array_push($array, $anAd);
            }
        }

        return $array;
    }

    function screenKeywordsForAds($ads, $keywords)
    {
        $array = array();
        foreach ($ads as $ad) {
            $ad = AdClassScreener::screenForKeywords($ad, $keywords);
            if ($ad) {
                array_push($array, $ad);
            }
        }

        return $array;
    }
}

$main = new Main();
$main->run();