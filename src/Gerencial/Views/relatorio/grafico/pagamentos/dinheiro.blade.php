<script>  
  $(function () {

    var dinheiroChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }





    var label_diario_pagamento_dinheiro = [], dados_diario_pagamento_dinheiro = [] 
    var ip = 0;
  @for ($i = 30; $i > 0; $i-- )
    label_diario_pagamento_dinheiro.push(["{{$data->subDays($i)->format('d/m')}} " ])    
    dados_diario_pagamento_dinheiro.push([ {{ Manzoli2122\Salao\Atendimento\Models\Pagamento::whereDate('created_at', [  $data->subDays($i)  ])->where('formaPagamento', 'dinheiro')->sum('valor') }}   ])
    ip = ip + 1;
  @endfor
  
  var area_diario_pagamento_dinheiro = {    
     
        labels  : label_diario_pagamento_dinheiro ,
        datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dados_diario_pagamento_dinheiro
        } 
      ]
    }


    //-------------
    //- diario atendimento CHART -
    //--------------
    var diario_pagamento_dinheiroCanvas          = $('#diario_pagamento_dinheiro').get(0).getContext('2d')
    var diario_pagamento_dinheiroChart                = new Chart(diario_pagamento_dinheiroCanvas)
    var diario_pagamento_dinheiroChartOptions         = dinheiroChartOptions
    diario_pagamento_dinheiroChartOptions.datasetFill = false
    diario_pagamento_dinheiroChart.Line(area_diario_pagamento_dinheiro, diario_pagamento_dinheiroChartOptions)






  })
 
</script>