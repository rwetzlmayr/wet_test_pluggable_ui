<?php

$plugin['version'] = '0.1';
$plugin['author'] = 'Robert Wetzlmayr';
$plugin['author_uri'] = 'http://wetzlmayr.com/';
$plugin['description'] = 'Various test for Textpattern\'s pluggable_ui hooks';
$plugin['type'] = 3;

if (!defined('txpinterface'))
    @include_once('zem_tpl.php');

if (0) {
?>
# --- BEGIN PLUGIN HELP ---

h3. Various tests for Textpattern's pluggable_ui hooks

*wet_test_pluggable_ui* is a plugin for "Textpattern CMS":http://textpattern.com/ which aids during the development of the core by responding to various 'pluggable_ui' hooks.

h4. usage:

# Textpattern 4.5+ is required.

h4. Licence and Disclaimer

This plug-in is released under the Gnu General Public Licence.

# --- END PLUGIN HELP ---

<?php
}

# --- BEGIN PLUGIN CODE ---

class wet_pluggable_ui
{
    // An array of 'event' => ['step', 'step',...] hooks we want to listen to.
    var $events = array(
        'article_ui' => array(
            'sort_display',
            'markup',
            'override',
            'extend_col_1',
            'sidehelp',
            'title',
            'author',
            'url_title','custom_fields',
            'description',
            'keywords',
            'article_image',
            'recent_articles',
            'body',
            'excerpt',
            'view',
            'status',
            'section',
            'categories',
            'annotate_invite',
            'timestamp',
            'expires',
        )
    );

    public function __construct()
    {
        foreach ($this->events as $event => $steps) {
            foreach ($steps as $step) {
                register_callback(array('wet_pluggable_ui', 'render'), $event, $step);
            }
        }
    }

    public static function render($event, $step, $default)
    {
        global $app_mode;
        if ($app_mode == 'async') {
            $background_color = '#FFC0CB';
        } else {
            $background_color = '#CC0000';
        }

        return n .
        graf(__FUNCTION__ . ": $event.$step", " style=color:white;background-color:$background_color") . n .
        $default;
    }
}

new wet_pluggable_ui();

# --- END PLUGIN CODE ---
