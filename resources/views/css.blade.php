<?php
//Setup our colour variables.
$primaryColor = setting('colours.primary');
$secondaryColor = setting('colours.secondary');
$tertiaryColor = setting('colours.tertiary');
?>

<style>
/*=========== BEGIN PRIMARY COLOR ============*/
a {color: <?= $primaryColor; ?>;}
a:hover {color: <?= $primaryColor; ?>;}
.borderB {border-color: <?= $secondaryColor; ?>;}
.customSwalBtn {border-color: <?= $primaryColor; ?>; color: <?= $primaryColor; ?>;}
.customSwalBtn:before,
.customSwalBtn:after { background: <?= $primaryColor; ?>;}
.customSwalBtn:before{background: transparent;}
.swal2-icon.swal2-success { border-color: <?= $primaryColor; ?>;}
.swal2-icon.swal2-success .swal2-success-ring { border-color: <?= $primaryColor; ?>;}
.swal2-icon.swal2-success [class^='swal2-success-line'] { background: <?= $primaryColor; ?>;}
.btn-wrap {border-color: <?= $primaryColor; ?>; color: <?= $primaryColor; ?>;}
.btn-wrap:before,
.btn-wrap:after { background: <?= $primaryColor; ?>;}
.btn-wrap:before{ background: transparent;}
.btncurtainD:before,
.btncurtainD:after { background: <?= $primaryColor; ?>;}
.small-btn,
.big-btn{ background: rgba(0, 0, 0, .2); color: #ffffff; }
.logo-wrap {color: <?= $primaryColor; ?>;}
.logo-wrap a,
.logo-wrap a:hover,
.logo-wrap a:focus {color: <?= $primaryColor; ?>;}
.nav-container ul li a {color: <?= $primaryColor; ?>;}
.nav-container ul li > a:hover, 
.nav-container ul li.active > a{ opacity: .7; }
.prayertime-top-content { background: <?= $primaryColor; ?>;}
.prayer-times,
.prayer-time-content,
.staff-management-item-wrap:hover .icon-wrap { border-color: <?= $primaryColor; ?>;}
.events-item-wrap .events-bottom-content .event-date-wrap .event-month{color: <?= $primaryColor; ?>;}
.events-item-wrap .events-bottom-content .event-title h4 {color: <?= $primaryColor; ?>;}
.events-item-wrap .events-bottom-content .event-title h4 a {color: <?= $primaryColor; ?>;}
.blog-single-banner .blog-meta a.author-name:hover {color: <?= $primaryColor; ?>;}
.blog-categories ul li a,
#eventsTabs .ui-tabs-nav .ui-tabs-anchor,
#eventsTabs .ui-tabs-nav li.ui-state-active a {color: <?= $primaryColor; ?>;}
#eventsTabs .ui-tabs-nav .ui-tabs-anchor
.social-share .social-share-wrap a {color: <?= $primaryColor; ?>;}
.quick-donate-wrap { border-color: <?= $primaryColor; ?>;}
.quick-donate-content-wrap,
.contact-form-wrap .view-more-wrap .btn-wrap:hover,
.payment-form-wrap .btn-wrap.small-btn:hover,
.serial-number,
.gift-aid-btn{ background: <?= $primaryColor; ?>;}
.quick-donate-btn { background-color: <?= $primaryColor; ?>;}
.quick-donate-content .btn-wrap:before,
.quick-donate-content .btn-wrap:after{background: <?= $primaryColor; ?>; opacity: .8;}
.quick-donate-content .btn-wrap:before{background: transparent;}
.campaign-content.one-campaign ul li .campaign-item-wrap{background: <?= $primaryColor; ?>;}
#homePrayertimeTabs .ui-tabs-nav li.ui-state-active a {color: <?= $primaryColor; ?>;}
/*=========== END PRIMARY COLOR ============*/

/*=========== BEGIN SECONDARY COLOR ============*/
.events-item-wrap .events-bottom-content .event-date-wrap .event-date {color: <?= $secondaryColor; ?>}
.impact-item-wrap .impact-circle,
.salahtime-filter-row,
.grey-line { border-color: <?= $secondaryColor; ?>;}
.impact-circle span,
.total-amount-row .total-amount .total-txt {color: <?= $secondaryColor; ?>}
.footer-section .col-sm-3.footer-column span,
.footer-section .col-sm-3.footer-column span a {color: <?= $secondaryColor; ?>}
.footer-social-media ul li a {color: <?= $secondaryColor; ?>}
.copyright .col-sm-4 > a {color: <?= $secondaryColor; ?>}

/*=========== END SECONDARY COLOR ============*/
/*=========== BEGIN TERTIARY COLOR ============*/
.footer-section .footer-column address,
.footer-section .footer-column span,
.footer-section .footer-column span a {color: <?= $tertiaryColor; ?>;}
.copyright {color: <?= $tertiaryColor; ?>;}
.copyright a {color: <?= $tertiaryColor; ?>;}
/*=========== END TERTIARY COLOR ============*/



@media only screen and (max-width:991px){
	.phone-nav span { background: <?= $primaryColor; ?>;}
	.main-nav-wrap { border-color: <?= $primaryColor; ?>;}
	.nav-container ul li > a:hover,
    .nav-container ul li.active > a{ background: <?= $primaryColor; ?>; opacity: 1;}
}
</style>


