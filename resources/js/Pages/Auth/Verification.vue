<template>
    <auth-layout>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Verification Notice</h3>
                    </div>
                    <div class="card-body">
                        <p>We send you a verification on your email. Please <b>verify</b> to activate your account.</p>
                        <p>If you didn't get an email, click the button below.</p>
                        <button :disabled="countdown > 0" @click="resend" class="btn btn-primary btn-block">{{ (countdown > 0) ? `Resend after ${countdown}s` : 'Resend verification email.' }}</button>
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
                loading: false,
                countdown: 0
            }
        },
        created() {
            this.countdown = 20;
            this.countdownHandler();
        },
        methods: {
            resend () {
                this.loading = true;
                this.$inertia.post('/email/resend', {}, {
                    onSuccess: () => {
                        this.loading = false;
                        this.countdown = 20;
                        this.countdownHandler();
                        toastr.info('Verification email has been sent.');
                    },
                    onError: () => {
                        this.loading = false;
                        toastr.error('Something went wrong.');
                    }
                });
            },
            countdownHandler () {
                setTimeout(() => {
                    if (this.countdown > 0) {
                        this.countdown -= 1
                        this.countdownHandler() 
                    }
                }, 1000)
            }
        }
    }
</script>
