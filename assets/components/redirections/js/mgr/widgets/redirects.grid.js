Redirections.grid.Redirects = function(config) {
    config = config || {};

	config.tbar = [{
        text		: _('redirections.redirect_create'),
        cls			: 'primary-button',
        handler		: this.createRedirect,
        scope		: this
   }, {
		text		: _('bulk_actions'),
		menu		: [{
			text		: _('redirections.redirects_reset'),
			handler		: this.resetRedirects,
			scope		: this
		}]
	}, '->', {
        xtype		: 'textfield',
        name 		: 'redirections-filter-search',
        id			: 'redirections-filter-search',
        emptyText	: _('search')+'...',
        listeners	: {
	        'change'	: {
	        	fn			: this.filterSearch,
	        	scope		: this
	        },
	        'render'	: {
		        fn			: function(cmp) {
			        new Ext.KeyMap(cmp.getEl(), {
				        key		: Ext.EventObject.ENTER,
			        	fn		: this.blur,
				        scope	: cmp
			        });
		        },
		        scope		: this
	        }
        }
    }, {
    	xtype		: 'button',
    	cls			: 'x-form-filter-clear',
    	id			: 'redirections-filter-clear',
    	text		: _('filter_clear'),
    	listeners	: {
        	'click'		: {
        		fn			: this.clearFilter,
        		scope		: this
        	}
        }
    }];
    
    columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('redirections.label_old'),
            dataIndex	: 'old',
            sortable	: true,
            editable	: true,
            width		: 150,
            editor		: {
            	xtype		: 'textfield'
            }
        }, {
            header		: _('redirections.label_new'),
            dataIndex	: 'new',
            sortable	: true,
            editable	: true,
            width		: 100,
            fixed		: true,
            editor		: {
            	xtype		: 'textfield'
            }
        }, {
            header		: _('redirections.label_type'),
            dataIndex	: 'type',
            sortable	: true,
            editable	: true,
            width		: 250,
            fixed		: true,
            editor		: {
            	xtype		: 'redirections-combo-xtype'
            }
        }, {
            header		: _('redirections.label_active'),
            dataIndex	: 'active',
            sortable	: true,
            editable	: true,
            width		: 100,
            fixed		: true,
			renderer	: this.renderBoolean,
			editor		: {
            	xtype		: 'modx-combo-boolean'
            }
        }, {
            header		: _('last_modified'),
            dataIndex	: 'editedon',
            sortable	: true,
            editable	: false,
            fixed		: true,
			width		: 200,
			renderer	: this.renderDate
        }, {
            header		: _('context'),
            dataIndex	: 'context',
            sortable	: true,
            hidden		: true,
            editable	: false
        }]
    });
    
    Ext.applyIf(config, {
    	cm			: columns,
        id			: 'redirections-grid-redirects',
        url			: Redirections.config.connector_url,
        baseParams	: {
        	action		: 'mgr/redirects/getlist',
        	context		: MODx.request.context || MODx.config.default_context
        },
        autosave	: true,
        save_action	: 'mgr/redirects/updatefromgrid',
        fields		: ['id', 'context', 'context_name', 'old', 'new', 'type', 'active', 'editedon'],
        paging		: true,
        pageSize	: MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        sortBy		: 'id'
    });
    
    Redirections.grid.Redirects.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.grid.Redirects, MODx.grid.Grid, {
    filterSearch: function(tf, nv, ov) {
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
	        closeAction	: 'close',
	        listeners	: {
		        'success'	: {
		        	fn			: this.refresh,
		        	scope		: this
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
	        closeAction	: 'close',
	        listeners	: {
		        'success'	: {
		        	fn			: this.refresh,
		        	scope		: this
		        }
	        }
        });
        
        this.updateRedirectWindow.setValues(this.menu.record);
        this.updateRedirectWindow.show(e.target);
    },
    removeRedirect: function(btn, e) {
    	MODx.msg.confirm({
        	title 		: _('redirections.redirect_remove'),
        	text		: _('redirections.redirect_remove_confirm'),
        	url			: Redirections.config.connector_url,
        	params		: {
            	action		: 'mgr/redirects/remove',
            	id			: this.menu.record.id
            },
            listeners	: {
            	'success'	: {
            		fn			: this.refresh,
            		scope		: this
            	}
            }
    	});
    },
    resetRedirects: function(btn, e) {
    	MODx.msg.confirm({
        	title 		: _('redirections.redirects_reset'),
        	text		: _('redirections.redirects_reset_confirm'),
        	url			: Redirections.config.connector_url,
        	params		: {
            	action		: 'mgr/redirects/reset',
				context		: MODx.request.context || MODx.config.default_context
            },
            listeners	: {
            	'success'	: {
            		fn			: this.refresh,
            		scope		: this
            	}
            }
    	});
    },
    renderBoolean: function(d, c) {
    	c.css = 1 == parseInt(d) || d ? 'green' : 'red';
    	
    	return 1 == parseInt(d) || d ? _('yes') : _('no');
    },
	renderDate: function(a) {
        if (Ext.isEmpty(a)) {
            return '—';
        }

        return a;
    }
});

Ext.reg('redirections-grid-redirects', Redirections.grid.Redirects);

Redirections.window.CreateRedirect = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
	    width		: 400,
    	autoHeight	: true,
        title 		: _('redirections.redirect_create'),
        url			: Redirections.config.connector_url,
        baseParams	: {
            action		: 'mgr/redirects/create'
        },
        fields		: [{
        	layout		: 'column',
        	border		: false,
            defaults	: {
                layout		: 'form',
                labelSeparator : ''
            },
        	items		: [{
	        	columnWidth	: .85,
	        	items		: [{
			        xtype		: 'textfield',
		            fieldLabel	: _('redirections.label_old'),
		            description	: MODx.expandHelp ? '' : _('redirections.label_old_desc'),
		            name		: 'old',
		            anchor		: '100%',
		            allowBlank	: false
		        }, {
		        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
		            html		: _('redirections.label_old_desc'),
		            cls			: 'desc-under'
		        }]
	        }, {
		        columnWidth	: .15,
		        style		: 'margin-right: 0;',
		        items		: [{
			        xtype		: 'checkbox',
		            fieldLabel	: _('redirections.label_active'),
		            description	: MODx.expandHelp ? '' : _('redirections.label_active_desc'),
		            name		: 'active',
		            inputValue	: 1,
		            checked		: true
		        }, {
		        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
		            html		: _('redirections.label_active_desc'),
		            cls			: 'desc-under'
		        }]
	        }]	
	    }, {
        	xtype		: 'textfield',
        	fieldLabel	: _('redirections.label_new'),
        	description	: MODx.expandHelp ? '' : _('redirections.label_new_desc'),
        	name		: 'new',
        	anchor		: '100%',
        	allowBlank	: false
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.label_new_desc'),
            cls			: 'desc-under'
        }, {
        	xtype		: 'redirections-combo-xtype',
        	fieldLabel	: _('redirections.label_type'),
        	description	: MODx.expandHelp ? '' : _('redirections.label_type_desc'),
        	name		: 'type',
        	anchor		: '100%',
        	allowBlank	: false
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
        	html		: _('redirections.label_type_desc'),
        	cls			: 'desc-under'
        }, {
	    	layout		: 'form',
	    	labelSeparator : ''	,
	    	hidden		: Redirections.config.context,
	    	items		: [{
	        	xtype		: 'modx-combo-context',
	        	fieldLabel	: _('redirections.label_context'),
	        	description	: MODx.expandHelp ? '' : _('redirections.label_context_desc'),
	        	name		: 'context',
	        	anchor		: '100%',
				baseParams	: {
					action		: 'context/getlist',
					exclude		: 'mgr'
				}
	        }, {
	        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
	        	html		: _('redirections.label_context_desc'),
	        	cls			: 'desc-under'
	        }]
	    }]
    });
    
    Redirections.window.CreateRedirect.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.window.CreateRedirect, MODx.Window);

Ext.reg('redirections-window-redirect-create', Redirections.window.CreateRedirect);

Redirections.window.UpdateRedirect = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
	    width		: 400,
    	autoHeight	: true,
        title 		: _('redirections.redirect_update'),
        url			: Redirections.config.connector_url,
        baseParams	: {
            action		: 'mgr/redirects/update'
        },
        fields		: [{
            xtype		: 'hidden',
            name		: 'id'
        }, {
        	layout		: 'column',
        	border		: false,
            defaults	: {
                layout		: 'form',
                labelSeparator : ''
            },
        	items		: [{
	        	columnWidth	: .85,
	        	items		: [{
			        xtype		: 'textfield',
		            fieldLabel	: _('redirections.label_old'),
		            description	: MODx.expandHelp ? '' : _('redirections.label_old_desc'),
		            name		: 'old',
		            anchor		: '100%',
		            allowBlank	: false
		        }, {
		        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
		            html		: _('redirections.label_old_desc'),
		            cls			: 'desc-under'
		        }]
	        }, {
		        columnWidth	: .15,
		        style		: 'margin-right: 0;',
		        items		: [{
			        xtype		: 'checkbox',
		            fieldLabel	: _('redirections.label_active'),
		            description	: MODx.expandHelp ? '' : _('redirections.label_active_desc'),
		            name		: 'active',
		            inputValue	: 1
		        }, {
		        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
		            html		: _('redirections.label_active_desc'),
		            cls			: 'desc-under'
		        }]
	        }]	
	    }, {
        	xtype		: 'textfield',
        	fieldLabel	: _('redirections.label_new'),
        	description	: MODx.expandHelp ? '' : _('redirections.label_new_desc'),
        	name		: 'new',
        	anchor		: '100%',
        	allowBlank	: false
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('redirections.label_new_desc'),
            cls			: 'desc-under'
        }, {
        	xtype		: 'redirections-combo-xtype',
        	fieldLabel	: _('redirections.label_type'),
        	description	: MODx.expandHelp ? '' : _('redirections.label_type_desc'),
        	name		: 'type',
        	anchor		: '100%',
        	allowBlank	: false
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
        	html		: _('redirections.label_type_desc'),
        	cls			: 'desc-under'
        }, {
	    	layout		: 'form',
	    	labelSeparator : '',
	    	hidden		: Redirections.config.context,
	    	items		: [{
	        	xtype		: 'modx-combo-context',
	        	fieldLabel	: _('redirections.label_context'),
	        	description	: MODx.expandHelp ? '' : _('redirections.label_context_desc'),
	        	name		: 'context',
	        	anchor		: '100%',
				baseParams	: {
					action		: 'context/getlist',
					exclude		: 'mgr'
				}
	        }, {
	        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
	        	html		: _('redirections.label_context_desc'),
	        	cls			: 'desc-under'
			}]
	    }]
	});
    
    Redirections.window.UpdateRedirect.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.window.UpdateRedirect, MODx.Window);

Ext.reg('redirections-window-redirect-update', Redirections.window.UpdateRedirect);

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