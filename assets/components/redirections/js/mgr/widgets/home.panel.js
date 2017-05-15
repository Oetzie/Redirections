Redirections.panel.Home = function(config) {
	config = config || {};
	
    Ext.apply(config, {
        id			: 'redirections-panel-home',
        cls			: 'container',
        items		: [{
            html		: '<h2>'+_('redirections')+'</h2>',
            id			: 'redirections-header',
            cls			: 'modx-page-header'
        }, {
        	layout		: 'form',
            items		: [{
            	html			: '<p>' + _('redirections.redirects_desc') + '</p>',
                bodyCssClass	: 'panel-desc'
            }, {
                xtype			: 'redirections-grid-redirects',
                cls				: 'main-wrapper',
                preventRender	: true
            }]
        }]
    });

	Redirections.panel.Home.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.panel.Home, MODx.FormPanel);

Ext.reg('redirections-panel-home', Redirections.panel.Home);