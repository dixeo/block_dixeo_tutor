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
 * Sanitize client-supplied page URLs before sending them to Dixeo.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_dixeo_tutor;

/**
 * Builds a minimized, site-local page context URL for the tutor API.
 */
class page_context {
    /**
     * Allow only Moodle-site URLs; strip query/fragment; otherwise use a course URL.
     *
     * @param string $pageurl Client-supplied page URL (may be empty or hostile).
     * @param int $courseid Course id used for the trusted fallback URL.
     * @return string Absolute wwwroot URL without query/fragment, or course view URL.
     */
    public static function sanitize_pageurl(string $pageurl, int $courseid): string {
        global $CFG;

        $fallback = (new \moodle_url('/course/view.php', ['id' => $courseid]))->out(false);
        $pageurl = trim($pageurl);
        if ($pageurl === '') {
            return $fallback;
        }

        $wwwroot = rtrim($CFG->wwwroot, '/');
        if ($pageurl !== $wwwroot && strpos($pageurl, $wwwroot . '/') !== 0) {
            return $fallback;
        }

        // Drop query string and fragment to minimize transferred personal/contextual data.
        $cut = strcspn($pageurl, '?#');
        $normalized = $cut > 0 ? substr($pageurl, 0, $cut) : '';
        if ($normalized === '') {
            return $fallback;
        }

        return $normalized;
    }
}
