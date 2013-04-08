<?php

class My_Mod_Helper_JsHelp extends Mage_Core_Helper_Abstract {
    
    
    public function renderHideShow() {
        $hideShowJs = " <script>
      document.observe(\"dom:loaded\", function() {
          $$('.stack').each(function(item){
              item.hide();
          });
          $$('.result').each(function(item){
              item.hide();
          });
          $$('.hideall').each(function(item){
              item.observe('click', function(e){
                  $$('.stack').each(function(item){
              
             item.hide();
         
          }); // close stack 
                  
              }); // close item.observe
          }); // close hideshowall
          $$('.showall').each(function(item){
              item.observe('click', function(e){
                  $$('.stack').each(function(item){
              
             item.show();
         
          }); // close stack 
                  
              }); // close item.observe
          }); // close hideshowall
      
              
         
    $$('.hideshow').each(function(item){
        
        item.observe('click', function(e){
                  
         var elem = e.element();         
         var nexts = elem.nextSiblings(elem);         
         var nextt = nexts[0];     
        
         if (!nextt.visible()){
             console.log('show');
             nextt.show();
         } else {
             console.log('hide');
             nextt.hide();
         }
         
     }); // close item.
    
    });   // close hideshow 
     
     }); // close dom:loaded
 </script>";
        return $hideShowJs;
    }
    
    
}