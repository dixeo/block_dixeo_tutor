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
 * German language strings for the Dixeo Student Tutor block.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname']  = 'Dixeo Student Tutor';
$string['editingmode'] = 'Dixeo Student Tutor ist im Bearbeitungsmodus nicht verfügbar.';
$string['quizrestriction'] = 'Dixeo Student Tutor ist auf Quiz-Seiten nicht verfügbar.';
$string['filecountlimit'] = 'Der KI-Tutor ist auf 150 Dateien pro Kurs beschränkt (derzeit {$a} Dateien). Bitte reduzieren Sie bei Bedarf die Anzahl der Dateien.';
$string['notenrolled'] = 'Sie müssen in diesen Kurs eingeschrieben sein, um den Tutor zu nutzen.';
$string['errorsendmessage'] = 'Beim Senden Ihrer Nachricht ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.';
$string['error_apierror'] = 'Bei der Kommunikation mit dem KI-Dienst ist ein Problem aufgetreten.';
$string['unknownerror'] = 'Ein unbekannter Fehler ist aufgetreten.';
$string['talktotutor'] = 'Mit dem Tutor sprechen';

// Weitere UI-Strings.
$string['assistanttitle'] = 'Frag Ed';
$string['tutorpresentation'] = 'Hallo! Ich bin Ed, dein KI-Tutor. Wie kann ich dir bei diesem Kurs helfen?';
$string['placeholder'] = 'Nachricht eingeben...';
$string['send'] = 'Senden';
$string['retry'] = 'Erneut versuchen';

// Timeout- und Fehlerbehandlungs-Strings.
$string['timeout_message'] = 'Die Antwort dauert länger als erwartet. Der Assistent arbeitet möglicherweise noch an Ihrer Anfrage.';
$string['check_for_updates'] = 'Auf Updates prüfen';
$string['error_check_updates'] = 'Updates konnten nicht geprüft werden. Bitte laden Sie die Seite neu.';
$string['error_timeout'] = 'Zeitüberschreitung der Anfrage. Bitte überprüfen Sie Ihre Verbindung und versuchen Sie es erneut.';
$string['error_network'] = 'Netzwerkfehler. Bitte überprüfen Sie Ihre Verbindung und versuchen Sie es erneut.';

$string['connection_lost'] = 'Verbindung verloren. Verbindung wird wiederhergestellt...';
$string['yesterday'] = 'gestern';

// Barrierefreiheits-Strings.
$string['aria_chat_messages'] = 'Chat-Nachrichten';
$string['aria_type_message'] = 'Nachricht eingeben';
$string['aria_send_message'] = 'Nachricht senden';
$string['aria_skip_to_input'] = 'Zum Nachrichteneingabefeld springen';
$string['aria_your_message'] = 'Ihre Nachricht';
$string['aria_assistant_message'] = 'Assistenten-Nachricht';
$string['aria_sender_you'] = 'Sie';
$string['aria_sender_assistant'] = 'Assistent';
$string['message_too_long'] = 'Die Nachricht darf maximal {$a} Zeichen enthalten.';

$string['dixeo_tutor:addinstance'] = 'Einen neuen Dixeo Student Tutor-Block hinzufügen';
$string['dixeo_tutor:talktotutor'] = 'Mit dem KI-Tutor interagieren';

// Einstellungen.
$string['setting_displaymode'] = 'Anzeigemodus';
$string['setting_displaymode_desc'] = 'Tutor im Block-Schublade (Seitenpanel) oder in einem schwebenden Popup-Fenster per Button anzeigen.';
$string['setting_displaymode_drawer'] = 'In der Block-Schublade';
$string['setting_displaymode_popup'] = 'In einem Popup-Fenster';
$string['tooltip_open_tutor'] = 'Dixeo Tutor öffnen';
$string['tooltip_hide_tutor'] = 'Dixeo Tutor ausblenden';
$string['setting_excludedmodules'] = 'Ausgeschlossene Modultypen';
$string['setting_excludedmodules_desc'] = 'Kommagetrennte Liste von Aktivitätsmodultypen, auf deren Seiten der Tutor ausgeblendet werden soll (z. B. quiz, simplequiz). Der Tutor erscheint nicht auf den Seiten dieser Aktivitätstypen.';

// Datenschutz.
$string['privacy:metadata:userid'] = 'Die ID des Benutzers, der die Nachricht sendet.';
$string['privacy:metadata:courseid'] = 'Die ID des Kurses, in dem der Benutzer eingeschrieben ist.';
$string['privacy:metadata:message'] = 'Der Inhalt der vom Benutzer gesendeten Nachricht.';
$string['privacy:metadata:pageurl'] = 'Die URL der Seite, auf der sich der Benutzer beim Senden der Nachricht befand.';
$string['privacy:metadata:externalpurpose'] = 'Benutzernachrichten werden an die Dixeo-API gesendet, um KI-Tutor-Antworten basierend auf dem Kursinhalt zu erzeugen.';
