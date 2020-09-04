<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">School entry</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-sm">Name</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label class="text-sm">Display Name</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.display_name" placeholder="Display Name">
                            </div>
                            <div class="d-flex">
                                <button @click="submitDetails" class="btn btn-success btn-sm ml-auto mx-1">{{ buttonName }}</button>
                                <button @click="cancelActions" class="btn btn-danger btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Schools</h6>
                            
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-sm text-center">
                                        <th class="text-left">#</th>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="schools.length > 0">
                                    <tr v-for="school in schools" :key="school.id" class="text-sm text-center">
                                        <td class="text-left">{{ school.id }}</td>
                                        <td>{{ school.name }}</td>
                                        <td>{{ school.display_name }}</td>
                                        <td>
                                            <button @click="editSchool(school)" class="btn btn-xs btn-success">Edit</button>
                                            <button @click="deleteSchool(school)" class="btn btn-xs btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr class="text-sm text-center">
                                        <td colspan="4">No record registered</td>
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
        props: ['schools'],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                form: {
                    name: '',
                    display_name: ''
                },
                action: 'add',
                buttonName: 'Add'
            }
        },
        methods: {
            submitDetails() {
                let formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('display_name', this.form.display_name);
                switch(this.action) {
                    case 'add':
                        this.$inertia.post('/storeSchool', formData)
                            .then((response) => {
                                this.cancelActions();
                                toastr.info('School added.');
                            });
                    break;

                    case 'edit':
                        formData.append('id', this.form.id);
                        formData.append('_method', 'PUT');
                        this.$inertia.post('/updateSchool', formData)
                            .then((response) => {
                                this.cancelActions();
                                toastr.info('School updated.');
                            })
                        break;
                }
            },
            editSchool(school) {
                this.action = 'edit';
                this.buttonName = 'Update';
                this.form = {...school};
            },
            deleteSchool(school) {
                let prompt = confirm('Delete this record?');
                if(prompt) {
                    this.$inertia.delete(`/deleteSchool/${school.id}`)
                        .then((response) => {
                            toastr.info(`${school.name} deleted.`);
                            this.cancelActions();
                        })
                }
            },
            cancelActions() {
                this.buttonName = 'Add';
                this.form = {},
                this.action = 'add';
            }
        }
    }
</script>