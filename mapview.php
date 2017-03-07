<!DOCTYPE html>
<html lang="es">
<head>
<meta charset=utf-8>
<title>¡Seguimiento en directo!</title>

<script src="http://openlayers.org/api/OpenLayers.js"></script>
<script type="text/javascript" src="prototype.js"></script>
<script type="text/javascript" src="common.js"></script>
<script>
	var map, zoom=15, team1Marker, team1Popup, team2Marker, team2Popup, team3Marker, team3Popup,
		team4Marker, team4Popup, team5Marker, team5Popup, team6Marker, team6Popup,
		team7Marker, team7Popup, goalMarker;
	
	function init()
	{
		screen = new Ajax.PeriodicalUpdater('', 'gps_data_reader.php', { method: 'get', frequency: 10.0,onSuccess: function(t) {
			var data = t.responseText.evalJSON();
			team1Data = data[0].toString().split("_");
			team2Data = data[1].toString().split("_");
			team3Data = data[2].toString().split("_");
			team4Data = data[3].toString().split("_");
			team5Data = data[4].toString().split("_");
			team6Data = data[5].toString().split("_");
			team7Data = data[6].toString().split("_");
			
			if (typeof(map) === "undefined") {
				initalizeMap();
			}
			
			updateMarkers();
		}});
	}
	
	function initalizeMap() {
		map = new OpenLayers.Map ("mapcanvas", {
            controls:[
                new OpenLayers.Control.Navigation(),
                new OpenLayers.Control.PanZoomBar(),
                new OpenLayers.Control.LayerSwitcher(),
                new OpenLayers.Control.Attribution()],
            maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
                maxResolution: 156543.0399,
            numZoomLevels: 18,
            units: 'm',
            projection: new OpenLayers.Projection("EPSG:900913"),
            displayProjection: new OpenLayers.Projection("EPSG:4326")
        } );
			
		layerMapnik = new OpenLayers.Layer.OSM();
        map.addLayer(layerMapnik);
        layerMarkers = new OpenLayers.Layer.Markers("Markers");
        map.addLayer(layerMarkers);
		
        var initLonLat = new OpenLayers.LonLat(-103.37409292, 20.63039886).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
        map.setCenter (initLonLat, zoom);
		
		var team1LonLat = new OpenLayers.LonLat(team1Data[1], team1Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		var team2LonLat = new OpenLayers.LonLat(team2Data[1], team2Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		var team3LonLat = new OpenLayers.LonLat(team3Data[1], team3Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		var team4LonLat = new OpenLayers.LonLat(team4Data[1], team4Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		var team5LonLat = new OpenLayers.LonLat(team5Data[1], team5Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		var team6LonLat = new OpenLayers.LonLat(team6Data[1], team6Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		var team7LonLat = new OpenLayers.LonLat(team7Data[1], team7Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		var goalLonLat = new OpenLayers.LonLat(-1.985959, 43.320920).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		
        var size = new OpenLayers.Size(21,25);
		var size2 = new OpenLayers.Size(31,35);
        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
		
		var goal = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/chequered_flag.png',size2,offset);
        var icon = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/marker1.png',size,offset);
		var icon2 = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/marker2.png',size,offset);
		var icon3 = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/marker3.png',size,offset);
		var icon4 = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/marker4.png',size,offset);
		var icon5 = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/marker5.png',size,offset);
		var icon6 = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/marker6.png',size,offset);
		var icon7 = new OpenLayers.Icon('http://www.saulcintero.com/gpstracker/img/marker7.png',size,offset);
			
        team1Marker =new OpenLayers.Marker(team1LonLat,icon);
        team1Popup = new OpenLayers.Popup("Repartidor",
                        team1LonLat,
                        new OpenLayers.Size(145,52),
                        "<font size=-2>Equipo 1<br>Lon: "+Math.round(team1Data[1] * 10000) / 10000+", Lat: "+Math.round(team1Data[0] * 10000) / 10000);
        map.addPopup(team1Popup);
        team1Popup.hide();
		team1Popup.opacity=0.5;
		team1Marker.events.register('mouseover', team1Marker, function (e) { team1Popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(team1Marker);
			
		team2Marker =new OpenLayers.Marker(team2LonLat,icon2);
		team2Popup = new OpenLayers.Popup("Repartidor2",
						team2LonLat,
						new OpenLayers.Size(145,52),
						"<font size=-2>Equipo 2<br>Lon: "+Math.round(team2Data[1] * 10000) / 10000+", Lat: "+Math.round(team2Data[0] * 10000) / 10000);
		map.addPopup(team2Popup);
		team2Popup.hide();
		team2Popup.opacity=0.5;
		team2Marker.events.register('mouseover', team2Marker, function (e) { team2Popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(team2Marker);
		
		team3Marker =new OpenLayers.Marker(team3LonLat,icon3);
		team3Popup = new OpenLayers.Popup("Equipo3",
						team3LonLat,
						new OpenLayers.Size(145,52),
						"<font size=-2>Equipo 3<br>Lon: "+Math.round(team3Data[1] * 10000) / 10000+", Lat: "+Math.round(team3Data[0] * 10000) / 10000);
		map.addPopup(team3Popup);
		team3Popup.hide();
		team3Popup.opacity=0.5;
		team3Marker.events.register('mouseover', team3Marker, function (e) { team3Popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(team3Marker);
		
		team4Marker =new OpenLayers.Marker(team4LonLat,icon4);
		team4Popup = new OpenLayers.Popup("Equipo4",
						team4LonLat,
						new OpenLayers.Size(145,52),
						"<font size=-2>Equipo 4<br>Lon: "+Math.round(team4Data[1] * 10000) / 10000+", Lat: "+Math.round(team4Data[0] * 10000) / 10000);
		map.addPopup(team4Popup);
		team4Popup.hide();
		team4Popup.opacity=0.5;
		team4Marker.events.register('mouseover', team4Marker, function (e) { team4Popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(team4Marker);
		
		team5Marker =new OpenLayers.Marker(team5LonLat,icon5);
		team5Popup = new OpenLayers.Popup("Equipo5",
						new OpenLayers.LonLat(team5Data[1],team5Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject()),
						new OpenLayers.Size(145,52),
						"<font size=-2>Equipo 5<br>Lon: "+Math.round(team5Data[1] * 10000) / 10000+", Lat: "+Math.round(team5Data[0] * 10000) / 10000);
		map.addPopup(team5Popup);
		team5Popup.hide();
		team5Popup.opacity=0.5;
		team5Marker.events.register('mouseover', team5Marker, function (e) { team5Popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(team5Marker);
		
		team6Marker =new OpenLayers.Marker(team6LonLat,icon6);
		team6Popup = new OpenLayers.Popup("Equipo6",
						new OpenLayers.LonLat(team6Data[1],team6Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject()),
						new OpenLayers.Size(145,52),
						"<font size=-2>Equipo 6<br>Lon: "+Math.round(team6Data[1] * 10000) / 10000+", Lat: "+Math.round(team6Data[0] * 10000) / 10000);
		map.addPopup(team6Popup);
		team6Popup.hide();
		team6Popup.opacity=0.5;
		team6Marker.events.register('mouseover', team6Marker, function (e) { team6Popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(team6Marker);
		
		team7Marker =new OpenLayers.Marker(team7LonLat,icon7);
		team7Popup = new OpenLayers.Popup("Equipo7",
						new OpenLayers.LonLat(team7Data[1],team7Data[0]).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject()),
						new OpenLayers.Size(145,52),
						"<font size=-2>Equipo 7<br>Lon: "+Math.round(team7Data[1] * 10000) / 10000+", Lat: "+Math.round(team7Data[0] * 10000) / 10000);
		map.addPopup(team7Popup);
		team7Popup.hide();
		team7Popup.opacity=0.5;
		team7Marker.events.register('mouseover', team7Marker, function (e) { team7Popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(team7Marker);
		
		goalMarker =new OpenLayers.Marker(goalLonLat,goal);
		layerMarkers.addMarker(goalMarker);
	}

	function updateMarkers(){
		var newPx1 = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(team1Data[1], team1Data[0]).transform(map.displayProjection, map.projection)));
		team1Marker.moveTo(newPx1);
		team1Popup.moveTo(newPx1);
		team1Popup.setContentHTML("<font size=-2>Equipo 1<br>Lon: "+Math.round(team1Data[1] * 10000) / 10000+", Lat: "+Math.round(team1Data[0] * 10000) / 10000);
		
		var newPx2 = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(team2Data[1], team2Data[0]).transform(map.displayProjection, map.projection)));
		team2Marker.moveTo(newPx2);
		team2Popup.moveTo(newPx2);
		team2Popup.setContentHTML("<font size=-2>Equipo 2<br>Lon: "+Math.round(team2Data[1] * 10000) / 10000+", Lat: "+Math.round(team2Data[0] * 10000) / 10000);
		
		var newPx3 = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(team3Data[1], team3Data[0]).transform(map.displayProjection, map.projection)));
		team3Marker.moveTo(newPx3);
		team3Popup.moveTo(newPx3);
		team3Popup.setContentHTML("<font size=-2>Equipo 3<br>Lon: "+Math.round(team3Data[1] * 10000) / 10000+", Lat: "+Math.round(team3Data[0] * 10000) / 10000);
		
		var newPx4 = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(team4Data[1], team4Data[0]).transform(map.displayProjection, map.projection)));
		team4Marker.moveTo(newPx4);
		team4Popup.moveTo(newPx4);
		team4Popup.setContentHTML("<font size=-2>Equipo 4<br>Lon: "+Math.round(team4Data[1] * 10000) / 10000+", Lat: "+Math.round(team4Data[0] * 10000) / 10000);
		
		var newPx5 = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(team5Data[1], team5Data[0]).transform(map.displayProjection, map.projection)));
		team5Marker.moveTo(newPx5);
		team5Popup.moveTo(newPx5);
		team5Popup.setContentHTML("<font size=-2>Equipo 5<br>Lon: "+Math.round(team5Data[1] * 10000) / 10000+", Lat: "+Math.round(team5Data[0] * 10000) / 10000);
		
		var newPx6 = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(team6Data[1], team6Data[0]).transform(map.displayProjection, map.projection)));
		team6Marker.moveTo(newPx6);
		team6Popup.moveTo(newPx6);
		team6Popup.setContentHTML("<font size=-2>Equipo 6<br>Lon: "+Math.round(team6Data[1] * 10000) / 10000+", Lat: "+Math.round(team6Data[0] * 10000) / 10000);
		
		var newPx7 = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(team7Data[1], team7Data[0]).transform(map.displayProjection, map.projection)));
		team7Marker.moveTo(newPx7);
		team7Popup.moveTo(newPx7);
		team7Popup.setContentHTML("<font size=-2>Equipo 7<br>Lon: "+Math.round(team7Data[1] * 10000) / 10000+", Lat: "+Math.round(team7Data[0] * 10000) / 10000);
	}
</script>
</head>
 
<body onLoad="init()">
	<div id="mapcanvas" style="width: 800px; height: 600px" />
</body>
</html>