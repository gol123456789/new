
/**
 * Controller of order review form that may select shipping method
 */
ClassManager = Class.create();
ClassManager.prototype = {
    
    _data : null,
    _placeHolder: null,
    
    /*
     */
    initialize : function(data)
    {
        if (!data) {
            console.log('you developer has fucked up');
            return;
        }
        this._data = $H(data);
     //   this.getPlaceHolder();
        this.startProcess(this._data);
        new classmanagerhideshow();
       
          //  Event.observe(orderFormSubmit, 'click', this._submitOrder.bind(this));
       //    this._submitShipping.bindAsEventListener(this, shippingSubmitForm.action, shippingResultId)
          
    },
    getPlaceHolder : function()
    {
        this._placeHolder = $('classPlaceHolder');
        return this._placeHolder;
    },

    /**
     * Register element that should show up when ajax request is in progress
     * @param element
     */
    startProcess : function(data)
    {
        this._data.each(function(n){
          this.render(n);  
        }.bind(this));
    },
    render : function (topNode)
    {
       var nodePlace = this.renderTop(topNode);
       this.renderArr(topNode, nodePlace);
    },

    /**
     * 
     * @param associative array
     */
    renderTop : function(topNode)
    {
        var placeholder = this.getPlaceHolder();
        var topNodeDiv = this.createTopNodeDiv(topNode.key);
        placeholder.insert(topNodeDiv);
        return topNodeDiv;
    },
    createTopNodeDiv : function(key)
    {
       var container =  new Element('div', {'class': 'topleveldiv'});
       var label = new Element('span', {'class': 'label'}).update(key);
       container.insert(label);
       return label;
    },

    /**
     
     */
    renderArr : function(topnode, nodePlace)
    {
        topnode.value.each(function(b){console.log(b)});
        topnode.value.each(function(y){
        this.renderArrLi(y, nodePlace)
            }.bind(this));
    },

    /**
     * Set event observer to copy data from shipping address to billing
     * @param element
     */
   renderArrLi : function(y, nodePlace)
    {
        var el = new Element('li', {'class': 'classnode'}).update(y);
        nodePlace.insert(el);
    }

}