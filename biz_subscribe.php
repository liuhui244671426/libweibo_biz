<?php
/**
 * 商业接口订阅
 *
 * author liuhui9<liuhui9@staff.sina.com.cn>
 * @version 16/5/3
 * @copyright copyright(2016) weibo.com all rights reserved
 */

class biz_subscribe
{
    public function push_method($url, $params){
        $parse_url = parse_url($url);
        $host = $parse_url['host'];
        $path = $parse_url['path'];
        $query = http_build_query($params);

        $fp = fsockopen($host, 80, $errno, $errstr, 30);
        stream_set_timeout($fp, 30);
        $ret = '';
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            $requestHeader = "GET {$path}?{$query} HTTP/1.1\r\n";
            $requestHeader .= "Host: {$host}\r\n";
            $requestHeader .= "Connection: Close\r\n\r\n";
            //fwrite($fp, $requestHeader);
            fputs($fp, $requestHeader);
            stream_set_blocking($fp, true);//阻塞

            $responseHeader = '';
            $responseContent = '';
            $chunk_size = (integer)hexdec(fgetss( $fp, 4096 ) );
            $i = 1;//小切片
            $ii = 1;//大切片
            while (!feof($fp) && $chunk_size > 0) {
                if($i <= 10){
                    $responseContent .= fgetss($fp, 4096);
                    echo $responseContent;
                    $i++;
                } else {
                    $i = 1;
                    //var_dump($responseContent);
                    $content = $this->unchunkHttp11Json($responseContent);

                    var_dump($content);
                    $content = '';
                    $ii++;
                    if($ii == 5)die;
                }

            }
            fclose($fp);
        }
        return $ret;
    }

    public function unchunkHttp11Json($data) {
        $outData = array();
        $content = explode("\r\n", $data);

        foreach ($content as $k => $v) {
            $chunk = json_decode($v, true);
            //is json string
            if(json_last_error() == JSON_ERROR_NONE){
                if(!empty($chunk)){
                    $outData[] = $chunk;
                }
            }

        }
        return $outData;
    }
}