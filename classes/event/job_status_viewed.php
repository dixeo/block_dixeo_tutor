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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Event when a tutor job status is retrieved.
 *
 * @package    block_dixeo_tutor
 * @copyright  2026 Edunao SAS (contact@edunao.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_dixeo_tutor\event;

/**
 * Fired after an owned tutor job status is successfully fetched.
 */
class job_status_viewed extends tutor_course_base {
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
        return get_string('eventjobstatusviewed', 'block_dixeo_tutor');
    }

    /**
     * Non-localised description for logs.
     *
     * @return string
     */
    public function get_description(): string {
        return get_string('eventjobstatusvieweddesc', 'block_dixeo_tutor', (object) [
            'userid' => $this->userid,
            'courseid' => $this->courseid,
            'jobid' => clean_param((string) ($this->other['jobid'] ?? ''), PARAM_TEXT),
            'status' => clean_param((string) ($this->other['status'] ?? ''), PARAM_ALPHANUMEXT),
        ]);
    }

    /**
     * Create an event for a job status fetch.
     *
     * @param int $courseid Course id.
     * @param int $userid Acting user id.
     * @param string $jobid Remote job UUID.
     * @param string $status Current job status code.
     * @return self
     */
    public static function create_for_course(int $courseid, int $userid, string $jobid, string $status): self {
        return self::create(self::build_course_data($courseid, $userid, [
            'jobid' => $jobid,
            'status' => $status,
        ]));
    }

    /**
     * Custom validation.
     */
    protected function validate_data(): void {
        parent::validate_data();
        if (empty($this->other['jobid'])) {
            throw new \coding_exception('The \'jobid\' value must be set in other.');
        }
        if (empty($this->other['status'])) {
            throw new \coding_exception('The \'status\' value must be set in other.');
        }
    }
}
