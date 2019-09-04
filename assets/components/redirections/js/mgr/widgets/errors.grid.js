Redirections.grid.Errors = function(config) {
    config = config || {};

    config.tbar = [{
        text        : _('bulk_actions'),
        menu        : [{
            text        : '<i class="x-menu-item-icon icon icon-history"></i>' + _('redirections.errors_clean'),
            handler     : this.cleanErrors,
            scope       : this
        }, '-', {
            text        : '<i class="x-menu-item-icon icon icon-times"></i>' + _('redirections.errors_reset'),
            handler     : this.resetErrors,
            scope       : this
        }]
    }, {
        xtype       : 'checkbox',
        name        : 'redirections-toggle-files',
        id          : 'redirections-toggle-files',
        boxLabel    : _('redirections.filter_files'),
        listeners   : {
            'check'     : {
                fn          : this.filterFiles,
                scope       : this
            }
        }
    }, '->', {
        xtype       : 'textfield',
        name        : 'redirections-filter-errors-search',
        id          : 'redirections-filter-errors-search',
        emptyText   : _('search') + '...',
        listeners   : {
            'change'    : {
                fn          : this.filterSearch,
                scope       : this
            },
            'render'    : {
                fn          : function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key     : Ext.EventObject.ENTER,
                        fn      : this.blur,
                        scope   : cmp
                    });
                },
                scope       : this
            }
        }
    }, {
        xtype       : 'button',
        cls         : 'x-form-filter-clear',
        id          : 'redirections-filter-errors-clear',
        text        : _('filter_clear'),
        listeners   : {
            'click'     : {
                fn          : this.clearFilter,
                scope       : this
            }
        }
    }];
    
    var columns = new Ext.grid.ColumnModel({
        columns     : [{
            header      : _('redirections.label_old_url'),
            dataIndex   : 'old_url_formatted',
            sortable    : true,
            editable    : false,
            width       : 150,
            renderer    : this.renderUrl
        }, {
            header      : _('redirections.label_visits'),
            dataIndex   : 'visits',
            sortable    : true,
            editable    : false,
            width       : 100,
            fixed       : true
        }, {
            header      : _('redirections.label_last_visit'),
            dataIndex   : 'last_visit',
            sortable    : true,
            editable    : false,
            fixed       : true,
            width       : 200,
            renderer    : this.renderDate
        }]
    });
    
    Ext.applyIf(config, {
        cm          : columns,
        id          : 'redirections-grid-errors',
        url         : Redirections.config.connector_url,
        baseParams  : {
            action      : 'mgr/redirects/getlist',
            context     : MODx.request.context || MODx.config.default_context,
            type        : 'error'
        },
        fields      : ['id', 'context', 'new_url', 'new_url_formatted', 'old_url', 'old_url_formatted', 'redirect_type', 'visits', 'last_visit', 'active', 'editedon'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        sortBy      : 'visits',
        refreshGrid : []
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

        Ext.getCmp('redirections-filter-errors-search').reset();

        this.getBottomToolbar().changePage(1);
    },
    getMenu: function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-pencil"></i>' + _('redirections.error_create'),
            handler : this.updateError,
            scope   : this
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-times"></i>' + _('redirections.error_remove'),
            handler : this.removeError,
            scope   : this
        }];
    },
    refreshGrids: function() {
        if (typeof this.config.refreshGrid === 'string') {
            Ext.getCmp(this.config.refreshGrid).refresh();
        } else {
            for (var i = 0; i < this.config.refreshGrid.length; i++) {
                Ext.getCmp(this.config.refreshGrid[i]).refresh();
            }
        }
    },
    updateError: function(btn, e) {
        if (this.updateErrorWindow) {
            this.updateErrorWindow.destroy();
        }

        this.updateErrorWindow = MODx.load({
            xtype       : 'redirections-window-error-update',
            record      : this.menu.record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : function() {
                        this.refreshGrids();
                        this.refresh();
                    },
                    scope       : this
                }
            }
        });

        this.updateErrorWindow.setValues(this.menu.record);
        this.updateErrorWindow.show(e.target);
    },
    removeError: function(btn, e) {
        MODx.msg.confirm({
            title       : _('redirections.error_remove'),
            text        : _('redirections.error_remove_confirm'),
            url         : Redirections.config.connector_url,
            params      : {
                action      : 'mgr/redirects/remove',
                id          : this.menu.record.id
            },
            listeners   : {
                'success'   : {
                    fn          : function() {
                        this.refreshGrids();
                        this.refresh();
                    },
                    scope       : this
                }
            }
        });
    },
    cleanErrors: function(btn, e) {
        if (this.cleanErrorsWindow) {
            this.cleanErrorsWindow.destroy();
        }

        this.cleanErrorsWindow = MODx.load({
            xtype       : 'redirections-window-errors-clean',
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : function(record) {
                        MODx.msg.status({
                            title   : _('success'),
                            message : record.a.result.message,
                            delay   : 4
                        });

                        this.refreshGrids();
                        this.refresh();
                    },
                    scope       : this
                }
            }
        });

        this.cleanErrorsWindow.show(e.target);
    },
    resetErrors: function(btn, e) {
        MODx.msg.confirm({
            title       : _('redirections.errors_reset'),
            text        : _('redirections.errors_reset_confirm'),
            url         : Redirections.config.connector_url,
            params      : {
                action      : 'mgr/redirects/reset',
                context     : MODx.request.context || MODx.config.default_context,
                type        : 'error'
            },
            listeners   : {
                'success'   : {
                    fn          : function() {
                        this.refreshGrids();
                        this.refresh();
                    },
                    scope       : this
                }
            }
        });
    },
    renderUrl: function(d) {
        return String.format('<a href="{0}" target="_blank">{1}</a>', d, d);
    },
    renderBoolean: function(d, c) {
        c.css = parseInt(d) === 1 ? 'green' : 'red';

        return parseInt(d) === 1 ? _('yes') : _('no');
    },
    renderDate: function(a) {
        if (Ext.isEmpty(a)) {
            return '—';
        }

        return a;
    }
});

Ext.reg('redirections-grid-errors', Redirections.grid.Errors);

Redirections.window.UpdateError = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        width       : 400,
        autoHeight  : true,
        title       : _('redirections.error_create'),
        url         : Redirections.config.connector_url,
        baseParams  : {
            action      : 'mgr/redirects/update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            layout      : 'column',
            defaults    : {
                layout      : 'form',
                labelSeparator : ''
            },
            items       : [{
                columnWidth : .85,
                items       : [{
                    xtype       : 'statictextfield',
                    fieldLabel  : _('redirections.label_old_url'),
                    description : MODx.expandHelp ? '' : _('redirections.label_old_url_desc'),
                    name        : 'old_url',
                    anchor      : '100%',
                    allowBlank  : false
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('redirections.label_old_url_desc'),
                    cls         : 'desc-under'
                }]
            }, {
                columnWidth : .15,
                items       : [{
                    xtype       : 'checkbox',
                    fieldLabel  : _('redirections.label_active'),
                    description : MODx.expandHelp ? '' : _('redirections.label_active_desc'),
                    name        : 'active',
                    inputValue  : 1,
                    checked     : true
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('redirections.label_active_desc'),
                    cls         : 'desc-under'
                }]
            }]
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('redirections.label_new_url'),
            description : MODx.expandHelp ? '' : _('redirections.label_new_url_desc'),
            name        : 'new_url',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('redirections.label_new_url_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'redirections-combo-redirect-type',
            fieldLabel  : _('redirections.label_redirect_type'),
            description : MODx.expandHelp ? '' : _('redirections.label_redirect_type_desc'),
            name        : 'redirect_type',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('redirections.label_redirect_type_desc'),
            cls         : 'desc-under'
        }, {
            layout      : 'form',
            labelSeparator : '',
            hidden      : Redirections.config.context,
            items       : [{
                xtype       : 'modx-combo-context',
                fieldLabel  : _('redirections.label_context'),
                description : MODx.expandHelp ? '' : _('redirections.label_context_desc'),
                name        : 'context',
                anchor      : '100%',
                displayField : 'name',
                value       : MODx.request.context || MODx.config.default_context,
                baseParams  : {
                    action      : 'context/getlist',
                    exclude     : Redirections.config.exclude_contexts.join(',')
                }
            }, {
                xtype       : MODx.expandHelp ? 'label' : 'hidden',
                html        : _('redirections.label_context_desc'),
                cls         : 'desc-under'
            }]
        }]
    });
    
    Redirections.window.UpdateError.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.window.UpdateError, MODx.Window);

Ext.reg('redirections-window-error-update', Redirections.window.UpdateError);

Redirections.window.CleanErrors = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        width       : 500,
        title       : _('redirections.errors_clean'),
        cls         : 'x-window-formit',
        url         : Redirections.config.connector_url,
        baseParams  : {
            action      : 'mgr/redirects/clean'
        },
        fields      : [{
            html        : '<p>' + _('redirections.errors_clean_desc') + '</p>',
            cls         : 'panel-desc',
        }, {
            xtype       : 'hidden',
            name        : 'context',
            value       : MODx.request.context || MODx.config.default_context
        }, {
            xtype       : 'modx-panel',
            items       : [{
                xtype       : 'label',
                html        : _('redirections.label_clean_label')
            }, {
                xtype       : 'numberfield',
                name        : 'days',
                minValue    : 1,
                maxValue    : 9999999999,
                value       : Redirections.config.clean_days,
                width       : 75,
                allowBlank  : false,
                style       : 'margin: 0 10px;'
            }, {
                xtype       : 'label',
                html        : _('redirections.label_clean_desc'),
            }]
        }],
        keys        : [],
        saveBtnText : _('redirections.errors_clean'),
        waitMsg     : _('redirections.errors_clean_executing')
    });

    Redirections.window.CleanErrors.superclass.constructor.call(this, config);
};

Ext.extend(Redirections.window.CleanErrors, MODx.Window);

Ext.reg('redirections-window-errors-clean', Redirections.window.CleanErrors);