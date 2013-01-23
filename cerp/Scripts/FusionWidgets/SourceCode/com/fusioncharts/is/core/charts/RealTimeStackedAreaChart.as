﻿/**
* @class RealTimeStackedAreaChart
* @author InfoSoft Global(P) Ltd. www.InfoSoftGlobal.com
* @version 3.0
*
* Copyright(C) InfoSoft Global Pvt. Ltd. 2005-2006
* RealTimeStackedAreaChart extends the SYRealTimeChart class to render the
* functionality of a 2D Stacked Real-time area chart.
*/
//Import parent class
import com.fusioncharts.is.core.SYRealTimeChart;
//Error class
import com.fusioncharts.is.helper.FCError;
//Import Logger Class
import com.fusioncharts.is.helper.Logger;
import com.fusioncharts.is.helper.Utils;
//Style Object
import com.fusioncharts.is.core.StyleObject;
//Delegate
import mx.utils.Delegate;
//Axis for the chart
import com.fusioncharts.is.axis.LinearAxis;
//Legend Class
import com.fusioncharts.is.helper.Legend;
//Extensions
import com.fusioncharts.is.extensions.ColorExt;
import com.fusioncharts.is.extensions.StringExt;
import com.fusioncharts.is.extensions.MathExt;
import com.fusioncharts.is.extensions.DrawingExt;
//External Interface - to expose methods via JavaScript
import flash.external.ExternalInterface;
class com.fusioncharts.is.core.charts.RealTimeStackedAreaChart extends SYRealTimeChart {
	//Flag to indicate whether positive number is present
	private var positivePresent : Boolean;
	//Flag to indicate whether negative number is present
	private var negativePresent : Boolean;
	/**
	* Constructor function. We invoke the super class'
	* constructor.
	*/
	function RealTimeStackedAreaChart(targetMC:MovieClip, depth:Number, width:Number, height:Number, x:Number, y:Number, debugMode:Boolean, registerWithJS:Boolean, DOMId:String, lang:String) {
		//Invoke the super class constructor
		super(targetMC, depth, width, height, x, y, debugMode, registerWithJS, DOMId, lang);
		//Log additional information to debugger
		//We log version from this class, so that if this class version
		//is different, we can log it
		this.log("Version", _version, Logger.LEVEL.INFO);
		this.log("Chart Type", "Real-time Stacked 2D Area Chart", Logger.LEVEL.INFO);
		//List Chart Objects and set them in arrObjects array defined in super parent class.
		this.arrObjects = new Array("BACKGROUND", "CANVAS", "CAPTION", "SUBCAPTION", "XAXISNAME", "YAXISNAME", "DIVLINES", "VDIVLINES", "YAXISVALUES", "HGRID", "VGRID", "DATALABELS", "DATAVALUES", "REALTIMEVALUE", "TRENDLINES", "TRENDVALUES", "DATAPLOT", "ANCHORS", "TOOLTIP", "VLINES", "VLINELABELS", "LEGEND");
		super.setChartObjects();
		//Expose the methods to JavaScript using ExternalInterface
		if (ExternalInterface.available && this.registerWithJS==true){
			//feedData method
			ExternalInterface.addCallback("feedData", this, feedData);
			//getData method
			ExternalInterface.addCallback("getData", this, getData);			
			//stopUpdate method
			ExternalInterface.addCallback("stopUpdate", this, stopUpdate);
			//restartUpdate method
			ExternalInterface.addCallback("restartUpdate", this, restartUpdate);
			//clearChart method
			ExternalInterface.addCallback("clearChart", this, clearChart);
		}
	}
	/**
	* render method is the single call method that does the rendering of chart:
	* - Parsing XML
	* - Calculating values and co-ordinates
	* - Visual layout and rendering
	* - Event handling
	*/
	public function render():Void {
		//Parse the XML Data document
		this.parseXML();
		//Now, in a real-time chart, even if we do not have any data to start with,
		//we continue plotting, as chart can start without data and update itself
		//in real-time.		
		//But, if we do not have a defined dataset, we cannot map incoming data. So,
		//show an error.
		//error.
		if (this.numDS== 0)	{
			tfAppMsg = this.renderAppMessage (_global.getAppMessage ("NODATA", this.lang));
			//Add a message to log.
			this.log ("No Data to Display", "No data-set was found in the XML data document provided. If your system generates data based on parameters passed to it using dataURL, please make sure that dataURL is URL Encoded.", Logger.LEVEL.ERROR);
			//Expose rendered method
			this.exposeChartRendered();
			//Also raise the no data event
			this.raiseNoDataExternalEvent();
		} else {
			//Validate initial data
			this.validateInitialData();
			//Store status flags
			this.storeStatusFlag();
			//Setup the axis
			this.setupAxis();			
			//Set Style defaults
			this.setStyleDefaults();
			//Cache styles that get re-used
			this.cacheStyles();
			//Set the display value for each trend-line/zone and filter out NaN ones
			this.setTrendDisplayValues();			
			//Now, validate trend lines
			this.validateTrendLines();
			//Allot the depths for various charts objects now
			this.allotDepths();
			//Set the container for annotation manager
			this.setupAnnotationMC();
			//Set the container for alert manager
			this.setupAlertManagerMC();
			//Set-up message log
			this.setupMessageLog();
			//Feed any empty data if required.
			this.feedEmptyData();
			//Select the tool text for each point
			this.selectToolText();
			//Select which labels we've to show/hide
			this.selectLabelsToShow();
			//Calculate canvas co-ordinates
			this.calculateCanvasCoords();
			//Calculate the x-axis position for points
			this.calculateXPoints();
			//Calculate Points
			this.calculatePoints();
			//Calculate vLine Positions
			this.calcVLinesPos();
			//Calculate trend line positions
			this.calcTrendLinePos();
			//Feed macro values
			super.feedMacros();
			//Remove application message
			this.removeAppMessage(this.tfAppMsg);
			//Set tool tip parameter
			this.setToolTipParam();
			//Set the context menu - initially
			this.setContextMenu();			
			//-----Start Visual Rendering Now------//
			//Draw background
			this.drawBackground();
			//Set click handler
			this.drawClickURLHandler();
			//Load background SWF
			this.loadBgSWF();
			//Update timer
			this.timeElapsed =(this.params.animation) ? this.styleM.getMaxAnimationTime(this.objects.BACKGROUND):0;
			//Render the annotations below
			this.config.intervals.annotationsBelow = setInterval(Delegate.create(this, renderAnnotationBelow) , this.timeElapsed);			
			//Draw canvas
			this.config.intervals.canvas = setInterval(Delegate.create(this, drawCanvas) , this.timeElapsed);			
			//Draw headers
			this.config.intervals.headers = setInterval(Delegate.create(this, drawHeaders) , this.timeElapsed);			
			//Update timer
			this.timeElapsed +=(this.params.animation) ? this.styleM.getMaxAnimationTime(this.objects.CANVAS, this.objects.CAPTION, this.objects.SUBCAPTION, this.objects.YAXISNAME, this.objects.XAXISNAME):0;
			//Draw div lines
			this.config.intervals.divLines = setInterval(Delegate.create(this, drawDivLines) , this.timeElapsed);
			//Update timer
			this.timeElapsed +=(this.params.animation) ? this.styleM.getMaxAnimationTime(this.objects.DIVLINES, this.objects.YAXISVALUES):0;
			//Vertical div lines
			this.config.intervals.vDivLines = setInterval(Delegate.create(this, drawVDivLines) , this.timeElapsed);
			//Update timer
			this.timeElapsed +=(this.params.animation &&(this.params.numVDivLines > 0)) ? this.styleM.getMaxAnimationTime(this.objects.VDIVLINES):0;
			//Horizontal grid
			this.config.intervals.hGrid = setInterval(Delegate.create(this, drawHGrid) , this.timeElapsed);
			//Vertical grid
			this.config.intervals.vGrid = setInterval(Delegate.create(this, drawVGrid) , this.timeElapsed);
			//Update timer
			this.timeElapsed +=(this.params.animation &&(this.params.showAlternateHGridColor || this.params.showAlternateVGridColor)) ? this.styleM.getMaxAnimationTime(this.objects.HGRID, this.objects.VGRID):0;
			//Draw labels
			this.config.intervals.labels = setInterval(Delegate.create(this, drawLabels) , this.timeElapsed);
			//Draw line chart
			this.config.intervals.plot = setInterval(Delegate.create(this, drawAreaChart) , this.timeElapsed);
			//Legend
			this.config.intervals.legend = setInterval(Delegate.create(this, drawLegend) , this.timeElapsed);
			//Update timer
			this.timeElapsed +=(this.params.animation && (this.numDS > 0)) ? this.styleM.getMaxAnimationTime(this.objects.DATALABELS, this.objects.DATAPLOT, this.objects.LEGEND):0;
			//Real-time value			
			this.config.intervals.realTimeValue = setInterval(Delegate.create(this, drawRealTimeValue) , this.timeElapsed);
			//Anchors
			this.config.intervals.anchors = setInterval(Delegate.create(this, drawAnchors) , this.timeElapsed);
			//Data Values
			this.config.intervals.dataValues = setInterval(Delegate.create(this, drawValues) , this.timeElapsed);
			//Draw trend lines			
			this.config.intervals.trend = setInterval(Delegate.create(this, drawTrendLines) , this.timeElapsed);			
			//Draw vertical div lines
			this.config.intervals.vLine = setInterval(Delegate.create(this, drawVLines) , this.timeElapsed);
			//Update timer
			this.timeElapsed +=(this.params.animation) ? this.styleM.getMaxAnimationTime(this.objects.REALTIMEVALUE, this.objects.ANCHORS, this.objects.TRENDLINES, this.objects.TRENDVALUES, this.objects.VLINES, this.objects.DATAVALUES):0;
			//Render the annotations above the chart
			this.config.intervals.annotationsAbove = setInterval(Delegate.create(this, renderAnnotationAbove) , this.timeElapsed);			
			//Now, that everything has rendered, we can start our cycle for real-time data retrieval.
			this.config.intervals.updateInterval = setInterval(Delegate.create(this, setUpdateInterval) , this.timeElapsed);			
			this.config.intervals.refreshInterval = setInterval(Delegate.create(this, setRefreshInterval) , this.timeElapsed);			
			this.config.intervals.clearChartInterval = setInterval(Delegate.create(this, setClearChartInterval), this.timeElapsed);
			//Update rendered flag.
			this.config.intervals.renderedFlag = setInterval(Delegate.create(this, updateRenderedFlag) , this.timeElapsed);			
			//Dispatch event that the chart has loaded.
			this.config.intervals.renderedEvent = setInterval(Delegate.create(this, exposeChartRendered) , this.timeElapsed);
			//Set context menu - after 100 ms delay
			this.config.intervals.contextMenu = setInterval(Delegate.create(this, setContextMenu) , this.timeElapsed + 100);			
		}
	}
	/**
	* returnDataAsObject method creates an object out of the parameters
	* passed to this method. The idea is that we store each data point
	* as an object with multiple(flexible) properties. So, we do not
	* use a predefined class structure. Instead we use a generic object.
	*	@param	value		Value for the data.
	*	@param	color		Hex Color code.
	*	@param	alpha		Alpha of the line
	*	@param	toolText	Tool tip text(if specified).
	*	@param	link		Link(if any) for the data.
	*	@param	showValue	Flag to show/hide value for this data.
	*	@param	isDashed	Flag whether the line would be dashed.
	*	@param	anchorSides				Number of sides of the anchor.
	*	@param	anchorRadius			Radius of the anchor(in pixels).
	*	@param	anchorBorderColor		Border color of the anchor.
	*	@param	anchorBorderThickness	Border thickness of the anchor.
	*	@param	anchorBgColor			Background color of the anchor.
	*	@param	anchorAlpha				Alpha of the anchor.
	*	@param	anchorBgAlpha			Background(fill) alpha of the anchor.
	*	@return			An object encapsulating all these properies.
	*/
	private function returnDataAsObject(value:Number, color:String, alpha:Number, toolText:String, link:String, showValue:Number, isDashed:Boolean, anchorSides:Number, anchorRadius:Number, anchorBorderColor:String, anchorBorderThickness:Number, anchorBgColor:String, anchorAlpha:Number, anchorBgAlpha:Number):Object {
		//Create a container
		var dataObj:Object = new Object();
		//Store the values
		dataObj.value = value;
		dataObj.color = color;
		dataObj.alpha = alpha;
		dataObj.toolText = toolText;
		dataObj.link = link;
		dataObj.showValue =(showValue == 1) ? true:false;
		dataObj.dashed = isDashed;
		//Anchor properties
		dataObj.anchorSides = anchorSides;
		dataObj.anchorRadius = anchorRadius;
		dataObj.anchorBorderColor = anchorBorderColor;
		dataObj.anchorBorderThickness = anchorBorderThickness;
		dataObj.anchorBgColor = anchorBgColor;
		dataObj.anchorAlpha = anchorAlpha;
		dataObj.anchorBgAlpha = anchorBgAlpha;
		//If the given number is not a valid number or it's missing
		//set appropriate flags for this data point
		dataObj.isDefined =((dataObj.alpha == 0) || isNaN(value)) ? false:true;
		//Other parameters
		//X & Y Position of data point
		dataObj.x = 0;
		dataObj.y = 0;
		//X & Y Position of value tb
		dataObj.valTBX = 0;
		dataObj.valTBY = 0;
		//Store the formatted display value
		dataObj.displayValue = (dataObj.isDefined)?(this.nf.formatNumber(value, this.params.formatNumber, this.params.formatNumberScale, this.params.decimals, this.params.forceDecimals)):("");
		//Return the container
		return dataObj;
	}
	/**
	* returnDataAsCat method returns data of a <category> element as
	* an object
	*	@param	label		Label of the category.
	*	@param	showLabel	Whether to show the label of this category (forced by user).
	*	@param	toolText	Tool-text for the category
	*	@return			A container object with the given properties
	*/
	private function returnDataAsCat(label:String, showLabel:Number, toolText:String):Object{
		//Create container object
		var catObj:Object = new Object();
		catObj.label = label;
		//oShowLabel represents the original forced value set by the user whether
		//to show/hide this label.
		catObj.oShowLabel = showLabel;
		catObj.showLabel =((showLabel == 1) && (label != undefined) && (label != null) && (label != ""));
		catObj.toolText = toolText;
		//X and Y Position
		catObj.x = 0;
		catObj.y = 0;
		//Return container
		return catObj;
	}
	/**
	* parseXML method parses the XML data, sets defaults and validates
	* the attributes before storing them to data storage objects.
	*/
	private function parseXML():Void {
		//Get the element nodes
		var arrDocElement:Array = this.xmlData.childNodes;
		//Loop variable
		var i:Number;
		var j:Number;
		var k:Number;
		//Look for <graph> element
		for(i = 0; i < arrDocElement.length; i ++){
			//If it's a <graph> element, proceed.
			//Do case in-sensitive mathcing by changing to upper case
			if(arrDocElement [i].nodeName.toUpperCase() == "GRAPH" || arrDocElement [i].nodeName.toUpperCase() == "CHART") {
				//Extract attributes of <graph> element
				this.parseAttributes(arrDocElement[i]);
				//Extract common attributes/over-ride chart specific ones
				this.parseCommonAttributes (arrDocElement [i], true);
				//Now, get the child nodes - first level nodes
				//Level 1 nodes can be - CATEGORIES, DATASET, TRENDLINES, STYLES etc.
				var arrLevel1Nodes:Array = arrDocElement[i].childNodes;
				var setNode:XMLNode;
				//Before we iterate through other level 1 nodes, we necessarily need
				//to parse the ANNOTATIONS or customObjects node, as the object IDs of 
				//the annotations would be validated by Style Manager. 
				for(j = 0; j < arrLevel1Nodes.length; j ++){
					if(arrLevel1Nodes [j].nodeName.toUpperCase() == "ANNOTATIONS" || arrLevel1Nodes [j].nodeName.toUpperCase() == "CUSTOMOBJECTS"){
						//Parse and store
						this.am.parseXML(arrLevel1Nodes [j]);
					}
				}
				//Iterate through all level 1 nodes.
				for(j = 0; j < arrLevel1Nodes.length; j ++){
					if(arrLevel1Nodes [j].nodeName.toUpperCase() == "CATEGORIES"){
						//Categories Node.
						var categoriesNode:XMLNode = arrLevel1Nodes [j];
						//Convert attributes to array
						var categoriesAtt:Array = Utils.getAttributesArray(categoriesNode);
						//Extract attributes of this node.
						this.params.catFont = getFV(categoriesAtt ["font"] , this.params.outCnvBaseFont);
						this.params.catFontSize = getFN(categoriesAtt ["fontsize"] , this.params.outCnvBaseFontSize);
						this.params.catFontColor = formatColor(getFV(categoriesAtt ["fontcolor"] , this.params.outCnvBaseFontColor));
						//Get reference to child node.
						var arrLevel2Nodes:Array = arrLevel1Nodes [j].childNodes;
						//Iterate through all child-nodes of CATEGORIES element
						//and search for CATEGORY or VLINE node
						for(k = 0; k < arrLevel2Nodes.length; k ++){
							if(arrLevel2Nodes [k].nodeName.toUpperCase() == "CATEGORY"){
								//Category Node.
								//Update counter
								this.num ++;
								//Extract attributes
								var categoryNode:XMLNode = arrLevel2Nodes [k];
								var categoryAtt:Array = Utils.getAttributesArray(categoryNode);
								//Category label.
								var catLabel:String = getFV(categoryAtt ["label"] , categoryAtt ["name"] , "");
								var catShowLabel:Number = getFN(categoryAtt ["showlabel"] , categoryAtt ["showname"] , this.params.showLabels);
								var catToolText:String = getFV(categoryAtt ["tooltext"] , categoryAtt ["hovertext"] , catLabel);
								//Store it in data container.
								this.categories [this.num] = this.returnDataAsCat(catLabel, catShowLabel, catToolText);
							} 
							else if(arrLevel2Nodes [k].nodeName.toUpperCase() == "VLINE"){
								//Vertical axis division Node - extract child nodes
								var vLineNode:XMLNode = arrLevel2Nodes [k];
								//Parse and store
								super.parseVLineNode(vLineNode, this.num);
							}
						}
					} else if(arrLevel1Nodes [j].nodeName.toUpperCase() == "DATASET"){
						//Increment
						this.numDS ++;
						//Dataset node.
						var dataSetNode:XMLNode = arrLevel1Nodes[j];
						//Get attributes array
						var dsAtts:Array = Utils.getAttributesArray(dataSetNode);
						//Create storage object in dataset array
						this.dataset [this.numDS] = new Object();
						//Store attributes
						this.dataset [this.numDS].seriesName = getFV(dsAtts ["seriesname"] , "");
						this.dataset [this.numDS].color = formatColor(getFV(dsAtts ["color"] , this.colorM.getColor()));
						this.dataset [this.numDS].alpha = getFN(dsAtts ["alpha"] , this.params.plotFillAlpha);
						this.dataset [this.numDS].showValues = toBoolean(getFN(dsAtts ["showvalues"] , this.params.showValues));
						this.dataset [this.numDS].includeInLegend = toBoolean(getFN(dsAtts ["includeinlegend"] , 1));
						//Whether to check this dataset's data for alerts
						this.dataset [this.numDS].checkForAlerts = toBoolean(getFN(dsAtts ["checkforalerts"] , 1));
						//Dash Properties
						this.dataset [this.numDS].dashed = toBoolean (getFN (dsAtts ["dashed"] , this.params.plotBorderDashed));
						//Data set anchors
						this.dataset [this.numDS].drawAnchors = toBoolean (getFN (dsAtts ["drawanchors"] , dsAtts ["showanchors"] , this.params.drawAnchors));
						this.dataset [this.numDS].anchorSides = getFN (dsAtts ["anchorsides"] , this.params.anchorSides);
						this.dataset [this.numDS].anchorRadius = getFN (dsAtts ["anchorradius"] , this.params.anchorRadius);
						this.dataset [this.numDS].anchorBorderColor = formatColor (getFV (dsAtts ["anchorbordercolor"] , this.params.anchorBorderColor, this.dataset [this.numDS].color));
						this.dataset [this.numDS].anchorBorderThickness = getFN (dsAtts ["anchorborderthickness"] , this.params.anchorBorderThickness);
						this.dataset [this.numDS].anchorBgColor = formatColor (getFV (dsAtts ["anchorbgcolor"] , this.params.anchorBgColor));
						this.dataset [this.numDS].anchorAlpha = getFN (dsAtts ["anchoralpha"] , this.params.anchorAlpha);
						this.dataset [this.numDS].anchorBgAlpha = getFN (dsAtts ["anchorbgalpha"] , this.params.anchorBgAlpha);
						//Area Border Properties
						this.dataset [this.numDS].showPlotBorder = toBoolean (getFN (dsAtts ["showplotborder"] , dsAtts ["showareaborder"] , this.params.showPlotBorder));
						this.dataset [this.numDS].plotBorderColor = formatColor (getFV (dsAtts ["plotbordercolor"] , dsAtts ["areabordercolor"] , this.params.plotBorderColor));
						this.dataset [this.numDS].plotBorderThickness = getFN (dsAtts ["plotborderthickness"] , dsAtts ["areaborderthickness"] , this.params.plotBorderThickness);
						this.dataset [this.numDS].plotBorderAlpha = getFN (dsAtts ["plotborderalpha"] , this.params.plotBorderAlpha);
						//Create data array under it.
						this.dataset [this.numDS].data = new Array();
						//Get reference to child node.
						var arrLevel2Nodes:Array = arrLevel1Nodes [j].childNodes;
						//Iterate through all child-nodes of DATASET element
						//and search for SET node
						//Counter
						var setCount:Number = 0;
						for(k = 0; k < arrLevel2Nodes.length; k ++){
							if(arrLevel2Nodes [k].nodeName.toUpperCase() == "SET"){
								//Set Node. So extract the data.
								//Update counter
								setCount ++;
								//Get reference to node.
								setNode = arrLevel2Nodes [k];
								//Get attributes
								var atts:Array;
								atts = Utils.getAttributesArray(setNode);
								//Now, get value.
								try{
									var setValue:Number = this.nf.parseValue(atts["value"]);
								} catch (e:Error){
									//If the value is not a number, log a data
									this.log("Invalid data",e.message, Logger.LEVEL.ERROR);
									//Set as NaN - so that we can show it as empty data.
									setValue = Number("");
								}
								//We do NOT unescape the link, as this will be done
								//in invokeLink method for the links that user clicks.
								var setLink:String = getFV(atts["link"] , "");
								var setToolText:String = getFV(atts ["tooltext"] , atts ["hovertext"]);
								var setColor:String = formatColor(getFV(atts ["color"] , this.dataset [this.numDS].color));
								var setAlpha:Number = getFN(atts ["alpha"] , this.dataset [this.numDS].alpha);
								var setShowValue:Number = getFN(atts ["showvalue"] , this.dataset [this.numDS].showValues);
								var setDashed:Boolean = toBoolean(getFN(atts ["dashed"] , this.dataset [this.numDS].dashed));
								//Anchor properties for individual set
								var setAnchorSides:Number = getFN(atts ["anchorsides"] , this.dataset [this.numDS].anchorSides);
								var setAnchorRadius:Number = getFN(atts ["anchorradius"] , this.dataset [this.numDS].anchorRadius);
								var setAnchorBorderColor:String = formatColor(getFV(atts ["anchorbordercolor"] , this.dataset [this.numDS].anchorBorderColor));
								var setAnchorBorderThickness:Number = getFN(atts ["anchorborderthickness"] , this.dataset [this.numDS].anchorBorderThickness);
								var setAnchorBgColor:String = formatColor(getFV(atts ["anchorbgcolor"] , this.dataset [this.numDS].anchorBgColor));
								var setAnchorAlpha:Number = getFN(atts ["anchoralpha"] , this.dataset [this.numDS].anchorAlpha);
								var setAnchorBgAlpha:Number = getFN(atts ["anchorbgalpha"] , this.dataset [this.numDS].anchorBgAlpha);
								//Store all these attributes as object.
								this.dataset[this.numDS].data[setCount] = this.returnDataAsObject(setValue, setColor, setAlpha, setToolText, setLink, setShowValue, setDashed, setAnchorSides, setAnchorRadius, setAnchorBorderColor, setAnchorBorderThickness, setAnchorBgColor, setAnchorAlpha, setAnchorBgAlpha);
							}
						}
					} else if(arrLevel1Nodes [j].nodeName.toUpperCase() == "STYLES"){
						//Parse the style nodes to extract style information
						this.styleM.parseXML(arrLevel1Nodes[j].childNodes);
					} else if(arrLevel1Nodes[j].nodeName.toUpperCase() == "ALERTS"){
						//Alerts - check if it has any child nodes
						if (arrLevel1Nodes[j].hasChildNodes()){							
							//Extract alert information
							super.setupAlertManager(arrLevel1Nodes[j]);
						}
					} else if(arrLevel1Nodes [j].nodeName.toUpperCase() == "TRENDLINES"){
						//Parse the trend line nodes
						super.parseTrendLineXML(arrLevel1Nodes [j].childNodes);
					}
				}				
			}
		}
		//Delete all temporary objects used for parsing XML Data document
		delete setNode;
		delete arrDocElement;
		delete arrLevel1Nodes;
		delete arrLevel2Nodes;
	}
	/**
	* parseAttributes method parses the attributes and stores them in
	* chart storage objects.
	* Starting ActionScript 2, the parsing of XML attributes have also
	* become case-sensitive. However, prior versions of FusionCharts
	* supported case-insensitive attributes. So we need to parse all
	* attributes as case-insensitive to maintain backward compatibility.
	* To do so, we first extract all attributes from XML, convert it into
	* lower case and then store it in an array. Later, we extract value from
	* this array.
	* @param	graphElement	XML Node containing the <graph> element
	*							and it's attributes
	*/
	private function parseAttributes(graphElement:XMLNode):Void{
		//Array to store the attributes
		var atts:Array = Utils.getAttributesArray(graphElement);
		//NOW IT'S VERY NECCESARY THAT WHEN WE REFERENCE THIS ARRAY
		//TO GET AN ATTRIBUTE VALUE, WE SHOULD PROVIDE THE ATTRIBUTE
		//NAME IN LOWER CASE. ELSE, UNDEFINED VALUE WOULD SHOW UP.
		//Extract attributes pertinent to this chart
		//Which palette to use?
		this.params.palette = getFN(atts ["palette"] , 1);
		//If single color them is to be used
		this.params.paletteThemeColor = getFV(atts["palettethemecolor"], "");
		//Setup the color manager
		this.setupColorManager(this.params.palette, this.params.paletteThemeColor);
		//Whether to show real time related context menu items
		this.params.showRTMenuItem = toBoolean(getFN(atts ["showrtmenuitem"] , 1));
		// ---------- PADDING AND SPACING RELATED ATTRIBUTES ----------- //
		//captionPadding = Space between caption/subcaption and canvas start Y
		this.params.captionPadding = getFN(atts ["captionpadding"] , 10);
		//Canvas Padding is the space between the canvas left/right border
		//and first/last data point
		this.params.canvasPadding = getFN(atts ["canvaspadding"] , 0);
		//Padding for x-axis name - to the right
		this.params.xAxisNamePadding = getFN(atts ["xaxisnamepadding"] , 5);
		//Padding for y-axis name - from top
		this.params.yAxisNamePadding = getFN(atts ["yaxisnamepadding"] , 5);
		//Y-Axis Values padding - Horizontal space between the axis edge and
		//y-axis values or trend line values(on left/right side).
		this.params.yAxisValuesPadding = getFN(atts ["yaxisvaluespadding"] , 2);
		//Label padding - Vertical space between the labels and canvas end position
		this.params.labelPadding = getFN(atts ["labelpadding"] , atts ["labelspadding"] , 3);
		//Value padding - vertical space between the anchors and start of value textboxes
		this.params.valuePadding = getFN(atts ["valuepadding"] , 2);
		//Padding between x-axis names and real-time value
		this.params.realTimeValuePadding = getFN(atts ["realtimevaluepadding"] , 3);
		//Padding of legend from right/bottom side of canvas
		this.params.legendPadding = getFN(atts ["legendpadding"] , 6);
		//Chart Margins - Empty space at the 4 sides
		this.params.chartLeftMargin = getFN(atts ["chartleftmargin"] , 15);
		this.params.chartRightMargin = getFN(atts ["chartrightmargin"] , 15);
		this.params.chartTopMargin = getFN(atts ["charttopmargin"] , 15);
		this.params.chartBottomMargin = getFN(atts ["chartbottommargin"] , 15);
		//Canvas margins (forced by user)
		this.params.canvasLeftMargin = getFN(atts ["canvasleftmargin"] , -1);
		this.params.canvasRightMargin = getFN(atts ["canvasrightmargin"] , -1);
		this.params.canvasTopMargin = getFN(atts ["canvastopmargin"] , -1);
		this.params.canvasBottomMargin = getFN(atts ["canvasbottommargin"] , -1);
		// -------------------------- HEADERS ------------------------- //
		//Chart Caption and sub Caption
		this.params.caption = getFV(atts ["caption"] , "");
		this.params.subCaption = getFV(atts ["subcaption"] , "");
		//X and Y Axis Name
		this.params.xAxisName = getFV(atts ["xaxisname"] , "");
		this.params.yAxisName = getFV(atts ["yaxisname"] , "");
		// --------------------- CONFIGURATION ------------------------- //
		//The upper and lower limits of y and x axis
		//this.params.yAxisMinValue = atts ["yaxisminvalue"];
		this.params.yAxisMaxValue = atts ["yaxismaxvalue"];
		//Whether to set animation for entire chart.
		this.params.animation = toBoolean(getFN(atts ["animation"] , 1));
		//Whether to set the default chart animation
		this.params.defaultAnimation = toBoolean(getFN(atts ["defaultanimation"] , 1));
		//Whether null data points are to be connected or left broken
		this.params.connectNullData = toBoolean(getFN(atts ["connectnulldata"] , 0));
		//Configuration to set whether to show the labels
		this.params.showLabels = toBoolean(getFN(atts ["showlabels"] , atts ["shownames"] , 1));
		//Label Display Mode - WRAP, STAGGER, ROTATE or NONE
		this.params.labelDisplay = getFV(atts ["labeldisplay"] , "WRAP");
		//Remove spaces and capitalize
		this.params.labelDisplay = StringExt.removeSpaces(this.params.labelDisplay);
		this.params.labelDisplay = this.params.labelDisplay.toUpperCase();
		//Option to show vertical x-axis labels
		this.params.rotateLabels = getFV(atts ["rotatelabels"] , atts ["rotatenames"]);
		//Whether to slant label(if rotated)
		this.params.slantLabels = toBoolean(getFN(atts ["slantlabels"] , atts ["slantlabel"] , 0));
		//Angle of rotation based on slanting
		this.config.labelAngle =(this.params.slantLabels == true) ? 315:270;
		//If rotateLabels has been explicitly specified, we assign ROTATE value to this.params.labelDisplay
		this.params.labelDisplay =(this.params.rotateLabels == "1") ? "ROTATE":this.params.labelDisplay;
		//Step value for labels - i.e., show all labels or skip every x label
		this.params.labelStep = int(getFN(atts ["labelstep"] , 1));
		//Cannot be less than 1
		this.params.labelStep =(this.params.labelStep < 1) ? 1:this.params.labelStep;
		//Number of stagger lines
		this.params.staggerLines = int(getFN(atts ["staggerlines"] , 2));
		//Cannot be less than 2
		this.params.staggerLines =(this.params.staggerLines < 2) ? 2:this.params.staggerLines;
		//Configuration whether to show data values
		this.params.showValues = toBoolean(getFN(atts ["showvalues"] , 1));
		//Whether to rotate values
		this.params.rotateValues = toBoolean(getFN(atts ["rotatevalues"] , 0));
		//Option to show/hide y-axis values
		this.params.showYAxisValues = getFN(atts ["showyaxisvalues"] , atts ["showyaxisvalue"] , 1);
		this.params.showLimits = toBoolean(getFN(atts ["showlimits"] , this.params.showYAxisValues));
		this.params.showDivLineValues = toBoolean(getFN(atts ["showdivlinevalue"] , atts ["showdivlinevalues"] , this.params.showYAxisValues));
		//Y-axis value step- i.e., show all y-axis or skip every x(th) value
		this.params.yAxisValuesStep = int(getFN(atts ["yaxisvaluesstep"] , atts ["yaxisvaluestep"] , 1));
		//Cannot be less than 1
		this.params.yAxisValuesStep =(this.params.yAxisValuesStep < 1) ? 1:this.params.yAxisValuesStep;
		//Whether to rotate y-axis name
		this.params.rotateYAxisName = toBoolean(getFN(atts ["rotateyaxisname"] , 1));
		//Max width to be alloted to y-axis name - No defaults, as it's calculated later.
		this.params.yAxisNameWidth = atts ["yaxisnamewidth"];
		//Click URL
		this.params.clickURL = getFV(atts ["clickurl"] , "");
		// ------------------- REAL-TIME CHART RELATED ATTRIBUTES -----------------//		
		//Message Logger
		this.params.useMessageLog = toBoolean(getFN(atts ["usemessagelog"] , 0));
		this.params.messageLogWPercent = getFN(atts ["messagelogwpercent"] , 80);
		this.params.messageLogHPercent = getFN(atts ["messageloghpercent"] , 70);
		this.params.messageLogShowTitle = toBoolean(getFN(atts ["messagelogshowtitle"] , 1));
		this.params.messageLogTitle = getFV(atts["messagelogtitle"] , "Message Log");
		this.params.messageLogColor = getFV(atts["messagelogcolor"] , this.colorM.get2DMsgLogColor());		
		this.params.messageGoesToLog = toBoolean(getFN(atts ["messagegoestolog"] , 1));
		this.params.messageGoesToJS = toBoolean(getFN(atts ["messagegoestojs"] , 0));
		this.params.messageJSHandler = getFV(atts["messagejshandler"] , "alert");
		this.params.messagePassAllToJS = toBoolean(getFN(atts["messagepassalltojs"] , 0));
		//Whether to show the real-time value below the chart
		this.params.showRealTimeValue = toBoolean(getFN(atts ["showrealtimevalue"] , 1));
		//Separator character for display value
		this.params.realTimeValueSep = getFV(atts["realtimevaluesep"] , ", ");
		//Number of items to be displayed on the chart
		this.params.numDisplaySets = getFN(atts ["numdisplaysets"] , -1);
		//Whether to pull feeds from
		this.params.dataStreamURL = unescape(getFV(atts ["datastreamurl"] , ""));
		//Check whether dataStreamURL contains ?
		this.params.streamURLQMarkPresent = (this.params.dataStreamURL.indexOf("?") != -1);
		//In what time to update the chart
		this.params.refreshInterval = getFN(atts["refreshinterval"] , -1);
		//In what time to update data & stock it
		this.params.updateInterval = getFN(atts["updateinterval"], this.params.refreshInterval);
		//If update interval is more than refreshInterval, we set them same
		this.params.updateInterval = (this.params.updateInterval>this.params.refreshInterval)?this.params.refreshInterval:this.params.updateInterval;
		//In what interval to clear the chart 
		this.params.clearChartInterval = getFN(atts["clearchartinterval"], 0);
		if (this.params.clearChartInterval<1){
			this.params.clearChartInterval = 0;
		}
		//Data stamp for first data.
		this.params.dataStamp = getFV(atts ["datastamp"] , "");
		// ------------------------- COSMETICS -----------------------------//
		//Background properties - Gradient
		this.params.bgColor = getFV(atts ["bgcolor"] , this.colorM.get2DBgColor());
		this.params.bgAlpha = getFV(atts ["bgalpha"] , this.colorM.get2DBgAlpha());
		this.params.bgRatio = getFV(atts ["bgratio"] , this.colorM.get2DBgRatio());
		this.params.bgAngle = getFV(atts ["bgangle"] , this.colorM.get2DBgAngle());
		//Border Properties of chart
		this.params.showBorder = toBoolean(getFN(atts ["showborder"] , 1));
		this.params.borderColor = formatColor(getFV(atts ["bordercolor"] , this.colorM.get2DBorderColor()));
		this.params.borderThickness = getFN(atts ["borderthickness"] , 1);
		this.params.borderAlpha = getFN(atts ["borderalpha"] , this.colorM.get2DBorderAlpha());
		//Canvas background properties - Gradient
		this.params.canvasBgColor = getFV(atts ["canvasbgcolor"] , this.colorM.get2DCanvasBgColor());
		this.params.canvasBgAlpha = getFV(atts ["canvasbgalpha"] , this.colorM.get2DCanvasBgAlpha());
		this.params.canvasBgRatio = getFV(atts ["canvasbgratio"] , this.colorM.get2DCanvasBgRatio());
		this.params.canvasBgAngle = getFV(atts ["canvasbgangle"] , this.colorM.get2DCanvasBgAngle());
		//Canvas Border properties
		this.params.canvasBorderColor = formatColor(getFV(atts ["canvasbordercolor"] , this.colorM.get2DCanvasBorderColor()));
		this.params.canvasBorderThickness = getFN(atts ["canvasborderthickness"] , 2);
		this.params.canvasBorderAlpha = getFN(atts ["canvasborderalpha"] , this.colorM.get2DCanvasBorderAlpha());
		//Plot gradient color
		if (atts ["plotgradientcolor"] == ""){
			//If some one doesn't want to specify a plot gradient color
			//i.e., he opts for solid fills
			this.params.plotGradientColor = ""
		}else{
			this.params.plotGradientColor = formatColor (getFV (atts ["plotgradientcolor"] , this.colorM.get2DPlotGradientColor()));
		}
		//Area fill properties
		this.params.plotFillAngle = getFN (atts ["plotfillangle"] , 270);
		this.params.plotFillColor = formatColor (getFV (atts ["plotfillcolor"] , atts ["areabgcolor"] , this.colorM.get2DPlotFillColor()));
		this.params.plotFillAlpha = getFN (atts ["plotfillalpha"] , atts ["areaalpha"] , 100);
		//Area Border Properties
		this.params.showPlotBorder = toBoolean (getFN (atts ["showplotborder"] , atts ["showareaborder"] , 1));
		this.params.plotBorderColor = formatColor (getFV (atts ["plotbordercolor"] , atts ["areabordercolor"] , "666666"));
		this.params.plotBorderThickness = getFN (atts ["plotborderthickness"] , atts ["areaborderthickness"] , 1);
		this.params.plotBorderAlpha = getFN (atts ["plotborderalpha"] , (this.params.showPlotBorder == true) ?95 : 0);
		//Plot is dashed
		this.params.plotBorderDashed = toBoolean (getFN (atts ["plotborderdashed"] , 0));
		//Dash Properties
		this.params.plotBorderDashLen = getFN (atts ["plotborderdashlen"] , 5);
		this.params.plotBorderDashGap = getFN (atts ["plotborderdashgap"] , 4);
		//Legend properties
		this.params.showLegend = toBoolean(getFN(atts ["showlegend"] , 1));
		//Alignment position
		this.params.legendPosition = getFV(atts ["legendposition"] , "BOTTOM");
		//Legend position can be either RIGHT or BOTTOM -Check for it
		this.params.legendPosition =(this.params.legendPosition.toUpperCase() == "RIGHT") ?"RIGHT":"BOTTOM";
		this.params.interactiveLegend = false;
		this.params.legendCaption = getFV(atts ["legendcaption"] , "");
		this.params.legendMarkerCircle = toBoolean(getFN(atts ["legendmarkercircle"] , 0));
		this.params.legendBorderColor = formatColor(getFV(atts ["legendbordercolor"] , this.colorM.get2DLegendBorderColor()));
		this.params.legendBorderThickness = getFN(atts ["legendborderthickness"] , 1);
		this.params.legendBorderAlpha = getFN(atts ["legendborderalpha"] , 100);
		this.params.legendBgColor = getFV(atts ["legendbgcolor"] , this.colorM.get2DLegendBgColor());
		this.params.legendBgAlpha = getFN(atts ["legendbgalpha"] , 100);
		this.params.legendShadow = toBoolean(getFN(atts ["legendshadow"] , 1));
		this.params.legendAllowDrag = toBoolean(getFN(atts ["legendallowdrag"] , 0));
		this.params.legendScrollBgColor = formatColor(getFV(atts ["legendscrollbgcolor"] , "CCCCCC"));
		this.params.legendScrollBarColor = formatColor(getFV(atts ["legendscrollbarcolor"] , this.params.legendBorderColor));
		this.params.legendScrollBtnColor = formatColor(getFV(atts ["legendscrollbtncolor"] , this.params.legendBorderColor));
		this.params.reverseLegend = toBoolean (getFN (atts ["reverselegend"] , 0));
		//Horizontal grid division Lines - Number, color, thickness & alpha
		//Necessarily need a default value for numDivLines.
		this.params.numDivLines = getFN(atts ["numdivlines"] , 4);
		this.params.divLineColor = formatColor(getFV(atts ["divlinecolor"] , this.colorM.get2DDivLineColor()));
		this.params.divLineThickness = getFN(atts ["divlinethickness"] , 1);
		this.params.divLineAlpha = getFN(atts ["divlinealpha"] , this.colorM.get2DDivLineAlpha());
		this.params.divLineIsDashed = toBoolean(getFN(atts ["divlineisdashed"] , 0));
		this.params.divLineDashLen = getFN(atts ["divlinedashlen"] , 4);
		this.params.divLineDashGap = getFN(atts ["divlinedashgap"] , 2);
		//Vertical div lines
		this.params.numVDivLines = getFN(atts ["numvdivlines"] , 0);
		this.params.vDivLineColor = formatColor(getFV(atts ["vdivlinecolor"] , this.params.divLineColor));
		this.params.vDivLineThickness = getFN(atts ["vdivlinethickness"] , this.params.divLineThickness);
		this.params.vDivLineAlpha = getFN(atts ["vdivlinealpha"] , this.params.divLineAlpha);
		this.params.vDivLineIsDashed = toBoolean(getFN(atts ["vdivlineisdashed"] , this.params.divLineIsDashed));
		this.params.vDivLineDashLen = getFN(atts ["vdivlinedashlen"] , this.params.divLineDashLen);
		this.params.vDivLineDashGap = getFN(atts ["vdivlinedashgap"] , this.params.divLineDashGap);
		//Zero Plane properties
		this.params.showZeroPlane = true;
		this.params.zeroPlaneColor = formatColor(getFV(atts ["zeroplanecolor"] , this.params.divLineColor));
		this.params.zeroPlaneThickness = getFN(atts ["zeroplanethickness"] , (this.params.divLineThickness == 1) ? 2 : this.params.divLineThickness);
		this.params.zeroPlaneAlpha = getFN(atts ["zeroplanealpha"] , this.params.divLineAlpha * 2);
		//Alternating grid colors
		this.params.showAlternateHGridColor = toBoolean(getFN(atts ["showalternatehgridcolor"] , 1));
		this.params.alternateHGridColor = formatColor(getFV(atts ["alternatehgridcolor"] , this.colorM.get2DAltHGridColor()));
		this.params.alternateHGridAlpha = getFN(atts ["alternatehgridalpha"] , this.colorM.get2DAltHGridAlpha());
		this.params.showAlternateVGridColor = toBoolean(getFN(atts ["showalternatevgridcolor"] , 0));
		this.params.alternateVGridColor = formatColor(getFV(atts ["alternatevgridcolor"] , this.colorM.get2DAltVGridColor()));
		this.params.alternateVGridAlpha = getFN(atts ["alternatevgridalpha"] , this.colorM.get2DAltVGridAlpha());
		//Shadow properties
		this.params.showShadow = toBoolean(getFN(atts ["showshadow"] , 0));
		//Anchor Properties
		this.params.drawAnchors = toBoolean (getFN (atts ["drawanchors"] , atts ["showanchors"] , 1));
		this.params.anchorSides = getFN (atts ["anchorsides"] , 10);
		this.params.anchorRadius = getFN (atts ["anchorradius"] , 3);
		this.params.anchorBorderColor = atts ["anchorbordercolor"];
		this.params.anchorBorderThickness = getFN (atts ["anchorborderthickness"] , 1);
		this.params.anchorBgColor = formatColor (getFV (atts ["anchorbgcolor"] , this.colorM.get2DAnchorBgColor()));
		this.params.anchorAlpha = getFN (atts ["anchoralpha"] , 0);
		this.params.anchorBgAlpha = getFN (atts ["anchorbgalpha"] , this.params.anchorAlpha);
		//Tool Tip - Show/Hide, Background Color, Border Color, Separator Character
		this.params.showToolTip = toBoolean(getFN(atts ["showtooltip"] , atts ["showhovercap"] , 1));
		this.params.seriesNameInToolTip = toBoolean(getFN(atts ["seriesnameintooltip"] , 1));
		this.params.toolTipBgColor = formatColor(getFV(atts ["tooltipbgcolor"] , atts ["hovercapbgcolor"] , atts ["hovercapbg"] , this.colorM.get2DToolTipBgColor()));
		this.params.toolTipBorderColor = formatColor(getFV(atts ["tooltipbordercolor"] , atts ["hovercapbordercolor"] , atts ["hovercapborder"] , this.colorM.get2DToolTipBorderColor()));
		this.params.toolTipSepChar = getFV(atts ["tooltipsepchar"] , atts ["hovercapsepchar"] , ", ");
		//Font Properties
		this.params.baseFont = getFV(atts ["basefont"] , "Verdana");
		this.params.baseFontSize = getFN(atts ["basefontsize"] , 10);
		this.params.baseFontColor = formatColor(getFV(atts ["basefontcolor"] , this.colorM.get2DBaseFontColor()));
		this.params.outCnvBaseFont = getFV(atts ["outcnvbasefont"] , this.params.baseFont);
		this.params.outCnvBaseFontSize = getFN(atts ["outcnvbasefontsize"] , this.params.baseFontSize);
		this.params.outCnvBaseFontColor = formatColor(getFV(atts ["outcnvbasefontcolor"] , this.params.baseFontColor));
		//Font properties for the real-time value font
		this.params.realTimeValueFont = getFV(atts ["realtimevaluefont"] , this.params.outCnvBaseFont);
		this.params.realTimeValueFontSize = getFN(atts ["realtimevaluefontsize"] , this.params.outCnvBaseFontSize);
		this.params.realTimeValueFontColor = formatColor(getFV(atts ["realtimevaluefontcolor"] , this.params.outCnvBaseFontColor));
		// ------------------------- NUMBER FORMATTING ---------------------------- //
		//Option whether the format the number(using Commas)
		this.params.formatNumber = toBoolean(getFN(atts ["formatnumber"] , 1));
		//Option to format number scale
		this.params.formatNumberScale = toBoolean(getFN(atts ["formatnumberscale"] , 1));
		//Number Scales
		this.params.defaultNumberScale = getFV(atts ["defaultnumberscale"] , "");
		this.params.numberScaleUnit = getFV(atts ["numberscaleunit"] , "K,M");
		this.params.numberScaleValue = getFV(atts ["numberscalevalue"] , "1000,1000");
		//Recursive scale properties
		this.params.scaleRecursively = toBoolean(getFN(atts["scalerecursively"], 0));
		//By default we show all - so set as -1
		this.params.maxScaleRecursion = getFN(atts["maxscalerecursion"], -1);
		//Setting space as default scale separator.
		this.params.scaleSeparator = getFV(atts["scaleseparator"] , " ");		
		//Number prefix and suffix
		this.params.numberPrefix = getFV(atts ["numberprefix"] , "");
		this.params.numberSuffix = getFV(atts ["numbersuffix"] , "");
		//Decimal Separator Character
		this.params.decimalSeparator = getFV(atts ["decimalseparator"] , ".");
		//Thousand Separator Character
		this.params.thousandSeparator = getFV(atts ["thousandseparator"] , ",");
		//Input decimal separator and thousand separator. In some european countries,
		//commas are used as decimal separators and dots as thousand separators. In XML,
		//if the user specifies such values, it will give a error while converting to
		//number. So, we accept the input decimal and thousand separator from user, so that
		//we can covert it accordingly into the required format.
		this.params.inDecimalSeparator = getFV(atts ["indecimalseparator"] , "");
		this.params.inThousandSeparator = getFV(atts ["inthousandseparator"] , "");
		//Decimal Precision(number of decimal places to be rounded to)
		this.params.decimals = getFV(atts ["decimals"] , atts ["decimalprecision"], 2);
		//y-Axis values decimals
		this.params.yAxisValueDecimals = getFN(atts ["yaxisvaluedecimals"] , atts ["yaxisvaluesdecimals"] , atts ["divlinedecimalprecision"] , atts ["limitsdecimalprecision"], this.params.decimals);
		//Force Decimal Padding
		this.params.forceDecimals = toBoolean(getFN(atts ["forcedecimals"] , 0));
		this.params.forceYAxisDecimals = toBoolean(getFN(atts ["forceyaxisdecimals"] , Utils.fromBoolean(this.params.forceDecimals)));		
		//Set up number formatting 
		this.setupNumberFormatting(this.params.numberPrefix, this.params.numberSuffix, this.params.scaleRecursively, this.params.maxScaleRecursion, this.params.scaleSeparator, this.params.defaultNumberScale, this.params.numberScaleValue, this.params.numberScaleUnit, this.params.decimalSeparator, this.params.thousandSeparator, this.params.inDecimalSeparator, this.params.inThousandSeparator);
		//--------- For internal purposes -------------//
		this.params.valueInCanvasCheck = toBoolean(getFN(atts ["valueincanvascheck"] , 1));		
	}
	/**
	 * validateInitialData method validates the data provided in XML. Basically, we check
	 * if numDisplaySets > num. If not, we take necessary steps.
	 * We also set the position for vLines based on numDisplaySet.
	*/
	private function validateInitialData():Void{
		var i:Number;
		//First up, if the user has not specified numDisplaySets 
		if (this.params.numDisplaySets == -1) {
			//We set it to display all values defined in XML (if not 0), else 15.
			this.params.numDisplaySets = (this.num==0)?15:this.num;
		}
		
		//We also need to update the index of each vLine w.r.t global x containers
		//This needs to be done initially, before we re-calculate the numDisplaySets
		for (i=1; i<=this.numVLines; i++){
			this.vLines[i].index = this.params.numDisplaySets - this.num + this.vLines[i].index;
		}
		
		//If Params.num > numDisplaySets, re-set so as to consider only numDisplaySets data points
		if (this.num>this.params.numDisplaySets) {
			//Get the number of extra data points specified
			var extra:Number = this.num - this.params.numDisplaySets;
			//Update num to numDisplaySets
			this.num = this.params.numDisplaySets;
			//Remove extra data parsed and stored
			//First, remove the extra categories
			this.categories.splice(1,extra);
			//Need to remove data from each data-set too now
			for (i=1; i<=this.numDS; i++){
				//Remove the first extra items
				this.dataset[i].data.splice(1,extra);
			}
		}		
	}
	/**
	 * storeStatusFlag method checks whether there are positive/negative data
	 * present. Based on the same, it stores the required flags.
	*/
	private function storeStatusFlag():Void{
		//Initialize to false
		this.negativePresent = false;
		this.positivePresent = false;
		//Iterate and check over.
		var i:Number, j:Number;
		//Double loop with breaks to optimize 
		for (i=1; i<=this.numDS; i++){
			for (j=1; j<=this.num; j++){
				if (this.dataset[i].data[j].value>=0){
					this.positivePresent = true;
					break;
				}
			}
		}
		//Check for negative.
		for (i=1; i<=this.numDS; i++){
			for (j=1; j<=this.num; j++){
				if (this.dataset[i].data[j].value<0){
					this.negativePresent = true;
					break;
				}
			}
		}
	}
	/**
	* getSumOfValues method returns the sum of values of a particular data
	* index in all the data sets. It is used to get the positive and negative
	* sum for the given index.
	*	@param	index	Index for which we've to calculate sum
	*	@return			An object containing PSum and NSum as positive
	*					and negative sum respectively.
	*/
	private function getSumOfValues (index:Number):Object{
		//Loop variables
		var i:Number;
		//Variable to store positive and negative sum
		var pSum:Number, nSum:Number;
		//Return Object
		var rtnObj:Object = new Object();
		//Iterate through all the datasets for this index
		for (i = 1; i <= this.numDS; i ++){
			//Check only if the data is defined
			if (this.dataset [i].data [index].isDefined){
				if (this.dataset [i].data [index].value >= 0){
					pSum = (pSum == undefined) ? (this.dataset [i].data [index].value) : (pSum + this.dataset [i].data [index].value);
				} else {
					nSum = (nSum == undefined) ? (this.dataset [i].data [index].value) : (nSum + this.dataset [i].data [index].value);
				}
			}
		}
		//Store values in return object and return
		rtnObj.pSum = pSum;
		rtnObj.nSum = nSum;
		return rtnObj;
	}
	/**
	* getMaxDataValue method gets the maximum y-axis data sum present
	* in the data.
	*	@return	The maximum value present in the data provided.
	*/
	private function getMaxDataValue():Number{
		var maxValue:Number;
		var firstSumFound:Boolean = false;
		var i:Number;
		var pSum:Number, sNum:Number;
		var sumObj:Object;
		var vitalSum:Number;
		for (i=1; i<=this.num; i++){
			sumObj = this.getSumOfValues(i);
			vitalSum = (this.positivePresent == false) ? (sumObj.nSum) : (sumObj.pSum);
			//By default assume the first non-null sum to be maximum
			if (firstSumFound == false){
				if (vitalSum != undefined){
					//Set the flag that "We've found first non-null sum".
					firstSumFound = true;
					//Also assume this value to be maximum.
					maxValue = vitalSum;
				}
			} else {
				//If the first sum has been found and the current sum is defined, compare
				if (vitalSum != undefined) {
					//Store the greater number
					maxValue = (vitalSum > maxValue) ? vitalSum : maxValue;
				}
			}
		}
		return maxValue;
	}
	/**
	* getMinDataValue method gets the minimum y-axis data sum present
	* in the data
	*	@reurns		The minimum value present in data
	*/
	private function getMinDataValue():Number{
		var minValue:Number;
		var firstSumFound:Boolean = false;
		var i:Number;
		var pSum:Number, sNum:Number;
		var sumObj:Object;
		var vitalSum:Number;
		for (i=1; i<=this.num; i++){
			sumObj = this.getSumOfValues(i);
			vitalSum = (this.negativePresent == true) ? (sumObj.nSum) : (sumObj.pSum);
			//By default assume the first non-null sum to be minimum
			if (firstSumFound == false){
				if (vitalSum != undefined){
					//Set the flag that "We've found first non-null sum".
					firstSumFound = true;

					//Also assume this value to be minimum.
					minValue = vitalSum;
				}
			} else {
				//If the first sum has been found and the current sum is defined, compare
				if (vitalSum != undefined) {
					//Store the lesser number
					minValue = (vitalSum < minValue) ? vitalSum : minValue;
				}
			}
		}
		return minValue;
	}
	/**
	* setupAxis method sets the axis for the chart.
	* It gets the minimum and maximum value specified in data and
	* based on that it calls super.getAxisLimits();
	*/
	private function setupAxis():Void {
		this.pAxis = new LinearAxis(this.params.yAxisMinValue, this.params.yAxisMaxValue, true, true, this.params.numDivLines, this.params.yAxisValuesStep, this.nf, this.params.formatNumber, this.params.formatNumberScale, this.params.yAxisValueDecimals, this.params.forceYAxisDecimals);
		this.pAxis.calculateLimits(this.getMaxDataValue(),this.getMinDataValue());		
		//Calcuate div lines - based on the initial data.
		this.pAxis.calculateDivLines(true);
		//Store copy of divLines in local array
		this.divLines = this.pAxis.getDivLines();		
	}
	/**
	* setStyleDefaults method sets the default values for styles or
	* extracts information from the attributes and stores them into
	* style objects.
	*/
	private function setStyleDefaults():Void {
		//Default font object for Caption
		//-----------------------------------------------------------------//
		var captionFont = new StyleObject ();
		captionFont.name = "_SdCaptionFont";
		captionFont.align = "center";
		captionFont.valign = "top";
		captionFont.bold = "1";
		captionFont.font = this.params.outCnvBaseFont;
		captionFont.size = this.params.outCnvBaseFontSize;
		captionFont.color = this.params.outCnvBaseFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.CAPTION, captionFont, this.styleM.TYPE.FONT, null);
		delete captionFont;
		//-----------------------------------------------------------------//
		//Default font object for SubCaption
		//-----------------------------------------------------------------//
		var subCaptionFont = new StyleObject ();
		subCaptionFont.name = "_SdSubCaptionFont";
		subCaptionFont.align = "center";
		subCaptionFont.valign = "top";
		subCaptionFont.bold = "1";
		subCaptionFont.font = this.params.outCnvBaseFont;
		subCaptionFont.size = this.params.outCnvBaseFontSize;
		subCaptionFont.color = this.params.outCnvBaseFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.SUBCAPTION, subCaptionFont, this.styleM.TYPE.FONT, null);
		delete subCaptionFont;
		//-----------------------------------------------------------------//
		//Default font object for YAxisName
		//-----------------------------------------------------------------//
		var yAxisNameFont = new StyleObject ();
		yAxisNameFont.name = "_SdYAxisNameFont";
		yAxisNameFont.align = "center";
		yAxisNameFont.valign = "middle";
		yAxisNameFont.bold = "1";
		yAxisNameFont.font = this.params.outCnvBaseFont;
		yAxisNameFont.size = this.params.outCnvBaseFontSize;
		yAxisNameFont.color = this.params.outCnvBaseFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.YAXISNAME, yAxisNameFont, this.styleM.TYPE.FONT, null);
		delete yAxisNameFont;
		//-----------------------------------------------------------------//
		//Default font object for XAxisName
		//-----------------------------------------------------------------//
		var xAxisNameFont = new StyleObject ();
		xAxisNameFont.name = "_SdXAxisNameFont";
		xAxisNameFont.align = "center";
		xAxisNameFont.valign = "middle";
		xAxisNameFont.bold = "1";
		xAxisNameFont.font = this.params.outCnvBaseFont;
		xAxisNameFont.size = this.params.outCnvBaseFontSize;
		xAxisNameFont.color = this.params.outCnvBaseFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.XAXISNAME, xAxisNameFont, this.styleM.TYPE.FONT, null);
		delete xAxisNameFont;
		//-----------------------------------------------------------------//
		//Default font object for Real-time value
		//-----------------------------------------------------------------//
		var realTimeValueFont = new StyleObject ();
		realTimeValueFont.name = "_SdRealTimeValue";
		realTimeValueFont.align = "center";
		realTimeValueFont.valign = "middle";
		realTimeValueFont.font = this.params.realTimeValueFont;
		realTimeValueFont.size = this.params.realTimeValueFontSize;
		realTimeValueFont.color = this.params.realTimeValueFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.REALTIMEVALUE, realTimeValueFont, this.styleM.TYPE.FONT, null);
		delete realTimeValueFont;
		//-----------------------------------------------------------------//
		//Default font object for trend lines
		//-----------------------------------------------------------------//
		var trendFont = new StyleObject ();
		trendFont.name = "_SdTrendFontFont";
		trendFont.font = this.params.outCnvBaseFont;
		trendFont.size = this.params.outCnvBaseFontSize;
		trendFont.color = this.params.outCnvBaseFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.TRENDVALUES, trendFont, this.styleM.TYPE.FONT, null);
		delete trendFont;
		//-----------------------------------------------------------------//
		//Default font object for yAxisValues
		//-----------------------------------------------------------------//
		var yAxisValuesFont = new StyleObject ();
		yAxisValuesFont.name = "_SdYAxisValuesFont";
		yAxisValuesFont.align = "right";
		yAxisValuesFont.valign = "middle";
		yAxisValuesFont.font = this.params.outCnvBaseFont;
		yAxisValuesFont.size = this.params.outCnvBaseFontSize;
		yAxisValuesFont.color = this.params.outCnvBaseFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.YAXISVALUES, yAxisValuesFont, this.styleM.TYPE.FONT, null);
		delete yAxisValuesFont;
		//-----------------------------------------------------------------//
		//Default font object for DataLabels
		//-----------------------------------------------------------------//
		var dataLabelsFont = new StyleObject ();
		dataLabelsFont.name = "_SdDataLabelsFont";
		dataLabelsFont.align = "center";
		dataLabelsFont.valign = "bottom";
		dataLabelsFont.font = this.params.catFont;
		dataLabelsFont.size = this.params.catFontSize;
		dataLabelsFont.color = this.params.catFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.DATALABELS, dataLabelsFont, this.styleM.TYPE.FONT, null);
		delete dataLabelsFont;
		//-----------------------------------------------------------------//
		//Default font object for vLine Labels
		//-----------------------------------------------------------------//
		var vLineLabelsFont = new StyleObject ();
		vLineLabelsFont.name = "_SdvLineLabelsFont";
		vLineLabelsFont.align = "center";
		vLineLabelsFont.valign = "bottom";
		vLineLabelsFont.font = this.params.baseFont;
		vLineLabelsFont.size = this.params.baseFontSize;
		vLineLabelsFont.color = this.params.baseFontColor;
		//vLineLabelsFont.bgcolor = this.params.canvasBgColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.VLINELABELS, vLineLabelsFont, this.styleM.TYPE.FONT, null);
		delete vLineLabelsFont;

		//-----------------------------------------------------------------//
		//Default font object for Legend
		//-----------------------------------------------------------------//
		var legendFont = new StyleObject ();
		legendFont.name = "_SdLegendFont";
		legendFont.font = this.params.outCnvBaseFont;
		legendFont.size = this.params.outCnvBaseFontSize;
		legendFont.color = this.params.outCnvBaseFontColor;
		legendFont.ishtml = 1;
		legendFont.leftmargin = 3;
		//Over-ride
		this.styleM.overrideStyle (this.objects.LEGEND, legendFont, this.styleM.TYPE.FONT, null);
		delete legendFont;
		//-----------------------------------------------------------------//
		//Default font object for DataValues
		//-----------------------------------------------------------------//
		var dataValuesFont = new StyleObject ();
		dataValuesFont.name = "_SdDataValuesFont";
		dataValuesFont.align = "center";
		dataValuesFont.valign = "middle";
		dataValuesFont.font = this.params.baseFont;
		dataValuesFont.size = this.params.baseFontSize;
		dataValuesFont.color = this.params.baseFontColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.DATAVALUES, dataValuesFont, this.styleM.TYPE.FONT, null);
		delete dataValuesFont;
		//-----------------------------------------------------------------//
		//Default font object for ToolTip
		//-----------------------------------------------------------------//
		var toolTipFont = new StyleObject ();
		toolTipFont.name = "_SdToolTipFont";
		toolTipFont.font = this.params.baseFont;
		toolTipFont.size = this.params.baseFontSize;
		toolTipFont.color = this.params.baseFontColor;
		toolTipFont.bgcolor = this.params.toolTipBgColor;
		toolTipFont.bordercolor = this.params.toolTipBorderColor;
		//Over-ride
		this.styleM.overrideStyle (this.objects.TOOLTIP, toolTipFont, this.styleM.TYPE.FONT, null);
		delete toolTipFont;
		//-----------------------------------------------------------------//
		//Default Effect (Shadow) object for DataPlot
		//-----------------------------------------------------------------//
		if (this.params.showShadow){
			var dataPlotShadow = new StyleObject ();
			dataPlotShadow.name = "_SdDataPlotShadow";
			dataPlotShadow.angle = 45;
			//Over-ride
			this.styleM.overrideStyle (this.objects.DATAPLOT, dataPlotShadow, this.styleM.TYPE.SHADOW, null);
			delete dataPlotShadow;
		}
		//-----------------------------------------------------------------//
		//Default Effect (Shadow) object for Legend
		//-----------------------------------------------------------------//
		if (this.params.legendShadow){
			var legendShadow = new StyleObject ();
			legendShadow.name = "_SdLegendShadow";
			legendShadow.distance = 2;
			legendShadow.alpha = 90;
			legendShadow.angle = 45;
			//Over-ride
			this.styleM.overrideStyle (this.objects.LEGEND, legendShadow, this.styleM.TYPE.SHADOW, null);
			delete legendShadow;
		}
		//-----------------------------------------------------------------//
		//Default Animation object for DataPlot (if required)
		//-----------------------------------------------------------------//
		if (this.params.defaultAnimation){
			//We need three animation objects.
			//1. Alpha for data plot
			var dataPlotAnim = new StyleObject ();
			dataPlotAnim.name = "_SdDataPlotAnimAlpha";
			dataPlotAnim.param = "_alpha";
			dataPlotAnim.easing = "none";
			dataPlotAnim.wait = 0.1;
			dataPlotAnim.start = 0;
			dataPlotAnim.duration = 1;
			//Over-ride
			this.styleM.overrideStyle (this.objects.DATAPLOT, dataPlotAnim, this.styleM.TYPE.ANIMATION, "_alpha");
			delete dataPlotAnim;
			//2. YScale for data plot
			var dataPlotAnimY = new StyleObject ();
			dataPlotAnimY.name = "_SdDataPlotAnimYScale";
			dataPlotAnimY.param = "_yscale";
			dataPlotAnimY.easing = "regular";
			dataPlotAnimY.wait = 0.1;
			dataPlotAnimY.start = 0;
			dataPlotAnimY.duration = 0.7;
			//Over-ride
			this.styleM.overrideStyle (this.objects.DATAPLOT, dataPlotAnimY, this.styleM.TYPE.ANIMATION, "_yscale");
			delete dataPlotAnimY;
			//3. Alpha effect for anchors
			var anchorsAnim = new StyleObject ();
			anchorsAnim.name = "_SdDataAnchorAnim";
			anchorsAnim.param = "_alpha";
			anchorsAnim.easing = "regular";
			anchorsAnim.wait = 0;
			anchorsAnim.start = 0;
			anchorsAnim.duration = 0.5;
			//Over-ride
			this.styleM.overrideStyle (this.objects.ANCHORS, anchorsAnim, this.styleM.TYPE.ANIMATION, "_alpha");
			delete anchorsAnim;
		}		
	}	
	/**
	 * cacheStyles method caches all the styles that will be used by real-time
	 * objects. This helps to avoid generating them at run time.
	*/
	private function cacheStyles(){
		// --------- CACHE ALL TEXT LABEL STYLES -----------//
		//vLine Labels
		this.styleCache.vLineLabels = this.styleM.getTextStyle (this.objects.VLINELABELS);
		//Trend values
		this.styleCache.trendValues = this.styleM.getTextStyle (this.objects.TRENDVALUES)
		//Div Line font
		this.styleCache.divLineValues = this.styleM.getTextStyle(this.objects.YAXISVALUES);
		//Real time value
		this.styleCache.realTimeValue = this.styleM.getTextStyle(this.objects.REALTIMEVALUE);
		//Data labels
		this.styleCache.dataLabels = this.styleM.getTextStyle(this.objects.DATALABELS);
		//Data values
		this.styleCache.dataValues = this.styleM.getTextStyle(this.objects.DATAVALUES);
		// ---------- CACHE ALL FILTERS NOW ----------------//
		//vLines & labels
		this.styleCache.vLineFilters = this.styleM.getFilterStyles(this.objects.VLINES);
		this.styleCache.vLineLabelFilters = this.styleM.getFilterStyles(this.objects.VLINELABELS);
		//Trend lines & values
		this.styleCache.trendLineFilters = this.styleM.getFilterStyles(this.objects.TRENDLINES);
		this.styleCache.trendValueFilters = this.styleM.getFilterStyles(this.objects.TRENDVALUES);
		//Div lines & values
		this.styleCache.divLineFilters = this.styleM.getFilterStyles(this.objects.DIVLINES);
		this.styleCache.divLineValueFilters = this.styleM.getFilterStyles(this.objects.YAXISVALUES);
		//H-grid
		this.styleCache.hGridFilters = this.styleM.getFilterStyles(this.objects.HGRID);
		//Real-time value filters
		this.styleCache.realTimeValueFilters = this.styleM.getFilterStyles(this.objects.REALTIMEVALUE);
		//Data label filters
		this.styleCache.dataLabelFilters = this.styleM.getFilterStyles(this.objects.DATALABELS);
		//Data value filters
		this.styleCache.dataValueFilters = this.styleM.getFilterStyles(this.objects.DATAVALUES);
		//Data plot
		this.styleCache.dataPlotFilters = this.styleM.getFilterStyles(this.objects.DATAPLOT);
		//Anchors
		this.styleCache.anchorFilters = this.styleM.getFilterStyles(this.objects.ANCHORS);
	}
	/**
	* allotDepths method allots the depths for various chart objects
	* to be rendered. We do this before hand, so that we can later just
	* go on rendering chart objects, without swapping.
	*/
	private function allotDepths():Void{
		//Background
		this.dm.reserveDepths ("BACKGROUND", 1);
		//Click URL Handler
		this.dm.reserveDepths ("CLICKURLHANDLER", 1);
		//Background SWF
		this.dm.reserveDepths ("BGSWF", 1);
		//Annotations below the chart
		this.dm.reserveDepths ("ANNOTATIONBELOW", 1);
		//Movie clip holder for Alert Manager
		this.dm.reserveDepths ("ALERTMANAGER", 1);
		//Canvas
		this.dm.reserveDepths ("CANVAS", 1);
		//If vertical grid is to be shown
		if (this.params.showAlternateVGridColor){
			this.dm.reserveDepths ("VGRID", Math.ceil ((this.params.numVDivLines + 1) / 2));
		}
		//If horizontal grid is to be shown
		this.dm.reserveDepths ("HGRID", 1);
		//Vertical Div Lines
		this.dm.reserveDepths ("VDIVLINES", this.params.numVDivLines);
		//Div Lines and their labels
		this.dm.reserveDepths ("DIVLINES", 1);
		this.dm.reserveDepths ("DIVVALUES", this.divLines.length );
		//Caption
		this.dm.reserveDepths ("CAPTION", 1);
		//Sub-caption
		this.dm.reserveDepths ("SUBCAPTION", 1);
		//X-Axis Name
		this.dm.reserveDepths ("XAXISNAME", 1);
		//Y-Axis Name
		this.dm.reserveDepths ("YAXISNAME", 1);
		//Trend lines below plot
		this.dm.reserveDepths ("TRENDLINESBELOW", this.numTrendLinesBelow);		
		//Data Labels
		this.dm.reserveDepths ("DATALABELS", this.params.numDisplaySets * this.numDS);
		//Line Chart
		this.dm.reserveDepths ("DATAPLOT", this.numDS);		
		//Zero plane and it's value
		this.dm.reserveDepths ("ZEROPLANE", 2);
		//Vertical div lines and their labels
		this.dm.reserveDepths ("VLINES", 1);
		this.dm.reserveDepths ("VLINELABELS", this.params.numDisplaySets+1);		
		//Canvas Border
		this.dm.reserveDepths ("CANVASBORDER", 1);
		//Anchors
		this.dm.reserveDepths ("ANCHORS", this.params.numDisplaySets * this.numDS);
		//Trend lines below plot (lines and their labels)
		this.dm.reserveDepths ("TRENDLINESABOVE", (this.numTrendLines - this.numTrendLinesBelow));
		//Trend - values
		this.dm.reserveDepths ("TRENDVALUES", this.numTrendLines);
		//Data Values
		this.dm.reserveDepths ("DATAVALUES", this.params.numDisplaySets * this.numDS);
		//Real-time value text box
		this.dm.reserveDepths ("REALTIMEVALUE", 1);		
		//Legend
		this.dm.reserveDepths ("LEGEND", 1);
		//Annotations above the chart
		this.dm.reserveDepths ("ANNOTATIONABOVE", 1);
	}
	/**
	 * feedEmptyData method feeds all the empty data for categories which
	 * have not been allotted data. By default there should be equal number of 
	 * <categories> and <set> element within each dataset. If in case, <set> 
	 * elements fall short, we need to append empty data at the end.
	*/
	private function feedEmptyData():Void{
		var i:Number, j:Number;
		//Feed empty data - 
		for (i = 1; i <= this.numDS; i ++){
			for (j = 1; j <= this.num; j ++){
				if (this.dataset [i].data [j] == undefined){
					this.dataset [i].data [j] = this.returnDataAsObject(NaN);
				}
			}
		}
	}
	/**
	* calculateXPoints method calculates the available x-axis points on the chart.
	*/
	private function calculateXPoints()	{
		//Loop variable
		var i : Number;
		//Calculate the width between two points on chart
		var interPointWidth : Number = (this.elements.canvas.w - (2 * this.params.canvasPadding)) / (this.params.numDisplaySets - 1);
		for (i = 1; i <= this.params.numDisplaySets; i++){
			//Now, if there is only 1 point on the chart, we center it. Else, we get even X.
			this.dataPosX[i] = (this.params.numDisplaySets == 1) ? (this.elements.canvas.x + this.elements.canvas.w / 2) : (this.elements.canvas.x + this.params.canvasPadding + (interPointWidth * (i - 1)));
		}
	}
	/**
	* calculatePoints method calculates the position for all points on the chart.
	*/
	private function calculatePoints()	{
		//Loop variable
		var i:Number;
		var j:Number;
		//Store the cumulative positive and negative sum for each data
		//Set the cumulative values
		for (i = 1; i <= this.num; i ++){
			var posSum : Number = 0;
			var negSum : Number = 0;
			for (j = 1; j <= this.numDS; j ++){
				//If value >=0, add to positive sum (cumulative).
				if (this.dataset [j].data [i].value >= 0){
					if (this.dataset [j].data [i].isDefined){
						posSum = posSum + this.dataset [j].data [i].value;
					}
					this.dataset [j].data [i].cumValue = posSum;
				} else {
					//Else add to negative cumulative sum.
					if (this.dataset [j].data [i].isDefined){
						negSum = negSum + this.dataset [j].data [i].value;
					}
					this.dataset [j].data [i].cumValue = negSum;
				}
			}
		}
		//Dataset 0 for easy plotting later on
		this.dataset[0] = new Object ();
		this.dataset[0].data = new Array ();
		//Store y-max and y-min positions for data 
		//Required for alignment of gradient and its matrix calculation.
		this.config.yMaxPos = 0;
		this.config.yMinPos = 0;
		//Base Plane position - Base plane is the y-plane from which area chart emanates.
		//If there's a 0 value in between yMin,yMax, base plane represents 0 value.
		//Else, it's yMin
		if (this.pAxis.getYMax() > 0 && this.pAxis.getYMin() < 0){
			//Negative number present - so set basePlanePos as 0 value
			this.config.basePlanePos = this.pAxis.getAxisPosition(0, false);
		} else if (this.pAxis.getYMax() <= 0 && this.pAxis.getYMin()< 0){
			//All negative numbers
			this.config.basePlanePos = this.pAxis.getAxisPosition (this.pAxis.getYMax(),false);
		} else {
			//No negative numbers - so set basePlanePos as yMin value
			this.config.basePlanePos = this.pAxis.getAxisPosition (this.pAxis.getYMin(),false);
		}
		
		//Now, store the positions of the area points
		for (i = 1; i <= this.numDS; i ++){
			for (j = 1; j <= this.num; j ++){
				//X-Position
				this.dataset [i].data [j].x = this.dataPosX[(this.params.numDisplaySets-this.num)+j];
				//Set the y position
				this.dataset [i].data [j].y = this.pAxis.getAxisPosition (this.dataset [i].data [j].cumValue, false);
				//Store max and min positions
				this.config.yMaxPos = (this.dataset [i].data [j].y > this.config.yMaxPos) ? this.dataset [i].data [j].y : this.config.yMaxPos;
				this.config.yMinPos = (this.dataset [i].data [j].y < this.config.yMinPos) ? this.dataset [i].data [j].y : this.config.yMinPos;
				//Store value textbox y position
				this.dataset [i].data [j].valTBY = this.dataset [i].data [j].y;
				//Set for dataset 0
				if (i == 1){
					this.dataset[0].data[j] = new Object ();
					this.dataset[0].data[j].isDefined = true;
					this.dataset[0].data[j].x = this.dataset [1].data[j].x;
					this.dataset[0].data[j].y = this.config.basePlanePos;
				}
			}
		}
	}
	// -------------------- Visual Rendering Methods ---------------------------//
	/**
	* drawAreaChart method draws the lines on the chart
	*/
	private function drawAreaChart():Void{
		/**
		* The movie clip structure for each area (dataset) would be :
		* |- Holder
		* |- |- Chart
		* We create child movie clip as we need to animate xscale
		* and y scale. So, we need to position Chart Movie clip at 0,0
		* inside holder movie clip and then readjust Holder movie clip's
		* X and Y Position as per chart's canvas.
		*/
		//Remove existing chart
		this.objM.removeGroupMC("DATAPLOT");
		
		var m : Number;
		var prev : Number;
		//Use reverse depth mechanism - to show best visibility
		var depth : Number = this.dm.getDepth ("DATAPLOT") + this.numDS - 1;
		for (m = 1; m <= this.numDS; m ++)
		{
			//Create holder movie clip
			var holderMC : MovieClip = this.cMC.createEmptyMovieClip ("ChartHolder_" + m, depth);
			//Register with object manager
			this.objM.register(holderMC,"PL_"+m,"DATAPLOT");
			//Create chart movie clip inside holder movie clip
			var chartMC : MovieClip = holderMC.createEmptyMovieClip ("Chart", 1);
			//Loop variables
			var i, j;
			//Variables to store the max and min Y positions
			var maxY : Number, minY : Number;
			//Find the index of the first defined data
			//Initialize with (this.num+1) so that if no defined data is found,
			//next loop automatically terminates
			var firstIndex : Number = this.num + 1;
			var lastIndex : Number = - 1;
			//Storage container for next plot index
			var nxt : Number;
			for (i = 1; i < this.num; i ++)
			{
				if (this.dataset [m].data [i].isDefined)
				{
					firstIndex = i;
					break;
				}
			}
			//Get index of last defined data
			for (i = this.num; i > 0; i --)
			{
				if (this.dataset [m].data [i].isDefined)
				{
					lastIndex = i;
					break;
				}
			}
			//Create matrix object for gradient fill
			var matrix : Object = {
				matrixType : "box", w : (this.dataset [m].data [lastIndex].x - this.dataset [m].data [firstIndex].x) , h : (this.config.yMaxPos - this.config.yMinPos) , x : this.elements.canvas.x, y : this.elements.canvas.y, r : MathExt.toRadians (this.params.plotFillAngle)
			};
			//Now, we draw the areas inside chart
			for (i = firstIndex; i < this.num; i ++)
			{
				//We continue only if this data index is defined
				if (this.dataset [m].data [i].isDefined)
				{
					//Get next Index
					nxt = i + 1;
					//Now, if next index is not defined, we can have two cases:
					//1. Draw gap between this data and next data.
					//2. Connect the next index which could be found as defined.
					//Case 1. If connectNullData is set to false and next data is not
					//defined. We simply continue to next value of the loop
					if (this.params.connectNullData == false && this.dataset [m].data [nxt].isDefined == false)
					{
						//Discontinuous plot. So ignore and move to next.
						continue;
					}
					//Now, if nxt data is undefined, we need to find the index of the post data
					//which is not undefined
					if (this.dataset [m].data [nxt].isDefined == false)
					{
						//Initiate nxt as -1, so that we can later break if no next defined data
						//could be found.
						nxt = - 1;
						for (j = i + 1; j <= this.num; j ++)
						{
							if (this.dataset [m].data [j].isDefined == true)
							{
								nxt = j;
								break;
							}
						}
						//If nxt is still -1, we break
						if (nxt == - 1)
						{
							break;
						}
					}
					//Set line style to empty - as the border is drawn later on.
					chartMC.lineStyle ();
					//Move to data position
					chartMC.moveTo (this.dataset [m].data [i].x, this.dataset [m].data [i].y);
					//If we've to fill as gradient
					if (this.params.plotGradientColor != "")
					{
						//Fill as gradient
						chartMC.beginGradientFill ("linear", [parseInt (this.dataset [m].data [i].color, 16) , parseInt (this.params.plotGradientColor, 16)] , [this.dataset [m].data [i].alpha, this.dataset [m].data [i].alpha] , [0, 255] , matrix);
					} else 
					{
						//Solid fill
						chartMC.beginFill (parseInt (this.dataset [m].data [i].color, 16) , this.dataset [m].data [i].alpha);
					}
					//Move to the next data
					chartMC.lineTo (this.dataset [m].data [nxt].x, this.dataset [m].data [nxt].y);
					//Get the index of previous dataset which is not null
					//This is used for empty stacked values in stacked areas which are
					//not on the top. We need to fill the empty space left by the bottom
					//stacked areas with the top ones.
					prev = m;
					while (1 == 1)
					{
						prev --;
						if (this.dataset [prev].data [nxt].isDefined == true && this.dataset [prev].data [i].isDefined == true)
						{
							break;
						}
					}
					chartMC.lineTo (this.dataset [prev].data [nxt].x, this.dataset [prev].data [nxt].y);
					//Draw the line back to previous data x, base plane
					chartMC.lineTo (this.dataset [prev].data [i].x, this.dataset [prev].data [i].y);
					//We draw the line back from current data to base plan
					//only if it's the first data or the previous data was null (& connectNull=false)
					chartMC.lineTo (this.dataset [m].data [i].x, this.dataset [m].data [i].y);
					//End fill
					chartMC.endFill ();
					//Now, tat the entire fill is drawn, we're concerned with the border.
					//If border is to be shown, we need to redraw over the fill surface
					//Otherwise dashed borders are not filling the surface
					if (this.dataset [m].showPlotBorder)
					{
						//Set line style
						chartMC.lineStyle (this.dataset [m].plotBorderThickness, parseInt (this.dataset [m].plotBorderColor, 16) , this.dataset [m].plotBorderAlpha);
						//Now, based on whether we've to draw a normal or dashed line, we draw it
						if (this.dataset [m].data [i].dashed)
						{
							//Dashed border.
							DrawingExt.dashTo (chartMC, this.dataset [m].data [i].x, this.dataset [m].data [i].y, this.dataset [m].data [nxt].x, this.dataset [m].data [nxt].y, this.params.plotBorderDashLen, this.params.plotBorderDashGap);
							if (this.dataset [m].showPlotBorder && ((nxt == lastIndex) || (this.params.connectNullData == false && this.dataset [m].data [i + 2].isDefined == false)))
							{
								//Draw the line from next data to previous data
								DrawingExt.dashTo (chartMC, this.dataset [m].data [nxt].x, this.dataset [m].data [nxt].y, this.dataset [prev].data [nxt].x, this.dataset [prev].data [nxt].y, this.params.plotBorderDashLen, this.params.plotBorderDashGap);
							}
							//Draw the line back to previous data x, base plane
							DrawingExt.dashTo (chartMC, this.dataset [prev].data [nxt].x, this.dataset [prev].data [nxt].y, this.dataset [prev].data [i].x, this.dataset [prev].data [i].y, this.params.plotBorderDashLen, this.params.plotBorderDashGap);
							if (this.dataset [m].showPlotBorder && (i == firstIndex || (this.params.connectNullData == false && this.dataset [m].data [i - 1].isDefined == false)))
							{
								DrawingExt.dashTo (chartMC, this.dataset [prev].data [i].x, this.dataset [prev].data [i].y, this.dataset [m].data [i].x, this.dataset [m].data [i].y, this.params.plotBorderDashLen, this.params.plotBorderDashGap);
							}
						}else
						{
							//Move to data position
							chartMC.moveTo (this.dataset [m].data [i].x, this.dataset [m].data [i].y);
							//Draw point to next line
							chartMC.lineTo (this.dataset [m].data [nxt].x, this.dataset [m].data [nxt].y);
							if (this.dataset [m].showPlotBorder && ((nxt == lastIndex) || (this.params.connectNullData == false && this.dataset [m].data [i + 2].isDefined == false)))
							{
								//Draw the line from next data to previous data
								chartMC.moveTo (this.dataset [m].data [nxt].x, this.dataset [m].data [nxt].y);
								chartMC.lineTo (this.dataset [prev].data [nxt].x, this.dataset [prev].data [nxt].y);
							}
							//Draw the line back to previous data x, base plane
							chartMC.moveTo (this.dataset [prev].data [nxt].x, this.dataset [prev].data [nxt].y);
							chartMC.lineTo (this.dataset [prev].data [i].x, this.dataset [prev].data [i].y);
							if (this.dataset [m].showPlotBorder && (i == firstIndex || (this.params.connectNullData == false && this.dataset [m].data [i - 1].isDefined == false)))
							{
								chartMC.lineTo (this.dataset [m].data [i].x, this.dataset [m].data [i].y);
							}
						}
					}
					//Get maxY and minY
					maxY = (maxY == undefined || (this.dataset [m].data [i].y > maxY)) ? this.dataset [m].data [i].y : maxY;
					minY = (minY == undefined || (this.dataset [m].data [i].y < minY)) ? this.dataset [m].data [i].y : minY;
					//Update loop index (required when connectNullData is true and there is
					//a sequence of empty sets.) Since we've already found the "next" defined
					//data, we update loop to that to optimize.
					i = nxt - 1;
				}
			}
			//Now, we need to adjust the chart movie clip to 0,0 position as center
			chartMC._x = - (this.elements.canvas.w / 2) - this.elements.canvas.x;
			chartMC._y = - (maxY) + (maxY - this.config.basePlanePos);
			//Set the position of holder movie clip now
			holderMC._x = (this.elements.canvas.w / 2) + this.elements.canvas.x;
			holderMC._y = (maxY) - (maxY - this.config.basePlanePos);
			//Apply filter
			holderMC.filters = this.styleCache.dataPlotFilters;
			//Apply animation
			if (this.params.animation){
				this.styleM.applyAnimation (holderMC, this.objects.DATAPLOT, this.macro, holderMC._x, holderMC._y, 100, 100, 100, null);
			}
			//Decrease depth
			depth --;
		}
		//Clear interval
		if (!this.params.chartRendered){
			clearInterval (this.config.intervals.plot);
		}
	}
	/**
	* drawAnchors method draws the anchors on the chart
	*/
	private function drawAnchors():Void {
		//Remove existing anchors
		var i : Number;
		//Clear the group movie clip
		this.objM.removeGroupMC("ANCHORS");					

		//Variables
		var anchorMC : MovieClip;
		var depth : Number = this.dm.getDepth ("ANCHORS");
		var j : Number;
		//Create function storage containers for Delegate functions
		var fnRollOver : Function, fnClick : Function;
		//Iterate through all columns
		for (i = 1; i <= this.numDS; i ++){
			if (this.dataset [i].drawAnchors){
				for (j = 1; j <= this.num; j ++){
					//If defined
					if (this.dataset [i].data [j].isDefined){
						//Create an empty movie clip for this anchor
						anchorMC = this.cMC.createEmptyMovieClip ("Anchor_" + i + "_" + j, depth);
						//Register anchor
						this.objM.register(anchorMC,"AN"+i+"_"+j, "ANCHORS");
						//Set the line style and fill
						anchorMC.lineStyle (this.dataset [i].data [j].anchorBorderThickness, parseInt (this.dataset [i].data [j].anchorBorderColor, 16) , 100);
						anchorMC.beginFill (parseInt (this.dataset [i].data [j].anchorBgColor, 16) , this.dataset [i].data [j].anchorBgAlpha);
						//Draw the polygon
						DrawingExt.drawPoly (anchorMC, 0, 0, this.dataset [i].data [j].anchorSides, this.dataset [i].data [j].anchorRadius, 90);
						//Set the x and y Position
						anchorMC._x = this.dataset [i].data [j].x;
						anchorMC._y = this.dataset [i].data [j].y;
						//Set the alpha of entire anchor
						anchorMC._alpha = this.dataset [i].data [j].anchorAlpha;
						//Apply animation
						if (this.params.animation){
							this.styleM.applyAnimation (anchorMC, this.objects.ANCHORS, this.macro, anchorMC._x, anchorMC._y, this.dataset [i].data [j].anchorAlpha, 100, 100, null);
						}
						//Apply filters
						anchorMC.filters = this.styleCache.anchorFilters;
						//Event handlers for tool tip
						if (this.params.showToolTip){
							//Create Delegate for roll over function columnOnRollOver
							fnRollOver = Delegate.create (this, dataOnRollOver);
							//Set the tool text directly
							fnRollOver.text = this.dataset[i].data[j].toolText;
							//Assing the delegates to movie clip handler
							anchorMC.onRollOver = fnRollOver;
							//Set roll out and mouse move too.
							anchorMC.onRollOut = anchorMC.onReleaseOutside = Delegate.create (this, dataOnRollOut);
						}
						//Click handler for links - only if link for this anchor has been defined and click URL
						//has not been defined.
						if (this.dataset [i].data [j].link != "" && this.dataset [i].data [j].link != undefined && this.params.clickURL == ""){
							//Create delegate function
							fnClick = Delegate.create (this, dataOnClick);
							//Set link itself
							fnClick.link = this.dataset[i].data[j].link;
							//Assign
							anchorMC.onRelease = fnClick;
						} else {
							//Do not use hand cursor
							anchorMC.useHandCursor = (this.params.clickURL == "") ? false : true;
						}
						//Increase depth
						depth ++;
					}
				}
			}
		}
		//Clear interval
		if (!this.params.chartRendered){
			clearInterval (this.config.intervals.anchors);
		}
	}
	/**
	* drawValues method draws the values on the chart.
	*/
	private function drawValues():Void {
		//Remove existing values
		var i : Number;
		for (i = 1; i <= this.numDS; i ++){
			//Clear the group movie clip
			this.objM.removeGroupTF("DATAVALUES_" + i);		
		}
		//Get value text style
		var valueStyleObj : Object = this.styleCache.dataValues;
		//Individual properties
		var isBold : Boolean = valueStyleObj.bold;
		var isItalic : Boolean = valueStyleObj.italic;
		var font : String = valueStyleObj.font;
		var angle : Number = 0;
		//Container object
		var valueObj : MovieClip;
		//Depth
		var depth : Number = this.dm.getDepth ("DATAVALUES");
		//Loop var
		var j : Number;
		var yPos : Number;
		var align : String, vAlign : String;
		////Iterate through all points
		for (i = 1; i <= this.numDS; i ++){
			for (j = 1; j <= this.num; j ++){
				//If defined and value is to be shown
				if (this.dataset [i].data [j].isDefined && this.dataset [i].data [j].showValue)	{
					//Get the y position based on next data's position
					//If this data value is positive, we show textbox above
					if (this.dataset [i].data [j].value >= 0){
						//Above
						vAlign = "top";
						yPos = this.dataset [i].data [j].valTBY - this.params.valuePadding;
					} else {
						//Below
						vAlign = "bottom";
						yPos = this.dataset [i].data [j].valTBY + this.params.valuePadding;
					}
					//Align position
					align = "center";
					//Convey alignment to rendering object
					valueStyleObj.align = align;
					valueStyleObj.vAlign = vAlign;
					//Now, if the labels are to be rotated
					if (this.params.rotateValues){
						valueStyleObj.bold = isBold;
						valueStyleObj.italic = isItalic;
						valueStyleObj.font = font;
						angle = 270;
					} else {
						//Normal horizontal label - Store original properties
						valueStyleObj.bold = isBold;
						valueStyleObj.italic = isItalic;
						valueStyleObj.font = font;
						angle = 0;
					}
					valueObj = createText (false, this.dataset [i].data [j].displayValue, this.cMC, depth, this.dataset [i].data [j].x, yPos, angle, valueStyleObj, false, 0, 0);
					//Register
					this.objM.register(valueObj.tf,"VL"+i+"_"+j, "DATAVALUES_"+i);
					//Check for value collision only if required
					if (this.params.valueInCanvasCheck){
						//Next, we adjust those labels are falling out of top canvas area
						if (((yPos - valueObj.height) <= this.elements.canvas.y)){
							//Data value is colliding with the upper side of canvas. So we need to place it within
							//the area
							if (!this.params.rotateValues){
								valueObj.tf._y = yPos + (2 * this.params.valuePadding);
							} else {
								valueObj.tf._y = yPos + (2 * this.params.valuePadding) + valueObj.height;
							}
						}
						//Now, we adjust those labels are falling out of bottom canvas area
						if (((yPos + valueObj.height) >= this.elements.canvas.toY)) {
							//Data value is colliding with the lower side of canvas. So we need to place it within
							//the area
							if (!this.params.rotateValues) {
								valueObj.tf._y = yPos - (2 * this.params.valuePadding) - valueObj.height;
							} else {
								valueObj.tf._y = yPos - (2 * this.params.valuePadding);
							}
						}
					}
					//Apply filter
					valueObj.tf.filters = this.styleCache.dataValueFilters;
					//Apply animation
					if (this.params.animation){
						this.styleM.applyAnimation (valueObj.tf, this.objects.DATAVALUES, this.macro, valueObj.tf._x, valueObj.tf._y, 100, null, null, null);
					}
					//Increase depth
					depth ++;
				}
			}
		}
		//Clear interval
		if (!this.params.chartRendered){
			clearInterval (this.config.intervals.dataValues);
		}
	}
	/**
	* drawVDivLines method draws the vertical div lines on the chart
	*/
	private function drawVDivLines():Void{
		var yPos : Number;
		var depth : Number = this.dm.getDepth ("VDIVLINES");
		//Movie clip container
		var vDivLineMC : MovieClip;
		//Get the horizontal spacing between two vertical div lines
		//We do NOT accomodate the canvas padding here.
		var horSpace : Number = this.elements.canvas.w /(this.params.numVDivLines + 1);
		//Get x start position
		var xPos : Number = this.elements.canvas.x;
		var i : Number;
		for (i = 1; i <= this.params.numVDivLines; i ++){
			//Get x position
			xPos = xPos + horSpace;
			//Create the movie clip
			vDivLineMC = this.cMC.createEmptyMovieClip ("vDivLine_" + i, depth);
			//Draw the line
			vDivLineMC.lineStyle (this.params.vDivLineThickness, parseInt (this.params.vDivLineColor, 16) , this.params.vDivLineAlpha);
			if (this.params.vDivLineIsDashed){
				//Dashed line
				DrawingExt.dashTo (vDivLineMC, 0, - this.elements.canvas.h / 2, 0, this.elements.canvas.h / 2, this.params.vDivLineDashLen, this.params.vDivLineDashGap);
			} else {
				//Draw the line keeping 0,0 as registration point
				vDivLineMC.moveTo (0, - this.elements.canvas.h / 2);
				//Normal line
				vDivLineMC.lineTo (0, this.elements.canvas.h / 2);
			}
			//Re-position the div line to required place
			vDivLineMC._x = xPos;
			vDivLineMC._y = this.elements.canvas.y + (this.elements.canvas.h / 2);
			//Apply animation and filter effects to vertical div line
			//Apply animation
			if (this.params.animation){
				this.styleM.applyAnimation (vDivLineMC, this.objects.VDIVLINES, this.macro, vDivLineMC._x, null, 100, null, 100, null);
			}
			//Apply filters
			this.styleM.applyFilters (vDivLineMC, this.objects.VDIVLINES);
			//Increment depth
			depth ++;
		}
		//Clear interval
		clearInterval (this.config.intervals.vDivLines);
	}
	/**
	* drawHGrid method draws the horizontal grid background color
	*/
	private function drawVGrid():Void{
		//If we're required to draw vertical grid color
		//and numVDivLines > 1
		if (this.params.showAlternateVGridColor && this.params.numVDivLines > 1){
			//Movie clip container
			var gridMC : MovieClip;
			//Loop variable
			var i : Number;
			//Get depth
			var depth : Number = this.dm.getDepth ("VGRID");
			//X Position
			var xPos : Number, xPosEnd : Number;
			var width : Number;
			//Get the horizontal spacing between two vertical div lines
			//We do NOT accomodate canvas padding here.
			var horSpace : Number = this.elements.canvas.w/(this.params.numVDivLines + 1);
			for (i = 1; i <= this.params.numVDivLines + 1; i = i + 2){
				//Get x Position
				xPos = this.elements.canvas.x + (i - 1) * horSpace;
				//Get x end position
				xPosEnd = xPos + horSpace;
				//Get the width of the grid.
				width = xPosEnd - xPos;
				//Create the movie clip
				gridMC = this.cMC.createEmptyMovieClip ("VGridBg_" + i, depth);
				//Set line style to null
				gridMC.lineStyle ();
				//Set fill color
				gridMC.moveTo ( - (width / 2) , - (this.elements.canvas.h / 2));
				gridMC.beginFill (parseInt (this.params.alternateVGridColor, 16) , this.params.alternateVGridAlpha);
				//Draw rectangle
				gridMC.lineTo (width / 2, - (this.elements.canvas.h / 2));
				gridMC.lineTo (width / 2, this.elements.canvas.h / 2);
				gridMC.lineTo ( - (width / 2) , this.elements.canvas.h / 2);
				gridMC.lineTo ( - (width / 2) , - (this.elements.canvas.h / 2));
				//End Fill
				gridMC.endFill ();
				//Place it in right location
				gridMC._x = xPosEnd - (width / 2);
				gridMC._y = this.elements.canvas.y + this.elements.canvas.h / 2;
				//Apply animation
				if (this.params.animation){
					this.styleM.applyAnimation (gridMC, this.objects.VGRID, this.macro, gridMC._x, null,100, 100, 100, null);
				}
				//Apply filters
				this.styleM.applyFilters (gridMC, this.objects.VGRID);
				//Increase depth
				depth ++;
			}
		}
		//Clear interval
		clearInterval (this.config.intervals.vGrid);
	}
	/**
	* drawLegend method renders the legend
	*/
	private function drawLegend():Void{
		if (this.params.showLegend){
			this.lgnd.render ();
			//Apply filter
			this.styleM.applyFilters (lgndMC, this.objects.LEGEND);
			//Apply animation
			if (this.params.animation){
				this.styleM.applyAnimation (lgndMC, this.objects.LEGEND, this.macro, null, null, 100, null, null, null);
			}			
		}
		//Clear interval
		clearInterval (this.config.intervals.legend);
	}	
	// ------------ REAL TIME UPDATE/REFRESH HANDLERS ----------//	
	/**
	 * parseDataFromLV method is called when the server has responded with data 
	 * feed and the chart has picked it up properly. Here, we parse the same and
	 * store it in our data structures.
	*/
	private function parseDataFromLV():Void{
		//Update flag that we're done with loading - so that next loadvars can stream
		//in the background, meanwhile.
		this.inLoadingProcess = false;
		//Loop variables
		var i:Number, j:Number;
		//Get case insensitive representation of all data received in Loadvars
		var dt:Array = Utils.getParamsArray(this.lv);
		//Send the data to Message Handler (if required)
		if (this.params.useMessageLog){
			this.msgLgr.feedQS(this.lv);
		}		
		//Now, if we've been provided with a value, only then do we proceed		
		//This allows the user to skip chart update by not defining
		//&value in the real time feed. However, if he wants to push empty data, he can
		//do just by just specifying &value=&labels= and so on.
		if (dt["value"]!=undefined){
			//Variables to be used locally
			var numIncrements:Number = 0;
			// -----  Extract data from Loadvars and store in local vars ----- //
			//Whether to stop update
			var _stopUpdate:Boolean = toBoolean(getFN(dt["stopupdate"],0));
			//If we've to stop update, do so,
			if (_stopUpdate){
				this.stopUpdate();
				//Clear up existing allocations
				delete dt;
				//Exit
				return;
			}
			//Whether to clear existing cache
			var _clear:Boolean = toBoolean(getFN(dt["clear"],0));
			//If we've to clear the chart
			if (_clear){
				this.clearChart();
				//Clear up existing allocations
				delete dt;
				//Exit - we ignore any data provided in this feed.
				//If you want to plot data provided in this feed, after clearing the chart,
				//just uncomment the line below.
				return;
			}
			//New labels to be added.
			var _labels:String = getFV(dt["label"], dt["name"], "");
			//Forced value whether to show label
			var _showLabels:String = getFV(dt["showlabel"], dt["showname"], "");
			//Actual Data string (values)
			var _value:String = getFV(dt["value"],"");
			//Links for each dta
			var _link:String = getFV(dt["link"],"");
			//Color for each data
			var _color:String = getFV(dt["color"],"");
			//Tool text for each data
			var _toolText:String = getFV(dt["tooltext"], dt["hovertext"], "");
			//vLine
			var _vLine:String = getFV(dt["vline"],"");
			//Vline Label
			var _vLineLabel:String = getFV(dt["vlinelabel"],"");
			//vLine Color
			var _vLineColor:String = getFV(dt["vlinecolor"],"");
			//vLine Thickness
			var _vLineThickness:String = getFV(dt["vlinethickness"],"");
			//vLine Dashed
			var _vLineDashed:String = getFV(dt["vlinedashed"],"");
			//Update dataStamp
			this.params.dataStamp = getFV(dt["datastamp"],"");
			// --------------- Parse into local containers ------------------- //		
			var labels:Array = _labels.split(",");
			var values:Array = this.parseMultipleData(_value);
			var showLabels:Array = _showLabels.split(",");		
			var links:Array = this.parseMultipleData(_link);
			var colors:Array = this.parseMultipleData(_color);
			var toolText:Array = this.parseMultipleData(_toolText);
			var vLine:Array = _vLine.split(",");
			var vLineLabel:Array = _vLineLabel.split(",");
			var vLineColor:Array = _vLineColor.split(",");
			var vLineThickness:Array = _vLineThickness.split(",");
			var vLineDashed:Array = _vLineDashed.split(",");
			// --------------------------------------------------------------- //
			//Find out how many new data sequence values have been passed in this
			//update. We need to iterate through values array and check the length of
			//each array.
			//numIncrements can have a minimum value of 1, even if the user has given &value=
			//In that case, we assume empty data value.
			//We need to:
			//- Parse each value and store the numeric form.
			for (i=0; i<values.length; i++){
				numIncrements = Math.max(numIncrements, values[i].length);
				//Parse each number and store
				for (j=0; j<values[i].length; j++){
					try{
						var setValue:Number = this.nf.parseValue(values[i][j]);
					} catch (e:Error){
						//If the value is not a number, log a data
						this.log("Invalid data","Non-numeric data " + values[i][j] + " received in data stream.", Logger.LEVEL.ERROR);
						//Set as NaN - so that we can show it as empty data.
						setValue = Number("");
					}finally{
						//Store the updated value in array.
						values[i][j] = setValue;
					}
				}
			}			
			// --------- Store the data in our data structures now ---------//
			//Local variables to help in extracing data
			var catLabel:String, catShowLabel:Number;
			var setValue:Number, setLink:String, setColor:String, setToolText:String;
			var __vLineIndex:Number, __vLineLabel:String, __vLineColor:String, __vLineThickness:Number, __vLineDashed:Boolean;
			//Based on number of increments, we need to shift each vLine's index.
			for (i=1; i<=this.numVLines; i++) {
				this.vLines[i].index -= numIncrements;
			}
			//Based on how many data updates we've, we need to create positions/shift positions
			for (i=1; i<=numIncrements; i++) {
				//Shift data positions if necessary
				if (this.num == this.params.numDisplaySets) {
					//Shift the category arrays
					this.categories.shift();
					//Shift all the data arrays by 1
					for (j=1; j<=this.numDS; j++) {
						this.dataset[j].data.shift();
					}
				} else {
					//Increase this.num
					this.num++;
				}
				//Add the categories
				catLabel = getFV(labels[i-1], "");				
				catShowLabel = toBoolean(getFN(showLabels[i-1] , this.params.showLabels));
				//Store it in data container.
				this.categories[this.num] = this.returnDataAsCat(catLabel, catShowLabel, catLabel);
				//Now, feed the data in datasets.
				for (j=1; j<=this.numDS; j++){
					//Get the value. If it's undefined, set NaN, else actual
					setValue = (values[j-1][i-1]==undefined)?(Number("")):(values[j-1][i-1]);
					setLink = getFV(links[j-1][i-1],"");
					setColor = getFV(colors[j-1][i-1], this.dataset[j].color);
					//If the number is NaN, we save some cycles by alloting a blank space
					//as tool text, as it's not going to be shown for a undefined data.
					setToolText = isNaN(setValue)?" ":toolText[j-1][i-1];					
					//Store the set object
					this.dataset[j].data[this.num] = this.returnDataAsObject(setValue, setColor, this.dataset[j].alpha, setToolText, setLink, this.dataset[j].showValues, this.dataset[j].dashed, this.dataset[j].anchorSides, this.dataset[j].anchorRadius, this.dataset[j].anchorBorderColor, this.dataset[j].anchorBorderThickness, this.dataset[j].anchorBgColor, this.dataset[j].anchorAlpha, this.dataset[j].anchorBgAlpha);
					//Validate tool text here itself, so that when there's a lag between refresh interval
					//and updateInterval, the toolText for each data shows the right information.
					//If the tool tip text is not specified in the feed, we assume one.
					if (this.dataset[j].data[this.num].toolText == undefined || this.dataset[j].data[this.num].toolText == ""){
						//If labels have been defined
						setToolText = (this.params.seriesNameInToolTip && this.dataset[j].seriesName != "") ? (this.dataset [j].seriesName + this.params.toolTipSepChar) : "";
						setToolText = setToolText + ((this.categories[this.num].toolText != "") ? (this.categories[this.num].toolText + this.params.toolTipSepChar) : "");
						setToolText = setToolText + this.dataset[j].data[this.num].displayValue;
						this.dataset[j].data[this.num].toolText = setToolText;
					}
					//Now, feed it to alert manager (if required)
					if (this.useAlerts && this.dataset[j].checkForAlerts){
						this.alertM.check(setValue);
					}
				}
				
				//If this vLine has to be added.
				if (Number(vLine[i-1]) == 1){
					//Add at the required location.
					__vLineIndex = this.params.numDisplaySets - (numIncrements - i + 1);
					__vLineLabel = getFV(vLineLabel[i-1],"");
					__vLineColor = formatColor(getFV(vLineColor[i-1],"333333"));
					__vLineThickness = getFN(vLineThickness[i-1],1);					
					__vLineDashed = toBoolean(getFN(vLineDashed[i-1],0));
					//Add it
					this.numVLines++;
					this.vLines[this.numVLines] = this.returnDataAsVLineObj(__vLineIndex, __vLineLabel, __vLineColor, __vLineThickness, 100, __vLineDashed, 5, 2);
				}				
			}
			//We do not change axis limits here (in each update), as it would be more optimized to
			//change that only when we need to re-calculate the points and render the chart.
			//Update flag that the chart data has changed
			this.chartDataChanged = true;
			//Delete all values from lv - so that it doesn't cache the same from previous call. 
			this.deleteLoadVarsCache();
			//Free memory
			delete labels;
			delete showLabels;
			delete values;
			delete links;
			delete colors;
			delete toolText;
			delete vLine;
			delete vLineColor;
			delete vLineThickness;
			delete vLineDashed;
		}else{
			//If the control comes here, it means that the chart has not been
			//provided with a real-time update containing value. So, log it
			this.log("No data received","The chart couldn't find any data values in the real-time feed.",Logger.LEVEL.INFO);
		}
	}
	/**
	 * redrawChart method is called at each refreshInterval and it re-draws
	 * the entire chart to reflect the current data view state.
	*/
	private function redrawChart():Void{
		//This method re-draws the chart.
		//We update chart only if a fetchData has been invoked before this
		//call, and as such if data has changed
		if (this.chartDataChanged){
			//First thing - hide any existing tTip
			this.tTip.hide();
			//Re-set status flags
			this.storeStatusFlag();
			//We need to calculate new axis limits here. 
			this.pAxis.calculateLimits(this.getMaxDataValue(),this.getMinDataValue());
			//Now, if after updating, the axis has changed, we need to take various action
			if (this.pAxis.hasAxisChanged()){				
				//Re-calculate div lines				
				this.pAxis.calculateDivLines(true);
				//Store copy of divLines in local array
				this.divLines = this.pAxis.getDivLines();		
				//Re-render them
				this.drawDivLines();
				//Render HGrid again
				this.drawHGrid();
				//Render trend lines again - after validation
				//Validate trend lines
				this.validateTrendLines();
				//Calculate trend line positions
				this.calcTrendLinePos();			
				//Draw trend lines
				this.drawTrendLines();
			}
			//Axis related update has complete. So now, do the rest of calculations first.
			//Select which labels we've to show/hide
			this.selectLabelsToShow();
			//Calculate Points
			this.calculatePoints();
			//Calculate vLine Positions
			this.calcVLinesPos();
			//Do the drawing part
			this.drawVLines();
			this.drawLabels();
			this.drawAreaChart();
			this.drawValues();
			this.drawAnchors();
			//Update the real-time values
			this.drawRealTimeValue();			
			//Restore flag that chart has changed.
			this.chartDataChanged = false;
			//Convey event to JavaScript
			if (ExternalInterface.available && this.registerWithJS==true){
				ExternalInterface.call("FC_ChartUpdated", this.DOMId);
			}
		}
	}
	/**
	 * clearChart method clears the existing cache and it's related visuals.
 	 * Make this function public, so that if the real time chart is loaded inside other 
	 * Flash movies too, it can be cleared using this API.
	*/
	public function clearChart():Void{
		//Log the message
		this.log("Clearing Chart","Clearing chart cache, data & visuals.",Logger.LEVEL.INFO);
		//Re-set all data containers.
		var i:Number;
		//Delete the cache of Loadvars
		this.deleteLoadVarsCache();	
		//Remove existing categories
		this.categories = new Array();		
		//Remove all data from arrays
		for (i=1; i<=this.numDS; i++){
			this.dataset[i].data = new Array();
		}
		//Set count to 0
		this.num = 0;
		//Remove existing vLines too
		this.vLines = new Array();
		this.numVLines = 0;
		//Re-set flags
		this.inLoadingProcess = false;
		this.chartDataChanged = true;
		//Re-draw the chart
		this.redrawChart();
	}	
	/**
	* reInit method re-initializes the chart. This method is basically called
	* when the user changes chart data through JavaScript. In that case, we need
	* to re-initialize the chart, set new XML data and again render.
	*/
	public function reInit():Void {
		//Re-set data position X container array
		this.dataPosX = new Array();
		//Re-set legend
		this.lgnd.reset();
		//Invoke super class's reInit
		super.reInit();		
	}
	/**
	* remove method removes the chart by clearing the chart movie clip
	* and removing any listeners.
	*/
	public function remove():Void {
		this.lgnd.destroy();
		lgndMC.removeMovieClip();
		//Invoke super function
		super.remove();		
	}
}
