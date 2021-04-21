<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Create Template</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="saveTemplate()">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" v-model="form.name" class="form-control form-control-sm" placeholder="Sample Name">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" type="submit">Add Template</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Layouts</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm">
                            <thead >
                                <tr class="text-center">
                                    <th class="text-left">#</th>
                                    <th>Layout Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="layout in layouts" :key="layout.id">
                                    <td class="text-left">{{ layout.id }}</td>
                                    <td>{{ layout.name }}</td>
                                    <td class="text-center">
                                        <button @click="viewLayout(layout.id)" class="btn btn-success btn-sm">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: [
            'layouts'
        ],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                form: {
                    name: ''
                }
            }
        },
        methods: {
            viewLayout(layoutId) {
                this.$inertia.visit(`/certEditorView/${layoutId}`);
            },
            saveTemplate () {
                this.$inertia.post('/addCertTemplate', this.form, {
                    onBefore: () => confirm('Create this template?'),
                    onSuccess: () => {
                        toastr.info('Template created.');
                        this.form.name = '';
                    },
                    onError: () => {
                        toastr.error('Error occurs');
                    }
                })
            }
        }
    }
</script>