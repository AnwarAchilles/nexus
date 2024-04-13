<?php

function nexus_protect__expiredCheck_@{{ HASH }}( $index ) {
  if (defined('NEXUS_PROTECT')) {
    $SALT = [];
    $SALT[0] = '@{{ SALT-1 }}';
    $SALT[1] = '@{{ SALT-2 }}';
    $KEY = explode('__NEXUS__', NEXUS_PROTECT)[$index];
    if (explode('|||', $KEY)[0] !== crypt(date('Ym'), $SALT[$index])) {
      echo 'NEXUS ALREADY EXPIRED';
      die; exit;
    }
  }
}

function nexus_protect__unlockApp_@{{ HASH }}( $index, $inKey ) {
  if (defined('NEXUS_PROTECT')) {
    $KEY = explode('__NEXUS__', NEXUS_PROTECT)[$index];
    if (explode('|||', $KEY)[1] !== explode('|||', $inKey)[1]) {
      echo 'NEXUS_KEY : FAILED';
      die; exit;
    }
  }
}