
<?php
function Fusioncharts( $chartSWF,$strURL,$strXML,$chartId,$chartWidth,$chartHeight,$debugMode,$registerWithJS,$setTransparent){
        require_once( 'fusion/FusionCharts.php' );
		return renderChart($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight, $debugMode=false, $registerWithJS=false, $setTransparent=true);
      
}

?>