<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require('streetcreds.php');

$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$res= pg_get_result($db);


$query="SELECT json_build_object(
    'type', 'FeatureCollection',
    'crs',  json_build_object(
        'type',      'name',
        'properties', json_build_object(
            'name', 'EPSG:4326'
        )
    ),
    'features', json_agg(
        json_build_object(
            'type',       'Feature',
            'id',         uid,
            'geometry',  ST_AsGeoJSON(ST_POINT(longitude, latitude))::json,
            'properties', json_build_object(
                -- list of fields
                'orgname', orgname,
                'description', description,
                'country', country,
                'city', city,
                'province', province,
                'address', address,
                'postal_code', postal_code,
                'latitude', latitude,
                'longitude', longitude,
                'email', email,
                'phone', phone,
                'service_category', service_category,
                'website', website
            )
        )
    )
)
FROM cvetable;  --replace with your table ";

$result = pg_query($db, $query);
$arr = pg_fetch_all($result);

print_r($arr[0]['json_build_object']);

/*ST_AsGeoJSON(ST_Transform(geom,4326))::json, //{ "type": "Point", "coordinates": [ 2.3398829, 48.8789336 ] }*/
 ?>
