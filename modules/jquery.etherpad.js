(function( $ ){

  var padIdTransforms = [
    [/\s+/g, '_'],
    [/:+/g, '_']
  ];

  sanitizePadId = function(padId) {
    var transform_index = arguments[1] || 0;
    //we're out of possible transformations, so just return it                                                                                                                                                                                                                                                                  
    if(transform_index >= padIdTransforms.length)
    {
      return padId;
    }
    else
    {
      //get the next transformation *that's different*                                                                                                                                                                                                                                                                      
      var transformedPadId = padId;
      while(transformedPadId == padId && transform_index < padIdTransforms.length)
      {
        transformedPadId = padId.replace(padIdTransforms[transform_index][0], padIdTransforms[transform_index][1]);
        transform_index += 1;
      }
      //check the next transform                                                                                                                                                                                                                                                                                            
      return sanitizePadId(transformedPadId, transform_index);
    }
  }

  $.fn.pad = function( options ) {
    var settings = {
      'host'              : 'http://beta.etherpad.org',
      'baseUrl'           : '/p',
      'showControls'      : false,
      'showChat'          : false,
      'showLineNumbers'   : false,
      'userName'          : 'unnamed',
      'useMonospaceFont'  : false,
      'noColors'          : false,
      'hideQRCode'        : false,
      'width'             : 100,
      'height'            : 100,
      'border'            : 0,
      'borderStyle'       : 'solid',
      'toggleTextOn'      : 'Disable Rich-text',
      'toggleTextOff'     : 'Enable Rich-text'
    };
    
    var $self = this;
    if (!$self.length) return;
    if (!$self.attr('id')) throw new Error('No "id" attribute');
    
    var useValue = $self.is( 'textarea' );
    var selfId = $self.attr('id');
    var epframeId = 'epframe'+ selfId;
    // This writes a new frame if required
    if ( !options.getContents ) {
      if ( options ) {
        $self.data( 'ep-options', options );
        $.extend( settings, options );
      }

      settings.padId = sanitizePadId( settings.padId );
      var padUrl = settings.host+settings.baseUrl+'/'+settings.padId;

      var setupEp = function () {
        var iFrameLink = '<iframe id="'+epframeId;
            iFrameLink += '" name="'+epframeId;
            iFrameLink += '" src="'+padUrl;
            iFrameLink +=  '?showControls='+settings.showControls;
            iFrameLink +=  '&showChat='+settings.showChat;
            iFrameLink +=  '&showLineNumbers='+settings.showLineNumbers;
            iFrameLink +=  '&useMonospaceFont='+settings.useMonospaceFont;
            iFrameLink +=  '&userName=' + settings.userName;
            iFrameLink +=  '&noColors=' + settings.noColors;
            iFrameLink +=  '&hideQRCode=' + settings.hideQRCode;
            iFrameLink += '" style="border:'+settings.border;
            iFrameLink += '; border-style:'+settings.borderStyle;
  //          iFrameLink += '; width:'+settings.width;
  //          iFrameLink += '; height:'+settings.height;
            iFrameLink += ';" width="'+ '100%';//settings.width;
            iFrameLink += '" height="'+ settings.height; 
            iFrameLink += '"></iframe>';
        
        
        var $iFrameLink = $(iFrameLink);
        
        if (useValue) {
          $self.hide().after($iFrameLink);
        }
        else {      
          $self.html($iFrameLink);
        }
      };
      
      setupEp();
    }

    // This reads the etherpad contents if required
    else {
      var oldoptions = $self.data( 'ep-options' );
      
      if ( typeof oldoptions == 'object' ) {
        options = $.extend( settings, options, oldoptions );
      }

      // perform an ajax call on contentsUrl and write it to the parent
      $.ajax({
        url: mw.util.wikiScript( 'api' ),
        method: 'GET',
        data: { format: 'json', action: 'ApiEtherEditor', padId: sanitizePadId( settings.padId ) },
        success: function(data) {
          if ( typeof options.callback == 'function' ) {
            options.callback(data);
          } else {
            $self.html(data);
          }
        },
        xhrFields: {
          withCredentials: true
        },
        dataType: 'json'
      });
    }
    
    
    return $self;
  };
})( jQuery );
