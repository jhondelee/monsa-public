@extends('layouts.app')

@section('pageTitle','Dashboard')

@section('content')
        
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">{{$sales_monthyear}}</span>
                        <h5>Sales</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{number_format($sales_total)}}</h1>
                        <div class="stat-percent font-bold text-success">{{number_format($sales_percent)}}% <i class="fa fa-bolt"></i></div>
                        <small>Total Sales</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">{{$orders_monthyear}}</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{number_format($order_total)}}</h1>
                        <div class="stat-percent font-bold text-info">{{number_format($order_percent)}}% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5>Sales & Orders</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins">{{number_format($current_sales)}}</h1>
                                <div class="font-bold text-navy">0% <i class="fa fa-level-up"></i> <small>Sales</small></div>
                            </div>
                            <div class="col-md-6">
                                <h1 class="no-margins">{{number_format($current_orders)}}</h1>
                                <div class="font-bold text-navy">0% <i class="fa fa-level-up"></i> <small>Orders</small></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Daily Sales</h5>
                        <div class="ibox-tools">
                            <span class="label label-primary">Updated 07.2024</span>
                        </div>
                    </div>
                    <div class="ibox-content no-padding">
                        <div class="flot-chart m-t-lg" style="height: 55px;">
                            <div class="flot-chart-content" id="flot-chart1"></div>
                        </div>
                    </div>  

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div>
                                        <span class="pull-right text-right">
                                        <small>Average value of sales in the past month in: <strong>PH</strong></small>
                                            <br/>
                                            All sales: 162,862
                                        </span>
                            <h3 class="font-bold no-margins">
                                Half-year revenue margin
                            </h3>
                            <small>Sales marketing.</small>
                        </div>

                        <div class="m-t-sm">

                            <div class="row">
                                <div class="col-md-8">
                                    <div>
                                        <canvas id="lineChart" height="114"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul class="stat-list m-t-lg">
                                        <li>
                                            <h2 class="no-margins">2,346</h2>
                                            <small>Total orders in period</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 48%;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">4,422</h2>
                                            <small>Orders in last month</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 60%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="m-t-md">
                            <small class="pull-right">
                                <i class="fa fa-clock-o"> </i>
                                Update on 16.07.2015
                            </small>
                            <small>
                                <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over 50,000.
                            </small>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-warning pull-right">As of July 5</span>
                        <h5>TOP 3 Sales Agent This Week</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Employee Name</small>
                                <h4>Junior Nava</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">Orders</small>
                                <h4>11,256</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>23,566</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Employee Name</small>
                                <h4>Alden Limosnero</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">Orders</small>
                                <h4>10,560</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>21.331</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Employee Name</small>
                                <h4>Richard Martinez</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">Orders</small>
                                <h4>10,350</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>26,230</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Critical Stock</h5>
            <div class="ibox-tools">
          <div class="form-group">
            <div>
                <label> <input type="radio" checked="" value="In Stock" id="optionsRadios1" name="optionsRadios"> In Stock </label>
                &nbsp;&nbsp;
                <label> <input type="radio" checked="" value="Reorder" id="optionsRadios2" name="optionsRadios"> Reorder</label>
                 &nbsp;&nbsp;
                <label> <input type="radio" checked="" value="Critical" id="optionsRadios3" name="optionsRadios"> Critical</label>
        
            </div>
        </div>                           
            </div>
        </div>
        
        <div class="ibox-content">
    
            <div class="table-responsive">
                <table class="table table-striped data-table-inventory" id="data-table-inventory">
                    <thead>

                    </thead>
                    <tbody>
                               
                    </tbody>
                </table>
            </div>

     
        </div>

        </div>

        <!-- Inactive Customer-->

        <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Inactive Customers <small>(In 2 Weeks, Follow up)-(In 1 Month, Losing)-(More than a Month, Lost)</small></h5>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th>#</th>
                        <th>Customer Name </th>
                        <th>Status </th>
                        <th>Orders </th>
                        <th>Last Transaction </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>CS02 <small>ABC Store</small></td>
                        <td><span class="label label-info pull-left">No Transaction</span></td>
                        <td>2,00</td>
                        <td>2 weeks Ago</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>CS04 <small>Lerma Store</small></td>
                        <td><span class="label label-info pull-left">No Transaction</span></td>
                        <td>0,1000</td>
                        <td>2 weeks Ago</td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>CS35 <small>Market 3</small></td>
                        <td><span class="label label-success pull-left">Follow Up</span></td>
                        <td>700</td>
                        <td>3 weeks Ago</td>
                    </tr>   
                    <tr>
                        <td>5</td>
                        <td>CS10 <small>Pamela Trading</small></td>
                        <td><span class="label label-success pull-left">Follow Up</span></td>
                        <td>200</td>
                        <td>3 weeks Ago</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>CS20 <small>Eat&Drink Restobar</small></td>
                        <td><span class="label label-primary pull-left">Lost</span></td>
                        <td>5,563</td>
                        <td>More than a month</td>
                    </tr>
                                       
                    </tbody>
                </table>
            </div>

        </div>
        </div>
        </div>
        </div>

        </div>


        </div>
 </div>


@endsection


@section('scripts')
   
    <!-- Flot -->
    <script src="/js/plugins/flot/jquery.flot.js"></script>
    <script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="/js/plugins/flot/curvedLines.js"></script>

    <!-- Peity -->
    <script src="/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/js/demo/peity-demo.js"></script>

    <!-- Jvectormap -->
    <script src="/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Sparkline -->
    <script src="/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js"></script>
    <script src="/js/plugins/toastr/toastr.min.js"></script>
    <script>
        
    $(document).ready(function(){
       
            $.ajax({
                url:  '{{ url('/getinventorystatus') }}',
                type: 'POST',
                dataType: 'json',
                data: { _token: "{{ csrf_token() }}",
                id: 'Critical'}, 
                success:function(results){
                     
                $('#data-table-inventory').DataTable({
                                        destroy: true,
                                        pageLength: 100,
                                        responsive: true,
                                        data: results,
                                        autoWidth: true,
                                        dom: '<"html5buttons"B>lTfgitp',
                                        buttons: [],
                                        fixedColumns: true,
                                        columns: [
                                            {data: 'id', title: 'Id'},  
                                            {data: 'name', title: 'Name'},    
                                            {data: 'description', title: 'Description'},
                                            {data: 'units', title: 'Units'},
                                            {data: 'status', title: 'Status',
                                                render: function(data, type, row){
                                                    if(row.status=='In Stock'){
                                                        return '<label class="label label-success" >In Stock</label>  '
                                                    } 
                                                    if(row.status=='Reorder'){
                                                        return '<label class="label label-warning" >Reorder</label>  '
                                                    }  
                                                    if(row.status=='Critical'){
                                                        return '<label class="label label-danger" >Critical</label>  ';
                                                    }    
                                                }
                                            },
                        
                                 
                                        ],
                                    })

                }
            });

    });

     $("input[name='optionsRadios']").click(function () {
          var _rdVaule = $("input[name='optionsRadios']:checked").val();
          

            $.ajax({
                url:  '{{ url('/getinventorystatus') }}',
                type: 'POST',
                dataType: 'json',
                data: { _token: "{{ csrf_token() }}",
                id: _rdVaule}, 
                success:function(results){
                     
                $('#data-table-inventory').DataTable({
                                        destroy: true,
                                        pageLength: 100,
                                        responsive: true,
                                        data: results,
                                        autoWidth: true,
                                        dom: '<"html5buttons"B>lTfgitp',
                                        buttons: [],
                                        fixedColumns: true,
                                        columns: [
                                             {data: 'id', title: 'Id'},  
                                            {data: 'name', title: 'Name'},    
                                            {data: 'description', title: 'Description'},
                                            {data: 'units', title: 'Units'},
                                            {data: 'status', title: 'Status',
                                                render: function(data, type, row){
                                                    if(row.status=='In Stock'){
                                                        return '<label class="label label-success" >In Stock</label>  '
                                                    } 
                                                    if(row.status=='Reorder'){
                                                        return '<label class="label label-warning" >Reorder</label>  '
                                                    }  
                                                    if(row.status=='Critical'){
                                                        return '<label class="label label-danger" >Critical</label>  ';
                                                    }    
                                                }
                                            },
                        
                                 
                                        ],
                                    })

                }
            });

       
     });

 
        $(document).ready(function() {


            var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
            var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

            var data1 = [
                { label: "Data 1", data: d1, color: '#17a084'},
                { label: "Data 2", data: d2, color: '#127e68' }
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        },
                    },
                    points: {
                        width: 0.1,
                        show: false
                    },
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false,
                }
            });

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: [48, 48, 60, 39, 56, 37, 30]
                    },
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data: [65, 59, 40, 51, 36, 25, 40]
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});


        });
    </script>
    
@endsection