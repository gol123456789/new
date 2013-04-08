
classmanagerhideshow = Class.create();
classmanagerhideshow.prototype = {
    
    _labels : null, 
    
     initialize : function() {
        this._labels = $$('.label');
        this.hideclassnodes();
        this.bindhideshowobservers();
        
     },
     
     hideclassnodes : function(){
         $$('.classnode').each(function(y){
           y.hide();  
         })
     },
     
     bindhideshowobservers : function () {
         console.log(this._labels);
         console.log(1);
         alert(this._labels);
         $$('.label').each(this.HSO.bind(this))
     },
     
     HSO : function (y) {
         alert(1);
         alert(y);
          y.observe('click',this.HSfunction.bind(this))  
     },
     
     HSfunction : function(e) {
         var el = Event.element(e);
         var children = el.childElements();
         children.each(this.change.bind(this))
     },
     
     change : function(h) {
         if(h.visible()){
            h.hide();
         } else {
            h.show();
         }
     }
     
    
}
