<?php

class AdClass {

    public $url;
    public $image;
    public $title;
    public $price;
    public $location;
    public $date;
    public $description;

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
        $this->description = AdClassValidator::description($domAd);
    }
}

