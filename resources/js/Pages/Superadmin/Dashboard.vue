<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header"></div> -->
                        <div class="card-body">
                            <my-bar-chart :bar-data="chartConfig" :chart-option="options"></my-bar-chart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';  
    export default {
        components: {
            SuperadminLayout
        },
        data () {
            return {
                chartConfig: {
                    labels: [],
                    datasets: [
                        {
                        data: [10],
                        backgroundColor: '#3498db',
                        borderColor: 'rgba(136,136,136,0.5)',
                        label: "2013"
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: 'Chart.js Line Chart'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            categoryPercentage: 0.5,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }]
                    }
                }
            }
        }
    }
</script>
