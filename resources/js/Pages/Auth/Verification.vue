<template>
    <auth-layout>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Verification Notice</h3>
                    </div>
                    <div class="card-body">
                        <p>Please verify your email to activate your account.</p>
                        <button @click="resend" class="btn btn-primary btn-block btn-flat" :disabled="loading">
                            <i v-if="loading" class="fas fa-spinner fa-pulse"></i>
                            <span v-else>Resend Email Verification</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </auth-layout>
</template>

<script>
    import AuthLayout from '../../Layouts/AuthLayout.vue';
    export default {
        components: {
            AuthLayout
        },
        data () {
            return {
                loading: false
            }
        },
        methods: {
            resend () {
                this.loading = true;
                this.$inertia.post('/email/resend')
                    .then((response) => {
                        this.loading = false;
                        console.log(response);
                    })
            }
        }
    }
</script>
