pimcore.registerNS("pimcore.document.tags.button");
pimcore.document.tags.button = Class.create(pimcore.document.tags.link, {

    sizes: { Large:'lg', Default:null, Small:'sm', "Extra Small": 'xs' },

    openEditor: function () {
        // disable the global dnd handler in this editmode/frame
        window.dndManager.disable();

        this.window = pimcore.helpers.editmode.openButtonEditPanel(this.data, {
            empty:  pimcore.document.tags.link.prototype.empty.bind(this),
            cancel: pimcore.document.tags.link.prototype.cancel.bind(this),
            save:   pimcore.document.tags.link.prototype.save.bind(this)
        });

    },

    getLinkContent: function() {
        var text = "[" + t("not_set") + "]";
        if (this.data.text) {
            text = this.data.text;
        }
        if (this.data.path) {
            return '<a href="' + this.data.path + '" class="' + this.getButtonClasses() + ' ' +
                    this.options["class"] + ' ' + this.data["class"] + '">' + text + '</a>';
        }
        return text;
    },

    getButtonClasses: function() {
        var classes = [
            'btn',
            'btn-' + this.data['buttonStyle'].toLowerCase(),
            'btn-' + this.sizes[this.data['buttonSize']]
        ];
        if (!!this.data['buttonActive']) {
            classes.push('active');
        }
        if (!!this.data['buttonDisabled']) {
            classes.push('disabled');
        }
        return classes.join(' ');
    },

    getType: function () {
        return "button";
    }
});
