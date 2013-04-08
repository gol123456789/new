<?php

class My_Anal_Helper_ClickTale extends Mage_Core_Helper_Abstract {

    public function renderStack(){
        return 'var ClickTaleEventBuffer = ClickTaleEventBuffer || [];';
    }

        public function renderEvent($array) {
       $eventText = " 
           var tag = '%s'+'--'+'%s';
           
function BufferedClickTaleEvent(tag) {
  if(typeof ClickTaleEvent == \"function\") {
     ClickTaleEvent(tag);
  } else {
     ClickTaleEventBuffer.push(tag);
  }
}
BufferedClickTaleEvent(tag);
setTimeout(function tagBuffer() {
  if(typeof ClickTaleEvent == \"function\") {
    for(var i = 0; i < ClickTaleEventBuffer.length; i++) {
       ClickTaleEvent(ClickTaleEventBuffer[i]);
    }
  } else {
     setTimeout(tagBuffer, 100);
  }
}, 100);";
        $stringJs = sprintf($eventText, $array['event'],$array['label']);
        
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