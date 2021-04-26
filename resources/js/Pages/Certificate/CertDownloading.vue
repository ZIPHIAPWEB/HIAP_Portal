<template>
    <div class="wrapper">
        <div class="cert-dl-header">
            <img src="/logo2.png" alt="hiap logo">
            <span>HIAP INC. WEBINAR E-CERTIFICATES</span>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="progress">
                  <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                    <span class="sr-only">100% Complete</span>
                  </div>
                </div>
                <p class="mt-3 text-center" style="font-family: 'Montserrat'">Your certificate is downloading. Once done, just close this tab.</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                
            }
        },
        methods: {
            
        }
    }
</script>

<style lang="scss" scoped>
    .wrapper {
        height: 100vh;
        width: 100%;
        background: url('/assets/img/cert_dl_bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: bottom;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        .cert-dl-header {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            img {
                width: 140px;
                margin: 15px 0;
            }

            span {
                font-family: 'Montserrat';
                font-size: 25px;
                font-weight: bold;
                text-align: center;
            }
        }

        @media only screen and (min-width: 992px) {
            .card {
                width: 700px;
            }
        }
    }
</style>