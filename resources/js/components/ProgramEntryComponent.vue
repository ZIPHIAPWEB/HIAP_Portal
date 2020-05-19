
<template>
    <div class="card">
        <div v-if="loading" class="overlay">
            <i class="fas fa-2x fa-spinner fa-pulse"></i>
        </div>
        <div class="card-header">
            <input v-model="filterName" placeholder="Search program by name" type="text" class="col-2 form-control form-control-sm float-right">
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Description</th>
                        <th style="width: 13%;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="isCreateNew == false" @click="isCreateNew = true">
                        <td colspan="3" class="text-center text-sm create-new">
                            <i class="fas fa-plus my-2"></i>
                        </td>
                    </tr>
                    <tr v-else style="background: #F0F0F0">
                        <td class="ml-0">
                            <input autofocus v-model="form.name" placeholder="Program Name" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td>
                            <input v-model="form.description" placeholder="Program Description" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td class="text-center">
                            <button @click="addNewProgram" class="btn btn-success btn-xs">Add</button>
                            <button @click="isCreateNew = false;" class="btn btn-danger btn-xs">Cancel</button>
                        </td>
                    </tr>
                    <tr  v-for="program in filteredPrograms" :key="program">
                        <td class="text-sm">
                            <span v-if="forEdit != program.id">{{ program.name }}</span>
                            <input autofocus v-else v-model="form.name" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td class="text-center text-sm">
                            <span v-if="forEdit != program.id">{{ program.description }}</span>
                            <input v-else v-model="form.description" type="text" class="form-control form-control-sm text-center">
                        </td>
                        <td class="text-center">
                            <div v-if="forEdit != program.id">
                                <inertia-link :href="`/sa/program/initials/${program.id}`" class="btn btn-warning btn-xs">
                                    View
                                </inertia-link>
                                <button @click="editProgram(program)" class="btn btn-success btn-xs">
                                    Edit
                                </button>
                                <button @click="deleteProgram(program)" class="btn btn-danger btn-xs">
                                    Delete
                                </button>
                            </div>
                            <div v-else>
                                <button @click="updateProgram(program.id)" class="btn btn-success btn-xs">
                                    Update
                                </button>
                                <button @click="forEdit = 0; form.name = ''; form.description = '';" class="btn btn-danger btn-xs">
                                    Cancel
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
    data () {
        return {
            programs: [],
            form: {
                name: '',
                description: ''
            },
            loading: false,
            isCreateNew: false,
            forEdit: 0,
            filterName: ''
        }
    },
    computed: {
        filteredPrograms () {
            return this.programs.filter(e => {
                return e.name.toLowerCase().includes(this.filterName.toLowerCase());
            })
        },
    },
    mounted () {
        this.getAllPrograms();
    },
    methods: {
        getAllPrograms () {
            this.loading = true;
            axios.get('/getAllPrograms')
                .then(({data}) => {
                    this.loading = false;
                    this.programs = data;
                })
                .catch(({response}) => {
                    this.loading = false;
                    console.log(response.errors);
                })
        },
        goToInitial(program) {
            window.location.href = `/sa/initials/${program.id}`;
        },
        addNewProgram () {
            axios.post('/storeProgramDetails', this.form)
                .then(({data}) => {
                    this.programs.unshift(data);
                    this.isCreateNew = false;
                })
                .catch(({response}) => {
                    console.log(response.errors);
                })
        },
        editProgram (program) {
            this.form.name = program.name;
            this.form.description = program.description;

            this.forEdit = program.id;
        },
        updateProgram (id) {
            axios.post(`/updateProgramDetails/${id}`, this.form)
                .then(({data}) => {
                    this.getAllPrograms();
                    this.form.name = '';
                    this.form.description = '';
                    this.forEdit = 0;
                })
        },
        deleteProgram (program) {
            this.loading = true;
            axios.delete(`/deleteProgramDetails/${program.id}`)
                .then(({data}) => {
                    this.getAllPrograms();
                    console.log(data);
                    this.loading = false;
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
