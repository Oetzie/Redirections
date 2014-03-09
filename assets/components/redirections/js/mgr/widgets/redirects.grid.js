Redirections.grid.Redirects = function(config) {
    config = config || {};

	config.tbar = [{
        text	: _('redirections.redirect_create'),
        handler	: this.createRedirect
    }, '->', {
        xtype		: 'textfield',
        name 		: 'redirects-filter-search',
        id			: 'redirects-filter-search',
        emptyText	: _('search')+'...',
        listeners	: {
	        'change'	: {
	        	fn			: this.filter,
	        	scope		: this
	        },
	        'render'		: {
		        fn			: function(cmp) {
			        new Ext.KeyMap(cmp.getEl(), {
				        key		: Ext.EventObject.ENTER,
			        	fn		: this.blur,
				        scope	: cmp
			        });
		        },
		        scope	: this
	        }
        }
    }, {
    	xtype	: 'button',
    	id		: 'redirects-filter-clear',
    	text	: _('filter_clear'),
    	listeners: {
        	'click': {
        		fn		: this.clearFilter,
        		scope	: this
        	}
        }
    }];

    this.cm = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('redirections.old'),
            dataIndex	: 'old',
            sortable	: true,
            editable	: true,
            width		: 150,
            editor		: {
            	xtype		: 'textfield'
            }
        }, {
            header		: _('redirections.new'),
            dataIndex	: 'new',
            sortable	: true,
            editable	: true,
            width		: 100,
            fixed		: true,
            editor		: {
            	xtype		: 'textfield'
            }
        }, {
            header		: _('redirections.type'),
            dataIndex	: 'type',
            sortable	: true,
            editable	: true,
            width		: 250,
            fixed		: true,
            editor		: {
            	xtype		: 'redirections-combo-xtype'
            }
        }, {
            header		: _('redirections.active'),
            dataIndex	: 'active',
            sortable	: true,
            editable	: false,
            width		: 100,
            fixed		: true,
			renderer	: this.renderActive
        }, {
            header		: _('last_modified'),
            dataIndex	: 'editedon',
            sortable	: true,
            editable	: false,
            fixed		: true,
			width		: 200
        }, {
            header		: _('redirections.context'),
            dataIndex	: 'context',
            sortable	: true,
            hidden		: true,
            editable	: false
        }]
    });
    
    Ext.applyIf(config, {
    	cm			: this.cm,
        id			: 'redirections-grid-redirects',
        url			: Redirections.config.connectorUrl,
        baseParams	: {
        	action		: 'mgr/getList'
        },
        autosave	: true,
        save_action	: 'mgr/updateFromGrid',
        fields		: ['id', 'context', 'old', 'new', 'type', 'active', 'editedon'],
        paging		: true,
        pageSize	: MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        grouping	: true,
        groupBy		: 'context',
        singleText	: _('redirections.redirect'),
        pluralText	: _('redirections.redirects')
    });
    
    Redirections.grid.Redirects.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.grid.Redirects, MODx.grid.Grid, {
    filter: function(tf, nv, ov) {
        this.getStore().baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
    },
    clearFilter: function() {
	    this.getStore().baseParams.query = '';
	    Ext.getCmp('redirections-filter-search').reset();
        this.getBottomToolbar().changePage(1);
    },
    getMenu: function() {
        return [{
	        text	: _('redirections.redirect_update'),
	        handler	: this.updateRedirect
	    }, '-', {
		    text	: _('redirections.redirect_remove'),
		    handler	: this.removeRedirect
		 }];
    },
    createRedirect: function(btn, e) {
        if (this.createRedirectWindow) {
	        this.createRedirectWindow.destroy();
        }
        
        this.createRedirectWindow = MODx.load({
	        xtype		: 'redirections-window-redirect-create',
	        listeners	: {
		        'success'	: {
		        	fn			:this.refresh,
		        	scope		:this
		        }
	         }
        });
        
        
        this.createRedirectWindow.show(e.target);
    },
    updateRedirect: function(btn, e) {
        if (this.updateRedirectWindow) {
	        this.updateRedirectWindow.destroy();
        }
        
        this.updateRedirectWindow = MODx.load({
	        xtype		: 'redirections-window-redirect-update',
	        record		: this.menu.record,
	        listeners	: {
		        'success'	: {
		        	fn			:this.refresh,
		        	scope		:this
		        }
	         }
        });
        
        this.updateRedirectWindow.setValues(this.menu.record);
        this.updateRedirectWindow.show(e.target);
    },
    removeRedirect: function() {
    	MODx.msg.confirm({
        	title 	: _('redirections.redirect_remove'),
        	text	: _('redirections.redirect_remove_confirm'),
        	url		: this.config.url,
        	params	: {
            	action	: 'mgr/remove',
            	id		: this.menu.record.id
            },
            listeners: {
            	'success': {
            		fn		: this.refresh,
            		scope	: this
            	}
            }
    	});
    },
    renderActive: function(d, c) {
    	c.css = ('1' == d || 1 == d) ? 'green' : 'red';
    	
    	return ('1' == d || 1 == d) ? _('yes') : _('no');
    },
});

Ext.reg('redirections-grid-redirects', Redirections.grid.Redirects);

Redirections.window.CreateRedirect = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        title 		: _('redirections.redirect_create'),
        url			: Redirections.config.connectorUrl,
        baseParams	: {
            action		: 'mgr/create'
        },
        fields		: [{
        	xtype		: 'textfield',
        	fieldLabel	: _('redirections.old'),
        	description	: MODx.expandHelp ? '' : _('redirections.old_desc'),
        	name		: 'old',
        	anchor		: '100%',
        	allowBlank	: false,
        	maxLength	: 75
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.old_desc'),
            cls			: 'desc-under'
        }, {
	        xtype		: 'textfield',
            fieldLabel	: _('redirections.new'),
            description	: MODx.expandHelp ? '' : _('redirections.new_desc'),
            name		: 'new',
            anchor		: '100%',
            allowBlank	: false
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.new_desc'),
            cls			: 'desc-under'
        }, {
        	xtype		: 'redirections-combo-context',
        	fieldLabel	: _('redirections.context'),
        	description	: MODx.expandHelp ? '' : _('redirections.context_desc'),
        	name		: 'context',
        	anchor		: '100%',
        	allowBlank	: false,
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
        	html		: _('redirections.context_desc'),
        	cls			: 'desc-under'
        }, {
        	xtype		: 'redirections-combo-xtype',
        	fieldLabel	: _('redirections.type'),
        	description	: MODx.expandHelp ? '' : _('redirections.type_desc'),
        	name		: 'type',
        	anchor		: '100%',
        	allowBlank	: false,
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
        	html		: _('redirections.type_desc'),
        	cls			: 'desc-under'
        }, {
	        xtype		: 'checkbox',
            fieldLabel	: _('redirections.active'),
            description	: MODx.expandHelp ? '' : _('redirections.active_desc'),
            name		: 'active',
            inputValue	: 1,
            checked		: true
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.active_desc'),
            cls			: 'desc-under'
        }]
    });
    
    Redirections.window.CreateRedirect.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.window.CreateRedirect, MODx.Window);

Ext.reg('redirections-window-redirect-create', Redirections.window.CreateRedirect);

Redirections.window.UpdateRedirect = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        title 		: _('redirections.redirect_update'),
        url			: Redirections.config.connectorUrl,
        baseParams	: {
            action		: 'mgr/update'
        },
        fields		: [{
            xtype		: 'hidden',
            name		: 'id'
        }, {
        	xtype		: 'textfield',
        	fieldLabel	: _('redirections.new'),
        	description	: MODx.expandHelp ? '' : _('redirections.new_desc'),
        	name		: 'new',
        	anchor		: '100%',
        	allowBlank	: false,
        	maxLength	: 75
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.new_desc'),
            cls			: 'desc-under'
        }, {
	        xtype		: 'textfield',
            fieldLabel	: _('redirections.old'),
            description	: MODx.expandHelp ? '' : _('redirections.old_desc'),
            name		: 'old',
            anchor		: '100%',
            allowBlank	: false
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.old_desc'),
            cls			: 'desc-under'
        }, {
        	xtype		: 'redirections-combo-context',
        	fieldLabel	: _('redirections.context'),
        	description	: MODx.expandHelp ? '' : _('redirections.context_desc'),
        	name		: 'context',
        	anchor		: '100%',
        	allowBlank	: false,
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
        	html		: _('redirections.context_desc'),
        	cls			: 'desc-under'
        }, {
        	xtype		: 'redirections-combo-xtype',
        	fieldLabel	: _('redirections.type'),
        	description	: MODx.expandHelp ? '' : _('redirections.type_desc'),
        	name		: 'type',
        	anchor		: '100%',
        	allowBlank	: false,
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
        	html		: _('redirections.type_desc'),
        	cls			: 'desc-under'
        }, {
	        xtype		: 'checkbox',
            fieldLabel	: _('redirections.active'),
            description	: MODx.expandHelp ? '' : _('redirections.active_desc'),
            name		: 'active',
            inputValue	: 1
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.active_desc'),
            cls			: 'desc-under'
        }]
    });
    
    Redirections.window.UpdateRedirect.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.window.UpdateRedirect, MODx.Window);

Ext.reg('redirections-window-redirect-update', Redirections.window.UpdateRedirect);

Redirections.combo.Context = function(config) {
    config = config || {};
    
    var contexts = [];
    var _this = this;
    
    Ext.each(Redirections.config.contexts, function(context) {
    	contexts.push([context.key]);
    });
    
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
            mode	: 'local',
            fields	: ['label'],
            data	: contexts
        }),
        remoteSort	: ['label', 'asc'],
        hiddenName	: 'context',
        valueField	: 'label',
        displayField: 'label',
        mode		: 'local',
        value		: contexts[0]
    });
    
    Redirections.combo.Context.superclass.constructor.call(this,config);
};

Ext.extend(Redirections.combo.Context, MODx.combo.ComboBox);

Ext.reg('redirections-combo-context', Redirections.combo.Context);

Redirections.combo.RedirectTypes = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
            mode	: 'local',
            fields	: ['type','label'],
            data	: [
                ['301', 'HTTP/1.1 301 Moved Permanently'],
               	['302', 'HTTP/1.1 302 Found'],
               	['303', 'HTTP/1.1 303 See Other']
            ]
        }),
        remoteSort	: ['label', 'asc'],
        hiddenName	: 'type',
        valueField	: 'label',
        displayField: 'label',
        mode		: 'local',
        value		: 'HTTP/1.1 301 Moved Permanently'
    });
    
    Redirections.combo.RedirectTypes.superclass.constructor.call(this,config);
};

Ext.extend(Redirections.combo.RedirectTypes, MODx.combo.ComboBox);

Ext.reg('redirections-combo-xtype', Redirections.combo.RedirectTypes);