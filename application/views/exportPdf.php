<!doctype html>
<html lang="pt-br">
    <head>

        <style>

            @page{
                margin: 70px 0;
                /*margin-bottom: 35px;*/
            }

            body{
                margin: 0;
                padding: 0;
                margin-top: -25px;
                margin-left:10px;
                margin-right:10px;
                font-family: "Open Sans", sans-serif;
            }


            .header{
                position: fixed;
                top:-80px;
                left: 0;
                right: 0;
                width: 100%;
                text-align: left;
                background: #ffffff;
                padding: 10px;
                margin-left:10px;
                margin-right:10px;
                border-bottom: 1px solid #ccc;
            }

            .header-title{
                font-size: 1.5em;
            }

            .footer{
                position: fixed;
                bottom: 0px;
                left: 0;
                margin-top: -20px;
                margin-left:10px;
                margin-right:15px;
                width: 100%;
                padding: 5px 10px 10px 10px;
                text-align: right;
                background: #FFFFFF;
                font-size: 0.5em;
            }

            .footer .page:after{
                content: counter(page);
            }


            table{
                width: 100%;
                /*border: 1px solid #555555;*/
                margin: 0;
                padding: 0;
            }

            th{
                text-transform: uppercase;
            }

            table, th, td{

                border: 1px solid #555555;
                border-collapse: collapse;
                padding: 7px;
                font-size:12px;
            }

            tr:nth-child(2n+0){
                background: #eeeeee;
            }



        </style>



    </head>
    <body>


        <div class="header">
            <?= $_title; ?>
        </div>


        <div class="footer">
            <span class="page">Página: </span>
        </div>

        <?= $_table_td; ?>


    </body>
</html>






