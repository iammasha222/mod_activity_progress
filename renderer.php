<?php 

defined('MOODLE_INTERNAL') || die();

class block_activity_progress_renderer extends plugin_renderer_base {

    public function render_activity_progress(array $data): string {
        return $this->render_from_template('block_activity_progress/block_activity_progress', $data);
    }

}