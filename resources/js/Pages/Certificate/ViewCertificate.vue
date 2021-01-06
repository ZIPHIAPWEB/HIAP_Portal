<template>
    <certificate-layout>
        <div class="container-fluid d-flex flex-column align-items-center justify-content-center cert-bg">
            <img src="/logo2.png" alt="HIAP Logo">
            <div class="cert-basic d-flex flex-column justify-content-center align-items-center">
                <h1 class="cert-name">{{ cert_details.name }}</h1>
                <span class="cert-school">{{ cert_details.school }}</span>
                <span class="cert-track">{{ cert_details.program }}</span>
                <span class="cert-grade">{{ cert_details.total_grade }}</span>
            </div>

            <div class="container">
                <div class="row my-2">
                    <div class="col-md-3 d-flex flex-row align-items-center justify-content-center p-3" style="border: solid black 2px; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                        <span class="fas fa-medal fa-2x" style="color: #D4AF37"></span>
                        <h5 class="mx-2 text-bold">GOLD MEDALS</h5>
                    </div>
                    <div class="col-md-3 d-flex flex-row align-items-center justify-content-center p-3" style="border: solid black 2px; border-left: 0; border-right: 0;">
                        <span class="fas fa-medal fa-2x" style="color: #C0C0C0"></span>
                        <h5 class="mx-2 text-bold">SILVER MEDALS</h5>
                    </div>
                    <div class="col-md-3 d-flex flex-row align-items-center justify-content-center p-3" style="border: solid black 2px; border-right: 0;">
                        <span class="fas fa-medal fa-2x" style="color: #cd7f32"></span>
                        <h5 class="mx-2 text-bold">BRONZE MEDALS</h5>
                    </div>
                    <div class="col-md-3 d-flex flex-row align-items-center justify-content-center p-3" style="border: solid black 2px; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                        <h5 class="mx-2 text-bold">TOTAL MEDALS</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 d-flex flex-row align-items-center justify-content-center">
                        <h5 class="mx-2 text-bold">{{ cert_details.gold_medal }}</h5>
                    </div>
                    <div class="col-md-3 d-flex flex-row align-items-center justify-content-center">
                        <h5 class="mx-2 text-bold">{{ cert_details.silver_medal }}</h5>
                    </div><div class="col-md-3 d-flex flex-row align-items-center justify-content-center">
                        <h5 class="mx-2 text-bold">{{ cert_details.bronze_medal }}</h5>
                    </div><div class="col-md-3 d-flex flex-row align-items-center justify-content-center">
                        <h5 class="mx-2 text-bold">{{ cert_details.total_medal }}</h5>
                    </div>
                </div>
            </div>

        </div>
    </certificate-layout>    
</template>

<script>
    import CertificateLayout from '../../Layouts/CertificateLayout.vue';
    export default {
        props: ['cert_details'],
        components: {
            CertificateLayout
        }
    }
</script>

<style lang="scss" scoped>
    .cert-bg {
        height: 100vh;
        background: url('/assets/img/cert-background.jpg');
        background-size: cover;
        background-position: center;
        font-family: Montserrat;

        img {
            height: 200px;
            margin: 1em;
        }

        .cert-basic {
        margin: 50px 0;

            .cert-name {
                width: 50vw;
                border-bottom: solid #910824 4px;
                text-align: center;
                padding-bottom: 15px;
                margin-bottom: 15px;
                font-family: 'Bebas Kai';
                font-size: 80px;
            }

            .cert-school {
                font-weight: bold;
                font-size: 25px;
                margin-bottom: 15px;
            }

            .cert-track {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .cert-grade {
                font-size: 25px;
                font-weight: bolder;
            }
        }
    }
</style>