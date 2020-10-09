<?php
if (!isset($_SESSION['authenticated'])) {
    header("Location:admin_login");
}

require '../../db/db_connect.php';

$animalQ = $pdo->prepare("SELECT COUNT(animal_id) as count_animal FROM animals WHERE an_archived='false'");
$animalQ->execute();
$animal = $animalQ->fetch();

$sponsorPriceQ = $pdo->prepare("SELECT SUM(total_price) as total_price FROM sponsored_animals WHERE s_status='accepted'");
$sponsorPriceQ->execute();
$sponsorPrice = $sponsorPriceQ->fetch();

$sponsorQ = $pdo->prepare("SELECT COUNT(sponsor_id) as total_sponsor FROM sponsors WHERE s_approved='true'");
$sponsorQ->execute();
$sponsor = $sponsorQ->fetch();

$vacancyQ = $pdo->prepare("SELECT COUNT(vacancy_id) as total_vacancies FROM vacancies WHERE v_archived='false' AND v_status='available' ");
$vacancyQ->execute();
$vacancy = $vacancyQ->fetch();


$title = "Claybrook Zoo - Dashboard";
$content = loadTemplate('../templates/admin-home_template.php', [
    'animal' => $animal,
    'sponsorPrice' => $sponsorPrice,
    'sponsor' => $sponsor,
    'vacancy' => $vacancy
]);
