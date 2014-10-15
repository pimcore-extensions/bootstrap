pimcore.registerNS("pimcore.plugin.bootstrap");

pimcore.plugin.bootstrap = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.bootstrap";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },
 
    pimcoreReady: function (params,broker){
        // alert("Example Ready!");
    }
});

var bootstrapPlugin = new pimcore.plugin.bootstrap();

