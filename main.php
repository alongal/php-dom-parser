<?php
require_once "vendor/simplehtmldom/simple_html_dom.php";
require_once "app/classes/AdClass.php";

class Main {

    public function run()
    {
        $ads = $this->getRecentAdsFromSite("gumtree.html");

//        $dom = $this->downloadWebsite("gumtree.html");
//        $ads = $this->getMostRecentAdds($dom);
//
//        $firstAdd = $ads->find('li', 0);
//        echo $firstAdd;
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

        echo json_encode($array);
    }
}

$main = new Main();
$main->run();