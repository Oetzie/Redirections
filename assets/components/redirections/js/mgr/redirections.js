var Redirections = function(config) {
	config = config || {};
	
	Redirections.superclass.constructor.call(this, config);
};

Ext.extend(Redirections, Ext.Component, {
	page	: {},
	window	: {},
	grid	: {},
	tree	: {},
	panel	: {},
	combo	: {},
	config	: {}
});

Ext.reg('redirections', Redirections);

Redirections = new Redirections();