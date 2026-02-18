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
 * Privacy provider for the Dixeo Tutor block.
 *
 * Declares external data sent to the Dixeo API. No personal data
 * is stored locally in Moodle by this plugin.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_dixeo_tutor\privacy;

use core_privacy\local\metadata\collection;

/**
 * Privacy metadata provider for block_dixeo_tutor.
 *
 * This plugin sends user data to an external Dixeo API service
 * but does not store any personal data locally in the Moodle database.
 */
class provider implements \core_privacy\local\metadata\provider {

    /**
     * Describe the type of personal data stored or transmitted by this plugin.
     *
     * @param collection $collection The privacy metadata collection.
     * @return collection The updated collection.
     */
    public static function get_metadata(collection $collection): collection {
        $collection->add_external_location_link(
            'dixeo_api',
            [
                'userid' => 'privacy:metadata:userid',
                'courseid' => 'privacy:metadata:courseid',
                'message' => 'privacy:metadata:message',
                'pageurl' => 'privacy:metadata:pageurl',
            ],
            'privacy:metadata:externalpurpose'
        );

        return $collection;
    }
}
