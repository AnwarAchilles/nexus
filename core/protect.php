<?php
# Nexus version - 0.0.1
# Author: Anwar Achilles | hudorianwar07@gmail.com

define('NEXUS_PROTECT', '@{{ KEY }}');

eval("?>".base64_decode('@{{ PROTECT-UNLOCK }}'));

eval('?>'.base64_decode('@{{ PROTECT-LOADER }}'));

$GLOBALS['NEXUS_APP']::run();