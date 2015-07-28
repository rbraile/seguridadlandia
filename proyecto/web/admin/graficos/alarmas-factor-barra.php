<?php
require_once ('../../lib/jpgraph/src/jpgraph.php');
require_once ('../../lib/jpgraph/src/jpgraph_bar.php');


    $datay = array($_GET["false"], $_GET["real"]);


    // Create the graph. 
    // One minute timeout for the cached image
    // INLINE_NO means don't stream it back to the browser.
    $graph = new Graph(400,300,'auto');
    $graph->SetScale("textlin");
    $graph->img->SetMargin(60,30,20,40);
    $graph->yaxis->SetTitleMargin(45);
    $graph->yaxis->scale->SetGrace(30);
    $graph->SetShadow();

    // Turn the tickmarks
    $graph->xaxis->SetTickSide(SIDE_DOWN);
    $graph->yaxis->SetTickSide(SIDE_LEFT);

    // Create a bar pot
    $bplot = new BarPlot($datay);

    $graph->xaxis->SetTickLabels(array('Falsa','Real'));

    // Use a shadow on the bar graphs (just use the default settings)
    $bplot->SetShadow();
    $bplot->value->SetFormat(" $ %2.1f",70);
    $bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
    $bplot->value->SetColor("blue");
    $bplot->value->Show();

    $graph->Add($bplot);

    $graph->title->Set("Cantidad de alarmas disparadas VS factor");
    $graph->xaxis->title->Set("Factor de alrma");
    $graph->yaxis->title->Set("Cantidad de alarmas disparadas");

    $graph->title->SetFont(FF_FONT1,FS_BOLD);
    $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
    $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

    // Send back the HTML page which will call this script again
    // to retrieve the image.
    $graph->Stroke();
?>