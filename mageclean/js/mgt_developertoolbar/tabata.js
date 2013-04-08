$(function($,document,undefined){
    var tabata;
    $.fn.tabata = tabata = function(form){
        tabata.form = $('#'+form);
        tabata.currentRound = 1;
        tabata.time = tabata.getTime();
        tabata.rest = tabata.getRest();
        tabata.circuits = tabata.getCircuits();
        tabata.circuitBreak = tabata.getCircuitBreak();
        tabata.setEvents();
      // console.log(form);
    };
    tabata.setEvents = function(form){
       $('#form-start'));
        $('#form-pause'));
       $('#form-reset'));
    };
    tabata.bindStart = function(elem){
       elem.click(tabata.start) 
    };
    tabata.bindStop = function(elem){
       elem.click(tabata.stop); 
    };
    tabata.bindReset = function(elem){
        elem.click(tabata.reset);
    };
    tabata.start = function(){
        
    }

}(jQuery,document));