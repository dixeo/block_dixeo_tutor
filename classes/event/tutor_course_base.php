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
 * Base event for tutor course-scoped audit records.
 *
 * @package    block_dixeo_tutor
 * @copyright  2026 Edunao SAS (contact@edunao.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_dixeo_tutor\event;

/**
 * Shared helpers for tutor Moodle events.
 *
 * Payload is limited to identifiers and counts — no message or conversation content.
 */
abstract class tutor_course_base extends \core\event\base {
    /**
     * Init method.
     */
    protected function init(): void {
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'course';
    }

    /**
     * Relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/course/view.php', ['id' => $this->courseid]);
    }

    /**
     * Build event data for a course-scoped tutor action.
     *
     * @param int $courseid Course id.
     * @param int $userid Acting user id.
     * @param array $other Event other payload (no message content).
     * @return array Event data array for self::create().
     */
    protected static function build_course_data(int $courseid, int $userid, array $other): array {
        return [
            'context' => \context_course::instance($courseid),
            'objectid' => $courseid,
            'userid' => $userid,
            'courseid' => $courseid,
            'other' => $other,
        ];
    }

    /**
     * Object id mapping for backup/restore.
     *
     * @return array
     */
    public static function get_objectid_mapping(): array {
        return ['db' => 'course', 'restore' => 'course'];
    }

    /**
     * Other mapping for backup/restore.
     *
     * @return false
     */
    public static function get_other_mapping() {
        return false;
    }
}
