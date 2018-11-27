@extends('layouts.app')

@section('content')

    <head>

        <script src="js/canvasjs.min.js"></script>
        <script type="text/javascript">


            window.onload=function(){
                var chart=new CanvasJS.Chart("chartContainer",{
                    title:{
                        text:"Annual Revenue of Stock"
                    },
                    data:[
                        {
                            type:"column",
                            dataPoints:[


                                <?php

                                foreach ($data as $rows){
                                    echo "{label:'{$rows->product}',y:{$rows->amount}},\r\n";
                                }

                                ?>
                            ]
                        }
                    ]
                });
                chart.render();
            }
        </script>
    </head>


    <div id="chartContainer" style="height:400px; width:60%;margin-left: 200px;margin-top: 50px;"></div>



@endsection