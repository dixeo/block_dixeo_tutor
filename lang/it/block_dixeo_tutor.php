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
 * Italian language strings for the Dixeo Student Tutor block.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname']  = 'Tutor Studente Dixeo';
$string['editingmode'] = 'Tutor Studente Dixeo non è disponibile in modalità di modifica.';
$string['quizrestriction'] = 'Tutor Studente Dixeo non è disponibile nelle pagine del quiz.';
$string['filecountlimit'] = 'Il tutor IA è limitato a 150 file per corso (attualmente {$a} file). Si prega di ridurre il numero di file se necessario.';
$string['notenrolled'] = 'Devi essere iscritto a questo corso per utilizzare il tutor.';
$string['errorsendmessage'] = "Si è verificato un errore nell'invio del messaggio. Per favore, riprova.";
$string['error_apierror'] = 'Si è verificato un problema di comunicazione con il servizio IA.';
$string['unknownerror'] = 'Si è verificato un errore sconosciuto.';
$string['talktotutor'] = 'Parla con il tutor';

// Other UI Strings.
$string['assistanttitle'] = 'Chiedi a Ed';
$string['tutorpresentation'] = 'Ciao! Sono Ed, il tuo tutor IA. Come posso aiutarti con questo corso?';
$string['placeholder'] = 'Scrivi il tuo messaggio...';
$string['send'] = 'Invia';
$string['retry'] = 'Riprova';

// Timeout and error handling strings.
$string['timeout_message'] = 'La risposta sta impiegando più tempo del previsto. L\'assistente potrebbe ancora lavorare alla tua richiesta.';
$string['check_for_updates'] = 'Controlla aggiornamenti';
$string['error_check_updates'] = 'Impossibile verificare gli aggiornamenti. Per favore, aggiorna la pagina.';
$string['error_timeout'] = 'La richiesta è scaduta. Per favore, verifica la tua connessione e riprova.';
$string['error_network'] = 'Si è verificato un errore di rete. Per favore, verifica la tua connessione e riprova.';

$string['connection_lost'] = 'Connessione persa. Tentativo di riconnessione...';
$string['yesterday'] = 'ieri';

// Accessibility strings.
$string['aria_chat_messages'] = 'Messaggi della chat';
$string['aria_type_message'] = 'Scrivi il tuo messaggio';
$string['aria_send_message'] = 'Invia messaggio';
$string['aria_skip_to_input'] = 'Vai al campo di inserimento';
$string['aria_your_message'] = 'Il tuo messaggio';
$string['aria_assistant_message'] = "Messaggio dell'assistente";
$string['aria_sender_you'] = 'Tu';
$string['aria_sender_assistant'] = 'Assistente';
$string['message_too_long'] = 'Il messaggio non può superare {$a} caratteri.';

$string['dixeo_tutor:addinstance'] = 'Aggiungi un nuovo blocco Tutor Studente Dixeo';
$string['dixeo_tutor:talktotutor'] = 'Interagisci con il Tutor IA';

// Impostazioni.
$string['setting_displaymode'] = 'Modalità di visualizzazione';
$string['setting_displaymode_desc'] = 'Mostra il tutor nel cassetto dei blocchi (pannello laterale) o in una finestra a comparsa aperta con un pulsante.';
$string['setting_displaymode_drawer'] = 'Nel cassetto dei blocchi';
$string['setting_displaymode_popup'] = 'In una finestra a comparsa';
$string['tooltip_open_tutor'] = 'Chiedi a Ed';
$string['tooltip_hide_tutor'] = 'Chiudi Ed';
$string['setting_excludedmodules'] = 'Tipi di moduli esclusi';
$string['setting_excludedmodules_desc'] = 'Elenco separato da virgole dei tipi di moduli di attività in cui il tutor deve essere nascosto (es: quiz,simplequiz2). Il tutor non apparirà nelle pagine di questi tipi di attività.';

// Privacy.
$string['privacy:metadata:userid'] = 'L\'ID dell\'utente che invia il messaggio.';
$string['privacy:metadata:courseid'] = 'L\'ID del corso a cui l\'utente è iscritto.';
$string['privacy:metadata:message'] = 'Il contenuto del messaggio inviato dall\'utente.';
$string['privacy:metadata:pageurl'] = 'L\'URL della pagina in cui si trovava l\'utente al momento dell\'invio del messaggio.';
$string['privacy:metadata:externalpurpose'] = 'I messaggi degli utenti vengono inviati all\'API Dixeo per generare risposte del tutor IA basate sul contenuto del corso.';
