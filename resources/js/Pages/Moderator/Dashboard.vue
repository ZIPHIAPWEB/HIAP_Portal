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
                            <th>Newly Enrolled in Program Track</th>
                            <th>Confirmed Enrollees in Program Track</th>
                            <th>Completed Enrollees in Program Track</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="school in schools" :key="school.id" class="text-center text-sm">
                            <td class="text-left">{{ school.name }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" :style=" `width: ${(statusCounter(school.clients, 'New Learner') / totalStudents(school.clients)) * 100}%;` ">{{ statusCounter(school.clients, 'New Learner') }}/{{ totalStudents(school.clients) }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" :style=" `width: ${(statusCounter(school.clients, 'Confirmed Learner') / totalStudents(school.clients)) * 100}%;` ">{{ statusCounter(school.clients, 'Confirmed Learner') }}/{{ totalStudents(school.clients) }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-info" :style=" `width: ${(statusCounter(school.clients, 'Complete Learner') / totalStudents(school.clients)) * 100}%;` ">{{ statusCounter(school.clients, 'Complete Learner') }}/{{ totalStudents(school.clients) }}</div>
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
        methods: {
            statusCounter($data, $filterBy) {
                let temp = 0;
                $data.forEach(e => {
                    temp += e.user_program.filter(e => e.application_status == $filterBy).length;
                });

                return temp;
            },
            totalStudents($data) {
                let temp = 0;
                $data.forEach(e => {
                    temp += e.user_program.length;
                });

                return temp;
            }
        }
    }
</script>
