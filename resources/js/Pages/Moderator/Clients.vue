
<template>
    <moderator-layout>
        <div class="row">
            <div class="col-3">
                {{ Date.now() }}
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 card-title flex-grow-1">Enrollees</h5>
                <div class="input-group input-group-sm" style="width: 300px">
                    <input type="text" class="form-control" v-model="filterName" placeholder="Search by first name or last name">
                    <span class="input-group-append">
                        <button @click="searchClientByLastName" class="btn btn-info btn-flat">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                </div>
                <download-excel 
                    class="mx-1 btn btn-success btn-sm btn-flat"
                    :data="clients.data"
                    :fields="fields"
                    name="HIAP Export"
                    title="HIAP Clients"
                >Export</download-excel>
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
                            <th>Program</th>
                            <th>Enrolled Course(s)</th>
                            <th>E-mail Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="clients.data.length > 0">
                        <tr class="text-xs text-center" v-for="client in clients.data" :key="client.id">
                            <td class="text-left">{{ client.first_name }}</td>
                            <td>{{ client.middle_name}}</td>
                            <td>{{ client.last_name }}</td>
                            <td>{{ client.contact_no }}</td>
                            <td>{{ client.school ? client.school.name : '' }}</td>
                            <td>{{ client.online_program ? client.online_program.name : '' }}</td>
                            <td>{{ (client.user_program.length == 1) ? client.user_program[0]['program'].name : client.user_program.length + ' Courses' }}</td>
                            <td>{{ client.user.email }}</td>
                            <td>
                                <button @click="viewClientDetails(client.user_id)" class="btn btn-success btn-xs btn-flat">View</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-xs text-center">
                            <td colspan="8">No Client Registered</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-2">
                <button :disabled="!clients.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                <button :disabled="!clients.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
            </div>
        </div>
        <div class="modal fade show" id="modal-export" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selected Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </moderator-layout>
</template>

<script>
    import ModeratorLayout from '../../Layouts/ModeratorLayout.vue';
    export default {
        props: ['clients'],
        components: {
            ModeratorLayout
        },
        data () {
            return {
                filterName: '',
                fields: {
                    "First Name": "first_name",
                    "Middle Name": "middle_name",
                    "Last Name": "last_name",
                    "E-mail Address": "user.email",
                    "Contact No.": "contact_no",
                    "Program": "online_program.name",
                    "Program Track": {
                        field: "user_program",
                        callback: (value) => {
                            if (value.length > 1) {
                                return 'Multiple Courses'
                            } else {
                                return value[0]['program'].name;
                            }
                        }
                    },
                     "Required Hours": {
                        field: "user_program",
                        callback: (value) => {
                            return value[0]['hours_needed'];
                        }
                    },
                    
                     "Start Date": {
                        field: "user_program",
                        callback: (value) => {
                            return value[0]['start_date'];
                        }
                    },
                    
                     "End Date": {
                        field: "user_program",
                        callback: (value) => {
                            return value[0]['end_date'];
                        }
                    },
                    "Remarks": "''"
                }
            }
        },
        methods: {
            viewClientDetails (userId) {
                this.$inertia.visit(`/md/client/${userId}`);
            },
            deleteClientDetails (userId) {
                this.$inertia.delete(`/deleteClientDetails/${userId}`);
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
