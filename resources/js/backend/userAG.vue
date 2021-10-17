<template>
<div>
  <div @click="add" class="btn">插入数据</div>
  <div @click="allChecked" class="btn">全选</div>
  <div @click="unChecked" class="btn">清除選取</div>
  <div @click="getRows" class="btn">获取选中数据</div>
  <div @click="delRows" class="btn">删除选中数据</div>
  <ag-grid-vue style="width: 100%; height: 500px;"
      class="ag-theme-alpine"
      :columnDefs="columnDefs"
      :rowData="rowData"
      rowSelection="multiple"
      enableCellTextSelection=true
      suppressMultiRangeSelection=true
      ensureDomOrder=true
      pagination=true 
      editable=true
      @gridReady="onGridReady"
      >
  </ag-grid-vue>
</div>
</template>

<script>
import { AgGridVue } from "ag-grid-vue";

export default {
  props: ["data", "opencurrencylist"],
  name: "App",
  data() {
    return {
      columnDefs: null,
      rowData: null,
    };
  },
  components: {
    AgGridVue,
  },
  beforeMount() {
    this.columnDefs = [
      { headerName: '表頭A' ,
        children: [
          {field:'playerId',sortable: true, filter: true,sortable: true, //开启排序
        resizable: true, checkboxSelection: true,'pinned': 'left' },
          {field:'account',sortable: true, filter: true,  },
          {field:'name',sortable: true, filter: true },
        ]
      },
      { headerName: '表頭B',
        children: [
          {field:'currency',sortable: true, filter: true },
          {field:'status',sortable: true, filter: true, cellEditor: "agSelectCellEditor",//编辑时 显示下拉列表**************
        cellEditorParams: { values: ["0", "1"] } },
          {field:'created_at',sortable: true, filter: true },
          {field:'updated_at',sortable: true, filter: true },]
      }
    ];
    this.rowData = [
      { account: " ", created_at: " ", currency: 0,
      name: " ", playerId: " ", status: 1 , updated_at: 0  },
    ];
    //this.columnDefs = [
    //   { field: "make" },
    //   { field: "model" },
    //   { field: "price" },
    // ];

    // this.rowData = [
    //   { make: "Toyota777777", model: "Celica", price: 35000 },
    //   { make: "Ford6666666", model: "Mondeo", price: 32000 },
    //   { make: "Porsche555555", model: "Boxter", price: 72000 },
    // ];
  },
  methods: {
    onGridReady(params) {
        axios
        .get("/players/allData", this.props)
        .then(result => {
          console.log(result);
          console.log(this.rowData);
          this.errors = {
            gameId: false,
            gameNameEn: false,
            gameNameCn: false,
            gameNameTw: false,
            gameType: false
          };
          // alert("success");
          this.rowData=result.data.data
          console.log(this.rowData);
          
          // location.href = "/players/all";
        })
        .catch(error => {
          // 请求失败处理
          // console.log(error.response.data.errors);
          this.errors = error.response.data.errors;
        });
      console.log(this.data);
      
      // 获取gridApi
      this.gridApi = params.api;
      this.columnApi = params.columnApi;
      // 这时就可以通过gridApi调用ag-grid的传统方法了
      this.gridApi.sizeColumnsToFit();
    },
      onRowEditingStopped: function (event) {
        var itxst = JSON.stringify(event.data);
        //alert(itxst);
    },
    //单元格编辑完成事件**************************
    onCellEditingStopped: function (event) {
        var itxst = JSON.stringify(event.data);
        alert(itxst);
    },
    allChecked() {
        this.gridApi.selectAll();
    },
    //设置清除選擇
    unChecked() {
        this.gridApi.deselectAll();
    },
    //获取选中的数据
    getRows() {
        var selRows = this.gridApi.getSelectedRows();
        if (selRows == null || selRows.length <= 0) {
            alert("您未选中任何数据");
            return;
        }
        alert(JSON.stringify(selRows));
    },
    //删除选中数据
    delRows() {
        //获取选中的数据
        var selRows = this.gridApi.getSelectedRows();
        if (selRows == null || selRows.length <= 0) {
            alert("您未选中任何数据");
            return;
        }
        //注意调用updateRowData方法并不会更新vue的data
        this.gridApi.updateRowData({remove: selRows});
        //正确的删除方法是这样的
        // this.rowData = this.rowData.filter(item => {
        //     return selRows.filter(m => m.title === item.title).length <= 0
        // });
    },
    add() {
      this.rowData.push({"playerId":999,"account":"daugherty.2@example.org",
      "name":"Lempi Rice2","currency":3,"status":1,
      "created_at":"2021-10-17 14:24:49","updated_at":"2021-10-17 14:24:49" });
    }
  }
};
</script>
<style lang="scss">
   @import "~ag-grid-community/dist/styles/ag-grid.css";
   @import "~ag-grid-community/dist/styles/ag-theme-alpine.css";
</style>
