<template>
    <div class="card">
        <div v-if="loading" class="overlay">
            <i class="fas fa-2x fa-spinner fa-pulse"></i>
        </div>
        <div class="card-header d-flex justify-content-between">
            <h5 class="m-0 flex-fill">My Profile</h5>
            <div v-if="!isEdit" >
                <button @click="isEdit = true" class="btn btn-primary btn-xs">Edit</button>
            </div>
            <div v-else>
                <button @click="updateProfileDetails" class="btn btn-success btn-xs">Save</button>
                <button @click="isEdit = false;" class="btn btn-danger btn-xs">Cancel</button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped table-sm">
                <tbody class="tbody-custom">
                    <tr>
                        <td style="width: 45%">First Name</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.first_name }}</strong>
                            <input v-model="profile.first_name" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.middle_name}}</strong>
                            <input v-model="profile.middle_name" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td >Last Name</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.last_name }}</strong>
                            <input v-model="profile.last_name" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.address }}</strong>
                            <input v-model="profile.address" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.contact_no }}</strong>
                            <input v-model="profile.contact_no" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>FB Profile Link</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.fb_link }}</strong>
                            <input v-model="profile.fb_link" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>School/Organization</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.school }}</strong>
                            <input v-model="profile.school" type="text" v-else class="form-control form-control-sm w-100" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.user.email }}</strong>
                            <input v-model="profile.user.email" v-else type="text" class="form-control form-control-sm w-100" disabled>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                profile: {},
                isEdit: false,
                loading: false
            }
        },
        mounted () {
            this.getPersonalDetails();
        },
        methods: {
            getPersonalDetails () {
                this.loading = true;
                axios.get('/getLoggedClientDetails')
                    .then(({data}) => {
                        this.profile = {...data};
                        this.loading = false;
                    })
            },
            updateProfileDetails () {
                this.loading = true;
                axios.post('/updateClientDetails', this.profile)
                    .then(({data}) => {
                        console.log(data);
                        this.profile = {...data};
                        this.isEdit = false;
                        this.loading = false;
                        toastr.info('Profile Updated!');
                    })
                    .catch(error => {
                        toastr.error('An error occured.')
                    })
            }
        }
    }
</script>
