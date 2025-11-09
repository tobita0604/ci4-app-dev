<script type="text/javascript" src="<?php echo base_url(); ?>js/ip_setting.js"></script>

<style>
    td {
        background: white;
    }

    table.border th {
        color: #FFF;
        background: #77cc6d;
        border: 1px solid #000;
        padding: 3px 5px;
    }

    table.border th,
    td {
        vertical-align: middle;
    }

    .title_c {
        margin: 0 auto;
        margin-bottom: 1em;
        width: 900px;
        clear: both;
        text-align: right;
    }

    table.con th {
        border-top: none !important;
        border-left: none !important;
        width: 10%;
    }

    table.con td {
        border-right: none !important;
        border-top: none !important;
        width: 90%;
        padding: 3px !important;

    }

    table.con {
        width: 100%;
    }

    .btn {
        margin-top: 15px;
        font-size: 16px;
        padding-left: 5px;
        padding-right: 5px;
    }
</style>

<p style="border-bottom:2px solid #ccc;"></p>
<div style="width: 1150px; margin: 0 auto; position: relative; clear: both;">
    <div class="title-header">
        <div>
            <form action="<?php echo base_url(); ?>IpSetting" name="back_menu" method="post">
                <h1>許可IP登録</h1>
                <input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="戻る" onclick="backMenu()">
                <?php require(APPPATH . "views/element/csrf_input.php"); ?>
            </form>
        </div>
        <hr>
        </hr>
    </div>
    <!-- CONTENT START -->
    <div id="main-wrapper">
        <div align="center">
            <div style="clear:both"></div>
            <table class="border" id="table_rate" style="width: 900px; margin: 0 auto;">
                <form action="<?php echo base_url(); ?>IpSetting/save" method="post" id="ip_form">
                    <?php require(APPPATH . "views/element/csrf_input.php"); ?>
                    <tr>
                        <th>名称</th>
                        <td style="position:relative">
                            <input type="text" name="data[address_name]" style="width:98%; box-sizing:border-box; margin-left: 5px; margin-right: 5px;" value="<?= !empty($data['address_name']) ? $data['address_name'] : '' ?>">
                        </td>
                        <?= form_error('data[address_name]'); ?>
                    </tr>
                    <tr>
                        <th>IPアドレス</th>
                        <td style="position:relative">
                            <input type="text" name="data[ip_address]" style="width:98%; box-sizing:border-box; margin-left: 5px; margin-right: 5px;" value="<?= !empty($data['ip_address']) ? $data['ip_address'] : '' ?>">
                        </td>
                        <?= form_error('data[ip_address]'); ?>
                    </tr>
                </form>
            </table>
            <div>
                <button class="btn btn-save" type="button">登録</button>
            </div>
        </div>
    </div>
    <!-- CONTENT END -->