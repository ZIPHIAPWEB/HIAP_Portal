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
                <div class="card-header border-0 text-center">
                    <img src="/logo.png" alt="" style="width: 150px; cursor: pointer;" onclick="document.getElementById('home-link').click();">
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
                                <inertia-link href="/password/reset" class="text-sm">I dont have an account</inertia-link>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

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
