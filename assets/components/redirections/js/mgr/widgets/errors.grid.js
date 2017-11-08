Redirections.grid.Errors = function(config) {
    config = config || {};

	config.tbar = [{
		text		: _('bulk_actions'),
		menu		: [{
			text		: _('redirections.errors_reset'),
			handler		: this.resetErrors,
			scope		: this
		}]
	}, {
		xtype		: 'checkbox',
		name		: 'redirections-toggle-files',
        id			: 'redirections-toggle-files',
		boxLabel	: _('redirections.filter_files'),
		listeners	: {
			'check'		: {
				fn 			: this.filterFiles,
				scope 		: this	
			}
		}
	}, '->', {
        xtype		: 'textfield',
        name 		: 'redirections-filter-search-errors',
        id			: 'redirections-filter-search-errors',
        emptyText	: _('search') + '...',
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
    	id			: 'redirections-filter-clear-errors',
    	text		: _('filter_clear'),
    	listeners	: {
        	'click'		: {
        		fn			: this.clearFilter,
        		scope		: this
        	}
        }
    }];
    
    var columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('redirections.label_old'),
            dataIndex	: 'old_formatted',
            sortable	: true,
            editable	: false,
            width		: 150,
            renderer	: this.renderUrl
        }, {
            header		: _('last_modified'),
            dataIndex	: 'editedon',
            sortable	: true,
            editable	: false,
            fixed		: true,
			width		: 200,
			renderer	: this.renderDate
        }]
    });
    
    Ext.applyIf(config, {
    	cm			: columns,
        id			: 'redirections-grid-errors',
        url			: Redirections.config.connector_url,
        baseParams	: {
        	action		: 'mgr/redirects/getlist',
        	context		: MODx.request.context || MODx.config.default_context,
        	type		: 'error'
        },
        fields		: ['id', 'context', 'old', 'old_formatted', 'active', 'editedon'],
        paging		: true,
        pageSize	: MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        sortBy		: 'id',
        refreshGrid : [],
    });
    
    Redirections.grid.Errors.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.grid.Errors, MODx.grid.Grid, {
    filterFiles: function(tf, nv) {
        if (tf.getValue()) {
            this.getStore().baseParams.files = 0;
        } else {
            this.getStore().baseParams.files = 1;
        }
        
        this.getBottomToolbar().changePage(1);
    },
    filterSearch: function(tf, nv, ov) {
        this.getStore().baseParams.query = tf.getValue();
        
        this.getBottomToolbar().changePage(1);
    },
    clearFilter: function() {
	    this.getStore().baseParams.query = '';
	   
	    Ext.getCmp('redirections-filter-search-errors').reset();
	    
        this.getBottomToolbar().changePage(1);
    },
    getMenu: function() {
        return [{
	        text	: _('redirections.error_create'),
	        handler	: this.createError
	    }, '-', {
		    text	: _('redirections.error_remove'),
		    handler	: this.removeError
		}];
    },
    refreshGrids: function() {
	    if ('string' == typeof this.config.refreshGrid) {
		    Ext.getCmp(this.config.refreshGrid).refresh();
	    } else {
		    for (var i = 0; i < this.config.refreshGrid.length; i++) {
			    Ext.getCmp(this.config.refreshGrid[i]).refresh();
		    }
		}
    },
	createError: function(btn, e) {
        if (this.createErrorWindow) {
	        this.createErrorWindow.destroy();
        }
        
        this.createErrorWindow = MODx.load({
	        xtype		: 'redirections-window-error-create',
	        record		: this.menu.record,
	        closeAction	: 'close',
	        listeners	: {
		        'success'	: {
		        	fn			: function() {
			        	this.refreshGrids();
            			this.refresh();
		        	},
		        	scope		: this
		        }
	        }
        });
        
        this.createErrorWindow.show(e.target);
    },
    removeError: function(btn, e) {
    	MODx.msg.confirm({
        	title 		: _('redirections.error_remove'),
        	text		: _('redirections.error_remove_confirm'),
        	url			: Redirections.config.connector_url,
        	params		: {
            	action		: 'mgr/redirects/remove',
            	id			: this.menu.record.id
            },
            listeners	: {
            	'success'	: {
            		fn			: function() {
	            		this.refreshGrids();
            			this.refresh();
            		},
            		scope		: this
            	}
            }
    	});
    },
    resetErrors: function(btn, e) {
    	MODx.msg.confirm({
        	title 		: _('redirections.errors_reset'),
        	text		: _('redirections.errors_reset_confirm'),
        	url			: Redirections.config.connector_url,
        	params		: {
            	action		: 'mgr/redirects/reset',
				context		: MODx.request.context || MODx.config.default_context,
				type		: 'error'
            },
            listeners	: {
            	'success'	: {
            		fn			: function() {
	            		this.refreshGrids();
            			this.refresh();
            		},
            		scope		: this
            	}
            }
    	});
    },
    renderUrl: function(d) {
		return String.format('<a href="{0}" target="_blank">{1}</a>', d, d);  
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

Ext.reg('redirections-grid-errors', Redirections.grid.Errors);

Redirections.window.CreateError = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
	    width		: 400,
    	autoHeight	: true,
        title 		: _('redirections.error_create'),
        url			: Redirections.config.connector_url,
        baseParams	: {
            action		: 'mgr/redirects/update'
        },
        fields		: [{
	    	xtype		: 'hidden',
	    	name		: 'id',
	    	value		: config.record.id 
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
		            allowBlank	: false,
		            value		: config.record.old
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
		        value		: config.record.context,
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
    
    Redirections.window.CreateError.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.window.CreateError, MODx.Window);

Ext.reg('redirections-window-error-create', Redirections.window.CreateError);