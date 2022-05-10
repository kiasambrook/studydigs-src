                        // function creates map
                        function loadMap() {
                            var centerCoords = [<? echo $data['property']->longitude; ?>, <? echo $data['property']->latitude; ?>];

                            mapboxgl.accessToken =
                                        'pk.eyJ1Ijoia2lhc2FteiIsImEiOiJja3p0cTU2MXY2MzQ2Mm9vMWllMHdnMjcwIn0.aCZ3_K7HV_Mu5Ln9Vr_XiQ';
                                    var map = new mapboxgl.Map({
                                        container: 'map',
                                        center: centerCoords,
                                        zoom: 15,
                                        style: 'mapbox://styles/mapbox/streets-v11'
                                    });

                                    const marker = new mapboxgl.Marker()
                                        .setLngLat(centerCoords)
                                        .addTo(map);
                        }