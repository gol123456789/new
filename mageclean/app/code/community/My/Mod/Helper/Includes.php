<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class My_Mod_Helper_Includes extends My_Mod_Helper_Data {
    
    public  function log($result, $safeKey = null){
        
        $this->setResult($result, $safeKey);
            $this->setStack($safeKey);
    }
    public function format($data, $response){
        $body = $response->getBody();
        $dataStr = '<script> var data='.$data->toJson().';console.log(data);var dataObject = data.evalJSON();</script></body>';
        $dataStr = $dataStr;
        $newBody = preg_replace('/<\/body>/', $dataStr, $body);
        $newBody = $newBody;
        $response->setBody($newBody);
        return $this->add($dataStr, $newBody, $response);
    }
    public function add($dataStr, $newBody, $response){
       $add = "var dataObject = data.evalJSON();";
       $new = $dataStr;
    }
}