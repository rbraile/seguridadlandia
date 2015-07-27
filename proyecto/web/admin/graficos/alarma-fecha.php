<?php // content="text/plain; charset=utf-8"
require_once ('../../lib/jpgraph/src/jpgraph.php');
require_once ('../../lib/jpgraph/src/jpgraph_line.php');

$fechas = explode(",", $_GET["fechas"]);
$cantidad = explode(",", $_GET["cantidad"]);
$dato = array();

foreach ($fechas AS $value) {
    $fecha = explode("-", $value);
    $aux = $fecha[2] . "-" . $fecha[1];
    array_push($dato, $aux);
}

$datay1 = $cantidad;

// $datay1 = array(20,7,16,46);
    
// Setup the graph
$graph = new Graph(400,300);
$graph->SetScale("textlin");

$theme_class= new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->title->Set('Alarmas por fecha');
$graph->SetBox(false);

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xaxis->SetTickLabels($dato);
$graph->ygrid->SetFill(false);
// $graph->SetBackgroundImage("tiger_bkg.png",BGIMG_FILLFRAME);

$p1 = new LinePlot($datay1);
$graph->Add($p1);

$p1->SetColor("#55bbdd");
$p1->SetLegend('Alarmas');
$p1->mark->SetType(MARK_FILLEDCIRCLE,'',1.0);
$p1->mark->SetColor('#55bbdd');
$p1->mark->SetFillColor('#55bbdd');
$p1->SetCenter();

$graph->legend->SetFrameWeight(1);
$graph->legend->SetColor('#4E4E4E','#00A78A');
$graph->legend->SetMarkAbsSize(8);


// Output line
$graph->Stroke();

?>