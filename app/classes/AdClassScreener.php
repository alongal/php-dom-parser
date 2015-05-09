<?php

class AdClassScreener {

    /**
     * Search for an array of keywords inside an ad.
     * If no keyword has been found, return the ad, else return null
     * @param $ad
     * @param $keywords
     * @return null
     */
    public static function screenForKeywords($ad, $keywords)
    {
        foreach ($keywords as $kw) {
            if (AdClassScreener::wordInString(strtolower($kw), strtolower($ad->title)) ||
                AdClassScreener::wordInString(strtolower($kw), strtolower($ad->description))) {
                return null;
            }
        }

        return $ad;
    }

    static function wordInString($word, $string)
    {
        if (strpos($string, $word) !== false) {
            return true;
        }

        return false;
    }
} 