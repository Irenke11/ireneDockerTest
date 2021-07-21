<script>
/* Line 為引入的圖表種類（可以參考官方文件) */
import { Pie, mixins } from "vue-chartjs";

const { reactiveProp } = mixins;

export default {
  extends: Pie,
  mixins: [reactiveProp],
  data() {
    return {
      options: {
        /* 圖表選項，各類圖表的 options 可能不盡相圖，可參照官方文件 */
        responsive: true,
        maintainAspectRatio: false
      }
    };
  },
  async mounted() {
    this.renderChart(this.chartData, this.options);
  }
};
</script>
