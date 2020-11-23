<template>
    <client-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="avatar" src="/man.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <personal-profile-component></personal-profile-component>
                    <!-- <client-initial-requirements></client-initial-requirements> -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Enrolled Courses</h5>
                            <div class="card-tools">
                                <!-- <button class="btn btn-xs btn-primary" data-target="#modal-default" data-toggle="modal">Enroll New Course</button> -->
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-left">Course</th>
                                        <th>Program</th>
                                        <th>Application Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th style="width: 30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in userPrograms" :key="p.id">
                                        <td class="text-sm">{{ p.program.name }}</td>
                                        <td class="text-center text-sm">{{ p.course.name }}</td>
                                        <td class="text-center text-sm">{{ p.application_status }}</td>
                                        <td class="text-center text-sm">{{ p.start_date }}</td>
                                        <td class="text-center text-sm">{{ p.end_date}}</td>
                                        <td class="text-center">
                                            <inertia-link :href="`/client/${p.program.id}/requirements`" class="btn btn-xs btn-success">View Requirements</inertia-link>
                                        </td>
                                    </tr >
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade show" id="modal-default" aria-modal="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Choose Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <select v-model="selectedProgram" class="form-control form-control-sm">
                                <option v-for="program in programs" :key="program.id" :value="program.id">{{ program.name }}</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button @click="addNewProgram" type="button" class="btn btn-block btn-sm btn-primary">Enroll</button>
                        </div>
                    </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </client-layout>
</template>

<script>
    import ClientLayout from '../../Layouts/ClientLayout.vue';
    import PersonalProfileComponent from '../../components/PersonalProfileComponent.vue';
    import ClientInitialRequirements from '../../components/ClientInitialRequirement.vue';
    export default {
        props: ['user', 'client', 'userPrograms'],
        components: {
            ClientLayout,
            ClientInitialRequirements,
            PersonalProfileComponent
        },
        data () {
            return {
                programs: [],
                selectedProgram: ''
            }
        },
        mounted () {
            this.getAllPrograms();
        },
        methods: {
            getAllPrograms () {
                axios.get('/getAllPrograms')
                    .then((response) => {
                        this.programs = response.data;
                    })
            },
            addNewProgram () {
                let formData = new FormData();
                formData.append('program_id', this.selectedProgram);
                this.$inertia.post('/addNewProgram', formData)
                    .then((response) => {

                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .avatar {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: solid 0px gray;
        transition: border-width ease-out 250ms;
        cursor: pointer;
        &:hover {
            border-width: 3px;
        }
    }
</style>
