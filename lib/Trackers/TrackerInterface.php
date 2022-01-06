<?php

namespace Ttshop\Express\Trackers;

use Ttshop\Express\Waybill;

interface TrackerInterface
{
    /**
     * Track a willbay and return traces
     *
     * @param Waybill $waybill
     * @return void
     * @throws \Ttshop\Express\Exceptions\TrackingException
     */
    public function track(Waybill $waybill);

    static public function getSupportedExpresses();

    static public function isSupported($express);

    static public function getExpressCode($expressName);
}
