<?php
require_once ('../../lib/jpgraph/src/jpgraph.php');
require_once ('../../lib/jpgraph/src/jpgraph_pie.php');


    // Some data
    $data = array($_GET["false"], $_GET["real"]);

    // Create the Pie Graph. 
    $graph = new PieGraph(452,300);

    $theme_class="DefaultTheme";
    //$graph->SetTheme(new $theme_class());

    // Set A title for the plot
    $graph->title->Set("Alarmas disparadas");
    $graph->SetBox(true);

    // Create
    $p1 = new PiePlot($data);
    $graph->Add($p1);

    $p1->ShowBorder();
    $p1->SetColor('black');
    $p1->SetSliceColors(array('#1E90FF','#2E8B57'));
    $graph->Stroke();
?>