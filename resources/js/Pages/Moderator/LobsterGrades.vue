<template>
    <moderator-layout>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Certs</h6>
            <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <button @click="openExportModal" class="btn btn-success btn-sm mx-2">Export By School</button>
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
                <table class="table table-hover">
                    <thead>
                        <tr class="text-xs text-left">
                            <th>Cert. ID</th>
                            <th>Name</th>
                            <th>School</th>
                            <th>Program/Track</th>
                            <th>Gold Medals</th>
                            <th>Silver Medals</th>
                            <th>Bronze Medals</th>
                            <th>Total Grade</th>
                            <th>Total Medals</th>
                            <th>Proficiency</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-xs text-left" v-for="cert in sCerts.data" :key="cert.id">
                            <td>{{ cert.cert_no }}</td>
                            <td>{{ cert.name }}</td>
                            <td>{{ cert.school }}</td>
                            <td>{{ cert.program }}</td>
                            <td>{{ cert.gold_medal }}</td>
                            <td>{{ cert.silver_medal }}</td>
                            <td>{{ cert.bronze_medal }}</td>
                            <td class="text-bold">{{ cert.total_grade }}</td>
                            <td class="text-bold">{{ cert.total_medal }}</td>
                            <td>{{ cert.proficiency }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-2">
                <button :disabled="!certs.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                <button :disabled="!certs.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
            </div>
        </div>

        <div class="modal fade show" id="modal-export" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="overlay d-flex justify-content-center align-items-center" v-if="isExportLoading">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Export Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="school">School</label>
                                <select v-model="selectedSchool" class="form-control form-control-sm">
                                    <option value="all" selected>All</option>
                                    <option v-for="school in schools" :key="school.id" :value="school.school">{{ school.school }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="filterBySchool" type="button" class="btn btn-primary btn-sm btn-flat btn-block">Filter</button>
                        <download-excel v-if="selectedCerts.length > 0"
                            id="export-btn"
                            class="mx-1 btn btn-success btn-sm btn-flat btn-block"
                            :data="selectedCerts"
                            :fields="certFields"
                            name="HIAP Export"
                            title="HIAP Grades"
                        >Export</download-excel>
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
        props: ['certs', 'schools'],
        components: {
            ModeratorLayout
        },
        data () {
            return {
                search: '',
                sCerts: this.certs,
                selectedCerts: [],
                selectedSchool: '',
                distinctSchools: [],
                isExportLoading: false,
                certFields: {
                    "Cert. ID": "cert_no",
                    "Name": "name",
                    "School": "school",
                    "Program": "program",
                    "Total Grade": "total_grade",
                    "Gold Medal": "gold_medal",
                    "Silver Medal": "silver_medal",
                    "Bronze Medal": "bronze_medal",
                    "Total Medal": "total_medal",
                    "Proficiency": "proficiency"
                }
            }
        },
        methods: {
            prevPage() {
                this.$inertia.visit(this.certs.prev_page_url, { preserveScroll: true });
            },
            nextPage() {
                this.$inertia.visit(this.certs.next_page_url, { preserveScroll: true });
            },
            searchByNameOrCertId() {
                let formData = new FormData();
                formData.append('search', this.search);
                axios.post('/searchLobsterInkCertificate', formData)
                    .then((response) => {
                        this.sCerts = response.data
                    })
            },
            openExportModal() {
                $('#modal-export').modal('show');
            },
            filterBySchool() {
                this.isExportLoading = true;
                let formData = new FormData();
                formData.append('school', this.selectedSchool);
                axios.post('/filter-cert-by-school', formData)
                    .then((response) => {
                        this.selectedCerts = response.data
                    })
            }
        }
    }
</script>