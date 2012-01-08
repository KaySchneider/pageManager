<?php

/*
 * This pre Filter parse the signed request from
 * facebook!
 * The signed request will be "saved" in the registry!
 * So you can access it every time in the code
 */

class signedRequest {

    public function execute(Request $request) {
     
    }

    private function setParamsFromRequest($parsedRequest) {
        
        $reg = registry::getInstance();
        if (isset($parsedRequest['user_id']) && !empty($parsedRequest['user_id'])) {
            $reg->setFacebookUserId($parsedRequest['user_id']);
        }
        if (isset($parsedRequest['user']['locale']) && !empty($parsedRequest['user']['locale'])) {
            $reg->setUserLocale($parsedRequest['user']['locale']);
        }
        if (isset($parsedRequest['user']['locale']) && !empty($parsedRequest['user']['locale'])) {
            $reg->setUserLocale($parsedRequest['user']['locale']);
        }
        if (isset($parsedRequest['oauth_token']) ) {
            $AUTHORIZED = true;
        }
        if (isset($parsedRequest['page']) && is_array($parsedRequest['page'])) {
            $SEITENTYP = "T"; // Seitenaufruf in einer Fanpage

            if ($parsedRequest['page']['liked'] == 1) {
                $PAGE_ISFAN = true;
            }
            if ($parsedRequest['page']['admin'] == 1) {
                $PAGE_ISADMIN = true;
            }
        } elseif (is_array($parsedRequest)) {
            $SEITENTYP = "A"; // Seitenaufruf in einer App
        } else {
            $SEITENTYP = "D"; // Direktaufruf ohne Facebook
        }
    }

    private function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

}

?>
