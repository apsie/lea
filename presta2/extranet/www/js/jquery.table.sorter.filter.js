/*

Jquery filter :icontains. Same as :contains but not casesensitive.

*/
$.expr[':'].icontains = function(obj, index, meta, stack){
    return (obj.textContent || obj.innerText || jQuery(obj).text() || '')
     .toLowerCase()
     .indexOf(meta[3].toLowerCase()) >= 0;
};

/*

Tablesorter widget to filter table rows by its content.

*/
$.tablesorter.addWidget({ 
    /*
    
    Property: id
    The widget id.
    
    */
    id: 'filter',
    
    defaults: {
        title: 'Search...'
    },
    
    /*
    
    Method: filter
    Filter the table contents by string.
    
    Parameters:
        str - {string} The string to filter on.
    
    */ 
    filter: function(table, str){
        $('tbody tr:not(:visible)', table).show();
        $('tbody tr:not(:icontains("' +str +'"))', table).hide();
        $(table).trigger('update.tablesorter.filter');
    },
    
    /*
    
    Method: init
    Constructor
    
    */
    init: function(table) {
        var _this = this; 
        
        // Merge config.
        table.config.filter = $.extend({}, this.defaults, table.config.filter);
        
        var filterName = $(table).attr('id');
        var filterId = 'jqTablesorterFilter_' +filterName;

        // Create filter input.
        var filterIn = '<div class="tablesorter tsTools"><input class="tablesorter"'
            +' title="' +table.config.filter.title +'"'
            +' id="' +filterId +'"'
            +' type="text"'
            +' name="' +filterName +'" /></div>';
            
        var filterInput = $('input#' +filterId);
        
        // Insert filter input if not already added.
        if($(filterInput).length == 0)
            $(table).before(filterIn);
        
        var filterInput = $('input#' +filterId);
        
        // Filter table on every keyup event.
        $(filterInput).bind('keyup', function(){
            _this.filter(table, $(this).val());
        });
        
        // Apply filter on every table update.
        $(table).bind('update', function(){
            _this.filter(table, $(filterInput).val());
        });
        
    },
    
    /*
    
    Method: format
    Will be called on init.
    
    */
    format: function(table){
        this.init(table);
    }
    
});
