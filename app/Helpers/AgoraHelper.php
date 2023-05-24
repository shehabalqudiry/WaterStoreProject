<?php

namespace App\Helpers;

// use Willywes\AgoraSDK\RtcTokenBuilder;
use App\Class\AgoraDynamicKey\RtcTokenBuilder2;

class AgoraHelper
{
    public static function GetToken($user_id, $channelName)
    {
        $appID = env("AGORA_APP_ID");
        $appCertificate = env("AGORA_APP_CERTIFICATE");
        $channelName = $channelName;
        $uid = $user_id;
        $uidStr = ($user_id) . '';
        $role = "ROLE_PUBLISHER";
        $expireTimeInSeconds = 500000;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        return RtcTokenBuilder2::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
    }
}
