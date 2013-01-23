<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      //to help us easily embed the charts.
      include("Scripts/FusionCharts/FusionCharts.php");?>
<div id="data">
	<?php   ?>
<?php 
$strXML  = "";
$strXML .= "<chart yAxisName='Quantity' caption='Drug qunatiy per Facility'".
"useRoundEdges='1' bgColor='FFFFFF,FFFFFF' showBorder='0' showLabels='1' showvalues='1' decimals='0' placeValuesInside='1'>";
$strXML .= " <categories>";
$strXML .= " <category label='$facilities'  />";
$strXML .= " </categories>";
foreach ($posts->result() as $query):
$strXML .= "     <dataset seriesName='$query->name'  showValues='1'>";
$strXML .= "         <set value='$query->quantity' />";
$strXML .= "     </dataset>";
 endforeach; 
$strXML .= "</chart>";
           //Create the chart - Column 3D Chart with data from strXML variable using dataStr method
           echo renderChart("".base_url()."Scripts/FusionCharts/Charts/ScrollColumn2D.swf", "", $strXML, "kevo", 800, 400, false, true);
        ?>
        </div>