<?php

/**
 * Activity progress block
 */

defined('MOODLE_INTERNAL') || die();

class block_activity_progress extends block_base {
    /**
     * Initialises this block instance. 
     */
    public function init(){
        $this->title = get_string('pluginname', 'block_activity_progress');
    }

    /**
     * Returns the content for this block.
     *
     * @return stdClass
     */
    public function get_content(){
        global $COURSE, $CFG;

        if($this->content !== null){
            return $this->content;
        }

        require_once($CFG->dirroot . '/user/lib.php');

        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->footer = '';

        require_once($CFG->libdir . '/completionlib.php');
        $completion = new completion_info($COURSE);;

        if(!$completion->is_enabled()){
            $this->content->text = get_string('completionnotenabled', 'block_activity_progress');
            return $this->content;
        }

        // returns an object of class course_modinfo, that contains info about each activity
        $modinfo = get_fast_modinfo($COURSE);
        $activities = [];
        $completedCount = 0;
        $totalCount = 0;

        // Going through all the activities (course modules).
        foreach ($modinfo->get_cms() as $cm){
            if(!$cm->uservisible || !$completion->is_enabled($cm)){
                continue;
            }

            $completiondata = $completion->get_data($cm, true, $USER->id);
            $isCompleted = $completiondata->completionstate == COMPLETION_COMPLETE;

            $activityProgress = $isCompleted ? 100 : 0;

            $activities[] = [
                'name' => $cm->get_formatted_content(),
                'completed' => $isCompleted,
                'progress' => $activityProgress
            ];

            $totalCount++;
            if($isCompleted){
                $completedCount++;
            }
        } 

        // total course progress
        $progressPercent = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;

        $renderer = $this->page->get_renderer('block_activity_progress');
        $this->content->text = $renderer->render_activity_progress([
            'activities' => $activities,
            'progress' => $progressPercent
        ]);

        return $this->content;
    }

    /**
     * Where this block can be added.
     *
     * @return array
     */
    public function applicable_formats() {
        return [
            'course-view' => true, //in course
            'site-index' => true, // main page
            'my' => true, //dashboard
        ];
    }

    /* 
     * Allow the block to have a configuration page.
     * 
     * @return bool
    */
    public function has_config(){
        return true;
    }

    /**
     * Whether multiple instance of this block can be added to a page.
     *
     * @return bool
     */
    public function instance_allow_multiple()
    {
        return false;
    }
}