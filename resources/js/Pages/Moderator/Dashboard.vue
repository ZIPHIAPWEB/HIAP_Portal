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
                                    <div class="progress-bar bg-primary" :style="`width:${(newLearnerCount(school.clients) / totalStudents(school.clients)) * 100}%;`" >{{ newLearnerCount(school.clients) }}/{{ totalStudents(school.clients) }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" :style="`width:${(comfirmedLearnerCount(school.clients) / totalStudents(school.clients)) * 100}%;`">{{ comfirmedLearnerCount(school.clients) }}/{{ totalStudents(school.clients) }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-info" :style="`width:${(completeLearnerCount(school.clients) / totalStudents(school.clients)) * 100}%;`">{{ completeLearnerCount(school.clients) }}/{{ totalStudents(school.clients) }}</div>
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
            newLearnerCount(data) {
                let temp = 0;
                data.forEach(e => {
                    temp += e.get_new_learners_count;
                })

                return temp;
            },
            comfirmedLearnerCount(data) {
                let temp = 0;
                data.forEach(e => {
                    temp += e.get_confirmed_learners_count;
                })

                return temp;
            },
            completeLearnerCount(data) {
                let temp = 0;
                data.forEach(e => {
                    temp += e.get_complete_learners_count;
                })

                return temp;
            },
            totalStudents($data) {
                let temp = 0;
                $data.forEach(e => {
                    temp += e.user_program_count;
                });

                return temp;
            }
        }
    }
</script>
