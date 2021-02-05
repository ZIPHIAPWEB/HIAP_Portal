<template>
    <accounting-layout>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Enrolled Courses</span>
                        <span class="info-box-number">{{ totalCourseEnrolled }}</span>

                        <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <!-- <span class="progress-description">
                        70% Increase in 30 Days
                        </span> -->
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Verified</span>
                        <span class="info-box-number">{{ totalVerified }}</span>

                        <div class="progress">
                        <div class="progress-bar" :style="{ width: totalVerified / totalCourseEnrolled * 100 + '%' }"></div>
                        </div>
                        <!-- <span class="progress-description">
                        70% Increase in 30 Days
                        </span> -->
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fas fa-times"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Unverified</span>
                        <span class="info-box-number">{{ totalUnverified }}</span>

                        <div class="progress">
                        <div class="progress-bar" :style="{ width: totalUnverified / totalCourseEnrolled * 100 + '%' }"></div>
                        </div>
                        <!-- <span class="progress-description">
                        70% Increase in 30 Days
                        </span> -->
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 card-title flex-grow-1">Enrollees</h5>
                <div>
                    <div class="input-group input-group-sm" style="width: 300px">
                    <input type="text" class="form-control" v-model="filterName" placeholder="Search by last name">
                        <span class="input-group-append">
                            <button @click="searchClientByLastName" class="btn btn-info btn-flat">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-xs text-center">
                            <th class="text-left">First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Contact Number</th>
                            <th>School/Organization</th>
                            <th>E-mail Address</th>
                            <th>Unverified Payment(s)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="clients.data.length > 0">
                        <tr class="text-xs text-center" v-for="client in clients.data" :key="client.id">
                            <td class="text-left">{{ client.first_name }}</td>
                            <td>{{ client.middle_name}}</td>
                            <td>{{ client.last_name }}</td>
                            <td>{{ client.contact_no }}</td>
                            <td>{{ client.school.name }}</td>
                            <td>{{ client.user.email }}</td>
                            <td class="text-bold text-red">{{ (client.payments.length > 0) ? paymentCount(client.payments) : 0 }}</td>
                            <td>
                                <button @click="viewClientDetails(client.user_id)" class="btn btn-success btn-xs btn-flat">View</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-xs text-center">
                            <td colspan="7">No Client Registered</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button :disabled="!clients.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                <button :disabled="!clients.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
            </div>
        </div>
    </accounting-layout>
</template>

<script>
    import AccountingLayout from '../../Layouts/AccountingLayout.vue';
    export default {
        props: ['clients'],
        components: {
            AccountingLayout
        },
        data () {
            return {
                filterName: ''
            }
        },
        computed: {
            filteredClients () {
                return this.clients.data.filter(e => {
                    return e.last_name.toLowerCase().includes(this.filterName.toLowerCase());
                })
            },
            totalCourseEnrolled () {
                let total = 0;
                this.clients.data.forEach(e => {
                    total += e.user_program.length;
                });

                return total;
            },
            totalVerified () {
                let total = 0;

                this.clients.data.forEach(e => {
                    total += e.payments.filter(e => e.isVerified == 1).length;
                })

                return total;
            },
            totalUnverified () {
                let total = 0;

                this.clients.data.forEach(e => {
                    total += e.payments.filter(e => e.isVerified == 0).length;
                })

                return total;
            }
        },
        methods: {
            viewClientDetails (userId) {
                this.$inertia.visit(`/ac/client/${userId}`);
            },
            deleteClientDetails (userId) {
                this.$inertia.delete(`/deleteClientDetails/${userId}`);
            },
            paymentCount (payments) {
                return payments.filter(e => e.isVerified == 0).length;
            },
            prevPage() {
                this.$inertia.visit(this.clients.prev_page_url);
            },
            nextPage() {
                this.$inertia.visit(this.clients.next_page_url);
            },
            searchClientByLastName() {
                if (this.filterName !== '') {
                    let formData = new FormData();
                    formData.append('last_name', this.filterName);
                    axios.post('/searchStudentByLastName', formData)
                        .then((response) => {
                            this.clients = response.data;
                        })
                } else {
                    toastr.error('Cannot search empty field.');
                }
            }
        }
    }
</script>
