<template>
    <moderator-layout>
        <div class="card">
            <div class="card-header d-flex ">
                <div>
                    <select v-model="filterByProgram" class="form-control form-control-sm">
                        <option value="All" selected>All</option>
                        <option v-for="program in programs" :value="program.id" :key="program.id">{{ program.name }}</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">New Applicant: {{ newApplicant }}/{{ allClients }}</label>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-primary" :style="{ width: newApplicant / allClients * 100 + '%' }"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Requirement Submitted: {{ requirementSubmitted }}/{{ allClients }}</label>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-success" :style="{ width: requirementSubmitted / allClients * 100 + '%' }"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Application Processing: {{ applicationProcessing }}/{{ allClients }}</label>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-warning" :style="{ width: applicationProcessing / allClients * 100 + '%' }"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Program Completed: {{ programCompleted }}/{{ allClients }}</label>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-danger" :style="{ width: programCompleted / allClients * 100 + '%' }"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </moderator-layout>
</template>

<script>
    import ModeratorLayout from '../../Layouts/ModeratorLayout.vue';
    export default {
        props: ['programs', 'clients'],
        components: {
            ModeratorLayout
        },
        data () {
            return {
                filterByProgram: 'All'
            }
        },
        computed: {
            allClients () {
                return this.clients.length;
            },
            newApplicant () {
                return this.clients.filter(e => {
                    if (this.filterByProgram == 'All') {
                        return e;
                    } else {
                        return e.program_id == this.filterByProgram;
                    }
                }).filter(e => {
                    return e.application_status == 'New Applicant';
                }).length;
            },
            requirementSubmitted () {
                return this.clients.filter(e => {
                    if (this.filterByProgram == 'All') {
                        return e;
                    } else {
                        return e.program_id == this.filterByProgram;
                    }
                }).filter(e => {
                    return e.application_status == 'Requirement Submitted';
                }).length;
            },
            applicationProcessing () {
                return this.clients.filter(e => {
                    if (this.filterByProgram == 'All') {
                        return e;
                    } else {
                        return e.program_id == this.filterByProgram;
                    }
                }).filter(e => {
                    return e.application_status == 'Application Processing';
                }).length;
            },
            programCompleted () {
                return this.clients.filter(e => {
                    if (this.filterByProgram == 'All') {
                        return e;
                    } else {
                        return e.program_id == this.filterByProgram;
                    }
                }).filter(e => {
                    return e.application_status == 'Program Completed';
                }).length;
            }
        }
    }
</script>
