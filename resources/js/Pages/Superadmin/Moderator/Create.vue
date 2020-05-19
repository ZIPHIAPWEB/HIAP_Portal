<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-lg-3">
                    <div class="card">
                        <div v-if="loading" class="overlay">
                            <i class="fas fa-spinner fa-pulse fa-2x"></i>
                        </div>
                        <div class="card-header">
                            <h5 class="card-title">
                                Create New Moderator
                            </h5>
                            <inertia-link href="/sa/moderators" class="btn btn-danger btn-xs float-right">Back</inertia-link>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="addModerator">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="">First Name</label>
                                        <input v-model="form.first_name" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="">Middle Name</label>
                                        <input v-model="form.middle_name" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="">Last Name</label>
                                        <input v-model="form.last_name"  type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="">Email</label>
                                        <input v-model="form.email" type="email" name="" id="" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block">Add Moderator</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    export default {
        components: {
            SuperadminLayout
        },
        data() {
            return {
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    email: ''
                },
                loading: false
            }
        },
        methods: {
            addModerator () {
                this.loading = true;
                this.$inertia.post('/moderators/store', this.form)
                    .then((response) => {
                        this.loading = false;
                    })
            }
        }
    }
</script>
