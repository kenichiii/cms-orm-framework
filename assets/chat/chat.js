(function(window, $){
  $(function(){
    
    var chat = {
      cname: 'designochat',
      
      setCookie: function(cvalue, exdays) {
    	var cname = this.cname;
        var d = new Date();
    	d.setTime(d.getTime() + (exdays*24*60*60*1000));
    	var expires = "expires="+d.toUTCString();
    	document.cookie = cname + "=" + cvalue + "; " + expires;
	  },
        
      getCookie: function() {
    	var cname = this.cname;
        var name = cname + "=";
    	var ca = document.cookie.split(';');
    	for(var i = 0; i <ca.length; i++) {
        	var c = ca[i];
        	while (c.charAt(0)==' ') {
            	c = c.substring(1);
        	}
        	if (c.indexOf(name) == 0) {
            	return c.substring(name.length,c.length);
        	} else {
                return null;
            }
    	}
    	return "";
	  },
      
      
      template: '<a style="display:none" id="start-chat" href="#chat"><span>Potřebujete s něčím poradit?</span><span>IMG</span></a>'
      + '<div id="online-chat" style="display:none">'
      +    '<div><span>ONLINE CHAT</span><a id="close-chat" href="#">_</a></div>'
      +    '<div id="chat-panel"></div>'
      +    '<div>'
      +      '<form action="/chat/new-message.action" method="post">'
      +          '<input type="hidden" name="chat_id" value="new">'
      +          '<textarea name="message" id="new-message-area"></textarea>'
      +          '<button>ODESLAT</button>'
      +      '</form>'
      +    '</div>'
      +  '</div>',
      
      
      
      
      init: function() {
        
        //add chat template to html
        $('body').append(this.template);
        
        //bind start-chat listeners
        
        
        //bind online-chat listeners
        
        
        //check cookies if is open or not
        if (this.getCookie() !== null) {
           //show messages window
          
           //start message checker
          
        } else {
           //show start-chat panel
          
        }                
      }
    };
    
    chat.init();
    
  });      
})(window, jQuery);