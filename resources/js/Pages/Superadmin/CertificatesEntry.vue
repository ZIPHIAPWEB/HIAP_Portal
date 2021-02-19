<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-outline card-outline-tabs">
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
                                <form id="cert-form">
                                    <div class="form-group">
                                        <label for="">Cert ID</label>
                                        <input v-model="form.cert_id" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input v-model="form.full_name" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">School</label>
                                        <input v-model="form.school" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Program/Track</label>
                                        <input v-model="form.program" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gold Medals</label>
                                        <input v-model="form.gold_medals" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Silver Medals</label>
                                        <input v-model="form.silver_medals" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bronze Medals</label>
                                        <input v-model="form.bronze_medals" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total Grade</label>
                                        <input v-model="form.total_grade" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total Medals</label>
                                        <input v-model="form.total_medals" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <button @click="addCert" class="btn btn-primary btn-sm">Add Cert</button>
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
                        <h6>Certs</h6>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-xs text-center" v-for="cert in certs" :key="cert.id">
                                    <td class="text-left">{{ cert.cert_no }}</td>
                                    <td>{{ cert.name }}</td>
                                    <td>{{ cert.school }}</td>
                                    <td>{{ cert.program }}</td>
                                    <td>{{ cert.gold_medal }}</td>
                                    <td>{{ cert.silver_medal }}</td>
                                    <td>{{ cert.bronze_medal }}</td>
                                    <td class="text-bold">{{ cert.total_grade }}</td>
                                    <td class="text-bold">{{ cert.total_medal }}</td>
                                    <td>
                                        <button @click="deleteFile(cert.id)" class="btn btn-danger btn-xs">
                                            <span class="fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: ['certs'],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                form: {
                    file: '',
                    cert_id: '',
                    full_name: '',
                    school: '',
                    program: '',
                    gold_medals: '',
                    silver_medals: '',
                    bronze_medals: '',
                    total_grade: '',
                    total_medals: ''
                }
            }
        },
        methods : {
            fileHandler () {
                this.form.file = this.$refs.cert.files[0];
            },
            saveFile () {
                let formData = new FormData();
                formData.append('file', this.form.file);
                this.$inertia.post('/uploadCertificate', formData);
            },
            addCert () {
                this.$inertia.post('/addCertificate', this.form, {
                    onBefore: () => confirm('Add this cert?'),
                    onSuccess: () => {
                        document.getElementById('cert-form').reset();
                        toastr.info('Cert Added');
                    },
                    onError: () => {
                        toastr.error('Error Occurs.');
                    }
                })
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