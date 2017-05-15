Ext.onReady(function() {
	MODx.load({xtype: 'redirections-page-home'});
});

Redirections.page.Home = function(config) {
	config = config || {}
	
	config.buttons = [];
	
	if (Redirections.config.branding) {
		config.buttons.push({
			text 		: 'Redirections ' + Redirections.config.version,
			cls			: 'x-btn-branding',
			handler		: this.loadBranding
		});
	}
	
	config.buttons.push({
    	xtype		: 'modx-combo-context',
    	hidden		: Redirections.config.context,
        value 		: MODx.request.context || MODx.config.default_context,
		name		: 'redirections-filter-context',
        emptyText	: _('redirections.filter_context'),
        listeners	: {
        	'select'	: {
            	fn			: this.filterContext,
            	scope		: this   
		    }
		},
		baseParams	: {
			action		: 'context/getlist',
			exclude		: 'mgr'
		}
    }, {
		text		: _('help_ex'),
		handler		: MODx.loadHelpPane,
		scope		: this
	});
	
	Ext.applyIf(config, {
		components	: [{
			xtype		: 'redirections-panel-home',
			renderTo	: 'redirections-panel-home-div'
		}]
	});
	
	Redirections.page.Home.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.page.Home, MODx.Component, {
	loadBranding: function(btn) {
		window.open(Redirections.config.branding_url);
	},
	filterContext: function(tf) {
		var request = MODx.request || {};
		
        Ext.apply(request, {
	    	'context' : tf.getValue()  
	    });
	    
        MODx.loadPage('?' + Ext.urlEncode(request));
	}
});

Ext.reg('redirections-page-home', Redirections.page.Home);