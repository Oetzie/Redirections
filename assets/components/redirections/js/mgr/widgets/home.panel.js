Redirections.panel.Home = function(config) {
    config = config || {};

    Ext.apply(config, {
        id          : 'redirections-panel-home',
        cls         : 'container',
        items       : [{
            html        : '<h2>' + _('redirections') + '</h2>',
            cls         : 'modx-page-header'
        }, {
            xtype       : 'modx-tabs',
            items       : [{
                layout      : 'form',
                title       : _('redirections.redirects'),
                items       : [{
                    html            : '<p>' + _('redirections.redirects_desc') + '</p>',
                    bodyCssClass    : 'panel-desc'
                }, {
                    xtype           : 'redirections-grid-redirects',
                    cls             : 'main-wrapper',
                    preventRender   : true,
                    refreshGrid     : 'redirections-grid-errors'
                }]
            }, {
                layout      : 'form',
                title       : _('redirections.errors'),
                items       : [{
                    html            : '<p>' + _('redirections.errors_desc') + '</p>',
                    bodyCssClass    : 'panel-desc'
                }, {
                    xtype           : 'redirections-grid-errors',
                    cls             : 'main-wrapper',
                    preventRender   : true,
                    refreshGrid     : 'redirections-grid-redirects'
                }]
            }]
        }]
    });

    Redirections.panel.Home.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.panel.Home, MODx.FormPanel);

Ext.reg('redirections-panel-home', Redirections.panel.Home);