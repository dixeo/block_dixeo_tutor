<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Event when tutor conversation history is retrieved.
 *
 * @package    block_dixeo_tutor
 * @copyright  2026 Edunao SAS (contact@edunao.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_dixeo_tutor\event;

/**
 * Fired after conversation history is successfully fetched.
 */
class conversation_viewed extends tutor_course_base {
    /**
     * Init method.
     */
    protected function init(): void {
        parent::init();
        $this->data['crud'] = 'r';
    }

    /**
     * Localised event name.
     *
     * @return string
     */
    public static function get_name(): string {
        return get_string('eventconversationviewed', 'block_dixeo_tutor');
    }

    /**
     * Non-localised description for logs.
     *
     * @return string
     */
    public function get_description(): string {
        return get_string('eventconversationvieweddesc', 'block_dixeo_tutor', (object) [
            'userid' => $this->userid,
            'courseid' => $this->courseid,
            'messagecount' => (int) ($this->other['messagecount'] ?? 0),
            'sinceid' => clean_param((string) ($this->other['sinceid'] ?? ''), PARAM_ALPHANUMEXT),
        ]);
    }

    /**
     * Create an event for a conversation fetch.
     *
     * @param int $courseid Course id.
     * @param int $userid Acting user id.
     * @param int $messagecount Number of messages returned (not their content).
     * @param string $sinceid Optional message id filter.
     * @return self
     */
    public static function create_for_course(
        int $courseid,
        int $userid,
        int $messagecount,
        string $sinceid = ''
    ): self {
        $other = [
            'messagecount' => $messagecount,
        ];
        if ($sinceid !== '') {
            $other['sinceid'] = clean_param($sinceid, PARAM_ALPHANUMEXT);
        }

        return self::create(self::build_course_data($courseid, $userid, $other));
    }

    /**
     * Custom validation.
     */
    protected function validate_data(): void {
        parent::validate_data();
        if (!array_key_exists('messagecount', $this->other)) {
            throw new \coding_exception('The \'messagecount\' value must be set in other.');
        }
    }
}
