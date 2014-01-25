Ext.onReady(function() {
	MODx.load({xtype: 'redirections-page-home'});
});

Redirections.page.Home = function(config) {
	config = config || {};
	
	config.buttons = [{
		text		: _('help_ex'),
		handler		: MODx.loadHelpPane,
		scope		: this
	}];
	
	Ext.applyIf(config, {
		components	: [{
			xtype		: 'redirections-panel-home',
			renderTo	: 'redirections-panel-home-div'
		}]
	});
	
	Redirections.page.Home.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.page.Home, MODx.Component);

Ext.reg('redirections-page-home', Redirections.page.Home);