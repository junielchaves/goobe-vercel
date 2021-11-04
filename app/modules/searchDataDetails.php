<?php
$param = filter_input(INPUT_POST, "param", FILTER_SANITIZE_URL);
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
$url = $param;
$fileHTML = file_get_contents($url, false, stream_context_create($Options));
$document->loadHTML($fileHTML);

$xpath = new DOMXpath($document);

$title = $xpath->query('.//h1[@class="job-title"]');
$time = $xpath->query('.//div[@class="publish__tag"]//p');
$vacancy = $xpath->query('.//dd[1][@class="job-plain-text"]');
$company = $xpath->query('.//dd[2][@class="job-plain-text"]');
$money = $xpath->query('.//dd[3][@class="job-plain-text"]');
$local = $xpath->query('.//dd[4][@class="job-plain-text"]//a');
$type = $xpath->query('.//dd[5][@class="job-plain-text"]');
$description = $xpath->query('.//p[@class="job-plain-text"]');

error_reporting(0);

foreach ($title as $tags1) {
  $jobs_title[] = $tags1->textContent;
}
foreach ($time as $tags2) {
  $jobs_time [] = $tags2->textContent;
}
foreach ($vacancy as $tags3) {
  $jobs_vacancy [] = $tags3->textContent;
}
foreach ($company as $tags4) {
  $jobs_company [] = $tags4->textContent;
}
foreach ($money as $tags5) {
  $jobs_money [] = $tags5->textContent;
}
foreach ($local as $tags6) {
  $jobs_local [] = $tags6->textContent;
}
foreach ($type as $tags7) {
  $jobs_type [] = $tags7->textContent;
}
foreach ($description as $tags8) {
  $jobs_description [] = $tags8->textContent;
}

echo "<button onClick ='toggleBoxDisplay()' class='d-block mx-auto btn btn-danger btn-sm mb-5 py-1 px-3 fw-bold b-radius'><i class='fas fa-reply btn-danger'></i> &nbsp;Voltar para Vagas</button>";
echo "<div class='container border-bottom mb-5'></div>";

echo "<div class='container'>";
echo "<div class='card d-block mx-auto text-dark p-2' style='width:95%;border-radius:20px'><div class='card-body'>";
echo "<h5 class='card-title mb-3 fw-bolder'>".$jobs_title[0]."</h5>";
echo "<h6 class=' container alert alert-secondary mb-4 mt-3 text-center b-radius' role='alert'>".$jobs_time[0]."</h6>";

echo "<h6 class='card-subtitle mb-2 '> Empresa: ".$jobs_company[0]."</h6>";
echo "<h6 class='card-subtitle mb-2 '> Salário: ".$jobs_money[0]."</h6>";
echo "<h6 class='card-subtitle mb-2 '> Local: ".$jobs_local[0]."</h6>";

echo "<h6 class='card-subtitle mb-2 mt-3 '> Quantidade de Vagas: ".$jobs_vacancy[0]."</h6>";
echo "<h6 class='card-subtitle mb-2 '> Tipo de Vaga:  ".$jobs_type[0]."</h6><br>";

echo "<a class=' btn btn-sm btn-success py-1 px-3 mb-2 mt-2 fw-bold b-radius'  href='".$url."' target='__blank'><i class='fas fa-check btn-success'></i> &nbsp;Candidatar-me para Vaga</a><br><br>";

echo "<h6 class='d-inline align-bottom text-muted mt-5'>via &nbsp;</h6>";
echo "<a class='d-inline  text-decoration-none mt-5 mb-3'  href='https://www.trabalhabrasil.com.br'  target='__blank'>";
echo "<img src='./public/images/trabalhabrasil.png' width='120' ></a>";

echo "<h6 class='card-subtitle mb-2 mt-4 p-2'><b>Mais sobre está vaga:</b><br><br>".$jobs_description[0]."</h6>";
echo "</div></div></div><br>";