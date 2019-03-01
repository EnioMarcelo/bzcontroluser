<style>

    /* EFEITO FADE IN */
    @keyframes fadeIn {
        0% {
            transform: scale(1);
            opacity: 0;
        }
    }

    /* MODAL */
    .bz_modal{
        display: block;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        z-index: 98;

    }

    .bz_modal_box{
        z-index: 99;
        display: flex;
        position: relative;
        width: 90%;
        max-width: 90%;
        height: 90%;
        max-width: 90%;
        /*background: rgba(255,255,255,0.3);*/
        margin: 3% auto;
        /*padding: 10px;*/
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;

        animation-duration: 1s;
        animation-name: fadeIn;

        


    }

    .bz_modal_box_close{
        position: absolute;
        top: -12px;
        right: -12px;
        font-size: 0.9em;
        font-weight: bold;
        padding: 7px 11px;
        cursor: pointer;
        background: #000;
        border: 2px double #ccc;
        border-radius: 50%;
        -moz-border-radius:  50%;
        -webkit-border-radius:  50%;

    }

    .bz_modal_box_close:hover{
        background: #999999;
        color: black;
    }

    .bz_modal_box .header{
        padding: 0px;
        color: #fff;
        text-align: center;
        border-radius: 3px 3px 0 0;
        -moz-border-radius: 3px 3px 0 0;
        -webkit-border-radius: 3px 3px 0 0;
    }

    .bz_modal_box .header p{
        font-weight: 500;
        font-size: 1.5em;
        text-shadow: 1px 1px 0 #555;
    }

    .bz_modal_box #bz_modal_content{
        padding: 0px;
        background: #fff;
        border-radius: 0 0 3px 3px;
        -moz-border-radius: 0 0 3px 3px;
        -webkit-border-radius: 0 0 3px 3px;
    }

    #bz_modal_content {
        width: 100%;
        text-align: center;
        box-sizing: border-box;

    }
    #bz_modal_content *{
        box-sizing: border-box; 
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }

    #bz_modal_content img, #bz_modal_content iframe{
        max-width: 100%;
        width: 100%;
        height: 100%;
        max-height: 100%;
    }

    /* CORES */
    .color_blue{color: #0E96E5;}
    .color_green{color: #56b748;}
    .color_yellow{color: #F2AA27;}
    .color_red{color: #F43E33;}
    .color_purple{color: #7551CD;}
    .color_pink{color: #B873CD;}

    .bg_blue{background-color: #0E96E5;}
    .bg_green{background-color: #56b748;}
    .bg_yellow{background-color: #F2AA27;}
    .bg_red{background-color: #F43E33;}
    .bg_purple{background-color: #7551CD;}
    .bg_pink{background-color: #B873CD;}

    #modal-btn-icon{ display:none; }

    #bz_modal_content iframe {
        display: flex;
        height: 100%;
        max-height: 100%;

    }

</style>



<!--MODAL-->
<div id="modal-btn-icon" class="bz_modal">
    <div class="bz_modal_box">

        <div class="header bg_yellow">
            <span class="bz_modal_box_close j_btn_modal_box_close">X</span>
        </div>

        <div id="bz_modal_content">
            <iframe src="<?= site_url('menu/icons'); ?>" id="info" class="iframe" name="info" seamless="" height="100%" width="100%"></iframe>
        </div>


    </div>
</div>




<script>
    $(function () {
        //MODAL CLOSE
        $('.j_btn_modal_box_close').click(function () {
            $('.bz_modal').fadeOut(100);
        });

        //MODAL OPEN
        $('.j-btn-menu-icon').click(function () {
            $('.bz_modal').css('display', 'block');
        });
    });
</script>