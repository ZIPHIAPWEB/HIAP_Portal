<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-sm-3">
                <div class="card card-outline card-outline-tabs">
                    <div v-if="isLoading" class="overlay">
                        <i class="fas fa-2x fa-spinner fa-spin"></i>
                    </div>
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#single" class="nav-link active" data-toggle="pill">Single</a>
                            </li>
                            <li class="nav-item">
                                <a href="#bulk" class="nav-link" data-toggle="pill">Bulk</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="single">
                                <form id="cert-form" @submit.prevent="submitAction()">
                                    <div class="form-group">
                                        <label for="cert_id">Permanent Cert ID</label>
                                        <input v-model="selectedParticipant.cert_id_main" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="cert_id">Cert ID</label>
                                        <input v-model="selectedParticipant.cert_id" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="full_name">Fullname</label>
                                        <input v-model="selectedParticipant.full_name" type="text" class="form-control form-control-sm" placeholder="Jane Doe">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">School</label>
                                        <input v-model="selectedParticipant.school" type="text" class="form-control form-control-sm" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Course</label>
                                        <input v-model="selectedParticipant.course" type="text" class="form-control form-control-sm" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="cert_hours">Hours</label>
                                        <input v-model="selectedParticipant.hours" type="text" class="form-control form-control-sm" placeholder="01/01/1990 00:00:00">
                                    </div>
                                    <div class="form-group">
                                        <label for="layout">Layout</label>
                                        <select v-model="selectedParticipant.lobster_layout_id" class="form-control form-control-sm">
                                            <option selected value="">Select layout</option>
                                            <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button v-if="!isEdit" type="submit" class="btn btn-primary btn-sm">Add Cert</button>
                                        <div v-else>
                                            <button type="submit" class="btn btn-success btn-sm">Update Cert</button>
                                            <button @click="cancelEdit()" type="button" class="btn btn-danger btn-sm">Cancel Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="bulk">
                                <form @submit.prevent="saveFile()">
                                    <div class="form-group">
                                        <input @change="fileHandler" type="file" ref="participants" name="" id="">
                                    </div>
                                    <div class="form-group">
                                        <label>School</label>
                                        <input v-model="form.school" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label>Cert Layout</label>
                                        <select v-model="form.layout_id" class="form-control form-control-sm">
                                            <option selected value="">Select Layout</option>
                                            <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">Add Record</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Participants</h6>
                        <div class="card-tools">
                             <div class="input-group input-group-sm">
                                <input @keypress.enter="searchByCertId()" type="text" class="form-control" v-model="search"  placeholder="Search by cert id/name/school">
                                <span class="input-group-append">
                                    <button @click="searchByCertId()" class="btn btn-info btn-flat">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-left">Cert ID</th>
                                    <th>Full Name</th>
                                    <th>School</th>
                                    <th>Course</th>
                                    <th>Hours</th>
                                    <th>Layout</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="clients.data.length > 0">
                                <lobster-client-item v-for="participant in clients.data" :participant="participant" :key="participant.id" @selectedParticipant="editParticipant" class="text-center"></lobster-client-item>
                            </tbody>
                            <tbody v-else>
                                <tr class="text-center">
                                    <td colspan="6">No Records</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                    <div v-if="!isSearched" class="card-footer p-2">
                        <button :disabled="!clients.prev_page_url" @click="prevNormalPage()" class="btn btn-primary btn-xs">Prev</button>
                        <button :disabled="!clients.next_page_url" @click="nextNormalPage()" class="btn btn-primary btn-xs">Next</button>
                    </div>
                   <div v-else class="card-footer p-2">
                        <button :disabled="!clients.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                        <button :disabled="!clients.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>    
</template>

<script>
import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
import LobsterClientItem from '../../../components/LobsterClientItem.vue';

export default {
    props: [
        'lobster_clients',
        'layouts'
    ],
    components: {
        SuperadminLayout,
        LobsterClientItem
    },
    data () {
        return {
            clients: this.lobster_clients,
            isLoading: false,
            isEdit: false,
            isSearched: false,
            selectedParticipant: {
                cert_id_main: '',
                cert_id: '',
                full_name: '',
                school: '',
                course: '',
                hours: '',
                lobster_layout_id: ''
            },
            search: '',
            form: {
                layout_id: '',
                school: '',
                file: []
            }
        }
    },
    methods: {
        fileHandler() { 
            this.form.file = this.$refs.participants.files[0];
        },
        submitAction() {
            this.isLoading = true;
            switch(this.isEdit) {
                case false: 
                    this.$inertia.post('/lobsterClientUploadCert', this.selectedParticipant, {
                        onBefore: () => confirm('Submit this record?'),
                        onSuccess: () => {
                            toastr.info('New cert added.')
                            this.isLoading = false;
                        }
                    })
                break;

                case true: 
                    this.$inertia.patch(`/lobsterClientUpdateCert/${this.selectedParticipant.id}`, this.selectedParticipant, {
                        onBefore: () => confirm('Update this record?'),
                        onSuccess: () => {
                            this.isEdit = false;
                            this.isLoading = false;
                            toastr.info('Selected cert updated.')
                        }
                    })
                break;
            }
        },
        saveFile() {
            this.isLoading = true;
            this.$inertia.post('/lobsterClientUploadCerts', this.form, {
                onBefore: () => confirm('Add this datas?'),
                onSuccess: () => {
                    this.isLoading = false;
                    toastr.info('Record from file uploaded.');
                },
                onError: errors => {
                    this.isLoading = false;
                    toastr.error('An error has occured while uploading.')
                }
            })
        },
        editParticipant(participant) {
            this.isEdit = true;
            this.selectedParticipant = participant;
        },
        cancelEdit() {
            this.isEdit = false;
            this.selectedParticipant = {};
        },
        nextNormalPage() {
            this.$inertia.visit(this.clients.next_page_url);
        },
        prevNormalPage() {
            this.$inertia.visit(this.clients.prev_page_url);
        },
        nextPage() {
            axios.post(this.clients.next_page_url)
                .then((response) => {
                    this.clients = response.data;
                });
        },
        prevPage() {
            axios.post(this.clients.prev_page_url)
                .then((response) => {
                    this.clients = response.data;
                })
        },
        searchByCertId() {
            this.isSearched = true;
            axios.post('/lobsterClientSearch', {search: this.search})
                .then((response) => {
                    this.clients = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>