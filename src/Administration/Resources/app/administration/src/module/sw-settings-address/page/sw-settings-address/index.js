import template from './sw-settings-address.html.twig';

const { Component, Mixin } = Shopware;

Component.register('sw-settings-address', {
    template,

    mixins: [
        Mixin.getByName('notification')
    ],
    data() {
        return {
            isLoading: false,
            isSaveSuccessful: false
        };
    },
    methods: {
        saveFinish() {
            this.isSaveSuccessful = false;
        },
        onSave() {
            this.isSaveSuccessful = false;
            this.isLoading = true;

            this.$refs.systemConfig.saveAll().then(() => {
                this.isLoading = false;
                this.isSaveSuccessful = true;
            }).catch((err) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: this.$tc('sw-settings-address.general.titleSaveError'),
                    message: err
                });
            });
        }
    }
});
