<?php

//Ce fichier est le modèle qui contient le modèle pour les erreurs

//fonction qui affiche un message selon la valeur du paramètre get : error
function get_error_message($error){
    $messages=[
        'diff_password'  => "Les mots de passe ne correspondent pas.",
        'weak_password'  => "Le mot de passe ne remplit pas les critères de mot de passe fort (12 caractères, 1 symbole).",
        'auth_required'  => "Veuillez vous connecter pour accéder à cette page.",
        'invalid_token'  => "Le lien de récupération est invalide ou a expiré.",
        'mail_failed'    => "L'envoi de l'e-mail a échoué. Veuillez réessayer.",
        'auth_failed'    => "Identifiant ou mot de passe incorrect.",
        'access_denied'  => "Accès refusé. Vous n'avez pas les droits d'administrateur.",
        'db_error'       => "Une erreur technique est survenue. Veuillez contacter le support.",
        'email_exists'   => "Cette adresse e-mail est déjà associée à un compte."
    ];

    return $messages[$error]?? "";
}

// On crée une fonction pour les succès sur le même modèle
function get_success_message($success){
    $messages=[
        'mail_sent'      => "📩 Un lien de récupération a été envoyé sur votre boîte mail.",
        'password_reset' => "✅ Votre mot de passe a été mis à jour avec succès.",
        'accountcreated' => "🎉 Votre compte a été créé avec succès ! Vous pouvez vous connecter.",
        'updated'        => "💾 Les informations ont été mises à jour avec succès."
    ];

    return $messages[$success] ?? "";
}

?>