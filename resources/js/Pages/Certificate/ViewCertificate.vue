<template>
    <certificate-layout>
        <div class="container-fluid d-flex flex-column align-items-center justify-content-center cert-bg">
            <img src="/logo2.png" alt="HIAP Logo">
            <div class="cert-basic d-flex flex-column justify-content-center align-items-center">
                <h1 class="cert-name">{{ cert_details.name }}</h1>
                <span class="cert-school">{{ cert_details.school }}</span>
                <span class="cert-track">{{ cert_details.program }}</span>
                <span v-if="cert_details.total_grade != 0" class="cert-grade">OVER-ALL GRADE: {{ cert_details.total_grade }} </span>
                <span v-if="cert_details.proficiency > 0" class="cert-prof">Learner's Proficiency / Attempt to Pass: {{ cert_details.proficiency }}</span>
            </div>

            <div class="container-fluid d-block d-md-none">
                <div class="row justify-content-center" style="width: 100vw">
                    <div class="medal-wrapper">
                        <div>
                            <span class="fas fa-medal fa-2x" style="color: #D4AF37"></span>
                            <h5 class="mx-2 text-bold">GOLD MEDALS (100%)</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.gold_medal }}</h5>
                    </div>
                    <div class="medal-wrapper ">
                        <div >
                            <span class="fas fa-medal fa-2x" style="color: #C0C0C0"></span>
                            <h5 class="mx-2 text-bold">SILVER MEDALS (90-99%)</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.silver_medal }}</h5>
                    </div>
                    <div class="medal-wrapper ">
                        <div >
                            <span class="fas fa-medal fa-2x" style="color: #cd7f32"></span>
                            <h5 class="mx-2 text-bold">BRONZE MEDALS (80-89%)</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.bronze_medal }}</h5>
                    </div>
                    <div class="medal-wrapper">
                        <div >
                            <h5 class="mx-2 text-bold">TOTAL MEDALS</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.total_medal }}</h5>
                    </div>
                </div>
            </div>

            <div class="container d-none d-md-block">
                <div class="row justify-content-center">
                    <div class="medal-wrapper">
                        <div class="m-0" style="border-right: 0; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                            <span class="fas fa-medal fa-2x" style="color: #D4AF37"></span>
                            <h5 class="mx-2 text-bold">GOLD MEDALS (100%)</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.gold_medal }}</h5>
                    </div>
                    <div class="medal-wrapper ">
                        <div class="m-0" style="border-radius: 0;">
                            <span class="fas fa-medal fa-2x" style="color: #C0C0C0"></span>
                            <h5 class="mx-2 text-bold">SILVER MEDALS (90-99%)</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.silver_medal }}</h5>
                    </div>
                    <div class="medal-wrapper ">
                        <div class="m-0" style="border-radius: 0; border-left: 0;">
                            <span class="fas fa-medal fa-2x" style="color: #cd7f32"></span>
                            <h5 class="mx-2 text-bold">BRONZE MEDALS (80-89%)</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.bronze_medal }}</h5>
                    </div>
                    <div class="medal-wrapper">
                        <div class="m-0" style="border-left: 0; border-top-left-radius: 0; border-bottom-left-radius: 0;">
                            <h5 class="mx-2 text-bold">TOTAL MEDALS</h5>
                        </div>
                        <h5 class="my-2 text-bold">{{ cert_details.total_medal }}</h5>
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
    @font-face {
    font-family: 'Bebas Kai';
    src: url('/assets/fonts/BebasKai-Regular.woff');

    }
    .cert-bg {
        height: 100vh;
        background: url('/assets/img/cert-background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: 'Montserrat';

        img {
            height: 150px;
            margin: 0.5em;
        }

        @media (min-width: 576px) {
            img {
                height: 200px;
                margin: 1em;
            }
        }
        
        .medal-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            div {
                display: flex;
                align-items: center;
                padding: 15px;
                border: solid 2px black;
                border-radius: 10px;
                margin: 0 2px;
                
                @media (min-width: 576px) {
                    span {
                        font-size: 22px;
                    }

                    h5 {
                        font-size: 15px;
                    }
                }
            }
        }

        .cert-basic {
            margin: 20px 0;
            
            .cert-name {
                width: 80vw;
                border-bottom: solid #910824 4px;
                text-align: center;
                padding-bottom: 15px;   
                margin-bottom: 15px;
                font-family: 'Montserrat';
                font-size: 30px;
                text-transform: uppercase;
            }

            .cert-school {
                font-weight: bold;
                font-size: 18px;
                margin-bottom: 15px;
            }

            .cert-track {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .cert-grade {
                font-size: 18px;
                font-weight: bolder;
            }

            .cert-prof {
                font-weight: bold;
            }

            @media (min-width: 576px) {
                .cert-name {
                    width:50vw;
                }
                .cert-name {
                    font-size: 50px;
                }

                .cert-school {
                    font-size: 25px;
                }

                .cert-track {
                    font-size: 20px;
                }

                .cert-grade {
                    font-size: 25px;
                }
            }
        }
    }
</style>