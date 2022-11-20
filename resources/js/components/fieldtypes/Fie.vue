<template>
    <div>
        <div v-if="saving" class="p-4 text-center">
            <loading-graphic :text="__('Saving Image…')" />
        </div>
        <portal to="outside" v-if="editing">
            <div class="fie-container" ref="container" />
        </portal>
    </div>
</template>

<script>
export default {

    mixins: [Fieldtype],

    data() {
        return {
            source: this.config.source,
            editor: null,
            editing: true,
            saving: false,
        };
    },

    mounted() {
        this.$nextTick(() => {
            this.open();
        });
    },

    beforeDestroy() {
        if (this.editor) {
            this.editor.terminate();
        }
    },

    methods: {
        open() {
            const config = {
                source: this.source,
                closeAfterSave: true,
                moreSaveOptions: [
                    {
                        label: 'Replace Original',
                        onClick: (triggerSaveModal, triggerSave) => triggerSave((data) => this.save(data, 'replace')),
                    },
                ],
            };
            this.editor = new window.FilerobotImageEditor(this.$refs.container, config);
            this.editor.render({
                onSave: (data) => this.save(data, 'save'),
                onClose: (reason) => this.close(reason),
            });
        },
        close(reason) {            
            this.editor.terminate();
            this.editing = false;
            if (reason === 'close-button-clicked') {
                this.cancelAction();
            }
        },
        save({ fullName, imageBase64 }, mode) {
            this.saving = true;
            this.update({
                mode: mode,
                name: fullName,
                data: imageBase64,
            });
            this.$nextTick(() => {
                this.submitAction();
            });
        },
        submitAction() {
            const button = document.querySelector('.confirmation-modal > div:last-child > button.btn-primary');
            button.click();
            button.disabled = true;
        },
        cancelAction() {
            const button = document.querySelector('.confirmation-modal > div:last-child > button:not(.btn-primary)');
            button.click();
        },
    }, 

};
</script>
