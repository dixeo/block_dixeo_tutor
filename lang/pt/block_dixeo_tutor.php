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
 * Portuguese language strings for the Dixeo Student Tutor block.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname']  = 'Tutor Dixeo para Estudantes';
$string['editingmode'] = 'O Tutor Dixeo não está disponível no modo de edição.';
$string['quizrestriction'] = 'O Tutor Dixeo não está disponível nas páginas de questionários.';
$string['filecountlimit'] = 'O tutor de IA está limitado a 150 ficheiros por disciplina (atualmente {$a} ficheiros). Por favor, reduza o número de ficheiros se necessário.';
$string['notenrolled'] = 'Tem de estar inscrito nesta disciplina para usar o tutor.';
$string['errorsendmessage'] = 'Ocorreu um erro ao enviar a sua mensagem. Por favor, tente novamente.';
$string['error_apierror'] = 'Ocorreu um problema na comunicação com o serviço de IA.';
$string['unknownerror'] = 'Ocorreu um erro desconhecido.';
$string['talktotutor'] = 'Falar com o tutor';

// Outras strings da interface.
$string['assistanttitle'] = 'Pergunte ao Ed';
$string['tutorpresentation'] = 'Olá! Sou o Ed, o teu tutor de IA. Como posso ajudar-te nesta disciplina?';
$string['placeholder'] = 'Escreva a sua mensagem...';
$string['send'] = 'Enviar';
$string['retry'] = 'Tentar novamente';

// Strings de timeout e tratamento de erros.
$string['timeout_message'] = 'A resposta está a demorar mais do que o esperado. O assistente pode ainda estar a processar o seu pedido.';
$string['check_for_updates'] = 'Verificar atualizações';
$string['error_check_updates'] = 'Não foi possível verificar atualizações. Por favor, atualize a página.';
$string['error_timeout'] = 'O pedido expirou. Por favor, verifique a sua ligação e tente novamente.';
$string['error_network'] = 'Ocorreu um erro de rede. Por favor, verifique a sua ligação e tente novamente.';

$string['connection_lost'] = 'Ligação perdida. A tentar reconectar...';
$string['yesterday'] = 'ontem';

// Strings de acessibilidade.
$string['aria_chat_messages'] = 'Mensagens do chat';
$string['aria_type_message'] = 'Escreva a sua mensagem';
$string['aria_send_message'] = 'Enviar mensagem';
$string['aria_skip_to_input'] = 'Ir para o campo de mensagem';
$string['aria_your_message'] = 'A sua mensagem';
$string['aria_assistant_message'] = 'Mensagem do assistente';
$string['aria_sender_you'] = 'Você';
$string['aria_sender_assistant'] = 'Assistente';
$string['message_too_long'] = 'A mensagem não pode exceder {$a} caracteres.';

$string['dixeo_tutor:addinstance'] = 'Adicionar um novo bloco Tutor Dixeo para Estudantes';
$string['dixeo_tutor:talktotutor'] = 'Interagir com o Tutor de IA';

// Definições.
$string['setting_displaymode'] = 'Modo de exibição';
$string['setting_displaymode_desc'] = 'Mostrar o tutor na gaveta de blocos (painel lateral) ou numa janela flutuante aberta por um botão.';
$string['setting_displaymode_drawer'] = 'Na gaveta de blocos';
$string['setting_displaymode_popup'] = 'Numa janela flutuante';
$string['tooltip_open_tutor'] = 'Perguntar ao Ed';
$string['tooltip_hide_tutor'] = 'Fechar Ed';
$string['setting_excludedmodules'] = 'Tipos de módulos excluídos';
$string['setting_excludedmodules_desc'] = 'Lista separada por vírgulas dos tipos de módulos de atividade onde o tutor deve ser ocultado (ex.: quiz, simplequiz2). O tutor não aparecerá nas páginas destes tipos de atividade.';

// Privacidade.
$string['privacy:metadata:userid'] = 'O ID do utilizador que envia a mensagem.';
$string['privacy:metadata:courseid'] = 'O ID da disciplina em que o utilizador está inscrito.';
$string['privacy:metadata:message'] = 'O conteúdo da mensagem enviada pelo utilizador.';
$string['privacy:metadata:pageurl'] = 'O URL da página em que o utilizador estava ao enviar a mensagem.';
$string['privacy:metadata:externalpurpose'] = 'As mensagens dos utilizadores são enviadas para a API Dixeo para gerar respostas do tutor de IA com base no conteúdo da disciplina.';
