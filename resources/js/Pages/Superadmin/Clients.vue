
<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            Total Registers
                        </span>
                        <span class="info-box-number">
                            {{ clients.length }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            Is Verfied
                        </span>
                        <span class="info-box-number">
                            {{ clients.filter(e => e.email_verified_at !== null).length }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            Not Verified
                        </span>
                        <span class="info-box-number">
                            {{ clients.filter(e => e.email_verified_at === null).length }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            Is Filled
                        </span>
                        <span class="info-box-number">
                            {{ clients.filter(e => e.isFilled == true).length }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 card-title flex-grow-1">Enrollees</h5>
                <div>
                    <input type="text" class="form-control form-control-sm mx-auto" v-model="filterName" placeholder="Search by last name">
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-xs text-center">
                            <th class="text-left">#</th>
                            <th>Email</th>
                            <th>Is Verified</th>
                            <th>Is Filled</th>
                            <th>Has Client Record</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="filteredClients.length > 0">
                        <tr class="text-xs text-center" v-for="client in filteredClients" :key="client.id">
                            <td class="text-left">{{ client.id }}</td>
                            <td>{{ client.email }}</td>
                            <td>
                                <span v-if="client.email_verified_at" class="fas fa-check text-green"></span>
                                <span v-else class="fas fa-times text-red"></span>
                            </td>
                            <td>
                                <span v-if="client.isFilled" class="fas fa-check text-green"></span>
                                <span v-else class="fas fa-times text-red"></span>
                            </td>
                            <td>
                                <span v-if="client.client_count > 0" class="fas fa-check text-green"></span>
                                <span v-else class="fas fa-times text-red"></span>
                            </td>
                            <th>{{ client.created_at }}</th>
                            <td>
                                <button v-if="!client.email_verified_at" @click="verifyNow(client)" class="btn btn-warning btn-xs btn-flat">Verify</button>
                                <button v-if="client.client_count > 0" @click="viewClientDetails(client.id)" class="btn btn-success btn-xs btn-flat">View</button>
                                <button v-if="client.isFilled == false" @click="setToFilled(client)" class="btn btn-info btn-xs btn-flat">Filled</button>
                                <button v-if="client.isFilled == true" @click="setToUnfilled(client)" class="btn btn-info btn-xs btn-flat">Unfilled</button>
                                <button @click="deleteClientDetails(client.id)" class="btn btn-danger btn-xs btn-flat">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-xs text-center">
                            <td colspan="6">No Client Registered</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: ['clients'],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                filterName: ''
            }
        },
        computed: {
            filteredClients () {
                    return this.clients.filter(e => {
                        return e.email.toLowerCase().includes(this.filterName.toLowerCase());
                    })
                },
        },
        watch: {
            flash: function (value) {
                toastr.info(value.message)
            }
        },
        methods: {
            verifyNow(data)
            {
                this.$inertia.post(`/setToVerified/${data.id}`, {}, {
                    onBefore: () => confirm('Verify this account?'),
                    onSuccess: () => {
                        toastr.info('Account Verified.');
                    }
                })
            },
            setToFilled (data)
            {
                this.$inertia.post(`/setToFilled/${data.id}`, {}, {
                    onBefore: () => confirm(`Filled this ${data.email} account?`),
                    onSuccess: () => {
                        toastr.info(`${data.email} is filled.`);
                    }
                })
            },
            setToUnfilled (data)
            {
                this.$inertia.post(`/setToUnfilled/${data.id}`, {}, {
                    onBefore: () => confirm(`Unfilled this ${data.email} account?`),
                    onSuccess: () => {
                        toastr.info(`${data.email} is unfilled.`);
                    }
                })
            },
            viewClientDetails (userId) {
                this.$inertia.visit(`/sa/client/${userId}`);
            },
            deleteClientDetails (userId) {
                this.$inertia.delete(`/deleteClientDetails/${userId}`, {
                    onBefore: () => confirm("Are you sure to delete this record?"),
                    onSuccess: () => {
                        tostr.info('Client details deleted.');
                    }
                });
            }
        }
    }
</script>
