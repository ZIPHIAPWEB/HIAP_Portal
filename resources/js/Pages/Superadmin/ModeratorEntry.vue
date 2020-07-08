<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="overlay" v-if="modalLoading">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="card-header">
                            <h5 class="card-title">Moderator</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input v-model="form.first_name" type="text" name="firstName" id="firstName" class="form-control form-control-sm" placeholder="John">
                            </div>
                            <div class="form-group">
                                <label for="middleName">Middle Name</label>
                                <input v-model="form.middle_name" type="text" name="middleName" id="middleName" class="form-control form-control-sm" placeholder="Doe">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input v-model="form.last_name" type="text" name="lastName" id="lastName" class="form-control form-control-sm" placeholder="Doe">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input v-model="form.email" type="text" name="email" id="email" class="form-control form-control-sm" placeholder="john.doe@app.com" :disabled="method == 'edit'">
                            </div>
                            <div class="d-flex">
                                <button @click="submitDetails" class="btn btn-success btn-sm ml-auto mx-1">{{ buttonName }}</button>
                                <button @click="cancelRecord" class="btn btn-danger btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card ">
                        <div class="overlay" v-if="loading">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="card-header">
                            <h5 class="card-title">Moderators</h5>
                            <inertia-link href="/sa/moderators/create" class="btn btn-primary btn-sm float-right">Create Moderator</inertia-link>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-sm text-center">
                                        <th class="text-left">First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>
                                        <th>Last Known Action</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="moderators.length > 0">
                                    <tr class="text-center text-xs" v-for="moderator in moderators" :key="moderator.id">
                                        <td class="text-left">{{ moderator.first_name }}</td>
                                        <td>{{ moderator.middle_name }}</td>
                                        <td>{{ moderator.last_name }}</td>
                                        <td>{{ moderator.user.email }}</td>
                                        <td>Nothing</td>
                                        <td>
                                            <button class="btn btn-primary btn-xs">Logs</button>
                                            <button @click="editModerator(moderator)" class="btn btn-success btn-xs">Edit</button>
                                            <button @click="deleteModerator(moderator.user.id)" class="btn btn-danger btn-xs">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr class="text-center text-sm">
                                        <td colspan="6">No Moderators Added</td>
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
        props: ['moderators'],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                loading: false,
                modalLoading: false,
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    email: ''
                },
                method: 'create',
                buttonName: 'Add'
            }
        },
        methods: {
            deleteModerator(userId) {
                var r = confirm('Delete this account?');
                if (r) {
                    this.loading = true;
                    this.$inertia.delete(`/moderators/delete/${userId}`)
                        .then((response) => {
                            this.loading = false;
                        })
                }
            },
            submitDetails () {
                let formData = new FormData();
                formData.append('first_name', this.form.first_name);
                formData.append('middle_name', this.form.middle_name);
                formData.append('last_name', this.form.last_name);
                formData.append('email', this.form.email);
                switch(this.method) {
                    case 'create':
                        this.modalLoading = true;
                        this.$inertia.post('/moderators/store', formData)
                            .then((response) => {
                                this.cancelRecord();
                                this.modalLoading = false;
                            })
                        break;

                    case 'edit':
                        this.modalLoading = true;
                        formData.append('user_id', this.form.user_id);
                        formData.append('_method', 'PUT');
                        this.$inertia.post(`/moderators/update`, formData)
                            .then((response) => {
                                this.cancelRecord();
                                this.modalLoading = false;
                            })
                        break;
                }
            },
            editModerator(moderator) {
                this.form = {
                    user_id: moderator.user.id,
                    first_name: moderator.first_name,
                    middle_name: moderator.middle_name,
                    last_name: moderator.last_name,
                    email: moderator.user.email
                };

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
