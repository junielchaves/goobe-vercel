<?php
$param = filter_input(INPUT_POST, "param", FILTER_SANITIZE_STRING);
if (empty($param)) {
  echo "Parametro Vazio";
  exit();
}

$Options = array(
  "ssl" => array(
    "verify_peer" => false,
    "verify_peer_name" => false,
  ),
);
$document = new DOMDocument();

libxml_use_internal_errors(true);
$url = "https://www.trabalhabrasil.com.br/vagas-empregos/".$param;
$fileHTML = file_get_contents($url, false, stream_context_create($Options));
$document->loadHTML($fileHTML);

$xpath = new DOMXpath($document);

$link = $xpath->query('.//div[@class="jg__job"]//a/@href');
$name = $xpath->query('.//h3[@class="job__name"]');
$company = $xpath->query('.//h4[@class="job__company"]');
$description = $xpath->query('.//p[@class="job__description"]');
$value = $xpath->query('.//h5[1][@class="job__detail"]');
$local = $xpath->query('.//h5[2][@class="job__detail"]');

foreach ($link as $tags1) {
  $jobs_link [] = $tags1->nodeValue;
}

foreach ($name as $tags2) {
  $jobs_name [] = $tags2->textContent;
}
foreach ($company as $tags3) {
  $jobs_company [] = $tags3->textContent;
}
foreach ($description as $tags4) {
  $jobs_description [] = $tags4->textContent;
}
foreach ($value as $tags5) {
  $jobs_value [] = $tags5->textContent;
}
foreach ($local as $tags6) {
  $jobs_local [] = $tags6->textContent;
}
if(empty($jobs_name[0])){
  echo "<div class='text-center text-muted fs-1 ' style='margin-top:20%'><i class='fas fa-exclamation-triangle fa-2x'></i></div><div class='text-center text-muted mt-2 fs-5'>Nenhum resultado encontrado!<br></div><div class='text-center text-muted fs-8'> palavra-chave pesquisada: <b> ".$param."</b></div>";
  exit();
}


for($x=0;$x<=count($jobs_name);$x++){}
  echo "<div class='container mt-4'><hr></div>";
  echo "<div class='container alert alert-secondary text-center mt-4 mb-4' role='alert' style='width:90%;border-radius:12px'>Exibindo ".$x." resultados para '".$param."'</div>";

for($i=0;$i<=count($jobs_name);$i++){
error_reporting(0);

$cod = explode('/',$jobs_link[$i]);
$jobs_cod [] = $cod[3];

if(strpos($jobs_value[$i],'/')){
  $jobs_local[$i] = $jobs_value[$i];
  $jobs_value[$i]="";
}


echo "<div class='container'>";
echo "<div class='card d-block mx-auto  shadow-sm text-dark p-2' style='width:95%;border-radius:20px'><div class='card-body'>";
echo "<h5 class='card-title mb-3 fw-bolder'>".$jobs_name[$i]."</h5>";
echo $jobs_company[$i] = $jobs_company[$i]?"<h6 class='card-subtitle mb-2 '><i class='fas fa-suitcase text-muted'></i>  &nbsp;&nbsp;".$jobs_company[$i]."</h6>":"";
echo $jobs_value[$i] = $jobs_value[$i]?"<h6 class='card-subtitle mb-2 '><i class='fas fa-money-check-alt text-muted'></i>  &nbsp;&nbsp;".$jobs_value[$i]."</h6>":"";
echo $jobs_local[$i] = $jobs_local[$i]?"<h6 class='card-subtitle mb-2 '> <i class='fas fa-map-marker-alt text-muted'></i>  &nbsp;&nbsp;".$jobs_local[$i]."</h6>":"";
echo "<h6 class='d-block text-muted fs- p-1 mb-3 mt-3'>Código da Vaga: #".$jobs_cod[$i]."</h6>";
echo "<h6 class='d-inline align-bottom text-muted mt-3'>via &nbsp;</h6>";
echo "<a class='d-inline  text-decoration-none mt-3 mb-3'  href='https://www.trabalhabrasil.com.br'  target='__blank'>";
echo "<img src='./public/images/trabalhabrasil.png' width='120' ></a>";
$url_details = "https://www.trabalhabrasil.com.br".$jobs_link[$i];

echo "<form id='form-details-".$i."'>";
echo "<input type='text' style='display:none' value='".$url_details."' name='param' >";
echo "<button id='".$i."' onClick='formEventDetails(this.id)' class='btn btn-warning shadow-sm btn-sm b-radius py-1 px-3 mt-3' type='button'>Mais sobre a vaga &nbsp;<i class='fas fa-external-link-alt btn-warning'></i></button>";
echo "</form>";
echo "</div></div></div><br>";
}