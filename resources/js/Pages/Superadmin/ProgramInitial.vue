<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row" v-if="$page.flash.message">
                <div class="col-12">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Info</strong> &nbsp; {{ $page.flash.message }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Initial Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Requirement Name</label>
                                <input type="text" v-model="form.name" class="form-control form-control-sm" placeholder="Text Name">
                            </div>
                            <div class="form-group">
                                <label>Requirement Description</label>
                                <input type="text" v-model="form.description" class="form-control form-control-sm" placeholder="Text Description">
                            </div>
                            <div class="form-group">
                                <input type="file" ref="file" @change="fileHandler">
                            </div>
                            <div class="d-flex">
                                <button @click="submitDetails" class="btn btn-success btn-sm ml-auto mx-1">{{ buttonName }}</button>
                                <button @click="cancelRecord" class="btn btn-danger btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Initial Requirements</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hovered table-striped table-sm text-xs">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="initial in initials" :key="initial.id">
                                        <td>{{ initial.name }}</td>
                                        <td class="text-center">{{ initial.description }}</td>
                                        <td class="text-center">{{ initial.file_path }}</td>
                                        <td class="text-center">
                                            <button @click="editDetails(initial)" class="btn btn-success btn-xs">Edit</button>
                                            <button class="btn btn-danger btn-xs">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        components: {
            SuperadminLayout,
        },
        props: ['program', 'initials'],
        data () {
            return {
                form: {
                    name: '',
                    description: '',
                    file: '',
                },
                method: 'create',
                buttonName: 'Add'
            }
        },
        methods: {
            fileHandler () {
                this.form.file = this.$refs.file.files[0];
            },
            submitDetails () {
                let formData = new FormData();
                formData.append('id', this.form.id);
                formData.append('name', this.form.name);
                formData.append('description', this.form.description);
                formData.append('file', this.form.file);

                switch(this.method) {
                    case 'edit':
                        formData.append('_method', 'PUT');
                        this.$inertia.post(`/updateInitialRequirement`, formData)
                            .then((response) => {
                                this.cancelRecord();
                            })
                        break;
                    case 'create':
                        this.$inertia.post(`/storeInitialRequirement/${this.program.id}`, formData)
                            .then((response) => {
                                this.cancelRecord();
                            })
                        break;
                }

            },
            editDetails (initial) {
                this.form = {...initial};
                this.method = 'edit';
                this.buttonName = 'Update';
            },
            cancelRecord () {
                this.form = {};
                this.method = 'create';
                this.buttonName = 'Add';
            }
        }
    }
</script>
