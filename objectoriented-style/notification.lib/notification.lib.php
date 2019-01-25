<?php

abstract class NotificationTrigger
{
    const ThisPage = 1;
    const NextPage = 2;
    const OnCapture = 3;
}

abstract class NotificationAnchor
{
    const TopLeft = 1;
    const TopRight = 2;
    const BottomLeft = 3;
    const BottomRight = 4;
    const Top = 5;
    const TopFull = 6;
    const Bottom = 7;
    const BottomFull = 8;
    const Center = 9;
}

abstract class NotificationIcon
{
    const Asterisk = 1;
    const Error = 2;
    const Exclamation = 3;
    const Hand = 4;
    const Information = 5;
    const Question = 6;
    const Stop = 7;
    const Warning = 8;
}

abstract class NotificationButtons
{
    const OK = 1;
    const Cancel = 2;
    const Submit = 3;
    const Abort = 4;
    const Yes = 5;
    const No = 6;
    const Back = 7;
    const Next = 8;
    const Finish = 9;
}

abstract class NotificationEntry
{
    const Fade = 1;

    const Pop = 2;
    const Dim = 3;

    const SlideLeft = 4;
    const SlideRight = 5;
    const SlideTop = 6;
    const SlideBottom = 7;

    const BounceLeft = 8;
    const BounceRight = 9;
    const BounceTop = 10;
    const BounceBottom = 11;

    const FadeInSlideOutLeft = 12;
    const FadeInSlideOutRight = 13;
    const FadeInSlideOutTop = 14;
    const FadeInSlideOutBottom = 15;

    const SlideInLeftFadeOut = 16;
    const SlideInRightFadeOut = 17;
    const SlideInTopFadeOut = 18;
    const SlideInBottomFadeOut = 19;

    const FadeInBounceOutLeft = 20;
    const FadeInBounceOutRight = 21;
    const FadeInBounceOutTop = 22;
    const FadeInBounceOutBottom = 23;

    const BounceInLeftFadeOut = 24;
    const BounceInRightFadeOut = 25;
    const BounceInTopFadeOut = 26;
    const BounceInBottomFadeOut = 27;
}

class Notification
{
    private $notificationAnchor;
    private $notificationAnimation;


    public function __construct()
    {

    }

    public function SetEntry()
    {

    }

    public function SetAnimation()
    {

    }

    public function SetEntry()
    {

    }

    public function SetMessage()
    {

    }

    public function SetIcon()
    {

    }

    public function SetButtons()
    {

    }

    public function SetTrigger()
    {

    }

    public function Launch()
    {

    }

    public static function Capture()
    {

    }
}

?>