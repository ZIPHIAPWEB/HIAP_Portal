<template>
    <auth-layout>
        <div class="login-box">
            <div class="login-logo">
            <a href="#"><b>HIAP</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Please input your e-mail and desire password.</p>

                    <form @submit.prevent="changePassword">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">E-mail</label>
                                <input v-model="form.email" type="text" placeholder="jane.doe@app.com" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="">Password</label>
                                <input v-model="form.password" type="password" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="">Confirm Password</label>
                                <input v-model="form.password_confirmation" type="password" class="form-control">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
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
        props: ['email', 'token'],
        components: {
            AuthLayout
        },
        data () {
            return {
                form: {
                    email: this.email,
                    token: this.token,
                    password: '',
                    password_confirmation: ''
                }
            }
        },
        methods: {
            changePassword () {
                this.$inertia.post('/password/reset', this.form)
                    .then((response) => {
                        //
                    })
            }
        }
    }
</script>
