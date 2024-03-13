<?php
session_start(); 
include '../private/conn.php';


function calculateAge($birthdate) {
    $today = new DateTime();
    $diff = $today->diff(new DateTime($birthdate));
    return $diff->y;
}

$emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$postcodeRegexNL = '/^\d{4}\s?[a-zA-Z]{2}$/';

if (isset($_POST['signup'])) {
    $gebruiker_naam = $_POST['username'];
    $naam = $_POST['name'];
    $email = $_POST['email'];
    $geboortedatum = $_POST['date'];
    $wachtwoord = $_POST['password'];
    $postcode = $_POST['postcode'];

    if (!preg_match($postcodeRegexNL, $postcode)) {
        $_SESSION['melding'] = 'Ongeldige postcode.';
        header('location:../index.php?page=signup');
        exit;
    }

    
    if (!preg_match($emailRegex, $email)) {
        $_SESSION['melding'] = 'Ongeldig e-mailadres.';
        header('location:../index.php?page=signup');
        exit;
    }

    $leeftijd = calculateAge($geboortedatum);
    if ($leeftijd < 18) {
        $_SESSION['melding'] = 'Je moet minstens 18 jaar oud zijn om een account aan te maken.';
        header('location:../index.php?page=signup');
        exit;
    }
    
    $sql = 'INSERT INTO users (gebruiker_naam, naam, email, geboortedatum, wachtwoord, postcode) VALUES (:username, :name, :email, :date, :password, :postcode)';
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':username', $gebruiker_naam);
    $sth->bindParam(':name', $naam);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':date', $geboortedatum);
    $sth->bindParam(':password', $wachtwoord);
    $sth->bindParam(':postcode', $postcode);

    if ($sth->execute()) {
        $_SESSION['melding'] = 'Registratie succesvol! U kunt nu inloggen.';
        header('location:../index.php?page=login');
        exit;
    } else {
        $_SESSION['melding'] = 'Registratie mislukt. Probeer het opnieuw.';
        header('location:../index.php?page=signup');
        exit;
    }
}
?>
