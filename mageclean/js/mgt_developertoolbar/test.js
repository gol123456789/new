$(function($,document,undefined){
   
    var tabatas = function(config){
        var conf = $.extend({},this.config, config);
        this.config = conf;
        var form = $('#'+this.config.formId);
       
        $.data(form,'tabata',this);
        $().tabata.active(this.config.formId, form, true);
        this.init();
    };
    tabatas.prototype.config = {
        formId: 'tabataForm',
        circuits: 2,  
        circuit_break: 20,
        round_time: 10,
        round_rest: 5,
        exercises: [ {
            title: 'press up',
            vid_id: null,
            vid_routine_pos: 1
        }],
        currentRound: 0,
        currentCircuit: 1,
        currentPhase: null, 
        decrement: null,
        setVids: true,
        playingVid: null,
        phases: {
            round: {
                htmlSel: '#activeSpan' 
            },
            rest: {
                htmlSel: '#restSpan'  
            },
            cycleBreak: {
                htmlSel: '#restSpan'  
            }
        }
    };
    tabatas.prototype.init = function(){
        this.setFormData();
        this.bindControls();
        
    }
    tabatas.prototype.bindControls = function(){
        $('#form-start').click(this.start);
        $('#form-pause').click(this.pause);
        $('#form-reset').click(this.reset);
    }
    tabatas.prototype.setFormData = function(){
        $('#time').val(this.config.round_time);
        $('#rest').val(this.config.round_rest);
        $('#circuits').val(this.config.circuits);
        $('#break').val(this.config.circuit_break);
        var exercises = this.config.exercises;
        var formId = this.config.formId;
        if (exercises){
            $.each(exercises, this.createExerciseNode);
                
        }
    }
    
        
    
    tabatas.prototype.createExerciseNode = function(pos, obj){
        
        var elem =  $('<p>').html(obj.title).attr('vid_id', obj.vid_id).attr('title', obj.title).attr('pos', obj.vid_routine_pos);
        $.data(elem, obj);
        //  console.log($.data(elem, 'name'));
        // var div =$('#exerciseDiv');
        elem.appendTo($('#exerciseDiv'));
    }
    $.fn.tabata = function(config){
       
        return new tabatas(config);
    // console.log(form);
    };
    $.fn.tabata.playerReady = 0;
    // getter setter remembering active tabata forms
    $.fn.tabata.active = function(id, form, retAsDef) {
        if (retAsDef){
            $.fn.tabata.active.useThis = id;
        }
        if (form){
            $.fn.tabata.activeTabs[id] = form ;
        } 
        if (!id){
            if ($.fn.tabata.activeTabs[ $.fn.tabata.active.useThis]){
                return $.fn.tabata.activeTabs[ $.fn.tabata.active.useThis];
            } 
        }
        if ($.fn.tabata.activeTabs[id]){
            return $.fn.tabata.activeTabs[id];
        } else {
            return false; 
        }
            
    }
    $.fn.tabata.activeTabs = {};
    $.fn.tabata.decrement = function(id) { 
       
        var obj = $.data(this.active(id),'tabata');
        console.log(obj.config.currentPhase);
        var sel = obj.config.phases[obj.config.currentPhase].htmlSel;
        if(obj.config.decrement) {
            obj.config.decrement -= 1;                   
            $(sel).html(obj.config.decrement);
        } else {           
            obj.config.timer.stop();        
            this.decrementEnded(obj);
        }
    };
    $.fn.tabata.decrementEnded = function(obj) { 
        var rounds =$("#exerciseDiv").children('p');
        var totalRounds = rounds.length;
        var phase = obj.config.currentPhase;
        if (phase==='round'){
            obj.config.playingVid.destroy();
        }
        var cr = obj.config.currentRound + 1;
        if (cr > totalRounds && phase == 'round' ) {
            obj.config.currentRound = 0;
            
            var cycles = $('#circuits').val();
            if (obj.config.currentCircuit < cycles ) {
                // onemore...
               
                obj.startCycleBreak(obj);
            } else {
                //  obj.finished();
                console.log('finito')
            }
        } else {
            if(phase === 'rest') {
                
                obj.startRound(obj);
            } else {
                
                obj.startRest(obj);
                
            }
            
        }
        
    }
    tabatas.prototype.startCycleBreak = function(obj) {
        var cc = obj.config.currentCircuit += 1;
        console.log(cc);
        obj.warnNewCycle();
        obj.startRest(obj,true);
    }
    tabatas.prototype.warnNewCycle = function(){
        
    }
    tabatas.prototype.checkEndCycle = function(obj) {
        var number =$('#exerciseDiv').length;
        if( obj.config.currentRound === number){
            obj.config.currentRound += 1;
            return true;
        } else {
            return false;
        }
    }
    tabatas.prototype.startRest = function(obj, cycle) {
        /*
      var cE = obj.checkEndCycle(obj);
       if (cE){
           return  $.fn.tabata.decrementEnded(obj);
        }
        */
        obj.config.currentPhase = 'rest';
        if (cycle){
            var time = $('#break').val();
        } else {
            var time = $('#rest').val();  
        }
        obj.config.decrement = time;
        var id = obj.config.formId;
        console.log(obj);
        var timer = obj.config.timer = $.timer(function(){
            $.fn.tabata.decrement(id);
        });
        timer.set({
            time : 1000, 
            autostart : true
        });
        obj.prepareNextRound(obj);
        
    }
    tabatas.prototype.start = function(e){
        // prevent any default html events
        e.preventDefault();
        // assume elem is child of form and get parent id
        var formId = $( e.target ).closest("form").attr('id');
        // use helper method to get form object and ass data
        var form = $().tabata.active(formId) ;
        var tabataInstance = ($.data(form,'tabata'));
        if (tabataInstance){
            if(!tabataInstance.config.currentPhase) {
                tabataInstance.config.currentPhase = 'round';
                console.log(tabataInstance.config);
                tabataInstance.prepareNextRound(tabataInstance)
                tabataInstance.startRound(tabataInstance);
            } else {
                tabataInstance.config.timer.play();
            }
        }
    };
    tabatas.prototype.pause = function(e){
        e.preventDefault();
        var formId = $( e.target ).closest("form").attr('id');
        // use helper method to get form object and ass data
        var form = $().tabata.active(formId) ;
        var tabataInstance = ($.data(form,'tabata'));
        tabataInstance.config.timer.pause();
    };
    tabatas.prototype.reset = function(){
        
    };
    tabatas.prototype.prepareNextRound = function(obj){ 
        obj.config.currentRound += 1;
        var currentRound = obj.config.currentRound;
        var cycle = obj.config.currentCircuit;
        var exerElem =$("#exerciseDiv").children('p')[currentRound-1];
        var jElem = $(exerElem);
        var name = jElem.attr('title');
        var vidId = jElem.attr('vid_id');
        console.log(name);
        this.setVid(obj, vidId);
        this.setRoundName(name);
    }
    tabatas.prototype.startRound = function(obj){
        //moved  obj.config.currentRound += 1;
        obj.config.currentPhase = 'round'
        /*
     var currentRound = obj.config.currentRound;
        var cycle = obj.config.currentCycle;
        var exerElem =$("#exerciseDiv").children('p')[currentRound-1];
        var jElem = $(exerElem);
        var name = jElem.attr('name');
        var vidId = jElem.attr('vidId');
        console.log(name);
        this.setVid(obj, vidId);
        this.setRoundName(name);
        */
        if (typeof obj.config.playingVid.playVideo === 'function'){
            obj.config.playingVid.playVideo();
        } else {
            obj.config.playingVidDelayed = true;
        }
        this.startRoundTimer();
        
    }
    tabatas.prototype.onPlayerReady = function() {
        console.log($.fn.tabata.activeTabs)
        var   obj = $.fn.tabata.active();
      
        obj = $.data(obj,'tabata');
        console.log(obj);
        if (typeof obj.config.playingVid.playVideo === 'function'){
            obj.config.playingVid.playVideo();
        } 
        if (obj.config.playingVidDelayed === null) {
            obj.config.playingVid.pauseVideo();
        }
    }
    tabatas.prototype.onPlayerStateChange = function(event) {
        if (event.data == YT.PlayerState.ENDED) {
            
            var   obj = $.fn.tabata.active();
      
            obj = $.data(obj,'tabata');
           
             obj.config.playingVid.playVideo();
        
        }
    }
    tabatas.prototype.setVid = function(obj, vidId){
        if(obj.config.setVids){
            if($.fn.tabata.playerReady === true && vidId) {
                obj.config.playingVidDelayed = null;
                obj.config.playingVid = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: vidId,
                    events: {
                        'onReady': obj.onPlayerReady,
                        'onStateChange': obj.onPlayerStateChange
                    }
                });
            }
        }
    }
    tabatas.prototype.setRoundName = function(name){
        $('#thisRoundName').html(name);
    }
    tabatas.prototype.startRoundTimer = function(){
        var roundTime = $().tabata.active(this.config.formId).children('#time').val();
        this.config.decrement = roundTime;
        
        var id = this.config.formId;
        // console.log(roundTime);
        $('#active').html(roundTime);
        var timer = this.config.timer = $.timer(function(){
            $.fn.tabata.decrement(id);
        });
        timer.set({
            time : 1000, 
            autostart : true
        });
    }
  
}(jQuery,document));
jQuery(function(){

    var tag = document.createElement('script');

    // This is a protocol-relative URL as described here:
    //     http://paulirish.com/2010/the-protocol-relative-url/
    // If you're testing a local page accessed via a file:/// URL, please set tag.src to
    //     "https://www.youtube.com/iframe_api" instead.
    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
});

function onYouTubeIframeAPIReady() {
    console.log('iframeApiReady')
    jQuery.fn.tabata.playerReady = true;
}

