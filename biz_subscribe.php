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
            $content = array();
            while (!feof($fp) && $chunk_size > 0) {
                if($i <= 20){
                    $responseContent .= fgetss($fp, 4096);
                    //echo $responseContent;
                    $i++;
                } else {
                    $i = 1;

                    $responseContent = $this->parseHttpChunk2Array($responseContent);
                    $content[$ii] = $responseContent;

                    $responseContent = '';

                    $ii++;
                    if($ii > 5){
                        break;
                    }
                }
            }
            fclose($fp);
            //var_dump($content);
            return $content;
        }

    }

    /**
     * 将 chunked 的 json 串解析成 array
     * */
    public function parseHttpChunk2Array($data) {
        $outData = array();
        $content = explode("\r\n", $data);

        foreach ($content as $k => $v) {
            $chunk = json_decode($v, true);
            if(!is_array($chunk)){
                continue;
            }
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