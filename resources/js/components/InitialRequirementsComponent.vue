<template>
    <div class="card">
        <div v-if="loading" class="overlay">
            <i class="fas fa-2x fa-spinner fa-pulse"></i>
        </div>
        <div class="card-header">
            <h5 class="float-left">{{ program.name }} Initial Requirement</h5>
            <input v-model="filterName" placeholder="Search by name" type="text" class="col-2 form-control form-control-sm float-right">
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">File Uploaded</th>
                        <th style="width: 13%;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="isCreateNew == false" @click="isCreateNew = true">
                        <td colspan="4" class="text-center text-sm create-new">
                            <i class="fas fa-plus my-2"></i>
                        </td>
                    </tr>
                    <tr v-else style="background: #F0F0F0">
                        <td class="ml-0">
                            <input autofocus v-model="form.name" placeholder="Requirement Name" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td>
                            <input v-model="form.description" placeholder="Requirement Description" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td class="text-center">
                            <input @change="fileHandler" type="file" ref="file">
                        </td>
                        <td class="text-center">
                            <button @click="addNewRequirement" class="btn btn-success btn-xs"><i class="fas fa-check"></i></button>
                            <button @click="isCreateNew = false;" class="btn btn-danger btn-xs"><i class="fas fa-ban"></i></button>
                        </td>
                    </tr>
                    <tr  v-for="req in filteredRequirements" :key="req">
                        <td class="text-sm">
                            <span v-if="forEdit != req.id">{{ req.name }}</span>
                            <input autofocus v-else v-model="form.name" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td class="text-center text-sm">
                            <span v-if="forEdit != req.id">{{ req.description }}</span>
                            <input v-else v-model="form.description" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td class="text-center text-sm">
                            {{ req.file_path }}
                        </td>
                        <td class="text-center">
                            <div v-if="forEdit != req.id">
                                <button @click="editProgram(req)" class="btn btn-success btn-xs">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button @click="deleteProgram(req)" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div v-else>
                                <button @click="updateProgram(req.id)" class="btn btn-success btn-xs">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button @click="forEdit = 0; form.name = ''; form.description = '';" class="btn btn-danger btn-xs">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['program'],
        data () {
            return {
                form: {
                    name: '',
                    description: '',
                    file: ''
                },
                initials: [],
                filterName: '',
                loading: false,
                isCreateNew: false,
                forEdit: 0
            }
        },
        computed: {
            filteredRequirements () {
                return this.initials.filter(e => {
                    return e.name.toLowerCase().includes(this.filterName.toLowerCase());
                })
            }
        },
        mounted() {
            this.getAllInitialRequirements();
        },
        methods: {
            getAllInitialRequirements() {
                this.loading = true;
                axios.get(`/getAllInitialRequirements/${this.program.id}`)
                    .then(({data}) => {
                        this.initials = data;
                        this.loading = false;
                    })
                    .catch(({response}) => {
                        console.log(response);
                    })
            },
            fileHandler() {
                this.form.file = this.$refs.file.files[0];
            },
            addNewRequirement() {
                this.loading = true;
                let formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('description', this.form.description);
                formData.append('file', this.form.file);
                axios.post(`/storeInitialRequirement/${this.program.id}`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(({data}) => {
                        this.initials.unshift(data);
                        this.form.name = '';
                        this.form.description = '';
                        this.isCreateNew = false;
                        this.loading = false;
                        toastr.info('New requirement added.')
                    })
                    .catch(({response}) => {
                        console.log(response);
                        this.loading = false;
                        toastr.error('error has occured')
                    })
            },
            editProgram(req) {
                this.form.name = req.name;
                this.form.description = req.description;

                this.forEdit = req.id;
            },
            deleteProgram(req) {
                axios.delete(`/deleteInitialRequirement/${req.id}`)
                    .then((response) => {
                        this.getAllInitialRequirements();
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .create-new {
        cursor: pointer;
        &:hover {
            background: #1083f0;
            color: white !important;
        }
    }
</style>
