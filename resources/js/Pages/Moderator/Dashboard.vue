<template>
    <moderator-layout>
        <div class="card">
            <div class="card-header bg-info">
                <h6 class="card-title">School Overview</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-border">
                    <thead>
                        <tr class="text-center">
                            <th class="text-left">School</th>
                            <th>Students Newly Enrolled</th>
                            <th>Students Complete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="school in schools" :key="school.id" class="text-center text-sm">
                            <td class="text-left">{{ school.name }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" style="width: 100%">10/{{ clients.length }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" style="width: 100%">{{ school.clients.filter(e => e.user_program.application_status == 'Complete Learner') }}/{{ school.clients.length }}</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </moderator-layout>
</template>

<script>
    import ModeratorLayout from '../../Layouts/ModeratorLayout.vue';
    export default {
        props: ['programs', 'clients', 'schools'],
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
                    return e.application_status == 'New Learner';
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
                    return e.application_status == 'Confirmed Learner';
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
                    return e.application_status == 'On-going Learner';
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
