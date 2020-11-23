import './bootstrap';
import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import JsonExcel from 'vue-json-excel';
import vSelect from 'vue-select'

Vue.use(InertiaApp)
Vue.component('v-select', vSelect)
Vue.component('downloadExcel', JsonExcel);
const app = document.getElementById('app')

Vue.component('my-bar-chart', {
  extends: VueChartJs.Line,
  props: ['barData', 'chartOptions'],
  mounted(){
    this.renderChart(this.barData, this.chartOptions);
  },
  /*watch: {
    barData () {
      console.log('bar data changed')
      this.renderChart(this.barData, this.chartOptions);
  },
    chartOptions () {
      this.renderChart(this.barData, this.chartOptions);
   }
  }*/
}, {
    responsive: true, 
    maintainAspectRatio: false
  })

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(app)
