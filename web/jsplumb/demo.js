jsPlumb.ready(function() {			
		
	var instance = jsPlumb.getInstance({
		DragOptions : { cursor: "pointer", zIndex:2000 },
		HoverClass:"connector-hover"
	});

	var connectorStrokeColor = "rgba(50, 50, 200, 1)";
    var connectorHighlightStrokeColor = "rgba(180, 180, 200, 1)";

    // hover paint style is merged on normal style, so you
    // don't necessarily need to specify a lineWidth
    var hoverPaintStyle = { strokeStyle:"#7ec3d9" };

    var w23Stroke = "rgb(189,11,11)"; 
    var connection3 = instance.connect({
		source:"window2", 
		target:"window3", 
		paintStyle:{ 
			lineWidth:8,
			strokeStyle:w23Stroke,
			outlineColor:"#666",
			outlineWidth:1 
		},
		detachable:false,
		hoverPaintStyle:hoverPaintStyle, 
		anchors:[ [ 0.3 , 1, 0, 1 ], "TopCenter" ], 
		endpoint:"Rectangle", 
		endpointStyles:[
			{ gradient : { stops:[[0, w23Stroke], [1, "#558822"]] }},
			{ gradient : {stops:[[0, w23Stroke], [1, "#882255"]] }}
		]	
	});					
		
	var connection2 = instance.connect({
		source:'window3', target:'window4', 
		paintStyle:{ 
		   lineWidth:10,
		   strokeStyle:connectorStrokeColor,
		   outlineColor:"#666",
		   outlineWidth:1
		},
		hoverPaintStyle:hoverPaintStyle, 
		anchor:"AutoDefault",
		detachable:false,
		endpointStyle:{ 
			   gradient : { 
				   stops:[[0, connectorStrokeColor], [1, connectorHighlightStrokeColor]],
				   offset:17.5, 
				   innerRadius:15 
			   }, 
			   radius:35
		},				        					        			
		label : function(connection) { 
			var d = new Date();
			var fmt = function(n, m) { m = m || 10;  return (n < m ? new Array(("" + m).length - (""+n).length + 1).join("0") : "") + n; }; 
			return (fmt(d.getHours()) + ":" + fmt(d.getMinutes()) + ":" + fmt(d.getSeconds())+ "." + fmt(d.getMilliseconds(), 100)); 
		},
		labelStyle:{
			cssClass:"component label"
		}
   });

    var connection5 = instance.connect({
		source:"window4", 
		target:"window5", 
		anchors:["BottomRight", "TopLeft"], 
		paintStyle:{ 
			lineWidth:7,
			strokeStyle:"rgb(131,8,135)",
//										outlineColor:"#666",
//						 				outlineWidth:1,
			dashstyle:"4 2",
			joinstyle:"miter"
		},
		hoverPaintStyle:hoverPaintStyle, 
		endpoint:["Image", {url:"endpointTest1.png"}], 
		connector:"Straight", 
		endpointsOnTop:true,
		overlays:[ ["Label", {
						cssClass:"component label",		    			        				 
						label : "4 - 5",
						location:0.3
					}],
					"Arrow"
					
		]
	});

	// jsplumb event handlers

	// double click on any connection
	instance.bind("dblclick", function(connection, originalEvent) { alert("double click on connection from " + connection.sourceId + " to " + connection.targetId); });
	// single click on any endpoint
	instance.bind("endpointClick", function(endpoint, originalEvent) { alert("click on endpoint on element " + endpoint.elementId); });
	// context menu (right click) on any component.
	instance.bind("contextmenu", function(component, originalEvent) {
        alert("context menu on component " + component.id);
        originalEvent.preventDefault();
        return false;
    });
	
	// make all .window divs draggable. note that here i am just using a convenience method - getSelector -
	// that enables me to reuse this code across all three libraries. In your own usage of jsPlumb you can use
	// your library's selector method - "$" for jQuery, "$$" for MooTools, "Y.all" for YUI3.
	//instance.draggable(jsPlumb.getSelector(".window"), { containment:".demo"});    
	instance.draggable(jsPlumb.getSelector(".window"), {
		drag:function() {
			//console.log("DRAG")
		}
	});    

	jsPlumb.fire("jsPlumbDemoLoaded", instance);
});	


