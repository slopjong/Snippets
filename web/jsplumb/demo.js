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
		source: "window-2",
		target: "window-3",
		paintStyle:{
			lineWidth:1,
			strokeStyle: w23Stroke,
			outlineColor: "#666",
			outlineWidth: 1
		},
		detachable: false,
		hoverPaintStyle: hoverPaintStyle,
		anchors:[ [ 0.3 , 1, 0, 1 ], "Top" ],
		endpoint:"Rectangle",
		endpointStyles:[
			{ gradient : { stops:[[0, w23Stroke], [1, "#558822"]] }},
			{ gradient : {stops:[[0, w23Stroke], [1, "#882255"]] }}
		]
	});

    var connection3 = instance.connect({
        source: "window-5",
        target: "window-2",
        paintStyle:{
            lineWidth:1,
            strokeStyle: w23Stroke,
            outlineColor: "#666",
            outlineWidth: 1
        },
        detachable: false,
        hoverPaintStyle: hoverPaintStyle,
        anchors:[ [ 0.3 , 1, 0, 1 ], "Top" ],
        endpoint:"Rectangle",
        endpointStyles:[
            { gradient : { stops:[[0, w23Stroke], [1, "#558822"]] }},
            { gradient : {stops:[[0, w23Stroke], [1, "#882255"]] }}
        ]
    });

    var connection3 = instance.connect({
        source: "window-4",
        target: "window-5",
        paintStyle:{
            lineWidth:1,
            strokeStyle: w23Stroke,
            outlineColor: "#666",
            outlineWidth: 1
        },
        detachable: false,
        hoverPaintStyle: hoverPaintStyle,
        anchors:[ [ 0.3 , 1, 0, 1 ], "Top" ],
        endpoint:"Rectangle",
        endpointStyles:[
            { gradient : { stops:[[0, w23Stroke], [1, "#558822"]] }},
            { gradient : {stops:[[0, w23Stroke], [1, "#882255"]] }}
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
			// console.log("DRAG")
		}
	});

	jsPlumb.fire("jsPlumbDemoLoaded", instance);
});


