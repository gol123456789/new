<?php

class My_Anal_Helper_Google extends Mage_Core_Helper_Abstract {
    
    public function renderStack(){
        return 'var _gaq = _gaq || [];';
    }

        public function renderEvent($array) {
    //    $eventString = 'var _gaq = _gaq || []; _gaq.push(["_trackEvent",%s,%s]);'
        
        $stringJs = sprintf(' _gaq.push(["_trackEvent","%s","%s"]);', $array['event'],$array['label']);
        
        return $stringJs;
    }
    public function renderSocial($array) {
        $stringJs = sprintf('_gaq.push(["_trackEvent",%s,%s])', $array['event'],$array['label']);
        
        return $stringJs;
    }
    public function renderPageView($array) {
        $stringJs = sprintf('_gaq.push(["_trackEvent",%s,%s])', $array['event'],$array['label']);
        
        return $stringJs;
    }
}