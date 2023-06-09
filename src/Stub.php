<?php

namespace tencent\tpns;

class Stub {
    public $host;
    public $sign;

    public function __construct($accessId, $secretKey, $host) {
        $this->host = $host;
        if (strpos($host, "http://") === false && strpos($host, "https://") === false) {
            $this->host = "https://" . $host;
        }

        $this->sign = base64_encode($accessId . ":" . $secretKey);
    }

    public function Push($request) {
        $request->Validate();
        $data = $request->Marshal();

        $headers = array("Content-type: application/json;charset='utf-8'", "Authorization: Basic " . $this->sign);
        $url = $this->host . "/v3/push/app";

        $options = array(
            CURLOPT_HTTPHEADER      => $headers,
            CURLOPT_HEADER          => 0,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => 0,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_TIMEOUT         => 10000
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $ret = curl_exec($ch);
        $error = curl_error($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);

        if ($error != "") {
            throw new \Exception($error);
        }

        $code = $info["http_code"];

        if ($code != 200) {
            throw new \Exception("status: " . $code . ", message: " . $ret);
        }

        return json_decode($ret, 1);
    }

    public function UploadFile($file) {
        $headers = array("Content-type: multipart/form-data", "Authorization: Basic " . $this->sign);

        $url = $this->host . "/v3/push/package/upload";

        $cfile = new \CURLFile($file,'multipart/form-data',basename($file));

        $options = array(
            CURLOPT_HTTPHEADER      => $headers,
            CURLOPT_HEADER          => 0,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => 0,
            CURLOPT_POST            => 1,
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_TIMEOUT         => 10000,
            CURLOPT_POSTFIELDS      => array("file" => $cfile)
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);

        $ret = curl_exec($ch);
        $error = curl_error($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);

        if ($error != "") {
            throw new \Exception($error);
        }

        $code = $info["http_code"];

        if ($code != 200) {
            throw new \Exception("status: " . $code . ", message: " . $ret);
        }

        $data = json_decode($ret, 1);

        if ($data["retCode"] != 0) {
            throw new \Exception("upload error, retCode: " . $data["retCode"] . ", errMsg: " . $data["errMsg"]);
        }
        return $data["uploadId"];

    }
}