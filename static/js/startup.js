pimcore.registerNS("pimcore.plugin.bootstrap");

pimcore.plugin.bootstrap = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.bootstrap";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },

    pimcoreReady: function (params,broker){
        this.registerHelpers();
    },

    registerHelpers: function() {

        pimcore.helpers.editmode.openButtonEditPanel = function (data, callback) {

            var fieldPath = new Ext.form.TextField({
                fieldLabel: t('path'),
                value: data.path,
                name: "path",
                width: 320,
                cls: "pimcore_droptarget_input",
                enableKeyEvents: true,
                listeners: {
                    keyup: function (el) {
                        if(el.getValue().match(/^www\./)) {
                            el.setValue("http://" + el.getValue());
                        }
                    }
                }
            });


           fieldPath.on("render", function (el) {
                // add drop zone
                new Ext.dd.DropZone(el.getEl(), {
                    reference: this,
                    ddGroup: "element",
                    getTargetFromEvent: function(e) {
                        return fieldPath.getEl();
                    },

                    onNodeOver : function(target, dd, e, data) {
                        return Ext.dd.DropZone.prototype.dropAllowed;
                    }.bind(this),

                    onNodeDrop : function (target, dd, e, data) {
                        if (data.node.attributes.elementType == "asset" || data.node.attributes.elementType == "document") {
                            fieldPath.setValue(data.node.attributes.path);
                            return true;
                        }
                        return false;
                    }.bind(this)
                });
            }.bind(this));

            var form = new Ext.FormPanel({
                itemId: "form",
                items: [
                    {
                        xtype:'tabpanel',
                        activeTab: 0,
                        deferredRender: false,
                        defaults:{autoHeight:true, bodyStyle:'padding:10px'},
                        border: false,
                        items: [
                            {
                                title:t('basic'),
                                layout:'form',
                                border: false,
                                defaultType: 'textfield',
                                items: [
                                    {
                                        fieldLabel: t('text'),
                                        name: 'text',
                                        value: data.text
                                    },
                                    {
                                        xtype: "compositefield",
                                        items: [fieldPath, {
                                            xtype: "button",
                                            iconCls: "pimcore_icon_search",
                                            handler: function () {
                                                pimcore.helpers.itemselector(false, function (item) {
                                                    if (item) {
                                                        fieldPath.setValue(item.fullpath);
                                                        return true;
                                                    }
                                                }, {
                                                    type: ["asset","document"]
                                                });
                                            }
                                        }]
                                    },
                                    {
                                        xtype:'fieldset',
                                        title: t('properties'),
                                        collapsible: false,
                                        autoHeight:true,
                                        defaultType: 'textfield',
                                        items :[
                                            {
                                                xtype: "combo",
                                                fieldLabel: t('target'),
                                                name: 'target',
                                                triggerAction: 'all',
                                                editable: true,
                                                mode: "local",
                                                store: ["","_blank","_self","_top","_parent"],
                                                value: data.target
                                            },
                                            {
                                                fieldLabel: t('parameters'),
                                                name: 'parameters',
                                                value: data.parameters
                                            },
                                            {
                                                fieldLabel: t('anchor'),
                                                name: 'anchor',
                                                value: data.anchor
                                            },
                                            {
                                                fieldLabel: t('title'),
                                                name: 'title',
                                                value: data.title
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                title: t('button'),
                                layout:'form',
                                defaultType: 'textfield',
                                border: false,
                                items: [
                                    {
                                        xtype: "combo",
                                        fieldLabel: t('style'),
                                        name: 'buttonStyle',
                                        triggerAction: 'all',
                                        width:80,
                                        editable: true,
                                        mode: "local",
                                        store: ["Default", "Primary", "Success", "Info", "Warning", "Danger"],
                                        value: data.buttonStyle
                                    },
                                    {
                                        xtype: "combo",
                                        fieldLabel: t('size'),
                                        name: 'buttonSize',
                                        triggerAction: 'all',
                                        width:80,
                                        editable: true,
                                        mode: "local",
                                        store: ["Large", "Default", "Small", "Extra Small"],
                                        value: data.buttonSize || 'Default'
                                    },
                                    {
                                        xtype: "checkbox",
                                        fieldLabel: t('active'),
                                        name: 'buttonActive',
                                        triggerAction: 'all',
                                        checked: !!data.buttonActive
                                    },
                                    {
                                        xtype: "checkbox",
                                        fieldLabel: t('disabled'),
                                        name: 'buttonDisabled',
                                        triggerAction: 'all',
                                        checked: !!data.buttonDisabled
                                    }
                                ]
                            },
                            {
                                title: t('advanced'),
                                layout:'form',
                                defaultType: 'textfield',
                                border: false,
                                items: [
                                    {
                                        fieldLabel: t('accesskey'),
                                        name: 'accesskey',
                                        value: data.accesskey
                                    },
                                    {
                                        fieldLabel: t('relation'),
                                        name: 'rel',
                                        width: 300,
                                        value: data.rel
                                    },
                                    {
                                        fieldLabel: ('tabindex'),
                                        name: 'tabindex',
                                        value: data.tabindex
                                    },
                                    {
                                        fieldLabel: t('class'),
                                        name: 'class',
                                        width: 300,
                                        value: data["class"]
                                    },
                                    {
                                        fieldLabel: t('attributes') + ' (key="value")',
                                        name: 'attributes',
                                        width: 300,
                                        value: data["attributes"]
                                    }
                                ]
                            }
                        ]
                    }
                ],
                buttons: [
                    {
                        text: t("empty"),
                        listeners:  {
                            "click": callback["empty"]
                        }
                    },
                    {
                        text: t("cancel"),
                        listeners:  {
                            "click": callback["cancel"]
                        }
                    },
                    {
                        text: t("save"),
                        listeners: {
                            "click": callback["save"]
                        },
                        icon: "/pimcore/static/img/icon/tick.png"
                    }
                ]
            });


            var window = new Ext.Window({
                modal: false,
                width: 500,
                height: 330,
                title: t("edit_button"),
                items: [form],
                layout: "fit"
            });

            window.show();

            return window;
        };

    }
});

var bootstrapPlugin = new pimcore.plugin.bootstrap();

