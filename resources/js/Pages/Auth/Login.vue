<template>
    <auth-layout>
        <div class="login-box">
            <div class="login-logo">
                <a id="home-link" href="/" class="sr-only">Home Link</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="overlay" v-if="loading">
                    <i class="fas fa-spinner fa-2x fa-pulse"></i>
                </div>
                <div class="card-header border-0 text-center pt-4">
                    <img src="/logo.png" alt="" style="width: 120px; cursor: pointer;" onclick="document.getElementById('home-link').click();">
                </div>
                <div class="card-body login-card-body pt-0">
                    <p class="login-box-msg">Sign in to your account</p>
                    <form @submit.prevent="login">
                        <div class="form-group mb-3">
                            <input id="email" v-model="form.email" name="email" type="email" :class="hasEmailError" placeholder="Email">
                            <span id="email" class="error invalid-feedback" style="display: block">{{ errors.email }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <input id="password" v-model="form.password" name="password" type="password" :class="hasPasswordError" placeholder="Password">
                            <span id="password" class="error invalid-feedback" style="display:block">{{ errors.password }}</span>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Log Me In</button>
                            </div>

                            <div class="col-6 text-left">
                                <inertia-link href="/register" class="text-sm">Create an account</inertia-link>
                            </div>

                            <div class="col-6 text-right">
                                <!-- <inertia-link href="/password/reset" class="text-sm">Forgot Password?</inertia-link> -->
                                <a href="javascript:void()" data-target="#forgot" data-toggle="modal" class="text-sm">Forgot Password?</a>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <div id="forgot" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Forgot Password?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <i>Please contact  our support team to change your password.</i>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                        </div>

                        <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                        </p>
                        <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                        </p><
                    </div> -->
                </div>
            </div>
        </div>
    </auth-layout>
</template>

<script>
    import AuthLayout from '../../Layouts/AuthLayout.vue';
    export default {
        props: ['errors'],
        components: {
            AuthLayout
        },
        data () {
            return {
                form: {
                    email: '',
                    password: ''
                },
                loading: false
            }
        },
        computed: {
            hasEmailError() {
                let errors = Object.values(this.errors);
                if (this.errors.email) {
                    return 'form-control is-invalid';
                } else {
                    return 'form-control';
                }
            },
            hasPasswordError() {
                let errors = Object.values(this.errors);
                if (this.errors.password) {
                    return 'form-control is-invalid';
                } else {
                    return 'form-control';
                }
            }
        },
        methods: {
            login () {
                this.loading = true;
                this.$inertia.post('/login', this.form)
                    .then(({data}) => {
                        this.loading = false;
                        console.log(data);
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(errors);
                    })
            }
        }
    }
</script>
