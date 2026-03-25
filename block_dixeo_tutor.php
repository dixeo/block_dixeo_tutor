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
 * Block class definition for the Dixeo Student Tutor.
 *
 * @package    block_dixeo_tutor
 * @copyright  2025 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_dixeo_tutor extends block_base {
    /**
     * Returns the list of module types where the tutor should not be displayed.
     * Reads from plugin settings, falling back to default values.
     *
     * @return array List of module names to exclude.
     */
    protected function get_excluded_modules(): array {
        $setting = get_config('block_dixeo_tutor', 'excludedmodules');
        if ($setting === false || $setting === '') {
            return ['quiz', 'simplequiz2'];
        }
        return array_map('trim', explode(',', $setting));
    }

    /**
     * Initialize the block with its title and basic settings.
     *
     * @return void
     */
    public function init(): void {
        $this->title = get_string('pluginname', 'block_dixeo_tutor');
    }

    /**
     * Generate the content for this block.
     *
     * Renders the tutor interface if the user has appropriate permissions
     * and is not on an excluded page type. Returns cached content if already generated.
     *
     * @return stdClass The block content object with text and footer properties
     */
    public function get_content(): \stdClass {
        global $PAGE, $USER, $OUTPUT;

        // Return cached content if already generated.
        if ($this->content !== null) {
            return $this->content;
        }

        // Initialize empty content structure.
        $this->content = (object)[];
        $this->content->text = '';
        $this->content->footer = '';
        $courseid = $PAGE->course->id;

        // Check if user has permission to use the tutor.
        if (!has_capability('block/dixeo_tutor:talktotutor', \context_course::instance($courseid))) {
            $this->content->text = $OUTPUT->notification(get_string('notenrolled', 'block_dixeo_tutor'), 'info');
            return $this->content;
        }

        // Hide tutor on excluded module pages.
        if ($this->is_current_page_excluded()) {
            return $this->content;
        }

        // Do not display the block if the user is in editing mode.
        if ($PAGE->user_is_editing()) {
            $this->content->text = get_string('editingmode', 'block_dixeo_tutor');
            return $this->content;
        }

        // Note: Conversations are created automatically when user sends first message.
        // No need to pre-create anything with Response API architecture.

        // Render the tutor interface and initialize JavaScript.
        $this->content->text = $OUTPUT->render_from_template('block_dixeo_tutor/tutor', []);
        $displaymode = get_config('block_dixeo_tutor', 'displaymode');
        if ($displaymode === false) {
            $displaymode = 'popup';
        }
        $openTooltip = get_string('tooltip_open_tutor', 'block_dixeo_tutor');
        $hideTooltip = get_string('tooltip_hide_tutor', 'block_dixeo_tutor');
        $this->page->requires->js_call_amd('block_dixeo_tutor/tutor', 'init', [
            $courseid,
            $USER->id,
            $displaymode,
            $openTooltip,
            $hideTooltip
        ]);
        return $this->content;
    }

    /**
     * Check if the current page should exclude the tutor.
     *
     * Determines whether the tutor should be hidden on the current page
     * based on the module type and exclusion rules.
     *
     * @return bool True if the tutor should be hidden, false otherwise
     */
    protected function is_current_page_excluded(): bool {
        global $PAGE;

        // Only check exclusions for module context pages.
        if ($PAGE->context->contextlevel !== CONTEXT_MODULE || empty($PAGE->cm)) {
            return false;
        }

        // Check if current module type is in the exclusion list.
        return in_array($PAGE->cm->modname, $this->get_excluded_modules());
    }

    /**
     * Define where this block can be displayed.
     *
     * Specifies that this block is only available in course contexts,
     * as it requires course content to function properly.
     *
     * @return array Array of applicable formats
     */
    public function applicable_formats(): array {
        return ['course' => true];
    }

    /**
     * Determine if multiple instances of this block are allowed.
     *
     * Only one tutor instance per course is needed and recommended
     * to avoid confusion and resource duplication.
     *
     * @return bool False to prevent multiple instances
     */
    public function instance_allow_multiple(): bool {
        return false;
    }

    /**
     * Indicate that this block has a configuration page.
     *
     * @return bool True to enable the settings link in the admin panel.
     */
    public function has_config(): bool {
        return true;
    }

    /**
     * Determine if the block header should be hidden.
     *
     * The tutor interface provides its own visual identity,
     * so the standard block header is not needed.
     *
     * @return bool True to hide the block header
     */
    public function hide_header(): bool {
        global $PAGE;
        return !$PAGE->user_is_editing();
    }

    /**
     * Handle the creation of a new block instance.
     *
     * This method is called when the block is added to a course.
     * It configures the block settings (display on all pages, weight, etc.).
     *
     * @return bool True on success
     */
    public function instance_create(): bool {
        global $DB;

        // Update the block.
        $bi = $DB->get_record('block_instances', ['id' => $this->instance->id]);
        $bi->showinsubcontexts = 1;
        $bi->pagetypepattern = '*';
        $bi->defaultweight = 5;
        $DB->update_record('block_instances', $bi);

        // Note: With Response API architecture, conversations are created automatically
        // when users send their first message. No pre-creation needed.

        return true;
    }
}
