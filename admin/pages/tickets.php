<?php
if (!isset($_SESSION['authenticated'])) {
    header("Location:admin_login");
}

$ticketTable = new Table('tickets');
$tickets = $ticketTable->findAllInDatabase();

$title = "Claybrook Zoo - Tickets";
$content = loadTemplate('../templates/tickets_template.php', ['tickets' => $tickets]);
