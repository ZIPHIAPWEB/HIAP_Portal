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
                                        <label for="full_name">Fullname</label>
                                        <input v-model="selectedParticipant.full_name" type="text" class="form-control form-control-sm" placeholder="Jane Doe">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input v-model="selectedParticipant.email" type="text" class="form-control form-control-sm" placeholder="sample@app.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="school">School</label>
                                        <input v-model="selectedParticipant.school" type="text" class="form-control form-control-sm" placeholder="Sample school">
                                    </div>
                                    <div class="form-group">
                                        <label for="cert_created_at">Webinar Date</label>
                                        <input v-model="selectedParticipant.cert_created_at" type="text" class="form-control form-control-sm" placeholder="01/01/1990 00:00:00">
                                    </div>
                                    <div class="form-group">
                                        <label for="layout">Layout</label>
                                        <select v-model="selectedParticipant.cert_layout_id" class="form-control form-control-sm">
                                            <option selected value="">Select layout</option>
                                            <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button v-if="!isEdit" type="submit" class="btn btn-primary btn-sm">Add Cert</button>
                                        <button v-else type="submit" class="btn btn-success btn-sm">Update Cert</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="bulk">
                                <form @submit.prevent="saveFile()">
                                    <div class="form-group">
                                        <input @change="fileHandler" type="file" ref="participants" name="" id="">
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
                                <input @keypress.enter="searchByEmailOrName()" type="text" class="form-control" v-model="search"  placeholder="Search by cert id/name">
                                <span class="input-group-append">
                                    <button @click="searchByEmailOrName()" class="btn btn-info btn-flat">
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
                                    <th class="text-left">Date</th>
                                    <th>Full Name</th>
                                    <th>E-mail</th>
                                    <th>School</th>
                                    <th>Layout</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="sParticipants.data.length > 0">
                                <tr v-for="participant in sParticipants.data" :key="participant.id" class="text-center">
                                    <td class="text-left">{{ participant.cert_created_at }}</td>
                                    <td>{{ participant.full_name }}</td>
                                    <td>{{ participant.email }}</td>
                                    <td>{{ participant.school }}</td>
                                    <td>{{ participant.layout.name }}</td>
                                    <td>
                                        <button @click="downloadCert(participant.id)" class="btn btn-warning btn-xs">Download</button>
                                        <button @click="editParticipant(participant)" class="btn btn-success btn-xs">Edit</button>
                                        <button @click="deleteCert(participant.id)" class="btn btn-danger btn-xs">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr class="text-center">
                                    <td colspan="6">No Records</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                   <div class="card-footer p-2">
                        <button :disabled="!sParticipants.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                        <button :disabled="!sParticipants.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>    
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    export default {
        props: [
            'layouts', 'participants'
        ],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                form: {
                    file: '',
                    layout_id: ''
                },
                sParticipants: this.participants,
                selectedParticipant: {
                    full_name: '',
                    email: '',
                    school: '',
                    cert_layout_id: '',
                    cert_created_at: ''
                },
                search: '',
                isEdit: false,
                isLoading: false,
            }
        },
        methods: {
            editParticipant(value) {
                this.isEdit = true;
                this.selectedParticipant = value;
                toastr.info(`${value.full_name} selected!`);
                console.log(value);
            },
            searchByEmailOrName () {
                axios.post('/searchCertificate', {search: this.search})
                    .then((response) => {
                        this.sParticipants = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            nextPage() {
                this.$inertia.visit(this.participants.next_page_url);
            },
            prevPage() {
                this.$inertia.visit(this.participants.prev_page_url);
            },
            fileHandler () {
                this.form.file = this.$refs.participants.files[0];
            },
            saveFile () {
                this.isLoading = true;
                this.$inertia.post('/certClientsAddBulk', this.form, {
                    onBefore: () => confirm('Add this datas?'),
                    onSuccess: (data) => {
                        this.sParticipants = data.props.participants;
                        toastr.info('Data added.');
                        this.isLoading = false;
                    },
                    onError: () => {
                        toastr.error('Error occured.');
                        this.isLoading = false;
                    }
                })
            },
            submitAction () {
                switch(this.isEdit) {
                    case false:
                        this.isLoading = true;
                        this.$inertia.post('/certSaveSingle', this.selectedParticipant, {
                            onBefore: () => confirm('Save this certificate details?'),
                            onSuccess: (data) => {
                                this.sParticipants = data.props.participants;
                                toastr.info('Certificate added.');
                                this.isLoading = false;
                            },
                            onError: () => {
                                toastr.error('Something went wrong.');
                                this.isLoading = false;
                            }
                        })
                    break;

                    case true:
                        this.isLoading = true;
                        this.$inertia.patch('/certUpdateClient', this.selectedParticipant, {
                            onBefore: () => confirm('Update this certificate details?'),
                            onSuccess: (data) => {
                                this.sParticipants = data.props.participants;
                                toastr.info('Certificate updated.');
                                this.isLoading = false;
                            },
                            onError: () => {
                                toastr.error('Something went wrong.');
                                this.isLoading = false;
                            }
                        })
                    break;
                }
            },
            deleteCert(id) {
                this.$inertia.delete(`/certDelete/${id}`, {
                    onBefore: () => confirm('Delete this certificate?'),
                    onSuccess: (data) => {
                        this.sParticipants = data.props.participants;
                        toastr.info('Certificated deleted.');
                    }
                })
            },
            downloadCert (id) {
                this.$inertia.get(`/certDownloadActual/${id}`, {
                    onBefore: () => confirm('Download this cert?'),
                    onSuccess: () => {
                        toastr.info('Cert Downloaded');
                    }
                })
            }
        }
    }
</script>