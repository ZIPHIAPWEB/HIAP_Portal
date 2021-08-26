<template>
    <div>
        <button class="btn btn-primary btn-xs" @click="selectFile">Upload File</button>
        <input :id="'initial-'+initialId" style="display: none;" type="file" ref="file" @change="uploadMe">
    </div>
</template>

<script>
    export default {
        props: ['initialId'],
        methods: {
            uploadMe() {
                this.$parent.loading = true;
                let formData = new FormData();
                formData.append('file', this.$refs.file.files[0]);
                formData.append('initial_id', this.initialId);
                axios.post('/storeClientInitialRequirements', formData)
                    .then(({data}) => {
                        this.$parent.loading = false;
                        toastr.info(`File has been uploaded.`);
                        this.$parent.getClientRequirements();
                    })
            },
            selectFile() {
                document.getElementById(`initial-${this.initialId}`).click();
            }
        }
    }
</script>
