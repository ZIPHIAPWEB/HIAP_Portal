import './bootstrap'
import JsonExcel from 'vue-json-excel'
import vSelect from 'vue-select'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
  // The delay after which the progress bar will
  // appear during navigation, in milliseconds.
  delay: 250,

  // The color of the progress bar.
  color: '#29d',

  // Whether to include the default NProgress styles.
  includeCSS: true,

  // Whether the NProgress spinner will be shown.
  showSpinner: false,
});

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

