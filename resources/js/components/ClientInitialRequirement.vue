<template>
    <div class="card">
        <div class="overlay" v-if="loading">
            <i class="fas fa-2x fa-spinner fa-pulse m-2"></i>
        </div>
        <div class="card-header">
            <h5 class="m-0">Initial Requirements</h5>
        </div>
        <div class="card-body p-0">

            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="width: 45%;">Requirements</th>
                        <th style="width: 15%" class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="requirement in requirements" :key="requirement.id">
                        <td>{{ requirement.name }}</td>
                        <td class="text-center">
                            <i v-if="requirement.client_initial" class="fas fa-check text-success"></i>
                            <i v-else class="fas fa-times text-danger"></i>
                        </td>
                        <td class="text-center">
                            <button v-if="requirement.client_initial" @click="deleteFile(requirement.client_initial.id)" class="btn btn-danger btn-xs">Delete File</button>
                            <div v-else class="d-flex flex-row justify-content-center">
                                <div v-if="requirement.file_path">
                                    <a :href="'/initials/' + requirement.file_path" class="mx-1 btn btn-success btn-xs" download>Download {{ requirement.name }}</a>
                                </div>
                                <upload-initial-requirement :initialId="requirement.id" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import UploadInitialRequirement from '../components/UploadInitialRequirement.vue';
    export default {
        components: {
            UploadInitialRequirement
        },
        data () {
            return {
                loading: false,
                isUpload: true,
                requirements: [],
            }
        },
        mounted () {
            this.getClientRequirements();
        },
        methods: {
            getClientRequirements () {
                this.loading = true;
                axios.get('/getInitialRequirementsForClient')
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

