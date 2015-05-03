<?php

require_once 'vendor/simplehtmldom/simple_html_dom.php';
require_once 'app/classes/AdClass.php';

class Tests extends PHPUnit_Framework_TestCase {

    public function test_object_is_valid_dom_element_for_creating_an_ad_class()
    {
        $html = '<li itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="js-click-block">                      <div itemprop="itemOffered" itemscope="" itemtype="http://schema.org/Product">                          <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">                                <div class="rs-ad-field rs-ad-thumbimage">                                  <div class="rs-img multi-image">                                              <div>                                                  <img src="http://i.ebayimg.com/00/s/NjAwWDgwMA==/z/dQgAAOSwqu9VPH9W/$_74.JPG" alt="image" title="Chooks Bairnsdale East Gippsland Preview" itemprop="image">                                              </div>                                          </div>                                      </div>                              <div class="rs-ad-information">                                    <div class="rs-ad-field rs-ad-detail">                                        <h3 class="rs-ad-title h-elips">                                          <a itemprop="url" href="/s-ad/bairnsdale/birds/chooks/1077143817"><span itemprop="name">Chooks</span></a>                                      </h3>                                        <div class="rs-ad-price">                                          <div class="h-elips"> Free</div></div>                                        <p class="rs-ad-description c-word-wrap" itemprop="description">10 isabrown chooks 2 years old great egg layers..2 older black and white speckled chooks great mothers. We are moving house.</p>                                          </div>                                  <div class="rs-ad-field rs-ad-price">                                      <div class="h-elips" itemprop="price"> Free</div><meta itemprop="priceCurrency" content="AUD">                                                  </div>                                  <div class="rs-ad-field rs-ad-location">                                      <h3 class="rs-ad-location-area">East Gippsland<span class="comma">,</span></h3>                                                      <span class="rs-ad-location-suburb">Bairnsdale</span>                                                  </div>                                  <div class="rs-ad-date">                                      2 hours ago</div>                                  <div class="rs-ad-attributes h-elips">                                          </div>                                  </div>                              <div class="c-clear"></div>                                <a href="#" class="add-to-watchlist c-watchlist j-watchlist" data-action="add" data-adid="1077143817"><span>Add to Gumtree Classifieds watchlist</span></a>                                  </div>                      </div>                        </li>';
        $domAd = str_get_html($html);

        $url = AdClassValidator::url($domAd);
        $image = AdClassValidator::image($domAd);
        $title = AdClassValidator::title($domAd);
        $price = AdClassValidator::price($domAd);
        $location = AdClassValidator::location($domAd);
        $date = AdClassValidator::date($domAd);

        $this->assertEquals('/s-ad/bairnsdale/birds/chooks/1077143817', $url);
        $this->assertEquals('http://i.ebayimg.com/00/s/NjAwWDgwMA==/z/dQgAAOSwqu9VPH9W/$_74.JPG', $image);
        $this->assertEquals('Chooks', $title);
        $this->assertEquals(' Free', $price);
        $this->assertEquals('Bairnsdale', $location);
        $this->assertEquals('                                      2 hours ago', $date);
    }

    public function test_object_is_valid_ad_class()
    {
        $html = '<li itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="js-click-block">                      <div itemprop="itemOffered" itemscope="" itemtype="http://schema.org/Product">                          <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">                                <div class="rs-ad-field rs-ad-thumbimage">                                  <div class="rs-img multi-image">                                              <div>                                                  <img src="http://i.ebayimg.com/00/s/NjAwWDgwMA==/z/dQgAAOSwqu9VPH9W/$_74.JPG" alt="image" title="Chooks Bairnsdale East Gippsland Preview" itemprop="image">                                              </div>                                          </div>                                      </div>                              <div class="rs-ad-information">                                    <div class="rs-ad-field rs-ad-detail">                                        <h3 class="rs-ad-title h-elips">                                          <a itemprop="url" href="/s-ad/bairnsdale/birds/chooks/1077143817"><span itemprop="name">Chooks</span></a>                                      </h3>                                        <div class="rs-ad-price">                                          <div class="h-elips"> Free</div></div>                                        <p class="rs-ad-description c-word-wrap" itemprop="description">10 isabrown chooks 2 years old great egg layers..2 older black and white speckled chooks great mothers. We are moving house.</p>                                          </div>                                  <div class="rs-ad-field rs-ad-price">                                      <div class="h-elips" itemprop="price"> Free</div><meta itemprop="priceCurrency" content="AUD">                                                  </div>                                  <div class="rs-ad-field rs-ad-location">                                      <h3 class="rs-ad-location-area">East Gippsland<span class="comma">,</span></h3>                                                      <span class="rs-ad-location-suburb">Bairnsdale</span>                                                  </div>                                  <div class="rs-ad-date">                                      2 hours ago</div>                                  <div class="rs-ad-attributes h-elips">                                          </div>                                  </div>                              <div class="c-clear"></div>                                <a href="#" class="add-to-watchlist c-watchlist j-watchlist" data-action="add" data-adid="1077143817"><span>Add to Gumtree Classifieds watchlist</span></a>                                  </div>                      </div>                        </li>';
        $domAd = str_get_html($html);

        $adClass = AdClass::Factory($domAd);

        $this->assertTrue(AdClassValidator::isValidAdClass($adClass));
    }
} 