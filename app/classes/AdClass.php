<?php

class AdClass {

    public $url;
    public $image;
    public $title;
    public $price;
    public $location;
    public $date;

    public static function Factory($domAd)
    {
        $obj = new AdClass($domAd);

        if (!AdClassValidator::isValidAdClass($obj)){
            return null;
        }

        return $obj;
    }

    protected function __construct($domAd)
    {
        $this->url = AdClassValidator::url($domAd);
        $this->image = AdClassValidator::image($domAd);
        $this->title = AdClassValidator::title($domAd);
        $this->price = AdClassValidator::price($domAd);
        $this->location = AdClassValidator::location($domAd);
        $this->date = AdClassValidator::date($domAd);
    }
}

class AdClassValidator {

    public static function url($domElement)
    {
        foreach ($domElement->find('a') as $elem) {
            if (isset($elem->itemprop)) {
                if ($elem->itemprop == 'url') {
                    return $elem->href;
                }
            }
        }

        return null;
    }

    public static function image($domElement)
    {
        foreach ($domElement->find('img') as $elem) {
            if (isset($elem->itemprop)) {
                if ($elem->itemprop == 'image') {
                    return $elem->src;
                }
            }
        }

        return null;
    }

    public static function title($domElement)
    {
        foreach ($domElement->find('span') as $span) {
            if (isset($span->itemprop)) {
                if ($span->itemprop == 'name') {
                    return $span->innertext;
                }
            }
        }

        return null;
    }

    public static function price($domElement)
    {
        foreach ($domElement->find('div') as $elem) {
            if (isset($elem->itemprop)) {
                if ($elem->itemprop == 'price') {
                    return $elem->innertext;
                }
            }
        }

        return null;
    }

    public static function location($domElement)
    {
        foreach ($domElement->find('span') as $elem) {
            if (isset($elem->class)) {
                if ($elem->class == 'rs-ad-location-suburb') {
                    return $elem->innertext;
                }
            }
        }

        return null;
    }

    public static function date($domElement)
    {
        foreach ($domElement->find('div') as $elem) {
            if (isset($elem->class)) {
                if ($elem->class == 'rs-ad-date') {
                    return $elem->innertext;
                }
            }
        }

        return null;
    }

    public static function isValidAdClass($adClass)
    {
        if ($adClass->url &&
            $adClass->image &&
            $adClass->title &&
            $adClass->price &&
            $adClass->location &&
            $adClass->date != null) {
            return true;
        }

        return false;
    }
}