<?php

class Communication {

    protected $AUTH_TOKEN = 'ukpb97NX5WBn6lb9PLrY1KoaTKnSVm';
    protected $APP_KEY = 'stamp_me_demo';
    protected $PUSH_CODE = 8010;
    protected $URL = "https://api.streethawk.com/v1/push ";

    public static function create()
    {
        return new Communication();
    }

    private function httpPost($url, $params)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    // Accept any CA (ssl)
        $output = curl_exec($ch);

        if ($output) {
            error_log(print_r(curl_error($ch), 1));
            error_log(print_r(curl_errno($ch), 1));
        }

        curl_close($ch);
        return $output;

    }

    public function push($array)
    {
        $params = array(
            'auth_token' => $this->AUTH_TOKEN,
            'app_key' => $this->APP_KEY,
            'code' => $this->PUSH_CODE,
            'title' => $array['title'],
            'message' => $array['message'],
            'sh_cuid' => $array['email']
        );

        $result = $this->httpPost($this->URL, $params);
        return $result;
    }

} 