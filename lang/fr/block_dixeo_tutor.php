<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * French language strings for the Dixeo Student Tutor block.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname']  = 'Dixeo Tuteur';
$string['editingmode'] = "Dixeo Tuteur n'est pas disponible en mode édition.";
$string['quizrestriction'] = "Dixeo Tuteur n'est pas disponible sur les pages de quiz.";
$string['filecountlimit'] = "Le tuteur IA est limité à 150 fichiers par cours (actuellement {" . '$a' . "} fichiers). Veuillez réduire le nombre de fichiers si nécessaire.";
$string['notenrolled'] = 'Vous devez être inscrit à ce cours pour utiliser le tuteur.';
$string['errorsendmessage'] = "Désolé, une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer.";
$string['error_apierror'] = "Désolé, un problème de communication avec le service IA s'est produit.";
$string['unknownerror'] = "Une erreur inconnue s'est produite.";
$string['talktotutor'] = 'Parler au tuteur';

// Autres chaînes d'interface.
$string['assistanttitle'] = 'Demandez à Ed';
$string['tutorpresentation'] = "Salut ! Je suis Ed, votre tuteur IA. Comment puis-je vous aider avec ce cours ?";
$string['placeholder'] = 'Tapez votre message...';
$string['send'] = 'Envoyer';
$string['retry'] = 'Réessayer';

// Chaînes de timeout et gestion d'erreurs.
$string['timeout_message'] = "La réponse prend plus de temps que prévu. L'assistant travaille peut-être encore sur votre demande.";
$string['check_for_updates'] = 'Vérifier les mises à jour';
$string['error_check_updates'] = 'Impossible de vérifier les mises à jour. Veuillez rafraîchir la page.';
$string['error_timeout'] = 'La requête a expiré. Veuillez vérifier votre connexion et réessayer.';
$string['error_network'] = 'Une erreur réseau est survenue. Veuillez vérifier votre connexion et réessayer.';

$string['connection_lost'] = 'Connexion perdue. Tentative de reconnexion...';
$string['yesterday'] = 'hier';

// Chaînes d'accessibilité.
$string['aria_chat_messages'] = 'Messages du chat';
$string['aria_type_message'] = 'Tapez votre message';
$string['aria_send_message'] = 'Envoyer le message';
$string['aria_skip_to_input'] = 'Aller au champ de saisie';
$string['aria_your_message'] = 'Votre message';
$string['aria_assistant_message'] = "Message de l'assistant";
$string['aria_sender_you'] = 'Vous';
$string['aria_sender_assistant'] = 'Assistant';
$string['message_too_long'] = 'Le message ne peut pas dépasser {$a} caractères.';

$string['dixeo_tutor:addinstance'] = 'Ajouter un nouveau bloc Dixeo Tuteur';
$string['dixeo_tutor:talktotutor'] = 'Interagir avec le tuteur IA';

// Paramètres.
$string['setting_displaymode'] = 'Mode d\'affichage';
$string['setting_displaymode_desc'] = 'Afficher le tuteur dans le tiroir de blocs (panneau latéral) ou dans une fenêtre flottante ouverte par un bouton.';
$string['setting_displaymode_drawer'] = 'Dans le tiroir de blocs';
$string['setting_displaymode_popup'] = 'Dans une fenêtre flottante';
$string['tooltip_open_tutor'] = 'Demander à Ed';
$string['tooltip_hide_tutor'] = 'Fermer Ed';
$string['setting_excludedmodules'] = 'Types de modules exclus';
$string['setting_excludedmodules_desc'] = 'Liste de types de modules d\'activité séparés par des virgules où le tuteur doit être masqué (ex : quiz,simplequiz2). Le tuteur n\'apparaîtra pas sur les pages de ces types d\'activité.';

// Confidentialité.
$string['privacy:metadata:userid'] = 'L\'identifiant de l\'utilisateur envoyant le message.';
$string['privacy:metadata:courseid'] = 'L\'identifiant du cours auquel l\'utilisateur est inscrit.';
$string['privacy:metadata:message'] = 'Le contenu du message envoyé par l\'utilisateur.';
$string['privacy:metadata:pageurl'] = 'L\'URL de la page sur laquelle se trouvait l\'utilisateur lors de l\'envoi du message.';
$string['privacy:metadata:externalpurpose'] = 'Les messages des utilisateurs sont envoyés à l\'API Dixeo pour générer des réponses du tuteur IA basées sur le contenu du cours.';

$string['resize_panel'] = 'Redimensionner le panneau du tuteur';
