<!--  https://ipinfo.io -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('layout/head'); ?>

<div class="wrapper">

    <div id="content">
        <?php $this->load->view('layout/header'); ?>
        <?php $this->load->view('drop/dashboard'); ?>
    </div>
    <div class="overlay"></div>
</div>

<!-- Popper.JS -->
<script src="<?php echo base_url('assets/bootstrap/js/popper.min.js'); ?>"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="<?php echo base_url('assets/bootstrap/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<style>
    @import url(<?php echo base_url('assets/css/mydashboard.css') ?>);
    #content{
        width: 100%;
    }
    
</style>