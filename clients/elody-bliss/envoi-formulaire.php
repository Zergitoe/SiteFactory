<?php
// Reception du formulaire de contact et envoi par courriel.
// Repond en JSON : { "ok": true } ou { "ok": false, "erreur": "..." }

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'erreur' => 'Methode non autorisee']);
    exit;
}

// piege a robots : un champ cache qu un humain ne remplit jamais
if (!empty($_POST['botcheck'])) {
    echo json_encode(['ok' => true]);
    exit;
}

$destinataire = 'elodybliss@gmail.com';

$nettoie = function ($v) {
    $v = is_string($v) ? $v : '';
    // pas de saut de ligne dans les en-tetes
    $v = str_replace(["\r", "\n", "%0a", "%0d"], ' ', $v);
    return trim(mb_substr($v, 0, 2000));
};

// le nom du champ prenom porte un accent : on tolere les variantes
$champ = function (array $noms) use ($nettoie) {
    foreach ($noms as $n) {
        if (isset($_POST[$n]) && trim($_POST[$n]) !== '') return $nettoie($_POST[$n]);
    }
    return '';
};

$prenom = $champ(['Prénom', 'Prenom', 'prenom', 'first_name']);
$nom    = $champ(['Nom', 'nom', 'last_name']);
$email  = $champ(['email', 'Email', 'mail']);

if ($prenom === '' || $nom === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'erreur' => 'Champs obligatoires manquants ou adresse invalide']);
    exit;
}

$lignes = [];
foreach ($_POST as $cle => $valeur) {
    if ($cle === 'botcheck') continue;
    $valeur = $nettoie($valeur);
    if ($valeur === '') continue;
    $lignes[] = $nettoie($cle) . ' : ' . $valeur;
}

$corps = "Nouvelle demande depuis le site elodybliss.fr\n"
       . str_repeat('-', 46) . "\n\n"
       . implode("\n", $lignes) . "\n\n"
       . str_repeat('-', 46) . "\n"
       . 'Recu le ' . date('d/m/Y a H:i') . "\n";

$sujet = 'Nouvelle demande mariage : ' . $prenom . ' ' . $nom;

$entetes = 'From: Site Elody Bliss <contact@elodybliss.fr>' . "\r\n"
         . 'Reply-To: ' . $prenom . ' ' . $nom . ' <' . $email . '>' . "\r\n"
         . 'Content-Type: text/plain; charset=utf-8' . "\r\n"
         . 'X-Mailer: PHP/' . phpversion();

$envoye = mail(
    $destinataire,
    '=?UTF-8?B?' . base64_encode($sujet) . '?=',
    $corps,
    $entetes
);

if (!$envoye) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'erreur' => "L envoi a echoue"]);
    exit;
}

echo json_encode(['ok' => true]);
