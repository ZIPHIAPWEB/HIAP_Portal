<template>
    <auth-layout>
        <div class="login-box">
            <div class="login-logo">
                <a id="home-link" href="/" class="sr-only">Home Link</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-header border-0 text-center">
                    <img src="/logo.png" alt="" style="width: 150px; cursor: pointer;" onclick="document.getElementById('home-link').click();">
                </div>
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Please input your e-mail to where we send you a password verification.</p>

                    <form @submit.prevent="submitLinkRequest">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">E-mail</label>
                                <input v-model="form.email" type="text" placeholder="jane.doe@app.com" :class="hasEmailError">
                                <span class="error invalid-feedback" style="display: block;">{{ $page.errors.email }}</span>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
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
        data () {
            return {
                form: {
                    email: ''
                }
            }
        },
        computed: {
            hasEmailError () {
                return this.$page.errors.email ? 'form-control is-invalid' : 'form-control';
            }
        },
        methods: {
            submitLinkRequest() {
                this.$inertia.post('/password/email', this.form)
            }
        }
    }
</script>
