<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-outline card-outline-tabs">
                    <div v-if="isLoading" class="overlay">
                        <i class="fas fa-spinner fa-2x fa-spin"></i>
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
                                <form id="cert-form" @submit.prevent="submitCert">
                                    <div class="form-group">
                                        <label for="">Cert ID</label>
                                        <input v-model="form.cert_no" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('cert_no')) ? 'is-invalid' : ''" placeholder="ABCD123456">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input v-model="form.name" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('name')) ? 'is-invalid' : ''" placeholder="Jane Doe">
                                    </div>
                                    <div class="form-group">
                                        <label for="">School</label>
                                        <input v-model="form.school" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('school')) ? 'is-invalid' : ''" placeholder="Sample School">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Program/Track</label>
                                        <input v-model="form.program" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('program')) ? 'is-invalid' : ''" placeholder="Sample Program/Track">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gold Medals</label>
                                        <input v-model="form.gold_medal" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('gold_medal')) ? 'is-invalid' : ''" placeholder="123">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Silver Medals</label>
                                        <input v-model="form.silver_medal" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('silver_medal')) ? 'is-invalid' : ''" placeholder="123">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bronze Medals</label>
                                        <input v-model="form.bronze_medal" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('bronze_medal')) ? 'is-invalid' : ''" placeholder="123">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total Grade</label>
                                        <input v-model="form.total_grade" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('total_grade')) ? 'is-invalid' : ''" placeholder="100%">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total Medals</label>
                                        <input v-model="form.total_medal" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('total_medal')) ? 'is-invalid' : ''" placeholder="123">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Proficiency</label>
                                        <input v-model="form.proficiency" type="text" class="form-control form-control-sm" :class="(errors.hasOwnProperty('proficiency')) ? 'is-invalid' : ''" placeholder="1.2345">
                                    </div>
                                    <div class="form-group">
                                        <button v-if="!isEdit" type="submit" class="btn btn-primary btn-sm">Add Cert</button>
                                        <button v-else type="submit" class="btn btn-success btn-sm">Update Cert</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="bulk">
                                <div class="form-group">
                                    <input @change="fileHandler" type="file" ref="cert" name="" id="">
                                    <button @click="saveFile">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Certs</h6>
                        <div class="card-tools">
                             <div class="input-group input-group-sm">
                                <input @keypress.enter="searchByNameOrCertId()" type="text" class="form-control" v-model="search"  placeholder="Search by cert id/name">
                                <span class="input-group-append">
                                    <button @click="searchByNameOrCertId()" class="btn btn-info btn-flat">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr class="text-xs text-center">
                                    <th class="text-left">Cert. ID</th>
                                    <th>Name</th>
                                    <th>School</th>
                                    <th>Program/Track</th>
                                    <th>Gold Medals</th>
                                    <th>Silver Medals</th>
                                    <th>Bronze Medals</th>
                                    <th>Total Grade</th>
                                    <th>Total Medals</th>
                                    <th>Proficiency</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-xs text-center" v-for="cert in sCerts.data" :key="cert.id">
                                    <td class="text-left">{{ cert.cert_no }}</td>
                                    <td>{{ cert.name }}</td>
                                    <td>{{ cert.school }}</td>
                                    <td>{{ cert.program }}</td>
                                    <td>{{ cert.gold_medal }}</td>
                                    <td>{{ cert.silver_medal }}</td>
                                    <td>{{ cert.bronze_medal }}</td>
                                    <td class="text-bold">{{ cert.total_grade }}</td>
                                    <td class="text-bold">{{ cert.total_medal }}</td>
                                    <td>{{ cert.proficiency }}</td>
                                    <td>
                                        <button @click="editFile(cert)" class="btn btn-success btn-xs">
                                            Edit
                                        </button>
                                        <button @click="deleteFile(cert.id)" class="btn btn-danger btn-xs">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer p-2">
                        <button :disabled="!certs.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                        <button :disabled="!certs.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: [
            'certs',
            'errors'
        ],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                isEdit: false,
                isLoading: false,
                sCerts: this.certs,
                search: '',
                form: {
                    file: '',
                    cert_no: '',
                    name: '',
                    school: '',
                    program: '',
                    gold_medal: '',
                    silver_medal: '',
                    bronze_medal: '',
                    total_grade: '',
                    total_medal: '',
                    proficiency: ''
                }
            }
        },
        methods : {
            prevPage() {
                this.$inertia.visit(this.certs.prev_page_url, { preserveScroll: true });
            },
            nextPage() {
                this.$inertia.visit(this.certs.next_page_url, { preserveScroll: true });
            },
            fileHandler () {
                this.form.file = this.$refs.cert.files[0];
            },
            saveFile () {
                this.isLoading = true;
                let formData = new FormData();
                formData.append('file', this.form.file);
                this.$inertia.post('/uploadCertificate', formData, {
                    onSuccess: () => {
                        toastr.info('Data added.')
                        this.isLoading = false;
                    },
                    onError: () => {
                        toastr.error('Something went wrong');
                        this.isLoading = false;
                    }
                });
            },
            searchByNameOrCertId() {
                let formData = new FormData();
                formData.append('search', this.search);
                axios.post('/searchLobsterInkCertificate', formData)
                    .then((response) => {
                        this.sCerts = response.data
                    })
            },
            submitCert () {
                switch(this.isEdit) {
                    case false:
                        this.isLoading = true;
                        this.$inertia.post('/addCertificate', this.form, {
                            onBefore: () => confirm('Add this cert?'),
                            onSuccess: () => {
                                toastr.info('Cert Added');
                                this.isEdit = false;
                                this.isLoading = false;
                            },
                            onError: () => {
                                toastr.error('Error Occurs.');
                                this.isLoading = false;
                            }
                        })
                        break;

                    case true:
                        this.isLoading = true;
                        this.$inertia.patch('/updateCertificate', this.form, {
                            onBefore: () => confirm('Update this cert?'),
                            onSuccess: () => {
                                toastr.info('Cert Updated');
                                this.isEdit = false;
                                this.isLoading = false;
                            },
                            onError: () => {
                                toastr.error('Error Occurs');
                                this.isLoading = false;
                            }
                        })
                        break;
                }
            },
            editFile(data) {
                this.isEdit = true;
                this.form = data;
            },
            deleteFile (id) {
                let q = confirm('Delete this certificate?');
                
                if (q) {
                    this.$inertia.delete(`/deleteCertificate/${id}`);
                }
            }
        }
    }
</script>