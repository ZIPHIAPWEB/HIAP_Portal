import './bootstrap';
import JsonExcel from 'vue-json-excel';
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)
Vue.component('downloadExcel', JsonExcel);

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

Vue.use(plugin)

const el = document.getElementById('app')

new Vue({
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)

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

