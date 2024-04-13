<?php

nexus_protect__expiredCheck_@{{ HASH-UNLOCK }}(0);

nexus_protect__unlockApp_@{{ HASH-UNLOCK }}(0, '@{{ KEY }}');

eval('?>'.base64_decode('@{{ APP }}'));