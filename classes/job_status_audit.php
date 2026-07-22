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
 * Session-scoped deduplication for terminal tutor job-status audit events.
 *
 * @package    block_dixeo_tutor
 * @copyright  2026 Edunao SAS (contact@edunao.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_dixeo_tutor;

use block_dixeo_tutor\event\job_status_viewed;
use local_dixeo\dto\job_status;

/**
 * Emits job_status_viewed once per owned job when polling reaches a terminal hub status.
 */
class job_status_audit {
    /** @var string Session property for emitted terminal status audit keys. */
    private const SESSION_KEY = 'block_dixeo_tutor_terminal_status_audit';

    /**
     * Hub statuses that end client polling for a tutor job.
     *
     * @return string[]
     */
    public static function terminal_statuses(): array {
        return [
            job_status::STATUS_COMPLETED,
            job_status::STATUS_FAILED,
            'cancelled',
        ];
    }

    /**
     * Whether a hub status is terminal for tutor polling.
     *
     * @param string $status Status code from the hub.
     * @return bool
     */
    public static function is_terminal_status(string $status): bool {
        return in_array($status, self::terminal_statuses(), true);
    }

    /**
     * Emit job_status_viewed once per job when a terminal status is first observed.
     *
     * @param int $courseid Course id.
     * @param int $userid Acting user id.
     * @param string $jobid Remote job UUID.
     * @param string $status Current hub status.
     * @return void
     */
    public static function maybe_emit_terminal_viewed(int $courseid, int $userid, string $jobid, string $status): void {
        if (!self::is_terminal_status($status)) {
            return;
        }

        if (self::has_emitted($userid, $courseid, $jobid)) {
            return;
        }

        job_status_viewed::create_for_course($courseid, $userid, $jobid, $status)->trigger();
        self::mark_emitted($userid, $courseid, $jobid, $status);
    }

    /**
     * Whether this session already logged a terminal status view for the job.
     *
     * @param int $userid Moodle user id.
     * @param int $courseid Course id.
     * @param string $jobid Job UUID.
     * @return bool
     */
    public static function has_emitted(int $userid, int $courseid, string $jobid): bool {
        global $SESSION;

        self::ensure_session_structure();

        return isset($SESSION->{self::SESSION_KEY}[$userid][$courseid][$jobid]);
    }

    /**
     * Record that a terminal status audit event was emitted for the job.
     *
     * @param int $userid Moodle user id.
     * @param int $courseid Course id.
     * @param string $jobid Job UUID.
     * @param string $status Terminal status that was logged.
     * @return void
     */
    public static function mark_emitted(int $userid, int $courseid, string $jobid, string $status): void {
        global $SESSION;

        if ($userid < 1 || $courseid < 1 || $jobid === '') {
            return;
        }

        self::ensure_session_structure();
        $SESSION->{self::SESSION_KEY}[$userid][$courseid][$jobid] = $status;
    }

    /**
     * Ensure the SESSION property exists as the expected nested array.
     */
    private static function ensure_session_structure(): void {
        global $SESSION;

        if (!isset($SESSION->{self::SESSION_KEY}) || !is_array($SESSION->{self::SESSION_KEY})) {
            $SESSION->{self::SESSION_KEY} = [];
        }
    }
}
