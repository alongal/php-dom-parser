<?php

class Main {

    public function run()
    {
        $site = $this->downloadWebsite();
    }

    function downloadWebsite()
    {
        $dom = new DOMDocument();
        $dom->load("http://en.wikipedia.org/wiki/.li");
        return $dom;
    }

}

$main = new Main();
$main->run();