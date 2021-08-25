<template>
    <div class="card">
        <div class="overlay" v-if="loading">
            <i class="fas fa-2x fa-spinner fa-pulse m-2"></i>
        </div>
        <div class="card-header">
            <h5 class="m-0 card-title">Initial Requirements</h5>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a href="#requirement" class="nav-link active text-sm" data-toggle="tab">Requirement</a>
                    </li>
                    <li class="nav-item" v-if="grades.length > 0">
                        <a href="#gradebook" class="nav-link text-sm" data-toggle="tab">Gradebook</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="tab-content p-0">
                <div class="tab-pane active" id="requirement">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="width: 45%;">Requirements</th>
                                <th style="width: 15%" class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody v-if="requirements.length > 0">
                            <tr v-for="requirement in requirements" :key="requirement.id">
                                <td>{{ requirement.name }}</td>
                                <td class="text-center">
                                    <i v-if="requirement.client_initial.status" class="fas fa-check text-success"></i>
                                    <i v-else class="fas fa-times text-danger"></i>
                                </td>
                                <td class="text-center">
                                <button v-if="requirement.client_initial.status" @click="deleteFile(requirement.client_initial.id)" class="btn btn-danger btn-xs">Delete File</button>
                                    <div v-else class="d-flex flex-row justify-content-center">
                                        <div v-if="requirement.file_path">
                                            <a :href="requirement.file_path" class="mx-1 btn btn-success btn-xs" download>Download {{ requirement.name }}</a>
                                        </div>
                                        <upload-initial-requirement :initialId="requirement.id" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="3" class="text-center">No Requirements</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="gradebook">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Quiz Title</th>
                                <th class="text-center">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in grades" :key="item.id">
                                <td>{{ item.title }}</td>
                                <td class="text-center">{{ item.grade.grade }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UploadInitialRequirement from '../components/UploadInitialRequirement.vue';
    export default {
        props: ['programId'],
        components: {
            UploadInitialRequirement
        },
        data () {
            return {
                loading: false,
                isUpload: true,
                requirements: [],
                grades: []
            }
        },
        mounted () {
            this.getClientRequirements();
            this.getClientGrades();
        },
        methods: {
            getClientGrades () {
                this.loading = true;
                axios.get(`/getClientGrades/1`)
                    .then((response) => {
                        console.log(response)
                        this.requirements = data;
                        this.loading = false;
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                    })
            },
            getClientRequirements() {
                this.loading = true;
                axios.get(`/getInitial`)
                    .then(({data}) => {
                        this.requirements = data;
                        this.loading = false;
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                    })
            },
            deleteFile (initialId) {
                if (confirm("Are you sure on deleting this file?")) {
                    axios.delete(`/deleteClientInitialRequirement/${initialId}`)
                        .then((response) => {
                            this.getClientRequirements();
                            toastr.info('File Delete!');
                        })
                }
            }
        }
    }
</script>

