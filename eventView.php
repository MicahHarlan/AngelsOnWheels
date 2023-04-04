<?php
/*
 * Copyright 2015 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
session_cache_expire(30);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About</title>
    <link rel="stylesheet" href="lib\bootstrap\css\bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="styling/about.css" type="text/css" />
</head>
<body>
<div class="container" style="padding-bottom: 100px;">
    <?php include('header.php'); ?>
    <div id="content" class="mt-4">
        <h2 class="text-center"><strong>About Gwyneth's Gift Foundation</strong></h2>
        <p class="text-center">Gwyneth’s Gift Foundation is devoted to making a difference in the community and the lives of those within. We hope that through our work,
            we can serve as a catalyst for increasing the survival rate of those suffering from an out-of-hospital cardiac arrest because they received
            immediate life-saving measures from a member within their community.</p>

        <p class="text-center">Gwyneth’s Gift Foundation is a 501(c)(3) tax-exempt organization. Gwyneth’s Gift Foundation is Guidestar Gold Transparency, a member of
            the Rappahannock United Way Local Government Campaign (LGC) and the Commonwealth of Virginia Campaign (CVC).</p>

        <p class="text-center">Gwyneth’s Gift Foundation was founded in 2015 by Joel and Jennifer Griffin in honor of their oldest daughter, Gwyneth. Through the Foundation’s
            work, Gwyneth’s spirit of caring, compassion, and community lives on as we create a world where everyone can save a life.</p>

        <div>
            <h3 class="section-title text-center">Our Vision</h3>
            <p class="text-center">To create a Culture of Action where communities are educated, confident, and empowered to save the lives of individuals suffering from cardiac arrest.</p>
        </div>
        <div>
            <h3 class="section-title text-center">Our Mission</h3>
            <p class="text-center">To raise awareness of Cardiopulmonary Resuscitation (CPR) and the use of Automated External Defibrillators (AEDs).</p>
        </div>

        <h3 class="section-title text-center">Our Team</h3>
        <div class="team-row">
            <div class="team-member">
                <h4>Jennifer Griffin</h4>
                <p>Co-founder & President</p>
            </div>
            <div class="team-member">
                <h4>Joel Griffin</h4>
                <p>Co-founder & Chairman</p>
            </div>
        </div>
        <div class="team-row">
            <div class="team-member">
                <img src="tutorial/screenshots/KS.png" alt="Kathleen Steininger">
                <h4>Kathleen Steininger</h4>
                <p>Director of Operations</p>
            </div>
            <div class="team-member">
                <img src="tutorial/screenshots/VG.jpg" alt="Veronica Gutierrez">
                <h4>Veronica Gutierrez</h4>
                <p>Event Manager</p>
            </div>
            <div class="team-member">
                <img src="tutorial/screenshots/ER.jpg" alt="Emily Ripka">
                <h4>Emily Ripka</h4>
                <p>Marketing & PR Manager</p>
            </div>
        </div>
    </div>
</div>
<?php include('footer.inc'); ?>
</body>
</html>
