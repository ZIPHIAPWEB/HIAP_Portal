<template>
    <auth-layout>
        <div class="login-box">
            <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <!-- /.col -->
                            <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Log Me In</button>
                            <inertia-link href="/register" class="btn btn-danger btn-block">I dont have an account</inertia-link>
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
        components: {
            AuthLayout
        }

    }
</script>
