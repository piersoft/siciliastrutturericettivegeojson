<?php $l=file_get_contents('http://osservatorioturistico.sicilia.it/arcgis/rest/services/accommodations/accommodations_VISIT_sicily/MapServer/0/query?where=1%3D1&text=&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&relationParam=&outFields=*&returnGeometry=true&maxAllowableOffset=&geometryPrecision=&outSR=&returnIdsOnly=false&returnCountOnly=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&returnZ=false&returnM=false&gdbVersion=&returnDistinctValues=false&f=pjson');

$l=str_replace("attributes","properties",$l);
$l=str_replace("AccomDesc","denominazione_struttura",$l);
$l=str_replace("GeogAreaName","nome_comune",$l);
$l=str_replace("Tipology","categoria",$l);
$l=str_replace("Classification","classificazione",$l);
$l=str_replace("Address","indirizzo",$l);
$l=str_replace("Website","web",$l);
$l=str_replace("E_Mail","email",$l);
$l=str_replace("Tel","tel",$l);

  $parsed_json = json_decode($l);
  $count1=0;
  foreach ($parsed_json->{'features'} as $i => $value) {
    $count1 = $count1+1;


    if ($count1 >1){

    $features[] = array(
            'type' => 'Feature',
            'geometry' => array('type' => 'Point', 'coordinates' => array((float)$parsed_json->{'features'}[$i]->{'geometry'}->{'x'},(float)$parsed_json->{'features'}[$i]->{'geometry'}->{'y'})),
            'properties' => array('nome_comune' => $parsed_json->{'features'}[$i]->{'properties'}->{'nome_comune'},'denominazione_struttura' => $parsed_json->{'features'}[$i]->{'properties'}->{'denominazione_struttura'}, 'indirizzo' => $parsed_json->{'features'}[$i]->{'properties'}->{'indirizzo'},'prov' => $parsed_json->{'features'}[$i]->{'properties'}->{'prov'},'classificazione' => $parsed_json->{'features'}[$i]->{'properties'}->{'classificazione'},'categoria' => $parsed_json->{'features'}[$i]->{'properties'}->{'categoria'},'camere' => $parsed_json->{'features'}[$i]->{'properties'}->{'camere'},'web' => $parsed_json->{'features'}[$i]->{'properties'}->{'web'},'tel' => $parsed_json->{'features'}[$i]->{'properties'}->{'tel'},'email' => $parsed_json->{'features'}[$i]->{'properties'}->{'email'},'perdiodi'=>$parsed_json->{'features'}[$i]->{'properties'}->{'periodi'},'servizi_generali'=>$parsed_json->{'features'}[$i]->{'properties'}->{'servizi_generali'},'servizi_camera'=>$parsed_json->{'features'}[$i]->{'properties'}->{'servizi_camera'},'prezzo_alta_stagione_o_unica'=>$parsed_json->{'features'}[$i]->{'properties'}->{'prezzo_alta_stagione_o_unica'},'prezzo_bassa_stagione'=>$parsed_json->{'features'}[$i]->{'properties'}->{'prezzo_bassa_stagione'},'foto1'=>$parsed_json->{'features'}[$i]->{'properties'}->{'foto1'}));
  }
}
  $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);
  $geostring=json_encode($allfeatures, JSON_PRETTY_PRINT);


echo   $geostring;

 ?>
