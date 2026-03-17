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
 * Spanish language strings for the Dixeo Student Tutor block.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname']  = 'Tutor Estudiantil Dixeo';
$string['editingmode'] = 'Tutor Estudiantil Dixeo no está disponible en modo de edición.';
$string['quizrestriction'] = 'Tutor Estudiantil Dixeo no está disponible en las páginas de cuestionarios.';
$string['filecountlimit'] = 'El tutor IA está limitado a 150 archivos por curso (actualmente {$a} archivos). Por favor, reduzca el número de archivos si es necesario.';
$string['notenrolled'] = 'Debe estar inscrito en este curso para usar el tutor.';
$string['errorsendmessage'] = 'Lo sentimos, hubo un error al enviar su mensaje. Por favor, inténtelo de nuevo.';
$string['error_apierror'] = 'Lo sentimos, hubo un problema de comunicación con el servicio de IA.';
$string['unknownerror'] = 'Ocurrió un error desconocido.';
$string['talktotutor'] = 'Hablar con el tutor';

// Other UI Strings.
$string['assistanttitle'] = 'Pregunta a Ed';
$string['tutorpresentation'] = '¡Hola! Soy Ed, tu tutor de IA. ¿Cómo puedo ayudarte con este curso?';
$string['placeholder'] = 'Escribe tu mensaje...';
$string['send'] = 'Enviar';
$string['retry'] = 'Reintentar';

// Timeout and error handling strings.
$string['timeout_message'] = 'La respuesta está tardando más de lo esperado. El asistente puede estar trabajando aún en su solicitud.';
$string['check_for_updates'] = 'Buscar actualizaciones';
$string['error_check_updates'] = 'No se pudieron verificar las actualizaciones. Por favor, actualice la página.';
$string['error_timeout'] = 'La solicitud ha expirado. Por favor, verifique su conexión e inténtelo de nuevo.';
$string['error_network'] = 'Ocurrió un error de red. Por favor, verifique su conexión e inténtelo de nuevo.';

$string['connection_lost'] = 'Conexión perdida. Intentando reconectar...';
$string['yesterday'] = 'ayer';

// Accessibility strings.
$string['aria_chat_messages'] = 'Mensajes del chat';
$string['aria_type_message'] = 'Escribe tu mensaje';
$string['aria_send_message'] = 'Enviar mensaje';
$string['aria_skip_to_input'] = 'Ir al campo de mensaje';
$string['aria_your_message'] = 'Tu mensaje';
$string['aria_assistant_message'] = 'Mensaje del asistente';
$string['aria_sender_you'] = 'Tú';
$string['aria_sender_assistant'] = 'Asistente';
$string['message_too_long'] = 'El mensaje no puede exceder {$a} caracteres.';

$string['dixeo_tutor:addinstance'] = 'Agregar un nuevo bloque del Tutor Estudiantil Dixeo';
$string['dixeo_tutor:talktotutor'] = 'Interactuar con el Tutor de IA';

// Configuración.
$string['setting_displaymode'] = 'Modo de visualización';
$string['setting_displaymode_desc'] = 'Mostrar el tutor en el cajón de bloques (panel lateral) o en una ventana emergente flotante abierta con un botón.';
$string['setting_displaymode_drawer'] = 'En el cajón de bloques';
$string['setting_displaymode_popup'] = 'En una ventana emergente';
$string['tooltip_open_tutor'] = 'Preguntar a Ed';
$string['tooltip_hide_tutor'] = 'Cerrar Ed';
$string['setting_excludedmodules'] = 'Tipos de módulos excluidos';
$string['setting_excludedmodules_desc'] = 'Lista de tipos de módulos de actividad separados por comas donde el tutor debe ocultarse (ej: quiz,simplequiz2). El tutor no aparecerá en las páginas de estos tipos de actividad.';

// Privacidad.
$string['privacy:metadata:userid'] = 'El ID del usuario que envía el mensaje.';
$string['privacy:metadata:courseid'] = 'El ID del curso en el que está inscrito el usuario.';
$string['privacy:metadata:message'] = 'El contenido del mensaje enviado por el usuario.';
$string['privacy:metadata:pageurl'] = 'La URL de la página en la que se encontraba el usuario al enviar el mensaje.';
$string['privacy:metadata:externalpurpose'] = 'Los mensajes de los usuarios se envían a la API de Dixeo para generar respuestas del tutor IA basadas en el contenido del curso.';
