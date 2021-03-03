<template>
    <auth-layout>
        <div class="login-box">
            <div class="login-logo">
                <a id="home-link" href="/" class="sr-only">Home Link</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="overlay" v-if="isLoading">
                    <i class="fas fa-spinner fa-2x fa-pulse"></i>
                </div>
                <div class="card-header border-0 text-center pt-4">
                    <img src="/logo.png" alt="" style="width: 120px; cursor: pointer;" onclick="document.getElementById('home-link').click();">
                </div>
                <div class="card-body login-card-body pt-0">
                    <p class="login-box-msg">Please input your e-mail to where we send you a password verification.</p>

                    <form @submit.prevent="submitLinkRequest">
                        <div class="row">
                            <div class="form-group col-12">
                                <input v-model="form.email" type="text" placeholder="E-mail" :class="hasEmailError">
                                <span class="error invalid-feedback" style="display: block;">{{ errors.email }}</span>
                            </div>
                            <div class="col-12">
                                <button :disabled="countdown !== 0" type="submit" class="btn btn-primary btn-block">{{ (countdown > 0) ? `Cooldown in ${countdown}s` : 'Submit Request' }}</button>
                            </div>
                            <div class="col-6">
                                <inertia-link href="/login" class="text-sm">Sign In an account</inertia-link>
                            </div>
                        </div>
                    </form>
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
        props: ['errors', 'flash'],
        data () {
            return {
                form: {
                    email: ''
                },
                isLoading: false,
                timeout: null,
                countdown: 0
            }
        },
        watch: {
            flash : function (value) {
                toastr.info(value.message);
            }
        },
        computed: {
            hasEmailError () {
                return this.errors.email ? 'form-control is-invalid' : 'form-control';
            }
        },
        methods: {
            submitLinkRequest() {
                this.$inertia.post('/password/email', this.form, {
                    onBefore: () => {
                        this.isLoading = true;
                    },
                    onSuccess: () => {
                        this.isLoading = false;
                        this.countdown = 20;
                        this.countdownHandler();
                    },
                    onError: () => {
                        this.isLoading = false;
                    }
                })
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
