<template>
    <div>
        <div class="input-group input-group-sm">
            <input v-model="text" type="text" class="form-control" :placeholder="`Enter ${initial.name}`">
            <span class="input-group-append">
                <button @click="saveInputtedRequirement()" type="button" class="btn btn-info btn-flat">Save</button>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'input-initial-requirements-component',
        props: ['initial'],
        data () {
            return {
                text : ''
            }
        },
        methods: {
            saveInputtedRequirement() {
                let formData = new FormData();
                formData.append('file', this.text);
                formData.append('initial_id', this.initial.id);
                axios.post('/storeClientInitialRequirements', formData)
                    .then(({data}) => {
                        this.$parent.loading = false;
                        toastr.info(`File has been uploaded.`);
                        this.$parent.getClientRequirements();
                    })
            }
        }
    }
</script>