



function jDataGrid() {
    var self = this;

    this.settings = {
            
            datepicker_regional: 'cs',
            
            id: 'dataGrid',
            jid: '#dataGrid',

            viewTitle     : 'Record view',
            newRecordTitle: 'New record',
            deleteTitle   : "Delete record",
            editTitle     : "Edit record", 
            
            deleteSelectedTitle: 'Delete records',
            
        loadingText: 'Loading data ...',
        
        dialog_width: 800,
        
        
        message_timeout : 3500
    };
 
 
    
   jDataGrid.prototype.extendSettings = function(settings) {       
        $.extend(this.settings, settings);        
    };  
    
    
   jDataGrid.prototype.init = function() {       
        this.load();
        this.contentRefresh();
        /*
        $(document).bind('keydown','return',function(evt) {
             $(self.settings.jid+ ' form').submit();
        });
        */
    };  
    
    jDataGrid.prototype.resetFiltersButton = function() {
        $( this.settings.jid + ' a.dataGridResetFilters' ).click(function(e){
           e.preventDefault();
                   $(self.settings.jid + " .filterDate").each( function() {$(this).val('');} );
                   $(self.settings.jid + " .filterText").each( function() {$(this).val('');} );
                   $(self.settings.jid + " .dataGridHead select").each( function() {$(this).val('none');} );
                   $(self.settings.jid + " .dataGridHead input[type='radio']").each( function() {if( $(this).val() == 'none') this.checked = true;} );
          
        });
    };
    
    jDataGrid.prototype.loading = function() {
      $(this.settings.jid + " .dataGridContent .dataGridData").remove();
      $(this.settings.jid + " .dataGridContent .dataGridHead").last().after(
            "<tr><td colspan=\""+$(this.settings.jid + " input[name='dataGridColspan']").val()+"\" class=\"dataGridData\">"+this.settings.loadingText+"</td></tr>"
        );
    };   
    
    
    jDataGrid.prototype.getFiltersValues = function() {
       return {
        'sorting' : $(this.settings.jid + " input[name='sorting']").val(),
        'sortingCol' : $(this.settings.jid + " input[name='sortingCol']").val(),
        'limit' : $(this.settings.jid + " input[name='activePage']").val(),
        'showPerPage' : $(this.settings.jid + " input[name='showPerPage']").val()
       };
    };
    
    jDataGrid.prototype.contentRefresh = function() {
        this.addButton();
        this.actions();
        this.oddLines();
        this.paging();
        this.filters();
        this.sorting();
        this.showNextDateFilter();
        this.submit();
        this.activeLine();
        this.resetFiltersButton();
        this.perPageChooser();
        this.checkBoxes();
    };

    jDataGrid.prototype.checkBoxes = function()
    {
         $(this.settings.jid + " .dataGridCheckBoxAll").first().click(function(){            
            if( this.checked ) 
            {
                 $(self.settings.jid + " .dataGridCheckBox input").each(function(){
                     this.checked = true;
                 });
            }
            else
            {
                                    
                 $(self.settings.jid + " .dataGridCheckBox input").each(function(){
                     this.checked = false;
                 });
            }
            
                   var count = $(self.settings.jid + " .dataGridCheckBox input").filter(':checked').size();
                                    
                   $(self.settings.jid + " .dataGridCheckBoxesCount").html(count);
         });
                
                $(self.settings.jid + " .dataGridCheckBox input").click(function(){
                   
                   var count = $(self.settings.jid + " .dataGridCheckBox input").filter(':checked').size();
                                    
                   $(self.settings.jid + " .dataGridCheckBoxesCount").html(count);
                 });         
                 
                $(self.settings.jid + " .dataGridCommonActionSubmit").click(function(e){
                   e.preventDefault();
                   self.execCheckboxesAction( $(this).prev().find('select').first() );
                 });         
                 
    };
    
    jDataGrid.prototype.execCheckboxesAction = function( select ) {
        
      var checked = '';
                    
      $(self.settings.jid + " .dataGridCheckBox input").filter(':checked').each(function(){
           checked += checked != '' ? ',' + $(this).val() : $(this).val();
      });
      
      var count = $(self.settings.jid + " .dataGridCheckBox input").filter(':checked').size();
      
        switch(select.val())
        {
            case "delete":
                    
            var url = $(self.settings.jid + " input[name='checkboxesDelete']").val() + "?count=" + count + "&selected=" + checked;
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: self.settings.deleteSelectedTitle,
                            modal: true,
                            width: self.settings.dialog_width,
                            close: function(event, ui) {$(this).remove();}
                    });


                    $('a.goDelete').click(function() {
                        $.get( this.href,{},function(data){
                            if( data != "error" )
                                {
                                    self.showListInfo(data);
                                    self.load();
                                    self.contentRefresh();
                                    $(dialog).dialog('close');
                                }
                            else self.showError()
                        } );

                        return false;
                    });

                    $('a.stopDelete').click(function() {

                        $(dialog).dialog('close');

                        return false;
                    });


                });
                    
                    

                break;
            
            case "none": 
            default:
          
        }
        
       
    };
    

    jDataGrid.prototype.perPageChooser = function()
    {
         $(this.settings.jid + " input[name='showPerPage']").blur(function(){
             
             $(self.settings.jid + " input[name='activePage']").val('0');
             
             var value = $(this).val();
             $(self.settings.jid + " input[name='showPerPage']").each(function(){
                 $(this).val(value);
             });
             self.init();
         });
    };
    
    jDataGrid.prototype.activeLine = function()
    {
      var self = this;  
      $(this.settings.jid + " .dataGridData td").unbind('click').css('cursor','pointer').click(function(){
            $(this).parent().find('.dataGridDataActions a').first().trigger('click');
          return false;
      });

      $(this.settings.jid + " .dataGridDataActions").unbind('click').css('cursor','default');
      $(this.settings.jid + " .dataGridCheckBox").unbind('click').css('cursor','default');
    };
    
    jDataGrid.prototype.actions = function() {
      
      
      
      
      
      $( this.settings.jid + ' a.actionView').click(function() {
            var url = this.href;
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: self.settings.viewTitle,
                            modal: true,
                            width: self.settings.dialog_width,
                            close: function(event, ui) {$(this).remove();}
                    });
                    self.bindViewRecordActions();
                });
          return false;
       });
      
       $(this.settings.jid +  ' a.actionEdit').click(function() {
            var url = this.href;
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    
                    dialog.dialog({
                            title: self.settings.editTitle,
                            modal: true,
                            width: self.settings.dialog_width,
                            close: function(event, ui) {$(this).remove();}
                    });
                    self.bindEditRecordActions();
                });
          return false;
       });



       $('a.actionDelete').click(function() {
            var url = this.href;
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: self.settings.deleteTitle,
                            modal: true,
                            width: self.settings.dialog_width,
                            close: function(event, ui) {$(this).remove();}
                    });


                    $('a.goDelete').click(function() {
                        $.get( this.href,{},function(data){
                            if( data != "error" )
                                {
                                    self.showListInfo(data);
                                    self.load();
                                    self.contentRefresh();
                                    $(dialog).dialog('close');
                                }
                            else self.showError()
                        } );

                        return false;
                    });

                    $('a.stopDelete').click(function() {

                        $(dialog).dialog('close');

                        return false;
                    });


                });
            return false;
      });
      
    };

    jDataGrid.prototype.bindViewRecordActions = function() {
       $("#tabs").tabs();
    };
    
    jDataGrid.prototype.load = function() {
        this.loading();
        $.post( $(this.settings.jid + " input[name='dataGridSource']").val(),
            this.getFiltersValues(), function(data) {
                
                $(self.settings.jid + " .dataGridContent").html(data);
                self.contentRefresh();
            }
        );
    };
    
    jDataGrid.prototype.paging = function() {
      $(this.settings.jid + " .paging").unbind('click').click(function(event){
          event.preventDefault();
          self.loading();
          $(self.settings.jid+ " input[name='activePage']").val($(this).attr('rel'));
          $.post( this.href,self.getFiltersValues()
            , function(data) {
                $(self.settings.jid+ " .dataGridContent").html(data);
                self.contentRefresh();
            });
      });
      $(this.settings.jid + " .pagingActive").click(function(event){
          event.preventDefault();
      });
    };
    
    jDataGrid.prototype.filters = function() {        
        $.datepicker.setDefaults( $.datepicker.regional[ this.settings.datepicker_regional ]);
        $(this.settings.jid + " .filterDate").datepicker({
			changeMonth: true,
			changeYear: true
		}).keypress(function(event){
            
            if ( event.which == 13 ) {
                 event.preventDefault();
                 self.load();
            }
        });
        
        $(this.settings.jid + " .filterText").each( function() {

          var collum = this.id.replace( self.settings.id + "_","" );
          var value  = $(this).val();
          
          $(this).autocomplete({

			source: function( request, response ) {
				$.ajax({
					url:$(self.settings.jid+ " input[name='dataGridAutocomplete']").val() ,
					dataType: "json",
					data: {
						collum: collum,
                                                value: request.term
					},
					success: function( data ) {
						response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			}
                        
		});
        }).keypress(function(event){
            
            if ( event.which == 13 ) {
                 event.preventDefault();
                 self.load();
            }
        });

        var options = {
         success:  this.filtersLoad,
         beforeSubmit: function(arr, $form, options) {
            self.loading();
         },
         dataType:  'html'
        };
        $( this.settings.jid + " .dataGridFilters").ajaxForm(options);
    };

    jDataGrid.prototype.filtersLoad = function(data) {
                $(self.settings.jid+ " .dataGridContent").html(data);
                self.contentRefresh();
    };



    jDataGrid.prototype.showNextDateFilter = function() {
        $(this.settings.jid + ' .dataGridShowNextDateFilter').css('cursor','pointer').click(function(){
           $(this).parent().parent().next().show();
        });
    };

    jDataGrid.prototype.submit = function() {
        $(this.settings.jid + ' .dataGridSubmitButton').css('cursor','pointer').click(function(){
             $(self.settings.jid+ ' form').submit();
        });
    };      
       
    jDataGrid.prototype.sorting = function() {
        
        $(this.settings.jid + " .dataGridSortUp, " + this.settings.jid + " .dataGridSortDown").each(function(){

                    if( $(this).parent().hasClass('ui-state-hover') )
                        {
                            
                        
            var filterName = $(this).parent().parent().attr('class');
            var eqCurrent = $(self.settings.jid+ " tr").first().next().find("td."+filterName).first().index();
            
                $(self.settings.jid + " tr.dataGridData").each(function(){

                        $(this).find("td").eq( eqCurrent ).addClass('dataGridSelectedCollum');
                });
                        
                        }
              
        });

        
        
        
        $(this.settings.jid + " .dataGridSortUp").css('cursor','pointer').click(function(){
            self.loading();
            
            var filterName = $(this).parent().parent().attr('class');
            var eqCurrent = $(self.settings.jid+ " tr").first().next().find("td."+filterName).first().index();
            $(self.settings.jid+ " input[name='sorting']").val("ASC");
            $(self.settings.jid+ " input[name='sortingCol']").val( filterName );
            
            $.post( $(self.settings.jid+ " input[name='dataGridSource']").val() + "?sorting=ASC&sortingCol="+filterName,
                self.getFiltersValues(), function(data) {
                $(self.settings.jid+ " .dataGridContent").html(data);                
                $(self.settings.jid + " tr.dataGridData").each(function(){
                    
                    $(this).find("td").eq( eqCurrent ).addClass('dataGridSelectedCollum');
                });
                self.contentRefresh();
              }
            );

        });
        $(this.settings.jid + " .dataGridSortDown").css('cursor','pointer').click(function(){
            self.loading();
           
            var filterName = $(this).parent().parent().attr('class');
            var eqCurrent = $(self.settings.jid+ " tr").first().next().find("td."+filterName).first().index();
            
            $(self.settings.jid+ " input[name='sorting']").val("DESC");
            $(self.settings.jid+ " input[name='sortingCol']").val( filterName );
            $.post( $(self.settings.jid+ " input[name='dataGridSource']").val() + "?sorting=DESC&sortingCol="+filterName,
                self.getFiltersValues(), function(data) {
                $(self.settings.jid+ " .dataGridContent").html(data);
                $(self.settings.jid + " tr.dataGridData").each(function(){
                    $(this).find("td").eq( eqCurrent ).addClass('dataGridSelectedCollum');
                });
                self.contentRefresh();
              }
            );

        });
    };
    
    jDataGrid.prototype.oddLines = function() {
       $(this.settings.jid + " .dataGridData:odd").addClass('dataGridOddLine');

       $(this.settings.jid + " .dataGridData").mouseover(function() {
           $(this).addClass('dataGridActiveLine');
       }).mouseout( function() {
           $(this).removeClass('dataGridActiveLine');
       } )
    };    
    
    jDataGrid.prototype.addButton = function() {
       $(this.settings.jid + " .dataGridAddButton").css('cursor','pointer').click(function(){            
            var url = $(self.settings.jid+ " input[name='dataGridAddNewRecord']").val();
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');

            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: self.settings.newRecordTitle,
                            modal: true,
                            width: self.settings.dialog_width,
                            close: function(event, ui) {$(this).remove();}
                    });
                    self.bindNewRecordActions();
                });
            return false;

          
       });
    };

    jDataGrid.prototype.bindNewRecordActions = function() {

       var options = {
         success:   this.newRecordAdd,
         dataType:  'json'
       };

        $('#dialogAddForm').ajaxForm(options);


    };
    
    
    jDataGrid.prototype.newRecordAdd = function(json) {

          $("#dialogAddForm").find(".form_err").remove();
          $("#dialogAddForm").find(".err").removeClass('err');

      if( json.processed == "ok") {
          $.get( $(self.settings.jid+ " input[name='dataGridEditRecord']").val(), {
              id : json.data
          }, function(data) {
                self.load();
                self.contentRefresh();
                $("#dialogInnerHtml").html( data );
                self.bindEditRecordActions();
                $("#tabs").tabs('select', '#tabs-2');
                self.showInfo( json.ok_msg  );
          } );
      }
      else {
                if ( typeof(json.err_elements) == 'object' ) {
                  for ( var i=0;i<json.err_elements.length;i++ ) {
                    if ( json.err_elements[i].elem_id ) {
                      $("#dialogAddForm").find("." + json.err_elements[i].elem_id)
                        .addClass('err')
                        .after('<div class="form_err">' + json.err_elements[i].err_msg + '</div>');                        
                    }
                  }
                }
        self.showError();
      }
    };

   jDataGrid.prototype.bindEditRecordActions = function() {
       var options = {
         success:   this.recordEdited,
         dataType:  'json'
       };

        $('#dialogEditForm').ajaxForm(options);
        
        $("#tabs").tabs();
        
    };


    jDataGrid.prototype.recordEdited = function(json) {

          $("#dialogEditForm").find(".form_err").remove();
          $("#dialogEditForm").find(".err").removeClass('err');

      if( json.processed == "ok") {
                self.load();
                self.contentRefresh();
                self.showInfo( json.ok_msg  );
      }
      else {
                if ( typeof(json.err_elements) == 'object' ) {
                  for ( var i=0;i<json.err_elements.length;i++ ) {
                    if ( json.err_elements[i].elem_id ) {
                      $("#dialogEditForm").find("." + json.err_elements[i].elem_id)
                        .addClass('err')
                        .after('<div class="form_err">' + json.err_elements[i].err_msg + '</div>');
                    }
                  }
                }
        self.showError();
      }
    };





   jDataGrid.prototype.hideList = function () {

        $(this.settings.jid + " .infoMessageList").first().hide();
        $(this.settings.jid + " .errorMessageList").first().hide();
   }

   jDataGrid.prototype.showListError = function () {
        $(this.settings.jid + " .infoMessageList").first().hide();
        $(this.settings.jid + " .errorMessageList").first().show();

      $('<span></span>').delay(this.settings.message_timeout).queue(function(next){
           self.hideList();
           next();
        });
        
   }


   jDataGrid.prototype.showListInfo = function (info) {
       
       $(this.settings.jid + " .infoMessageList strong").html(info);

       $(this.settings.jid + " .infoMessageList").first().show();
       $(this.settings.jid + " .errorMessageList").first().hide();
       
      $('<span></span>').delay(this.settings.message_timeout).queue(function(next){
           self.hideList();
           next();
        });
        
   }
   
   jDataGrid.prototype.showError = function()   {
        $(".infoMessage").first().hide();
        $(".errorMessage").first().show();

        setTimeout( self.hideMessages, self.settings.message_timeout);
    }


   jDataGrid.prototype.showInfo = function (info) {
       $(".infoMessage strong").first().html(info);

       $(".infoMessage").first().show();
       $(".errorMessage").first().hide();

       setTimeout( self.hideMessages, self.settings.message_timeout);
    }

   jDataGrid.prototype.hideMessages = function () {
        $(".infoMessage").first().hide();
        $(".errorMessage").first().hide();
    }
    
} //end Class jDataGrid