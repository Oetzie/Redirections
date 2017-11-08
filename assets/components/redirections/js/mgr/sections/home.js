Ext.onReady(function() {
	MODx.load({xtype: 'redirections-page-home'});
});

Redirections.page.Home = function(config) {
	config = config || {}
	
	config.buttons = [];
	
	if (Redirections.config.branding_url) {
		config.buttons.push({
			text 		: 'Redirections ' + Redirections.config.version,
			cls			: 'x-btn-branding',
			handler		: this.loadBranding
		});
	}
	
	if (!Redirections.config.migrate) {
		config.buttons.push({
			text		: _('redirections.migrate_redirections'),
			cls			: 'x-btn-migrate',
			handler		: this.migrateRedirections
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
    });
    
    if (Redirections.config.branding_url_help) {
	    config.buttons.push({
			text		: _('help_ex'),
			handler		: MODx.loadHelpPane,
			scope		: this
		});
	}
	
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
	},
	migrateRedirections: function(btn) {
		MODx.msg.confirm({
        	title 		: _('redirections.migrate_redirections'),
        	text		: _('redirections.migrate_redirections_confirm'),
        	url			: Redirections.config.connector_url,
        	params		: {
            	action		: 'mgr/redirects/migrate'
            },
            listeners	: {
            	'success'	: {
            		fn			: function() {
						MODx.msg.status({
							title	: _('redirections.migrate_redirections_success'),
							message	: _('redirections.migrate_redirections_success_desc')
						});
						
						window.location.reload();
            		},
            		scope		: this
            	},
            	'failure'	: {
			    	fn 			: function(data) {
				    	MODx.msg.alert(_('warning'), data.message);
			    	},
			    	scope 		: this
		    	}
            }
    	});
	}
});

Ext.reg('redirections-page-home', Redirections.page.Home);