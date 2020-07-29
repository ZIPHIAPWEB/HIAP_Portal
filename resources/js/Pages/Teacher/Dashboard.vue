<template>
    <teacher-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-12" v-for="program in programs" :key="program.id">
                    <div class="info-box info-shadow">
                        <span @click="gotoGradebook(program)" class="info-box-icon bg-info elevation-1" style="cursor: pointer;">
                            <i class="fas fa-archive"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ program.name }}</span>
                            <span class="info-box-number">{{ program.clients.length }} student(s)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </teacher-layout>
</template>

<script>
    import TeacherLayout from '../../Layouts/TeacherLayout.vue';
    export default {
        props: ['lessons', 'students', 'programs'],
        components: {
            TeacherLayout
        },
        data () {
            return {
                step: 0
            }
        },
        mounted() {
            console.log(this.$refs.header);
        },
        methods: {
            gotoGradebook(program) {
                if (program.clients.length > 0) {
                    this.$inertia.visit(`/teacher/${program.id}/gradebook`)
                } else {
                    alert('No student record.')
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .info-shadow {
        transition: box-shadow 500ms;

        &:hover {
            -webkit-box-shadow: 10px 10px 15px -10px rgba(0,0,0,0.75);
            -moz-box-shadow: 10px 10px 15px -10px rgba(0,0,0,0.75);
            box-shadow: 10px 10px 15px -10px rgba(0,0,0,0.75);
        }
    }
</style>